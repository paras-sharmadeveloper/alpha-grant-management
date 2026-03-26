@extends('layouts.app')

@section('content')
<div class="row">
    <div class="col-lg-12">
        <div class="card">
            <div class="card-body text-center py-5">
                <i class="fas fa-tools" style="font-size: 4rem; color: #ccc;"></i>
                <h2 class="mt-4">{{ _lang($title) }}</h2>
                <p class="text-muted mt-2">{{ _lang('This feature is coming soon. We are working hard to bring it to you.') }}</p>
                <span class="badge badge-warning mt-2" style="font-size: 0.9rem; padding: 6px 14px;">{{ _lang('Coming Soon') }}</span>
            </div>
        </div>
    </div>
</div>
@endsection
