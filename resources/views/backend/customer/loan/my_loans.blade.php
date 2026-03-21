@extends('layouts.app')

@section('content')
<div class="row">
	<div class="col-lg-12">
		<div class="card">
			<div class="card-header d-flex justify-content-between align-items-center">
				<span class="panel-title">{{ _lang('My Loans') }}</span>
				<a class="btn btn-primary btn-xs float-right" href="{{ route('loans.apply_loan') }}"><i class="ti-plus"></i>&nbsp;{{ _lang('Apply Loan') }}</a>
			</div>

			<div class="card-body">
				<table id="loans_table" class="table table-bordered data-table text-center">
					<thead>
						<tr class="text-center">
                            <th class="text-center">{{ _lang('Loan ID') }}</th>
                            <th class="text-center">{{ _lang('Loan Name') }}</th>
                            <th class="text-center">{{ _lang('Amount') }}</th>
                            <th class="text-center">{{ _lang('Term') }}</th>
                            <th class="text-center">{{ _lang('Interest Rate') }}</th>
                            <th class="text-center">{{ _lang('Pending Amount') }}</th>
                            <th class="text-center">{{ _lang('Status') }}</th>
						</tr>
					</thead>
					<tbody>
                        @foreach($loans as $loan)
                        @php
                            $loanTerm = $loan->term ?? $loan->loan_product->term;
                            $loanRate = $loan->interest_rate ?? $loan->loan_product->interest_rate;
                            // Parse term period — e.g. "+1 month" or "+12 months" → "month"
                            $rawPeriod = preg_replace('/^\+\d+\s*/', '', $loan->loan_product->term_period);
                            $periodUnit = rtrim(strtolower(trim($rawPeriod)), 's'); // "month" or "year"
                            // Singular vs plural, and month vs year
                            if ($loanTerm == 1) {
                                $termLabel = '1 ' . $periodUnit;
                            } elseif ($periodUnit === 'month' && $loanTerm % 12 === 0) {
                                $years = $loanTerm / 12;
                                $termLabel = $years . ' ' . ($years == 1 ? 'year' : 'years');
                            } else {
                                $termLabel = $loanTerm . ' ' . $periodUnit . 's';
                            }
                        @endphp
                        <tr>
                            <td><a href="{{ route('loans.loan_details',$loan->id) }}">{{ $loan->loan_id ?? '#' . $loan->id }}</a></td>
                            <td>{{ $loan->loan_product->name }}</td>
                            <td>{{ decimalPlace($loan->applied_amount, currency($loan->currency->name)) }}</td>
                            <td>{{ $termLabel }}</td>
                            <td>{{ $loanRate }}%</td>
                            <td>{{ decimalPlace($loan->applied_amount - $loan->total_paid, currency($loan->currency->name)) }}</td>
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
                        @endforeach
					</tbody>
				</table>
			</div>
		</div>
	</div>
</div>
@endsection