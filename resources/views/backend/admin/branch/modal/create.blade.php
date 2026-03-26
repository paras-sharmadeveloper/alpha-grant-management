<form method="post" class="ajax-submit" autocomplete="off" action="{{ route('branches.store') }}" enctype="multipart/form-data">
	@csrf
    <div class="row px-2">
		<div class="col-md-6">
			<div class="form-group">
				<label class="control-label">{{ _lang('Branch Name') }} <span class="text-danger">*</span></label>
				<input type="text" class="form-control" name="name" id="modal_branch_name" value="{{ old('name') }}" required>
			</div>
		</div>

		<div class="col-md-6">
			<div class="form-group">
				<label class="control-label">{{ _lang('Branch Code') }}</label>
				<input type="text" class="form-control bg-light" name="branch_code" id="modal_branch_code" readonly placeholder="{{ _lang('Auto-generated') }}">
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
						<option value="{{ $manager->id }}">{{ $manager->name }}</option>
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

<script>
$('#modal_branch_name').on('input', function() {
    var name = $(this).val().trim();
    if (name.length === 0) { $('#modal_branch_code').val(''); return; }
    $.get('{{ route('branches.generate_code') }}', { name: name }, function(res) {
        $('#modal_branch_code').val(res.code);
    });
});
</script>
