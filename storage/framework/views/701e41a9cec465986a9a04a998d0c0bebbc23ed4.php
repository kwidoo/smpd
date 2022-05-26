<?php echo csrf_field(); ?>
<input type="hidden" name="version" value="mobile">
<div class="d-flex flex-column col-7 col-sm-5 ml-auto mr-auto mt-5 mb-5">
	<h2>
		<?php echo e(__('messages.callme')); ?>

	</h2>
	<h4>
		<?php echo e(__('messages.callback')); ?>

	</h4>
	<label for="name"><?php echo e(__('messages.your-name')); ?> </label>
	<div class="input-group">
		<div class="input-group-prepend input-group-lg">
			<span class="input-group-text"><i class="fa fa-user fa" aria-hidden="true"></i></span>
			</div>
		<input class="form-control" type="text" name="name" id="name" value="<?php echo e(old('name')); ?>" required>
	</div>
	<?php if($errors->has('name')): ?>
        <span class="invalid-feedback" role="alert">
            <strong><?php echo e($errors->first('name')); ?></strong>
        </span>
    <?php endif; ?>
	<br>
	<label for="phone"><?php echo e(__('messages.your-phone')); ?> </label>
	<div class="input-group">
		<div class="input-group-prepend input-group-lg">
			<span class="input-group-text"><i class="fa fa-phone fa" aria-hidden="true"></i></span>
			</div>
			<input class="form-control" type="text" name="phone" id="phone" value="<?php echo e(old('phone')); ?>">
	</div>
	<?php if($errors->has('phone')): ?>
        <span class="invalid-feedback" role="alert">
            <strong><?php echo e($errors->first('phone')); ?></strong>
        </span>
	<?php endif; ?>	
	<div class="d-flex flex-row w-100 mt-3 justify-content-between">
		<div class="col p-0 text-right">
			<button type="submit" name="submit" class="btn btn-primary"><?php echo e(__('Отправить')); ?></button>
		</div>
	</div>		
</div><?php /**PATH /Volumes/Oleg's HD/Users/0p/Documents/dev/Local Server/www/smpd-nova/resources/views/partials/templates/callback-mobile.blade.php ENDPATH**/ ?>