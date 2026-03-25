@extends('layouts.app')

@section('content')
<style>
    .kyc-top-bar  { background:#214942; text-align:center; padding:15px; color:#fff; font-family:"Poppins",sans-serif; font-size:14px; font-weight:400; }
    .kyc-bottom-bar { background:#214942; height:8px; border-radius:0 0 6px 6px; }
    .kyc-body     { padding:24px; font-family:"Poppins",sans-serif; font-size:14px; }
    .kyc-section  { margin-bottom:20px; }
    .kyc-section-title { font-size:12px; font-weight:600; color:#214942; text-transform:uppercase; letter-spacing:.8px; border-left:3px solid #44a74a; padding-left:8px; margin-bottom:12px; }
    .kyc-row      { display:flex; justify-content:space-between; padding:8px 0; border-bottom:1px solid #f0f0f0; }
    .kyc-label    { color:#666; font-size:13px; }
    .kyc-value    { color:#214942; font-size:13px; font-weight:500; text-align:right; }
    .badge-Approved,.badge-approved { background:#27ae60; color:#fff; padding:2px 9px; border-radius:10px; font-size:11px; }
    .badge-Declined,.badge-declined { background:#e74c3c; color:#fff; padding:2px 9px; border-radius:10px; font-size:11px; }
    .badge-Review,.badge-review     { background:#f39c12; color:#fff; padding:2px 9px; border-radius:10px; font-size:11px; }
    .badge-pending,.badge-Unknown   { background:#aaa;    color:#fff; padding:2px 9px; border-radius:10px; font-size:11px; }
    .vh-table th  { background:#214942; color:#fff; font-size:12px; font-weight:500; }
    .vh-table td  { font-size:12px; vertical-align:middle; }
</style>

<div class="col-lg-12">
    <div class="card">
        <div class="card-body p-0">

            <div class="kyc-top-bar">
                {{ _lang('KYC') }} &mdash; {{ $member->first_name.' '.$member->last_name }}
            </div>

            <div class="kyc-body">

                {{-- ── Personal Info + Address side by side ── --}}
                <div class="row">
                    <div class="col-md-6">
                        <div class="kyc-section">
                            <div class="kyc-section-title">{{ _lang('Personal Information') }}</div>
                            <div class="kyc-row"><span class="kyc-label">{{ _lang('Full Name') }}</span><span class="kyc-value">{{ $member->first_name.' '.$member->last_name }}</span></div>
                            <div class="kyc-row"><span class="kyc-label">{{ _lang('Member No') }}</span><span class="kyc-value">{{ $member->member_no ?? '—' }}</span></div>
                            <div class="kyc-row"><span class="kyc-label">{{ _lang('Email') }}</span><span class="kyc-value">{{ $member->email ?? '—' }}</span></div>
                            <div class="kyc-row"><span class="kyc-label">{{ _lang('Mobile') }}</span><span class="kyc-value">{{ ($member->country_code ? '+'.$member->country_code.' ' : '').$member->mobile }}</span></div>
                            <div class="kyc-row"><span class="kyc-label">{{ _lang('Gender') }}</span><span class="kyc-value">{{ ucfirst($member->gender ?? '—') }}</span></div>
                            <div class="kyc-row"><span class="kyc-label">{{ _lang('Business Name') }}</span><span class="kyc-value">{{ $member->business_name ?? '—' }}</span></div>
                            @if($member->credit_source)
                            <div class="kyc-row"><span class="kyc-label">{{ _lang('Credit Source') }}</span><span class="kyc-value">{{ $member->credit_source }}</span></div>
                            @endif
                            @if($member->kyc_status)
                            <div class="kyc-row">
                                <span class="kyc-label">{{ _lang('KYC Status') }}</span>
                                <span class="kyc-value">
                                    @php $ks = ucfirst(strtolower($member->kyc_status)); @endphp
                                    <span class="badge-{{ $ks }}">{{ $ks }}</span>
                                </span>
                            </div>
                            @endif
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="kyc-section">
                            <div class="kyc-section-title">{{ _lang('Address') }}</div>
                            <div class="kyc-row"><span class="kyc-label">{{ _lang('Address') }}</span><span class="kyc-value">{{ $member->address ?? '—' }}</span></div>
                            <div class="kyc-row"><span class="kyc-label">{{ _lang('City') }}</span><span class="kyc-value">{{ $member->city ?? '—' }}</span></div>
                            <div class="kyc-row"><span class="kyc-label">{{ _lang('State') }}</span><span class="kyc-value">{{ $member->state ?? '—' }}</span></div>
                            <div class="kyc-row"><span class="kyc-label">{{ _lang('Zip') }}</span><span class="kyc-value">{{ $member->zip ?? '—' }}</span></div>
                        </div>

                        @if($member->photo)
                        <div class="kyc-section">
                            <div class="kyc-section-title">{{ _lang('Photo') }}</div>
                            <img src="{{ asset('public/uploads/media/'.$member->photo) }}"
                                 style="max-width:100px;border-radius:6px;border:2px solid #214942;"
                                 onerror="this.onerror=null;this.src='{{ asset('public/backend/images/avatar.png') }}';">
                        </div>
                        @endif

                        @if($memberDocuments->isNotEmpty())
                        <div class="kyc-section">
                            <div class="kyc-section-title">{{ _lang('Documents') }}</div>
                            @foreach($memberDocuments as $doc)
                            <div class="kyc-row">
                                <span class="kyc-label">{{ $doc->name }}</span>
                                <span class="kyc-value">
                                    <a href="{{ asset('public/uploads/media/'.$doc->document) }}" target="_blank">{{ _lang('View') }}</a>
                                </span>
                            </div>
                            @endforeach
                        </div>
                        @endif
                    </div>
                </div>

                {{-- ── Verification History ── --}}
                <div class="kyc-section-title mt-3">{{ _lang('Verification History') }}</div>

                @if($verifications->isEmpty())
                    <p class="text-muted" style="font-size:13px;">{{ _lang('No verifications submitted yet.') }}</p>
                @else
                <div class="table-responsive">
                    <table class="table table-bordered vh-table">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Type</th>
                                <th>Request ID</th>
                                <th>Status</th>
                                <th>Result / Warnings</th>
                                <th>Date</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($verifications as $v)
                            @php
                                $typeKey      = $v->type;
                                $nested       = $v->response_data[$typeKey] ?? null;
                                $warnings     = $nested['warnings'] ?? [];
                                $nestedStatus = $nested['status'] ?? null;
                                $displayStatus = ucfirst(strtolower($nestedStatus ?? $v->status ?? 'Unknown'));
                                $extras = [];
                                if ($typeKey === 'age_estimation' && isset($nested['age_estimation'])) {
                                    $extras[] = 'Age: ' . round($nested['age_estimation'], 1);
                                }
                                if (isset($nested['score']) && $nested['score'] !== null) {
                                    $extras[] = 'Score: ' . $nested['score'];
                                }
                            @endphp
                            <tr>
                                <td>{{ $v->id }}</td>
                                <td>{{ str_replace('_', ' ', ucfirst($v->type)) }}</td>
                                <td style="max-width:130px;word-break:break-all;color:#888;">{{ $v->verification_request_id ?? '—' }}</td>
                                <td><span class="badge-{{ $displayStatus }}">{{ $displayStatus }}</span></td>
                                <td style="max-width:200px;">
                                    @if($extras)<div style="margin-bottom:3px;">{{ implode(' · ', $extras) }}</div>@endif
                                    @foreach($warnings as $w)
                                    <div style="background:#fff3cd;border-left:3px solid #f39c12;padding:3px 7px;margin-bottom:3px;border-radius:3px;">
                                        <span style="font-weight:600;color:#856404;">{{ $w['risk'] ?? '' }}</span>
                                        @if(!empty($w['short_description']))<br><span style="color:#555;">{{ $w['short_description'] }}</span>@endif
                                    </div>
                                    @endforeach
                                    @if(empty($warnings) && empty($extras))—@endif
                                </td>
                                <td>{{ $v->created_at->format('d M Y H:i') }}</td>
                                <td>
                                    {{-- JSON raw (commented out)
                                    <button class="btn btn-xs btn-outline-secondary" data-toggle="modal" data-target="#vmodal_{{ $v->id }}">
                                        <i class="fas fa-eye"></i>
                                    </button>
                                    --}}
                                    <button class="btn btn-xs btn-outline-primary" data-toggle="modal" data-target="#vfmodal_{{ $v->id }}" title="View Details">
                                        <i class="fas fa-table"></i> View
                                    </button>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                <div class="mt-2" style="border-left:3px solid #214942;border-right:3px solid #214942;padding:10px 12px;border-radius:0 0 4px 4px;">{{ $verifications->links() }}</div>
                @endif

                <div style="margin-top:20px;">
                    <a href="{{ route('loans.show', $loan->id) }}" class="btn btn-secondary btn-sm">
                        <i class="fas fa-arrow-left mr-1"></i>{{ _lang('Back') }}
                    </a>
                    <a href="{{ route('kyc.show', $member->id) }}" class="btn btn-sm" style="background:#214942;color:#fff;">
                        <i class="ti-id-badge mr-1"></i>{{ _lang('Run Verification') }}
                    </a>
                </div>

            </div>{{-- /kyc-body --}}

            <div class="kyc-bottom-bar"></div>
        </div>
    </div>
</div>

{{-- Response modals --}}
@foreach($verifications as $v)
<div class="modal fade" id="vmodal_{{ $v->id }}" tabindex="-1">
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

{{-- Formatted view modal --}}
@php
    $rd      = $v->response_data ?? [];
    $typeKey = $v->type;
    $nested  = $rd[$typeKey] ?? [];
    $warnings = $nested['warnings'] ?? [];
@endphp
<div class="modal fade" id="vfmodal_{{ $v->id }}" tabindex="-1">
    <div class="modal-dialog modal-lg">
        <div class="modal-content" style="font-family:Poppins,sans-serif;font-size:13px;">
            <div class="modal-header" style="background:#214942;color:#fff;">
                <h6 class="modal-title">{{ str_replace('_',' ',ucfirst($v->type)) }} — Details #{{ $v->id }}</h6>
                <button type="button" class="close text-white" data-dismiss="modal">&times;</button>
            </div>
            <div class="modal-body p-0">
                @include('backend.admin.member._kyc_detail_table', ['rd'=>$rd,'typeKey'=>$typeKey,'nested'=>$nested,'warnings'=>$warnings,'v'=>$v])
            </div>
        </div>
    </div>
</div>
@endforeach

@endsection
