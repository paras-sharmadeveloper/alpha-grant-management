@extends('layouts.app')

@section('content')
<div class="row mb-3">
    <div class="col-6 col-md-3">
        <div class="card text-center py-3">
            <div class="h4 mb-0 text-primary">{{ $loans->count() }}</div>
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
            <div class="h4 mb-0 text-warning">{{ decimalPlace($total_outstanding, currency_symbol()) }}</div>
            <small class="text-muted">{{ _lang('Outstanding Balance') }}</small>
        </div>
    </div>
    <div class="col-6 col-md-3">
        <div class="card text-center py-3">
            <div class="h4 mb-0 text-danger">{{ decimalPlace($total_arrears, currency_symbol()) }}</div>
            <small class="text-muted">{{ _lang('Total Arrears') }}</small>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-lg-12">
        <div class="card">
            <div class="card-header d-flex align-items-center">
                <span class="panel-title">{{ _lang('Loan Book') }}</span>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table id="loan_book_table" class="table data-table">
                        <thead>
                            <tr>
                                <th>{{ _lang('Loan ID') }}</th>
                                <th>{{ _lang('Borrower') }}</th>
                                <th>{{ _lang('Product') }}</th>
                                <th class="text-right">{{ _lang('Applied Amount') }}</th>
                                <th class="text-right">{{ _lang('Amount Paid') }}</th>
                                <th class="text-right">{{ _lang('Outstanding') }}</th>
                                <th class="text-right">{{ _lang('Arrears') }}</th>
                                <th>{{ _lang('Next Due Date') }}</th>
                                <th>{{ _lang('Release Date') }}</th>
                                <th class="text-center">{{ _lang('Action') }}</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($loans as $loan)
                            <tr>
                                <td><a href="{{ route('loans.show', $loan->id) }}">{{ $loan->loan_id }}</a></td>
                                <td>{{ $loan->borrower->first_name ?? '' }} {{ $loan->borrower->last_name ?? '' }}</td>
                                <td>{{ $loan->loan_product->name ?? '-' }}</td>
                                <td class="text-right">{{ decimalPlace($loan->applied_amount, currency($loan->currency->name ?? '')) }}</td>
                                <td class="text-right">{{ decimalPlace($loan->total_paid ?? 0, currency($loan->currency->name ?? '')) }}</td>
                                <td class="text-right">{{ decimalPlace(($loan->applied_amount ?? 0) - ($loan->total_paid ?? 0), currency($loan->currency->name ?? '')) }}</td>
                                <td class="text-right @if($loan->late_payment_penalties > 0) text-danger @endif">
                                    {{ decimalPlace($loan->late_payment_penalties ?? 0, currency($loan->currency->name ?? '')) }}
                                </td>
                                <td>
                                    @if($loan->next_payment && $loan->next_payment->repayment_date)
                                        @php $isOverdue = \Carbon\Carbon::parse($loan->next_payment->getRawOriginal('repayment_date'))->isPast(); @endphp
                                        <span class="{{ $isOverdue ? 'text-danger' : '' }}">{{ $loan->next_payment->repayment_date }}</span>
                                    @else
                                        -
                                    @endif
                                </td>
                                <td>{{ $loan->release_date ?? '-' }}</td>
                                <td class="text-center">
                                    <a href="{{ route('loans.show', $loan->id) }}" class="btn btn-primary btn-xs"><i class="ti-eye"></i></a>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
