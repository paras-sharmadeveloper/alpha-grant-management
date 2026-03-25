<table class="table table-sm table-bordered mb-0" style="font-family:Poppins,sans-serif;font-size:13px;">
    <tbody>
        <tr><td class="text-muted" style="width:35%;background:#f8f9fa;">Request ID</td><td style="word-break:break-all;">{{ $rd['request_id'] ?? '—' }}</td></tr>
        <tr><td class="text-muted" style="background:#f8f9fa;">Type</td><td>{{ str_replace('_',' ',ucfirst($v->type)) }}</td></tr>
        <tr>
            <td class="text-muted" style="background:#f8f9fa;">Status</td>
            <td>
                @php $s = ucfirst(strtolower($nested['status'] ?? $v->status ?? 'Unknown')); @endphp
                <span class="badge-{{ $s }}">{{ $s }}</span>
            </td>
        </tr>
        <tr><td class="text-muted" style="background:#f8f9fa;">Vendor Data</td><td>{{ $rd['vendor_data'] ?? '—' }}</td></tr>
        <tr><td class="text-muted" style="background:#f8f9fa;">Submitted At</td><td>{{ $v->created_at->format('d M Y H:i') }}</td></tr>

        @if($typeKey === 'id_verification')
            <tr><td class="text-muted" style="background:#f8f9fa;">Full Name</td><td>{{ $nested['full_name'] ?? '—' }}</td></tr>
            <tr><td class="text-muted" style="background:#f8f9fa;">First Name</td><td>{{ $nested['first_name'] ?? '—' }}</td></tr>
            <tr><td class="text-muted" style="background:#f8f9fa;">Last Name</td><td>{{ $nested['last_name'] ?? '—' }}</td></tr>
            <tr><td class="text-muted" style="background:#f8f9fa;">Date of Birth</td><td>{{ $nested['date_of_birth'] ?? '—' }}</td></tr>
            <tr><td class="text-muted" style="background:#f8f9fa;">Age</td><td>{{ $nested['age'] ?? '—' }}</td></tr>
            <tr><td class="text-muted" style="background:#f8f9fa;">Gender</td><td>{{ $nested['gender'] ?? '—' }}</td></tr>
            <tr><td class="text-muted" style="background:#f8f9fa;">Document Number</td><td>{{ $nested['document_number'] ?? '—' }}</td></tr>
            <tr><td class="text-muted" style="background:#f8f9fa;">Document Type</td><td>{{ $nested['document_type'] ?? '—' }}</td></tr>
            <tr><td class="text-muted" style="background:#f8f9fa;">Date of Issue</td><td>{{ $nested['date_of_issue'] ?? '—' }}</td></tr>
            <tr><td class="text-muted" style="background:#f8f9fa;">Expiration Date</td><td>{{ $nested['expiration_date'] ?? '—' }}</td></tr>
            <tr><td class="text-muted" style="background:#f8f9fa;">Issuing State</td><td>{{ ($nested['issuing_state'] ?? '—') . ' ' . ($nested['issuing_state_name'] ?? '') }}</td></tr>
            <tr><td class="text-muted" style="background:#f8f9fa;">Nationality</td><td>{{ $nested['nationality'] ?? '—' }}</td></tr>
            <tr><td class="text-muted" style="background:#f8f9fa;">Address</td><td>{{ $nested['formatted_address'] ?? $nested['address'] ?? '—' }}</td></tr>
            <tr><td class="text-muted" style="background:#f8f9fa;">Marital Status</td><td>{{ $nested['marital_status'] ?? '—' }}</td></tr>
            @if(!empty($nested['front_image_quality_score']))
            <tr>
                <td class="text-muted" style="background:#f8f9fa;">Image Quality</td>
                <td>
                    Overall: {{ $nested['front_image_quality_score']['overall_score'] ?? '—' }} &nbsp;|&nbsp;
                    Focus: {{ $nested['front_image_quality_score']['focus_score'] ?? '—' }} &nbsp;|&nbsp;
                    Brightness: {{ $nested['front_image_quality_score']['brightness_score'] ?? '—' }}
                </td>
            </tr>
            @endif
            @if(!empty($nested['portrait_image']))
            <tr><td class="text-muted" style="background:#f8f9fa;">Portrait</td>
                <td><a href="{{ $nested['portrait_image'] }}" target="_blank">
                    <img src="{{ $nested['portrait_image'] }}" style="height:70px;border-radius:4px;border:1px solid #ddd;" onerror="this.style.display='none'">
                </a></td>
            </tr>
            @endif
            @if(!empty($nested['front_image']))
            <tr><td class="text-muted" style="background:#f8f9fa;">Front Image</td>
                <td><a href="{{ $nested['front_image'] }}" target="_blank">
                    <img src="{{ $nested['front_image'] }}" style="height:70px;border-radius:4px;border:1px solid #ddd;" onerror="this.style.display='none'">
                </a></td>
            </tr>
            @endif
            @if(!empty($nested['back_image']))
            <tr><td class="text-muted" style="background:#f8f9fa;">Back Image</td>
                <td><a href="{{ $nested['back_image'] }}" target="_blank">
                    <img src="{{ $nested['back_image'] }}" style="height:70px;border-radius:4px;border:1px solid #ddd;" onerror="this.style.display='none'">
                </a></td>
            </tr>
            @endif

        @elseif($typeKey === 'age_estimation')
            <tr><td class="text-muted" style="background:#f8f9fa;">Estimated Age</td><td>{{ $nested['age_estimation'] ?? '—' }}</td></tr>
            <tr><td class="text-muted" style="background:#f8f9fa;">Method</td><td>{{ $nested['method'] ?? '—' }}</td></tr>
            <tr><td class="text-muted" style="background:#f8f9fa;">Score</td><td>{{ $nested['score'] ?? '—' }}</td></tr>
            @if(!empty($nested['user_image']['entities']))
                @foreach($nested['user_image']['entities'] as $ent)
                <tr>
                    <td class="text-muted" style="background:#f8f9fa;">Detected Entity</td>
                    <td>Age: {{ $ent['age'] ?? '—' }} &nbsp;|&nbsp; Gender: {{ $ent['gender'] ?? '—' }} &nbsp;|&nbsp; Confidence: {{ $ent['confidence'] ?? '—' }}</td>
                </tr>
                @endforeach
            @endif

        @elseif($typeKey === 'passive_liveness')
            <tr><td class="text-muted" style="background:#f8f9fa;">Score</td><td>{{ $nested['score'] ?? '—' }}</td></tr>
            <tr><td class="text-muted" style="background:#f8f9fa;">Method</td><td>{{ $nested['method'] ?? '—' }}</td></tr>
            @if(!empty($nested['portrait_image']))
            <tr><td class="text-muted" style="background:#f8f9fa;">Portrait</td>
                <td><a href="{{ $nested['portrait_image'] }}" target="_blank">
                    <img src="{{ $nested['portrait_image'] }}" style="height:70px;border-radius:4px;border:1px solid #ddd;" onerror="this.style.display='none'">
                </a></td>
            </tr>
            @endif

        @elseif($typeKey === 'poa')
            <tr><td class="text-muted" style="background:#f8f9fa;">Full Name</td><td>{{ $nested['full_name'] ?? '—' }}</td></tr>
            <tr><td class="text-muted" style="background:#f8f9fa;">Address</td><td>{{ $nested['formatted_address'] ?? $nested['address'] ?? '—' }}</td></tr>
            <tr><td class="text-muted" style="background:#f8f9fa;">Issuing Country</td><td>{{ $nested['issuing_country'] ?? '—' }}</td></tr>
            <tr><td class="text-muted" style="background:#f8f9fa;">Issue Date</td><td>{{ $nested['issue_date'] ?? '—' }}</td></tr>

        @elseif($typeKey === 'face_search')
            <tr><td class="text-muted" style="background:#f8f9fa;">Score</td><td>{{ $nested['score'] ?? '—' }}</td></tr>
            <tr><td class="text-muted" style="background:#f8f9fa;">Match Found</td><td>{{ isset($nested['match_found']) ? ($nested['match_found'] ? 'Yes' : 'No') : '—' }}</td></tr>
        @endif
    </tbody>
</table>

@if(!empty($warnings))
<div class="p-3" style="border-top:1px solid #dee2e6;">
    <div style="font-size:12px;font-weight:600;color:#856404;margin-bottom:6px;">Warnings</div>
    @foreach($warnings as $w)
    <div style="background:#fff3cd;border-left:3px solid #f39c12;padding:6px 10px;margin-bottom:6px;border-radius:3px;font-size:12px;">
        <strong>{{ $w['feature'] ?? '' }}{{ !empty($w['risk']) ? ' — '.$w['risk'] : '' }}</strong>
        @if(!empty($w['short_description']))<br>{{ $w['short_description'] }}@endif
        @if(!empty($w['long_description']))<br><span style="color:#777;font-size:11px;">{{ $w['long_description'] }}</span>@endif
    </div>
    @endforeach
</div>
@endif
