<div class="col-6 col-sm-4 col-lg-3 p-0 sortable" 
	data-toggle="collapse" 
	data-target="#service" 
	data-id="<?php echo e($service->id); ?>" 
	aria-expanded="true" 
	aria-controls="service-<?php echo e($service->id); ?>" 

	
	>
	<div class="d-flex flex-column align-items-center p-4 p-sm-2">
		<img src="/storage/<?php echo e($service->avatar); ?>" 
			class="img-fluid" 
			alt="<?php echo e($service->{'name_'.App::getLocale()}); ?>"/>
		<h4>
			<?php echo e($service->{'name_'.App::getLocale()}); ?>

		</h4>
		
  	</div>
</div><?php /**PATH /Volumes/Oleg's HD/Users/0p/Documents/dev/Local Server/www/smpd/resources/views/partials/templates/main_service.blade.php ENDPATH**/ ?>