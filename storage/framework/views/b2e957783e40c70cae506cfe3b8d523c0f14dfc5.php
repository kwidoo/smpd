<div class="col-6 col-sm-3 col-lg-2 p-0 sortable" 
	data-toggle="collapse" 
	data-target="#doctor" 
	data-id="<?php echo e($doctor->id); ?>" 
	aria-expanded="true" 
	aria-controls="doctor-<?php echo e($doctor->id); ?>" 
	>
	<div class="d-flex flex-column align-items-center p-4 p-sm-2">
		<img src="/storage/<?php echo e($doctor->avatar); ?>" 
			class="img-fluid" 
			alt="<?php echo e($doctor->{'name_'.App::getLocale()}); ?>" 
 			data-gender="<?php echo e($doctor->gender); ?>"
			/>
		<h4>
			<?php echo e($doctor->{'name_'.App::getLocale()}); ?>

		</h4>
		<h5 class="text-lowercase text-center">
			<?php echo e($doctor->{'small_'.App::getLocale()}); ?>

		</h5>
  	</div>
</div><?php /**PATH /home/smpd/public_html/resources/views/partials/templates/main_doctor.blade.php ENDPATH**/ ?>