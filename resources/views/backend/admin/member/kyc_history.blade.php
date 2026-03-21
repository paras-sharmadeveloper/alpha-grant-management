@extends('layouts.app')

@section('content')
<style>
    .vh-head  { background:#214942; color:#fff; padding:14px 20px; border-radius:6px 6px 0 0; display:flex; align-items:center; justify-content:space-between; font-family:"Poppins",sans-serif; font-size:14px; }
    .vh-body  { background:#fff; border:1px solid #ddd; border-top:none; border-radius:0 0 6px 6px; padding:20px; }
    .vh-table th { background:#214942; color:#fff; font-size:12px; font-weight:500; }
    .vh-table td { font-size:12px; vertical-align:middle; }
    .badge-Approved,.badge-approved { background:#27ae60; color:#fff; padding:2px 9px; border-radius:10px; font-size:11px; }
    .badge-Declined,.badge-declined { background:#e74c3c; color:#fff; padding:2px 9px; border-radius:10px; font-size:11px; }
    .badge-Review,.badge-review     { background:#f39c12; color:#fff; padding:2px 9px; border-radius:10px; font-size:11px; }
    .badge-pending,.badge-Unknown   { background:#aaa;    color:#fff; padding:2px 9px; border-radius:10px; font-size:11px; }
</style>

<div class="col-lg-12">
    <div style="max-width:1000px;margin:20px auto;">
        <div class="vh-head">
            <a href="{{ route('kyc.show', $member->id) }}" class="btn btn-sm"
               style="background:rgba(255,255,255,0.15);color:#fff;border:1px solid rgba(255,255,255,0.4);font-size:12px;">
                <i class="fas fa-arrow-left mr-1"></i> Back
            </a>
            <span style="flex:1;text-align:center;">
                KYC History — {{ $member->first_name }} {{ $member->last_name }}
            </span>
            <span style="width:70px;"></span>
        </div>

        <div class="vh-body">

            @if($verifications->isEmpty())
                <p class="text-muted" style="font-size:13px;">No verifications submitted yet.</p>
            @else
            <div class="table-responsive">
                <table class="table table-bordered vh-table">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Type</th>
                            <th>Loan</th>
                            <th>Request ID</th>
                            <th>Status</th>
                            <th>Result / Warnings</th>
                            <th>Vendor Data</th>
                            <th>Date</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($verifications as $v)
                        @php
                            $typeKey       = $v->type;
                            $nested        = $v->response_data[$typeKey] ?? null;
                            $warnings      = $nested['warnings'] ?? [];
                            $nestedStatus  = $nested['status'] ?? null;
                            $displayStatus = ucfirst(strtolower($nestedStatus ?? $v->status ?? 'Unknown'));
                            $extras = [];
                            if ($typeKey === 'age_estimation' && isset($nested['age_estimation'])) {
                                $extras[] = 'Age: ' . round($nested['age_estimation'], 1);
                            }
                            if (isset($nested['score']) && $nested['score'] !== null) {
                                $extras[] = 'Score: ' . $nested['score'];
                            }
                            if (isset($nested['method'])) {
                                $extras[] = 'Method: ' . $nested['method'];
                            }
                        @endphp
                        <tr>
                            <td>{{ $v->id }}</td>
                            <td>{{ str_replace('_', ' ', ucfirst($v->type)) }}</td>
                            <td>{{ $v->loan_id ? '#'.$v->loan_id : '—' }}</td>
                            <td style="max-width:140px;word-break:break-all;color:#888;">{{ $v->verification_request_id ?? '—' }}</td>
                            <td><span class="badge-{{ $displayStatus }}">{{ $displayStatus }}</span></td>
                            <td style="max-width:220px;">
                                @if($extras)<div style="margin-bottom:3px;">{{ implode(' · ', $extras) }}</div>@endif
                                @foreach($warnings as $w)
                                <div style="background:#fff3cd;border-left:3px solid #f39c12;padding:3px 7px;margin-bottom:3px;border-radius:3px;">
                                    <span style="font-weight:600;color:#856404;">{{ $w['risk'] ?? '' }}</span>
                                    @if(!empty($w['short_description']))<br><span style="color:#555;">{{ $w['short_description'] }}</span>@endif
                                </div>
                                @endforeach
                                @if(empty($warnings) && empty($extras))—@endif
                            </td>
                            <td style="font-size:11px;color:#888;">{{ $v->vendor_data }}</td>
                            <td style="font-size:11px;">{{ $v->created_at->format('d M Y H:i') }}</td>
                            <td>
                                <button class="btn btn-xs btn-outline-secondary" data-toggle="modal" data-target="#hmodal_{{ $v->id }}">
                                    <i class="fas fa-eye"></i>
                                </button>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <div class="mt-2">{{ $verifications->links() }}</div>
            @endif

        </div>
    </div>
</div>

{{-- Response modals --}}
@foreach($verifications as $v)
<div class="modal fade" id="hmodal_{{ $v->id }}" tabindex="-1">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header" style="background:#214942;color:#fff;">
                <h6 class="modal-title">{{ str_replace('_',' ',ucfirst($v->type)) }} — Response #{{ $v->id }}</h6>
                <button type="button" class="close text-white" data-dismiss="modal">&times;</button>
            </div>
            <div class="modal-body">
                <pre style="font-size:11px;background:#f8f9fa;padding:12px;border-radius:4px;max-height:400px;overflow:auto;">{{ json_encode($v->response_data, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE) }}</pre>
            </div>
        </div>
    </div>
</div>
@endforeach

@endsection
