@extends('layouts.app')

@section('content')

{{-- Header Stats --}}
<div class="row mb-3">
    <div class="col-6 col-md-3">
        <div class="card text-center py-3">
            <div class="h4 mb-0 text-primary">{{ $active_loans->count() }}</div>
            <small class="text-muted">{{ _lang('Active Loans') }}</small>
        </div>
    </div>
    <div class="col-6 col-md-3">
        <div class="card text-center py-3">
            <div class="h4 mb-0 text-success">{{ decimalPlace($total_portfolio, currency_symbol()) }}</div>
            <small class="text-muted">{{ _lang('Total Portfolio') }}</small>
        </div>
    </div>
    <div class="col-6 col-md-3">
        <div class="card text-center py-3">
            <div class="h4 mb-0 text-warning">{{ decimalPlace($outstanding, currency_symbol()) }}</div>
            <small class="text-muted">{{ _lang('Outstanding Balance') }}</small>
        </div>
    </div>
    <div class="col-6 col-md-3">
        <div class="card text-center py-3">
            <div class="h4 mb-0 text-danger">{{ decimalPlace($arrears, currency_symbol()) }}</div>
            <small class="text-muted">{{ _lang('Arrears') }}</small>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-md-3">
        <ul class="nav flex-column nav-tabs settings-tab" role="tablist">
            <li class="nav-item"><a class="nav-link active" data-toggle="tab" href="#branch_details"><i class="ti-home"></i>&nbsp;{{ _lang('Branch Details') }}</a></li>
            <li class="nav-item"><a class="nav-link" data-toggle="tab" href="#branch_users"><i class="ti-id-badge"></i>&nbsp;{{ _lang('Users') }}</a></li>
            <li class="nav-item"><a class="nav-link" data-toggle="tab" href="#branch_members"><i class="ti-user"></i>&nbsp;{{ _lang('Members') }}</a></li>
            <li class="nav-item"><a class="nav-link" data-toggle="tab" href="#branch_loans"><i class="ti-agenda"></i>&nbsp;{{ _lang('Loans') }}</a></li>
            <li class="nav-item"><a class="nav-link" href="{{ route('branches.edit', $id) }}"><i class="ti-pencil-alt"></i>&nbsp;{{ _lang('Edit Branch') }}</a></li>
        </ul>
    </div>

    <div class="col-md-9">
        <div class="tab-content">

            {{-- Tab 1: Branch Details --}}
            <div id="branch_details" class="tab-pane active">
                <div class="card">
                    <div class="card-header">
                        <span class="header-title">{{ _lang('Branch Details') }}</span>
                    </div>
                    <div class="card-body">
                        <table class="table table-bordered">
                            <tr><td style="width:35%">{{ _lang('Branch Name') }}</td><td>{{ $branch->name }}</td></tr>
                            <tr><td>{{ _lang('Branch Code') }}</td><td><span class="badge badge-secondary">{{ $branch->branch_code }}</span></td></tr>
                            <tr><td>{{ _lang('State') }}</td><td>{{ $branch->state ?? '-' }}</td></tr>
                            <tr><td>{{ _lang('Branch Manager') }}</td><td>{{ $branch->manager->name ?? '-' }}</td></tr>
                            <tr><td>{{ _lang('Contact Email') }}</td><td>{{ $branch->contact_email ?? '-' }}</td></tr>
                            <tr><td>{{ _lang('Contact Phone') }}</td><td>{{ $branch->contact_phone ?? '-' }}</td></tr>
                            <tr><td>{{ _lang('Address') }}</td><td>{{ $branch->address ?? '-' }}</td></tr>
                            <tr><td>{{ _lang('Descriptions') }}</td><td>{{ $branch->descriptions ?? '-' }}</td></tr>
                        </table>
                    </div>
                </div>
            </div>

            {{-- Tab 2: Users --}}
            <div id="branch_users" class="tab-pane">
                <div class="card">
                    <div class="card-header">
                        <span class="header-title">{{ _lang('Users') }}</span>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-bordered data-table">
                                <thead>
                                    <tr>
                                        <th>{{ _lang('Name') }}</th>
                                        <th>{{ _lang('Email') }}</th>
                                        <th>{{ _lang('Role') }}</th>
                                        <th>{{ _lang('Status') }}</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse($users as $user)
                                    <tr>
                                        <td>{{ $user->name }}</td>
                                        <td>{{ $user->email }}</td>
                                        <td>{{ $user->role->name ?? '-' }}</td>
                                        <td>{!! xss_clean(show_status($user->status == 1 ? _lang('Active') : _lang('Inactive'), $user->status == 1 ? 'success' : 'danger')) !!}</td>
                                    </tr>
                                    @empty
                                    <tr><td colspan="4" class="text-center">{{ _lang('No users found') }}</td></tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>

            {{-- Tab 3: Members --}}
            <div id="branch_members" class="tab-pane">
                <div class="card">
                    <div class="card-header">
                        <span class="header-title">{{ _lang('Members') }}</span>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-bordered data-table">
                                <thead>
                                    <tr>
                                        <th>{{ _lang('Member No') }}</th>
                                        <th>{{ _lang('Name') }}</th>
                                        <th>{{ _lang('Email') }}</th>
                                        <th>{{ _lang('Mobile') }}</th>
                                        <th>{{ _lang('Status') }}</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse($members as $member)
                                    <tr>
                                        <td><a href="{{ route('members.show', $member->id) }}">{{ $member->member_no }}</a></td>
                                        <td>{{ $member->first_name }} {{ $member->last_name }}</td>
                                        <td>{{ $member->email }}</td>
                                        <td>{{ $member->country_code }}{{ $member->mobile }}</td>
                                        <td>{!! xss_clean(show_status($member->status == 1 ? _lang('Active') : _lang('Inactive'), $member->status == 1 ? 'success' : 'danger')) !!}</td>
                                    </tr>
                                    @empty
                                    <tr><td colspan="5" class="text-center">{{ _lang('No members found') }}</td></tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>

            {{-- Tab 4: Loans --}}
            <div id="branch_loans" class="tab-pane">
                <div class="card">
                    <div class="card-header">
                        <span class="header-title">{{ _lang('Loans') }}</span>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-bordered data-table">
                                <thead>
                                    <tr>
                                        <th>{{ _lang('Loan ID') }}</th>
                                        <th>{{ _lang('Borrower') }}</th>
                                        <th>{{ _lang('Product') }}</th>
                                        <th class="text-right">{{ _lang('Applied Amount') }}</th>
                                        <th class="text-right">{{ _lang('Amount Paid') }}</th>
                                        <th class="text-right">{{ _lang('Outstanding') }}</th>
                                        <th>{{ _lang('Status') }}</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse($loans as $loan)
                                    <tr>
                                        <td><a href="{{ route('loans.show', $loan->id) }}">{{ $loan->loan_id }}</a></td>
                                        <td>{{ $loan->borrower->first_name ?? '' }} {{ $loan->borrower->last_name ?? '' }}</td>
                                        <td>{{ $loan->loan_product->name ?? '-' }}</td>
                                        <td class="text-right">{{ decimalPlace($loan->applied_amount, currency($loan->currency->name ?? '')) }}</td>
                                        <td class="text-right">{{ decimalPlace($loan->total_paid ?? 0, currency($loan->currency->name ?? '')) }}</td>
                                        <td class="text-right">{{ decimalPlace(($loan->applied_amount ?? 0) - ($loan->total_paid ?? 0), currency($loan->currency->name ?? '')) }}</td>
                                        <td>
                                            @if($loan->status == 0)
                                                {!! xss_clean(show_status(_lang('Pending'), 'warning')) !!}
                                            @elseif($loan->status == 1)
                                                {!! xss_clean(show_status(_lang('Approved'), 'success')) !!}
                                            @elseif($loan->status == 2)
                                                {!! xss_clean(show_status(_lang('Completed'), 'info')) !!}
                                            @elseif($loan->status == 3)
                                                {!! xss_clean(show_status(_lang('Cancelled'), 'danger')) !!}
                                            @endif
                                        </td>
                                    </tr>
                                    @empty
                                    <tr><td colspan="7" class="text-center">{{ _lang('No loans found') }}</td></tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>
@endsection

@section('js-script')
<script>
(function ($) {
    "use strict";
    $('.nav-tabs a').on('shown.bs.tab', function (e) {
        var tab = $(e.target).attr("href");
        history.pushState({}, null, window.location.pathname + "?tab=" + tab.substring(1));
        $($.fn.dataTable.tables(true)).DataTable().columns.adjust();
    });
    @if(isset($_GET['tab']))
        $('.nav-tabs a[href="#{{ $_GET['tab'] }}"]').tab('show');
    @endif
})(jQuery);
</script>
@endsection
