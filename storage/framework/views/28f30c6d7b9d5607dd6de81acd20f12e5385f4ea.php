<section role="description">
	<div class="col-12 pt-4" 
		data-toggle="collapse" 
		data-target="#doctor-<?php echo e($doctor->id); ?>" 
		data-id="<?php echo e($doctor->id); ?>" 
		aria-expanded="true" 
		aria-controls="doctor-<?php echo e($doctor->id); ?>">
		<div class="d-flex flex-row align-items-md-start pl-4">
			<div class="d-flex flex-column col-4">
				<img src="<?php echo e($doctor->image ?? $doctor->avatar); ?>" 
					class="img w-100" alt="<?php echo e($doctor->{'name_'.App::getLocale()}); ?>"  
					data-gender="<?php echo e($doctor->gender); ?>"
				/>
				<div class="text-white p-0 p-sm-2 ">
					<div class="p-sm-4 p-3 common" >
						<p><?php echo e(__('messages.register-phone')); ?></p>
						<p>
							<a href="tel:<?php echo e(Config('smpd.phone')); ?>">
								<i class="fa fa-phone" aria-hidden="true"></i>
								<?php echo e(Config('smpd.phone')); ?>

							</a>
						</p>
						<p>
							<a href="maps://maps.google.com/?q=<?php echo e(Config('smpd.address')); ?>">
								<i class="fa fa-home" aria-hidden="true"></i>
								<?php echo e(Config('smpd.address')); ?>

							</a>
						</p>
						<p><?php echo e(__('messages.working-time')); ?>:</p>
						<p>Pēc iepriekšēja pieraksta</p>
					</div>
				</div>
			</div>
			<div class="d-flex flex-column">
				<h4>
					<?php echo e($doctor->{'name_'.App::getLocale()}); ?>

				</h4>
				<h5>
					<?php echo e($doctor->{'title_'.App::getLocale()}); ?>

				</h5>
				<div class="d-flex flex-column col-8" >
						<?php echo $doctor->{'text_'.App::getLocale()}; ?>

				</div>
			</div>
      	</div>
	</div>
</section>
<?php /**PATH /Volumes/Oleg's HD/Users/0p/Documents/dev/Local Server/www/smpd/resources/views/partials/doctor.blade.php ENDPATH**/ ?>