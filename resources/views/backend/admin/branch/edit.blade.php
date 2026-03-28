@extends('layouts.app')

@section('content')
<div class="row">
	<div class="col-lg-8 offset-lg-2">
		<div class="card">
			<div class="card-header">
				<span class="header-title">{{ _lang('Update Branch') }}</span>
			</div>
			<div class="card-body">
				<form method="post" class="validate" autocomplete="off" action="{{ route('branches.update', $id) }}" enctype="multipart/form-data">
					@csrf
					<input name="_method" type="hidden" value="PATCH">
					<div class="row">
						<div class="col-md-6">
							<div class="form-group">
								<label class="control-label">{{ _lang('Branch Name') }} <span class="text-danger">*</span></label>
								<input type="text" class="form-control" name="name" id="branch_name" value="{{ $branch->name }}" required>
							</div>
						</div>

						<div class="col-md-6">
							<div class="form-group">
								<label class="control-label">{{ _lang('Branch Code') }}</label>
								<input type="text" class="form-control" name="branch_code" id="branch_code" value="{{ $branch->branch_code }}" placeholder="{{ _lang('Enter branch code') }}">
							</div>
						</div>

						<div class="col-md-6">
							<div class="form-group">
								<label class="control-label">{{ _lang('State') }}</label>
								<input type="text" class="form-control" name="state" value="{{ $branch->state }}">
							</div>
						</div>

						<div class="col-md-6">
							<div class="form-group">
								<label class="control-label">{{ _lang('Branch Manager') }}</label>
								<select class="form-control" name="branch_manager_id">
									<option value="">{{ _lang('Select Manager') }}</option>
									@foreach($managers as $manager)
										<option value="{{ $manager->id }}" {{ $branch->branch_manager_id == $manager->id ? 'selected' : '' }}>{{ $manager->name }}</option>
									@endforeach
								</select>
							</div>
						</div>

						<div class="col-md-6">
							<div class="form-group">
								<label class="control-label">{{ _lang('Contact Email') }}</label>
								<input type="text" class="form-control" name="contact_email" value="{{ $branch->contact_email }}">
							</div>
						</div>

						<div class="col-md-6">
							<div class="form-group">
								<label class="control-label">{{ _lang('Contact Phone') }}</label>
								<input type="text" class="form-control" name="contact_phone" value="{{ $branch->contact_phone }}">
							</div>
						</div>

						<div class="col-md-12">
							<div class="form-group">
								<label class="control-label">{{ _lang('Address') }}</label>
								<textarea class="form-control" name="address">{{ $branch->address }}</textarea>
							</div>
						</div>

						<div class="col-md-12">
							<div class="form-group">
								<label class="control-label">{{ _lang('Descriptions') }}</label>
								<textarea class="form-control" name="descriptions">{{ $branch->descriptions }}</textarea>
							</div>
						</div>

						<div class="col-md-12">
							<div class="form-group">
								<button type="submit" class="btn btn-primary"><i class="ti-check-box"></i>&nbsp;{{ _lang('Update') }}</button>
							</div>
						</div>
					</div>
				</form>
			</div>
		</div>
	</div>
</div>
@endsection

@section('js')
<script>
</script>
@endsection
