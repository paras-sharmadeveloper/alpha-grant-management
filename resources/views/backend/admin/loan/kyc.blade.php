@extends('layouts.app')

@section('content')
<style>
    .kyc-top-bar { background:#214942; text-align:center; padding:15px; color:#fff; font-family:"Poppins",sans-serif; font-size:14px; font-weight:400; text-transform:capitalize; }
    .kyc-bottom-bar { background:#214942; height:40px; margin-top:20px; }
    .kyc-body { width:85%; margin:20px auto; font-family:"Poppins",sans-serif; font-size:14px; }
    .kyc-row { display:flex; justify-content:space-between; padding:14px 0; border-bottom:1px solid #eee; font-size:14px; font-family:"Poppins",sans-serif; }
    .kyc-label { color:#2c3e50; font-weight:400; text-transform:capitalize; }
    .kyc-value { color:#214942; font-weight:400; }
    .kyc-section-title { font-size:13px; font-weight:600; color:#214942; text-transform:uppercase; letter-spacing:1px; margin:20px 0 8px; border-left:3px solid #44a74a; padding-left:10px; }
</style>

<div class="col-lg-12">
    <div class="card">
        <div class="card-body p-0">

            <div class="kyc-top-bar">
                {{ _lang('KYC') }} &mdash; {{ $member->first_name.' '.$member->last_name }}
            </div>

            <div class="kyc-body">

                <div class="kyc-section-title">{{ _lang('Personal Information') }}</div>
                <div class="kyc-row"><span class="kyc-label">{{ _lang('Full Name') }}</span><span class="kyc-value">{{ $member->first_name.' '.$member->last_name }}</span></div>
                <div class="kyc-row"><span class="kyc-label">{{ _lang('Member No') }}</span><span class="kyc-value">{{ $member->member_no ?? '—' }}</span></div>
                <div class="kyc-row"><span class="kyc-label">{{ _lang('Email') }}</span><span class="kyc-value">{{ $member->email ?? '—' }}</span></div>
                <div class="kyc-row"><span class="kyc-label">{{ _lang('Mobile') }}</span><span class="kyc-value">{{ ($member->country_code ? '+'.$member->country_code.' ' : '').$member->mobile }}</span></div>
                <div class="kyc-row"><span class="kyc-label">{{ _lang('Gender') }}</span><span class="kyc-value">{{ ucfirst($member->gender ?? '—') }}</span></div>
                <div class="kyc-row"><span class="kyc-label">{{ _lang('Business Name') }}</span><span class="kyc-value">{{ $member->business_name ?? '—' }}</span></div>

                <div class="kyc-section-title">{{ _lang('Address') }}</div>
                <div class="kyc-row"><span class="kyc-label">{{ _lang('Address') }}</span><span class="kyc-value">{{ $member->address ?? '—' }}</span></div>
                <div class="kyc-row"><span class="kyc-label">{{ _lang('City') }}</span><span class="kyc-value">{{ $member->city ?? '—' }}</span></div>
                <div class="kyc-row"><span class="kyc-label">{{ _lang('State') }}</span><span class="kyc-value">{{ $member->state ?? '—' }}</span></div>
                <div class="kyc-row"><span class="kyc-label">{{ _lang('Zip') }}</span><span class="kyc-value">{{ $member->zip ?? '—' }}</span></div>

                @if($member->credit_source)
                <div class="kyc-section-title">{{ _lang('Credit Information') }}</div>
                <div class="kyc-row"><span class="kyc-label">{{ _lang('Credit Source') }}</span><span class="kyc-value">{{ $member->credit_source }}</span></div>
                @endif

                @if($member->photo)
                <div class="kyc-section-title">{{ _lang('Photo') }}</div>
                <div style="padding:16px 0;">
                    <img src="{{ asset('public/uploads/media/'.$member->photo) }}" style="max-width:120px;border-radius:8px;border:2px solid #214942;">
                </div>
                @endif

                @if($memberDocuments->isNotEmpty())
                <div class="kyc-section-title">{{ _lang('Documents') }}</div>
                @foreach($memberDocuments as $doc)
                <div class="kyc-row">
                    <span class="kyc-label">{{ $doc->name }}</span>
                    <span class="kyc-value">
                        <a href="{{ asset('public/uploads/media/'.$doc->document) }}" target="_blank">{{ _lang('View') }}</a>
                    </span>
                </div>
                @endforeach
                @endif

                <div style="margin-top:24px;">
                    <a href="{{ route('loans.show', $loan->id) }}" class="btn btn-secondary btn-sm">
                        <i class="fas fa-arrow-left mr-1"></i>{{ _lang('Back') }}
                    </a>
                </div>

            </div>

            <div class="kyc-bottom-bar"></div>
        </div>
    </div>
</div>
@endsection
