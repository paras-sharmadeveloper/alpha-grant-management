@extends('layouts.app')

@section('content')
<div class="row">
	<div class="col-lg-12">
		<div class="card">
			<div class="card-header d-flex justify-content-between align-items-center">
				<span class="panel-title">{{ _lang('Loan Products') }}</span>
				<a class="btn btn-primary btn-xs float-right" href="{{ route('loan_products.create') }}"><i class="ti-plus"></i>&nbsp;{{ _lang('Add New') }}</a>
			</div>
			<div class="card-body">
				<table id="loan_products_table" class="table table-bordered data-table">
					<thead>
						<tr>
							<th>{{ _lang('Name') }}</th>
							<th>{{ _lang('Interest Rate') }}</th>
							<th>{{ _lang('Interest Type') }}</th>
							<th>{{ _lang('Term (Years)') }}</th>
							<th class="text-center">{{ _lang('Action') }}</th>
						</tr>
					</thead>
					<tbody>
						@foreach($loanproducts as $loanproduct)
						<tr data-id="row_{{ $loanproduct->id }}">
							<td class='name'>{{ $loanproduct->name }}</td>
							<td class='interest_rate'>{{ $loanproduct->interest_rate.' %' }}</td>
							<td class='interest_type'>{{ ucwords(str_replace("_"," ", $loanproduct->interest_type)) }}</td>
							<td class='term'>{{ round($loanproduct->term / 12, 1) }} {{ $loanproduct->term == 12 ? 'Year' : 'Years' }}</td>
							<td class="text-center">
								<div class="dropdown">
									<button class="btn btn-primary btn-xs dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
									{{ _lang('Action') }}
									</button>
									<form action="{{ route('loan_products.destroy', $loanproduct['id']) }}" method="post">
									@csrf
									<input name="_method" type="hidden" value="DELETE">

									<div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
										<a href="{{ route('loan_products.edit', $loanproduct['id']) }}" class="dropdown-item dropdown-edit dropdown-edit"><i class="ti-pencil-alt"></i>&nbsp;{{ _lang('Edit') }}</a>
										<button class="btn-remove dropdown-item" type="submit"><i class="ti-trash"></i>&nbsp;{{ _lang('Delete') }}</button>
									</div>
									</form>
								</div>
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