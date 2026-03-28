@extends('layouts.app')

@section('content')
<div class="row">
	<div class="col-lg-8 offset-lg-2">
		<div class="card">
			<div class="card-header">
				<span class="header-title">{{ _lang('Add New Branch') }}</span>
			</div>
			<div class="card-body">
			    <form method="post" class="validate" autocomplete="off" action="{{ route('branches.store') }}" enctype="multipart/form-data">
					@csrf
					<div class="row">
						<div class="col-md-6">
							<div class="form-group">
								<label class="control-label">{{ _lang('Branch Name') }} <span class="text-danger">*</span></label>
								<input type="text" class="form-control" name="name" id="branch_name" value="{{ old('name') }}" required>
							</div>
						</div>

						<div class="col-md-6">
							<div class="form-group">
								<label class="control-label">{{ _lang('Branch Code') }}</label>
								<input type="text" class="form-control" name="branch_code" id="branch_code" value="{{ old('branch_code') }}" placeholder="{{ _lang('Enter branch code') }}">
							</div>
						</div>

						<div class="col-md-6">
							<div class="form-group">
								<label class="control-label">{{ _lang('State') }}</label>
								<input type="text" class="form-control" name="state" value="{{ old('state') }}">
							</div>
						</div>

						<div class="col-md-6">
							<div class="form-group">
								<label class="control-label">{{ _lang('Branch Manager') }}</label>
								<select class="form-control" name="branch_manager_id">
									<option value="">{{ _lang('Select Manager') }}</option>
									@foreach($managers as $manager)
										<option value="{{ $manager->id }}" {{ old('branch_manager_id') == $manager->id ? 'selected' : '' }}>{{ $manager->name }}</option>
									@endforeach
								</select>
							</div>
						</div>

						<div class="col-md-6">
							<div class="form-group">
								<label class="control-label">{{ _lang('Contact Email') }}</label>
								<input type="text" class="form-control" name="contact_email" value="{{ old('contact_email') }}">
							</div>
						</div>

						<div class="col-md-6">
							<div class="form-group">
								<label class="control-label">{{ _lang('Contact Phone') }}</label>
								<input type="text" class="form-control" name="contact_phone" value="{{ old('contact_phone') }}">
							</div>
						</div>

						<div class="col-md-12">
							<div class="form-group">
								<label class="control-label">{{ _lang('Address') }}</label>
								<textarea class="form-control" name="address">{{ old('address') }}</textarea>
							</div>
						</div>

						<div class="col-md-12">
							<div class="form-group">
								<label class="control-label">{{ _lang('Descriptions') }}</label>
								<textarea class="form-control" name="descriptions">{{ old('descriptions') }}</textarea>
							</div>
						</div>

						<div class="col-md-12">
							<div class="form-group">
								<button type="submit" class="btn btn-primary"><i class="ti-check-box"></i>&nbsp;{{ _lang('Save') }}</button>
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
