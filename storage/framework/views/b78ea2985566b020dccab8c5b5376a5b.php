<form method="post" class="ajax-submit" autocomplete="off" action="<?php echo e(route('expenses.store')); ?>" enctype="multipart/form-data">
	<?php echo csrf_field(); ?>
	<div class="row px-2">
	    <div class="col-md-12">
			<div class="form-group">
				<label class="control-label"><?php echo e(_lang('Expense Date')); ?></label>						
				<input type="text" class="form-control datetimepicker" name="expense_date" value="<?php echo e(old('expense_date', now())); ?>" required>
			</div>
		</div>

		<div class="col-md-12">
			<div class="form-group">
				<label class="control-label"><?php echo e(_lang('Expense Category')); ?></label>						
				<select class="form-control auto-select select2" data-selected="<?php echo e(old('expense_category_id')); ?>" name="expense_category_id"  required>
					<option value=""><?php echo e(_lang('Select One')); ?></option>
					<?php $__currentLoopData = \App\Models\ExpenseCategory::all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $expense_category): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
					<option value="<?php echo e($expense_category->id); ?>"><?php echo e($expense_category->name); ?></option>
					<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
				</select>
			</div>
		</div>

		<div class="col-md-12">
			<div class="form-group">
				<label class="control-label"><?php echo e(_lang('Amount')); ?></label>	
				<div class="input-group mb-3">
					<div class="input-group-prepend">
						<span class="input-group-text" id="amount-addon"><?php echo e(currency(get_base_currency())); ?></span>
					</div>
					<input type="text" class="form-control float-field" name="amount" value="<?php echo e(old('amount')); ?>" aria-describedby="amount-addon" required>
				</div>
			</div>
		</div>

		<div class="col-md-12">
			<div class="form-group">
				<label class="control-label"><?php echo e(_lang('Reference')); ?></label>						
				<input type="text" class="form-control" name="reference" value="<?php echo e(old('reference')); ?>">
			</div>
		</div>

		<div class="col-md-12">
			<div class="form-group">
				<label class="control-label"><?php echo e(_lang('Note')); ?></label>						
				<textarea class="form-control" name="note"><?php echo e(old('note')); ?></textarea>
			</div>
		</div>

		<div class="col-md-12">
			<div class="form-group">
				<label class="control-label"><?php echo e(_lang('Attachment')); ?></label></br>						
				<input type="file" name="attachment">
			</div>
		</div>
	
		<div class="col-md-12 mt-2">
		    <div class="form-group">
			    <button type="submit" class="btn btn-primary"><i class="ti-check-box"></i>&nbsp;<?php echo e(_lang('Submit')); ?></button>
		    </div>
		</div>
	</div>
</form>
<?php /**PATH /home/u554938499/domains/app.alphagrantmanagement.com.au/public_html/resources/views/backend/admin/expense/modal/create.blade.php ENDPATH**/ ?>