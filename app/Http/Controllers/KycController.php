<?php

namespace App\Http\Controllers;

use App\Models\Loan;
use App\Models\Member;
use App\Models\KycVerification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class KycController extends Controller
{
    private string $apiKey;
    private string $baseUrl = 'https://verification.didit.me';

    public function __construct()
    {
        // x-api-key is the client_secret from .env
        $this->apiKey = config('services.didit.client_secret');
    }

    /**
     * Show KYC status page — lists latest 2 verifications for this member.
     */
    public function show(Request $request, $tenant, $member_id)
    {
        $member        = Member::findOrFail($member_id);
        $verifications = KycVerification::where('member_id', $member_id)
                            ->latest()->limit(2)->get();
        $loans         = Loan::where('borrower_id', $member_id)->get();

        return view('backend.admin.member.kyc', compact('member', 'verifications', 'loans'));
    }

    /**
     * Full paginated verification history for a member.
     */
    public function history(Request $request, $tenant, $member_id)
    {
        $member        = Member::findOrFail($member_id);
        $verifications = KycVerification::where('member_id', $member_id)
                            ->latest()->paginate(15);

        return view('backend.admin.member.kyc_history', compact('member', 'verifications'));
    }

    /**
     * Submit a verification request to Didit and save the response.
     */
    public function submit(Request $request, $tenant, $member_id)
    {
        $member = Member::findOrFail($member_id);
        $type   = $request->input('type');
        $loanId = $request->input('loan_id') ?: null;

        $vendorData = 'member_' . $member->id . ($loanId ? '_loan_' . $loanId : '');

        try {
            [$status, $requestId, $decision, $responseData] = match ($type) {
                'id_verification'  => $this->submitIdVerification($request, $vendorData),
                'poa'              => $this->submitPoa($request, $vendorData),
                'passive_liveness' => $this->submitPassiveLiveness($request, $vendorData),
                'face_search'      => $this->submitFaceSearch($request, $vendorData),
                'age_estimation'   => $this->submitAgeEstimation($request, $vendorData),
                default            => throw new \InvalidArgumentException('Unknown type: ' . $type),
            };
        } catch (\Exception $e) {
            Log::error('Didit KYC error', ['error' => $e->getMessage()]);
            return back()->with('error', 'Verification failed: ' . $e->getMessage());
        }

        KycVerification::create([
            'member_id'               => $member->id,
            'loan_id'                 => $loanId,
            'type'                    => $type,
            'verification_request_id' => $requestId,
            'status'                  => $status,
            'decision'                => $decision,
            'response_data'           => $responseData,
            'vendor_data'             => $vendorData,
        ]);

        // Also update member's top-level kyc_status if this is an id_verification
        if ($type === 'id_verification') {
            $member->kyc_status = strtolower($decision ?? $status ?? 'pending');
            if (strtolower($member->kyc_status) === 'approved') {
                $member->kyc_verified_at = now();
            }
            $member->save();
        }

        return back()->with('success', 'Verification submitted. Status: ' . ($decision ?? $status));
    }

    // ─── Private helpers ────────────────────────────────────────────────────

    private function submitIdVerification(Request $request, string $vendorData): array
    {
        $request->validate([
            'front_image' => 'required|file|mimes:jpg,jpeg,png,webp,tiff',
            'back_image'  => 'nullable|file|mimes:jpg,jpeg,png,webp,tiff',
        ]);

        $http = $this->http()->attach('front_image', file_get_contents($request->file('front_image')->getRealPath()), $request->file('front_image')->getClientOriginalName());

        if ($request->hasFile('back_image')) {
            $http = $http->attach('back_image', file_get_contents($request->file('back_image')->getRealPath()), $request->file('back_image')->getClientOriginalName());
        }

        $response = $http
            ->attach('perform_document_liveness', $request->input('perform_document_liveness', 'false'))
            ->attach('save_api_request', 'true')
            ->attach('vendor_data', $vendorData)
            ->attach('expiration_date_not_detected_action', $request->input('expiration_date_not_detected_action', 'DECLINE'))
            ->attach('invalid_mrz_action', $request->input('invalid_mrz_action', 'DECLINE'))
            ->attach('inconsistent_data_action', $request->input('inconsistent_data_action', 'DECLINE'))
            ->attach('preferred_characters', $request->input('preferred_characters', 'latin'))
            ->post($this->baseUrl . '/v3/id-verification/');

        return $this->parseResponse($response);
    }

    private function submitPoa(Request $request, string $vendorData): array
    {
        $request->validate([
            'document' => 'required|file|mimes:pdf,jpg,jpeg,png,webp,tiff',
        ]);

        $response = $this->http()
            ->attach('document', file_get_contents($request->file('document')->getRealPath()), $request->file('document')->getClientOriginalName())
            ->attach('save_api_request', 'true')
            ->attach('vendor_data', $vendorData)
            ->attach('expected_first_name', $request->input('expected_first_name', ''))
            ->attach('expected_last_name', $request->input('expected_last_name', ''))
            ->attach('expected_address', $request->input('expected_address', ''))
            ->attach('expected_country', $request->input('expected_country', ''))
            ->attach('poa_name_mismatch_action', 'DECLINE')
            ->attach('poa_document_issues_action', 'DECLINE')
            ->attach('poa_document_authenticity_action', 'DECLINE')
            ->attach('poa_address_mismatch_action', 'DECLINE')
            ->post($this->baseUrl . '/v3/poa/');

        return $this->parseResponse($response);
    }

    private function submitPassiveLiveness(Request $request, string $vendorData): array
    {
        $request->validate([
            'user_image' => 'required|file|mimes:jpg,jpeg,png,webp,tiff',
        ]);

        $response = $this->http()
            ->attach('user_image', file_get_contents($request->file('user_image')->getRealPath()), $request->file('user_image')->getClientOriginalName())
            ->attach('save_api_request', 'true')
            ->attach('vendor_data', $vendorData)
            ->attach('face_liveness_score_decline_threshold', $request->input('face_liveness_score_decline_threshold', '30'))
            ->attach('rotate_image', 'false')
            ->post($this->baseUrl . '/v3/passive-liveness/');

        return $this->parseResponse($response);
    }

    private function submitFaceSearch(Request $request, string $vendorData): array
    {
        $request->validate([
            'user_image' => 'required|file|mimes:jpg,jpeg,png,webp,tiff',
        ]);

        $response = $this->http()
            ->attach('user_image', file_get_contents($request->file('user_image')->getRealPath()), $request->file('user_image')->getClientOriginalName())
            ->attach('search_type', $request->input('search_type', 'most_similar'))
            ->attach('save_api_request', 'true')
            ->attach('vendor_data', $vendorData)
            ->attach('rotate_image', 'false')
            ->post($this->baseUrl . '/v3/face-search/');

        return $this->parseResponse($response);
    }

    private function submitAgeEstimation(Request $request, string $vendorData): array
    {
        $request->validate([
            'user_image' => 'required|file|mimes:jpg,jpeg,png,webp,tiff',
        ]);

        $response = $this->http()
            ->attach('user_image', file_get_contents($request->file('user_image')->getRealPath()), $request->file('user_image')->getClientOriginalName())
            ->attach('face_liveness_score_decline_threshold', $request->input('face_liveness_score_decline_threshold', '30'))
            ->attach('age_estimation_decline_threshold', $request->input('age_estimation_decline_threshold', '18'))
            ->attach('save_api_request', 'true')
            ->attach('vendor_data', $vendorData)
            ->attach('rotate_image', 'false')
            ->post($this->baseUrl . '/v3/age-estimation/');

        return $this->parseResponse($response);
    }

    /**
     * Parse Didit response — extract request_id, status, decision, full data.
     * Didit returns status nested under the type key, e.g. data['age_estimation']['status'].
     */
    private function parseResponse($response): array
    {
        if (! $response->successful()) {
            Log::error('Didit API error', ['status' => $response->status(), 'body' => $response->body()]);
            throw new \RuntimeException('Didit API returned ' . $response->status() . ': ' . $response->body());
        }

        $data      = $response->json();
        $requestId = $data['request_id'] ?? $data['session_id'] ?? $data['id'] ?? null;

        // Try top-level status first, then look inside nested type keys
        $status = $data['status'] ?? null;
        if (! $status) {
            // The nested key matches the type name: age_estimation, id_verification, poa, etc.
            $nestedKeys = ['age_estimation', 'id_verification', 'poa', 'passive_liveness', 'face_search', 'liveness'];
            foreach ($nestedKeys as $key) {
                if (isset($data[$key]['status'])) {
                    $status = $data[$key]['status'];
                    break;
                }
            }
        }

        $decision = $data['decision'] ?? $data['result'] ?? $status;

        return [$status, $requestId, $decision, $data];
    }

    /**
     * Build a pre-configured HTTP client with x-api-key header.
     */
    private function http()
    {
        return Http::withOptions(['verify' => false])
            ->withHeaders(['x-api-key' => $this->apiKey])
            ->asMultipart();
    }

    /**
     * Webhook — kept for compatibility but not used by direct API flow.
     */
    public function webhook(Request $request)
    {
        $payload  = $request->json()->all();
        $memberId = $payload['vendor_data'] ?? null;
        $status   = $payload['status']      ?? null;

        Log::info('Didit webhook received', $payload);

        if ($memberId && $status) {
            $member = Member::find($memberId);
            if ($member) {
                $member->kyc_status = strtolower($status);
                if (strtolower($status) === 'approved') {
                    $member->kyc_verified_at = now();
                }
                $member->save();
            }
        }

        return response()->json(['ok' => true]);
    }
}
