@extends('layouts.app')

@section('content')
<div class="row">
    <div class="col-lg-12">
        <div class="card">
            <div class="card-header d-flex justify-content-between align-items-center">
                <span class="panel-title">{{ _lang('Pending Loans') }}</span>
                <a class="btn btn-primary btn-xs float-right" href="{{ route('loans.apply_loan') }}"><i class="ti-plus"></i>&nbsp;{{ _lang('Apply Loan') }}</a>
            </div>

            <div class="card-body">
                <table id="pending_loans_table" class="table table-bordered data-table text-center">
                    <thead>
                        <tr class="text-center">
                            <th class="text-center">{{ _lang('Loan ID') }}</th>
                            <th class="text-center">{{ _lang('Name') }}</th>
                            <th class="text-center">{{ _lang('Request Amount') }}</th>
                            <th class="text-center">{{ _lang('Status') }}</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($loans as $loan)
                        <tr>
                            <td>
                                    {{ $loan->loan_id ?? '#' . $loan->id }}
                              
                            </td>
                            <td>{{ $loan->loan_product->name }}</td>
                            <td>{{ decimalPlace($loan->applied_amount, currency($loan->currency->name)) }}</td>
                            <td>{!! xss_clean(show_status(_lang('Pending'), 'warning')) !!}</td>
                        </tr>
                        @endforeach

                        @if($loans->isEmpty())
                        <tr>
                            <td colspan="4"><p class="text-center">{{ _lang('No Pending Loans') }}</p></td>
                        </tr>
                        @endif
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection
