@extends('layouts.app')

@section('content')
<style>
    .kyc-wrap  { max-width:860px; margin:30px auto; font-family:"Poppins",sans-serif; font-size:14px; }
    .kyc-head  { background:#214942; color:#fff; padding:14px 20px; border-radius:6px 6px 0 0; display:flex; align-items:center; justify-content:space-between; }
    .kyc-body  { background:#fff; border:1px solid #ddd; border-top:none; border-radius:0 0 6px 6px; padding:24px; }
    .section-title { font-size:13px; font-weight:600; color:#214942; text-transform:uppercase; letter-spacing:.5px; margin-bottom:14px; border-bottom:2px solid #44a74a; padding-bottom:6px; }
    .badge-Approved,.badge-approved { background:#27ae60; color:#fff; padding:2px 9px; border-radius:10px; font-size:11px; }
    .badge-Declined,.badge-declined { background:#e74c3c; color:#fff; padding:2px 9px; border-radius:10px; font-size:11px; }
    .badge-Review,.badge-review     { background:#f39c12; color:#fff; padding:2px 9px; border-radius:10px; font-size:11px; }
    .badge-pending                  { background:#aaa;    color:#fff; padding:2px 9px; border-radius:10px; font-size:11px; }
    .type-panel { display:none; }
    .type-panel.active { display:block; }
    .form-label { font-size:13px; color:#444; margin-bottom:4px; }
    .history-table th { background:#214942; color:#fff; font-size:12px; font-weight:500; }
    .history-table td { font-size:12px; vertical-align:middle; }
</style>

<div class="kyc-wrap">
    <div class="kyc-head">
        <a href="{{ auth()->user()->user_type === 'customer' ? route('loans.my_loans') : route('members.show', $member->id) }}" class="btn btn-sm"
           style="background:rgba(255,255,255,0.15);color:#fff;border:1px solid rgba(255,255,255,0.4);font-size:12px;">
            <i class="fas fa-arrow-left mr-1"></i> Back
        </a>
        <span style="flex:1;text-align:center;font-size:15px;">
            KYC Verification — {{ $member->first_name }} {{ $member->last_name }}
        </span>
        <span style="width:70px;"></span>
    </div>

    <div class="kyc-body">

        @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="close" data-dismiss="alert"><span>&times;</span></button>
        </div>
        @endif
        @if(session('error'))
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            {{ session('error') }}
            <button type="button" class="close" data-dismiss="alert"><span>&times;</span></button>
        </div>
        @endif
        @if($errors->any())
        <div class="alert alert-danger">
            @foreach($errors->all() as $e)<div>{{ $e }}</div>@endforeach
        </div>
        @endif

        {{-- ── Submit New Verification ── --}}
        <div class="section-title">Submit Verification</div>

        <form action="{{ route('kyc.submit', $member->id) }}" method="POST" enctype="multipart/form-data">
            @csrf

            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label class="form-label">Verification Type <span class="text-danger">*</span></label>
                        <select name="type" id="kyc_type" class="form-control" required>
                            <option value="">— Select Type —</option>
                            <option value="id_verification">ID Verification (Document OCR)</option>
                            <option value="poa">Proof of Address</option>
                            <option value="passive_liveness">Passive Liveness</option>
                            <option value="face_search">Face Search</option>
                            <option value="age_estimation">Age Estimation</option>
                        </select>
                    </div>
                </div>
                @if(auth()->user()->user_type !== 'customer')
                <div class="col-md-6">
                    <div class="form-group">
                        <label class="form-label">Link to Loan (optional)</label>
                        <select name="loan_id" class="form-control">
                            <option value="">— None —</option>
                            @foreach($loans as $loan)
                            <option value="{{ $loan->id }}">Loan #{{ $loan->loan_id ?? $loan->id }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                @endif
            </div>

            {{-- ID Verification --}}
            <div id="panel_id_verification" class="type-panel">
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label class="form-label">Front Image <span class="text-danger">*</span></label>
                            <input type="file" name="front_image" class="form-control-file" accept=".jpg,.jpeg,.png,.webp,.tiff">
                            <small class="text-muted">JPEG, PNG, WebP, TIFF — max 15MB</small>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label class="form-label">Back Image (optional)</label>
                            <input type="file" name="back_image" class="form-control-file" accept=".jpg,.jpeg,.png,.webp,.tiff">
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-4">
                        <div class="form-group">
                            <label class="form-label">Expiry Not Detected</label>
                            <select name="expiration_date_not_detected_action" class="form-control form-control-sm">
                                <option value="DECLINE">DECLINE</option>
                                <option value="NO_ACTION">NO_ACTION</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label class="form-label">Invalid MRZ Action</label>
                            <select name="invalid_mrz_action" class="form-control form-control-sm">
                                <option value="DECLINE">DECLINE</option>
                                <option value="NO_ACTION">NO_ACTION</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label class="form-label">Inconsistent Data</label>
                            <select name="inconsistent_data_action" class="form-control form-control-sm">
                                <option value="DECLINE">DECLINE</option>
                                <option value="NO_ACTION">NO_ACTION</option>
                            </select>
                        </div>
                    </div>
                </div>
            </div>

            {{-- Proof of Address --}}
            <div id="panel_poa" class="type-panel">
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label class="form-label">Document <span class="text-danger">*</span></label>
                            <input type="file" name="document" class="form-control-file" accept=".pdf,.jpg,.jpeg,.png,.webp,.tiff">
                            <small class="text-muted">PDF, JPEG, PNG, WebP, TIFF — max 15MB</small>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label class="form-label">Expected Country</label>
                            <input type="text" name="expected_country" class="form-control form-control-sm" placeholder="e.g. US">
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-4">
                        <div class="form-group">
                            <label class="form-label">Expected First Name</label>
                            <input type="text" name="expected_first_name" class="form-control form-control-sm" value="{{ $member->first_name }}">
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label class="form-label">Expected Last Name</label>
                            <input type="text" name="expected_last_name" class="form-control form-control-sm" value="{{ $member->last_name }}">
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label class="form-label">Expected Address</label>
                            <input type="text" name="expected_address" class="form-control form-control-sm">
                        </div>
                    </div>
                </div>
            </div>

            {{-- Passive Liveness --}}
            <div id="panel_passive_liveness" class="type-panel">
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label class="form-label">Face Image <span class="text-danger">*</span></label>
                            <input type="file" name="user_image" class="form-control-file" accept=".jpg,.jpeg,.png,.webp,.tiff">
                            <small class="text-muted">JPEG, PNG, WebP, TIFF — max 5MB</small>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label class="form-label">Liveness Score Decline Threshold (0–100)</label>
                            <input type="number" name="face_liveness_score_decline_threshold" class="form-control form-control-sm" value="30" min="0" max="100">
                        </div>
                    </div>
                </div>
            </div>

            {{-- Face Search --}}
            <div id="panel_face_search" class="type-panel">
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label class="form-label">Face Image <span class="text-danger">*</span></label>
                            <input type="file" name="user_image" class="form-control-file" accept=".jpg,.jpeg,.png,.webp,.tiff">
                            <small class="text-muted">JPEG, PNG, WebP, TIFF — max 5MB</small>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label class="form-label">Search Type</label>
                            <select name="search_type" class="form-control form-control-sm">
                                <option value="most_similar">Most Similar</option>
                                <option value="blocklisted_or_approved">Blocklisted or Approved</option>
                            </select>
                        </div>
                    </div>
                </div>
            </div>

            {{-- Age Estimation --}}
            <div id="panel_age_estimation" class="type-panel">
                <div class="row">
                    <div class="col-md-4">
                        <div class="form-group">
                            <label class="form-label">Face Image <span class="text-danger">*</span></label>
                            <input type="file" name="user_image" class="form-control-file" accept=".jpg,.jpeg,.png,.webp,.tiff">
                            <small class="text-muted">JPEG, PNG, WebP, TIFF — max 5MB</small>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label class="form-label">Liveness Score Threshold (0–100)</label>
                            <input type="number" name="face_liveness_score_decline_threshold" class="form-control form-control-sm" value="30" min="0" max="100">
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label class="form-label">Min Age Threshold</label>
                            <input type="number" name="age_estimation_decline_threshold" class="form-control form-control-sm" value="18" min="0" max="120">
                        </div>
                    </div>
                </div>
            </div>

            <div id="submit_btn" style="display:none; margin-top:8px;">
                <button type="submit" class="btn btn-success">
                    <i class="fas fa-paper-plane mr-1"></i> Submit Verification
                </button>
            </div>
        </form>

        {{-- ── Verification History (latest 2) ── --}}
        <div class="section-title mt-4" style="display:flex;align-items:center;justify-content:space-between;">
            <span>Recent Verifications</span>
            <a href="{{ auth()->user()->user_type === 'customer' ? route('customer.kyc.history', $member->id) : route('kyc.history', $member->id) }}" style="font-size:12px;color:#44a74a;font-weight:400;text-transform:none;letter-spacing:0;">
                View All <i class="fas fa-arrow-right ml-1"></i>
            </a>
        </div>

        @if($verifications->isEmpty())
            <p class="text-muted" style="font-size:13px;">No verifications submitted yet.</p>
        @else
        <div class="table-responsive">
            <table class="table table-bordered history-table">
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
                        <th>Raw</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($verifications as $v)
                    @php
                        $typeKey  = $v->type; // e.g. age_estimation
                        $nested   = $v->response_data[$typeKey] ?? null;
                        $warnings = $nested['warnings'] ?? [];
                        $nestedStatus = $nested['status'] ?? null;
                        $displayStatus = $nestedStatus ?? $v->status ?? 'Unknown';

                        // Extra result fields per type
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
                        <td style="font-size:11px;color:#888;max-width:140px;word-break:break-all;">{{ $v->verification_request_id ?? '—' }}</td>
                        <td>
                            @php $s = ucfirst(strtolower($displayStatus)); @endphp
                            <span class="badge-{{ $s }}">{{ $s }}</span>
                        </td>
                        <td style="font-size:11px;max-width:220px;">
                            @if($extras)
                                <div style="margin-bottom:4px;">{{ implode(' · ', $extras) }}</div>
                            @endif
                            @foreach($warnings as $w)
                                <div style="background:#fff3cd;border-left:3px solid #f39c12;padding:3px 7px;margin-bottom:3px;border-radius:3px;">
                                    <span style="font-weight:600;color:#856404;">{{ $w['risk'] ?? '' }}</span>
                                    @if(!empty($w['short_description']))
                                        <br><span style="color:#555;">{{ $w['short_description'] }}</span>
                                    @endif
                                </div>
                            @endforeach
                            @if(empty($warnings) && empty($extras)) — @endif
                        </td>
                        <td style="font-size:11px;color:#888;">{{ $v->vendor_data }}</td>
                        <td style="font-size:11px;">{{ $v->created_at->format('d M Y H:i') }}</td>
                        <td>
                            <button class="btn btn-xs btn-outline-secondary"
                                    data-toggle="modal"
                                    data-target="#modal_{{ $v->id }}">
                                <i class="fas fa-eye"></i>
                            </button>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        {{-- Response detail modals --}}
        @foreach($verifications as $v)
        <div class="modal fade" id="modal_{{ $v->id }}" tabindex="-1">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header" style="background:#214942;color:#fff;">
                        <h6 class="modal-title">Response — {{ str_replace('_',' ',ucfirst($v->type)) }} #{{ $v->id }}</h6>
                        <button type="button" class="close text-white" data-dismiss="modal">&times;</button>
                    </div>
                    <div class="modal-body">
                        <pre style="font-size:11px;background:#f8f9fa;padding:12px;border-radius:4px;max-height:400px;overflow:auto;">{{ json_encode($v->response_data, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE) }}</pre>
                    </div>
                </div>
            </div>
        </div>
        @endforeach
        @endif

    </div>{{-- /kyc-body --}}
</div>{{-- /kyc-wrap --}}
@endsection

@section('js-script')
<script>
document.getElementById('kyc_type').addEventListener('change', function () {
    var type = this.value;
    document.querySelectorAll('.type-panel').forEach(function (p) {
        p.classList.remove('active');
    });
    document.getElementById('submit_btn').style.display = 'none';
    if (type) {
        var panel = document.getElementById('panel_' + type);
        if (panel) {
            panel.classList.add('active');
            document.getElementById('submit_btn').style.display = 'block';
        }
    }
});
</script>
@endsection
