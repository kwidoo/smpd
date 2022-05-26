<section role="description">
	<div class="col-12 pt-4" 
		data-toggle="collapse" 
		data-target="#service-<?php echo e($service->id); ?>" 
		data-id="<?php echo e($service->id); ?>" 
		
		aria-expanded="true" 
		aria-controls="service-<?php echo e($service->id); ?>">
		<?php if(auth()->guard()->check()): ?>
		<div class="d-flex flex-column align-items-md-end pl-4">
			<button type="button" class="close pull-right" data-dismiss="collapse" aria-label="Close">
          		<span aria-hidden="true">&times;</span>
        	</button>
        </div>
        <?php endif; ?>
		<div class="d-flex flex-column align-items-md-start pl-4">
			<img src="/storage/<?php echo e($service->image ?? $service->avatar); ?>" 
				 class="img-fluid w-30" alt="<?php echo e($service->{'name_'.App::getLocale()}); ?>" 
			/>
			<h4>
				<?php echo e($service->{'name_'.App::getLocale()}); ?>

			</h4>
      	</div>
	</div>
	<div class="d-flex flex-column mt-4 pl-4 pr-4">
		<div class="d-flex flex-row">
			<div class="d-flex flex-column col-8" 
				<?php if(auth()->guard()->check()): ?>
					data-service="notebook" 				
					data-target="services.text_<?php echo e(App::getLocale()); ?>" 
					data-id="<?php echo e($service->id); ?>"
				<?php endif; ?>	
			>
				<?php echo $service->{'text_'.App::getLocale()}; ?>

			</div>
			<div class="col-4 text-white p-0 p-sm-2 ">
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
					<p><?php echo e(__('messages.working-time-values')); ?> <?php echo e($service->time); ?> </p>
				</div>
			</div>
		</div>
		<section role="price">
			<?php if(count($service->services2()->get()) > 0 || Auth::check()): ?>
				<div class="col-12 col-sm-9 col-md-10 col-lg-8 col-xl-7 ml-auto mr-auto mt-4">
					<ul class="d-flex flex-column p-0" >
						<?php $__currentLoopData = $service->services2()->orderBy('pivot_order', 'ASC')->get(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $service2): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
							<li class="d-flex flex-row">
								<div class="col-8" 
									data-service="editable" 
									data-type="text"
									data-id="<?php echo e($service2->pivot->id); ?>" 
									data-mode="popup" 
									data-target="servicesPivot.name_<?php echo e(App::getLocale()); ?>"					
									>
									

									<?php if($service2->pivot->{'name_'.App::getLocale()} !== NULL): ?>
										<?php echo e($service2->pivot->{'name_'.App::getLocale()}); ?>

									<?php else: ?>
										<?php echo e($service2->{'name_'.App::getLocale()}); ?>

									<?php endif; ?>
								</div>
								<div class="col-4 text-right">
									<?php echo $__env->make('pricelist.price_field', ['service' => $service2], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
								</div>
							</li >
						<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
						<li class="d-flex flex-row justify-content-end mt-4 ">
							<a href="<?php echo e(route('prices')); ?>" class="btn btn-primary btn-lg p-3 pl-5 pr-5 mr-2 text-uppercase"><?php echo e(__('messages.all-prices')); ?> </a>
						</li>
					</ul>
				</div>
			<?php endif; ?>
		</section>
		<?php if(count($service->doctors()->get()) > 0): ?> 
			<h4 class="mt-4" 
				<?php if(auth()->guard()->check()): ?>
					data-service="editable" 				
					data-type="text" 
					data-target="services.doctors_<?php echo e(App::getLocale()); ?>" 
					data-id="<?php echo e($service->id); ?>

				<?php endif; ?>
			">
				<?php echo e($service->{'doctors_'.App::getLocale()}); ?>

			</h4>
		<?php endif; ?>		
		<div class="d-flex flex-row mb-3 doctors">
			<?php $__currentLoopData = $service->doctors()->orderBy('pivot_order', 'ASC')->get(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $doctor): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
				<a href="<?php echo e(route('doctors', ['id' => $doctor->id])); ?>" class="col-4 col-lg-2 pt-2 pl-4">
					<img src="/storage/<?php echo e($doctor->avatar); ?>" class="img-fluid" alt="<?php echo e($doctor->{'name_'.App::getLocale()}); ?>" data-gender="<?php echo e($doctor->gender); ?>"/>
					<h4 class="mb-0 text-center">
						<?php echo e($doctor->{'name_'.App::getLocale()}); ?>

					</h4>
					<h5 class="text-center text-lowercase">
						<?php echo e($doctor->{'small_'.App::getLocale()}); ?>	
					</h5>
				</a>
			<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
		</div>
	</div>
</section>
<?php /**PATH /home/smpd/public_html/resources/views/partials/service.blade.php ENDPATH**/ ?>