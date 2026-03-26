@extends('layouts.app')

@section('content')
<div class="row">
	<div class="col-lg-12">
		<div class="card no-export">
		    <div class="card-header d-flex align-items-center">
				<span class="panel-title">{{ _lang('All Branch') }}</span>
				<a class="btn btn-primary btn-xs ml-auto ajax-modal" data-title="{{ _lang('Add New Branch') }}" href="{{ route('branches.create') }}"><i class="ti-plus"></i>&nbsp;{{ _lang('Add New') }}</a>
			</div>
			<div class="card-body">
				<div class="table-responsive">
				<table id="branches_table" class="table data-table">
					<thead>
					    <tr>
						    <th>{{ _lang('Branch Name') }}</th>
							<th>{{ _lang('Branch Code') }}</th>
							<th class="text-right">{{ _lang('Active Loans') }}</th>
							<th class="text-right">{{ _lang('Total Portfolio Value') }}</th>
							<th class="text-right">{{ _lang('Outstanding Balance') }}</th>
							<th class="text-right">{{ _lang('Arrears') }}</th>
							<th class="text-center">{{ _lang('Action') }}</th>
					    </tr>
					</thead>
					<tbody>
					    @foreach($branchs as $branch)
					    <tr data-id="row_{{ $branch->id }}">
							<td class='name'>
								{{ $branch->name }}
								@if($branch->contact_phone)
									<br><small class="text-muted"><i class="ti-mobile"></i> {{ $branch->contact_phone }}</small>
								@endif
							</td>
							<td class='branch_code'><span class="badge badge-secondary">{{ $branch->branch_code }}</span></td>
							<td class='text-right'>{{ $branch->active_loans_count ?? 0 }}</td>
							<td class='text-right'>{{ decimalPlace($branch->total_portfolio_value ?? 0, currency_symbol()) }}</td>
							<td class='text-right'>{{ decimalPlace($branch->outstanding_balance ?? 0, currency_symbol()) }}</td>
							<td class='text-right'>{{ decimalPlace($branch->arrears ?? 0, currency_symbol()) }}</td>
							<td class="text-center">
								<span class="dropdown">
								  <button class="btn btn-primary dropdown-toggle btn-xs" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
								  {{ _lang('Action') }}
								  </button>
								  <form action="{{ route('branches.destroy', $branch['id']) }}" method="post">
									@csrf
									<input name="_method" type="hidden" value="DELETE">
									<div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
										<a href="{{ route('branches.edit', $branch['id']) }}" data-title="{{ _lang('Update Branch') }}" class="dropdown-item dropdown-edit ajax-modal"><i class="ti-pencil-alt"></i>&nbsp;{{ _lang('Edit') }}</a>
										<a href="{{ route('branches.show', $branch['id']) }}" class="dropdown-item"><i class="ti-eye"></i>&nbsp;{{ _lang('View') }}</a>
										<button class="btn-remove dropdown-item" type="submit"><i class="ti-trash"></i>&nbsp;{{ _lang('Delete') }}</button>
									</div>
								  </form>
								</span>
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
