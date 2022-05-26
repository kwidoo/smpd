<section role="header">
	
	<div class="d-none d-md-flex flex-md-row justify-content-between">
		<div class="col p-0 mt-3 d-flex flex-row justify-content-end">
				<a href="/">
					<img src="<?php echo e(asset(Config('smpd.logo'))); ?>" class="img-fluid">
				</a>
		</div>
		<div class="col-6 p-0 mt-3 text-center">
			<ul class="list-group d-sm-flex flex-column">
				<li class="list-group-item border-0 p-0">
					<h1 class="m-0">
						<a href="maps://maps.google.com/?q=<?php echo e(Config('smpd.address')); ?>">
						<?php echo e(Config('smpd.address')); ?>

						</a>
					</h1>
				</li>
				<li class="list-group-item border-0">					
					<h2 class="m-0">
						<a href="tel:<?php echo e(Config('smpd.phone')); ?>">
							<?php echo e(Config('smpd.phone')); ?>

						</a>
					</h2>
				</li>
				<li class="d-flex flex-row list-group-item border-0">
					<a data-toggle="modal" data-target="#callback" class="col-12 col-md-6 ml-auto mr-auto mb-0">
						<h4 class="pt-2 pb-2">
							<?php echo e(__('messages.callme')); ?>

						</h4>
					</a>

				</li>
			</ul>
		</div>
		<div class="col-3 p-0">
			<div class="d-flex flex-column">
				<div class="d-flex flex-row justify-content-end">
					<div class="col-3 facebook">
						<h2>
							<a href="//facebook.com/smpd.lv" class="pr-2" target="_blank" >
								<i class="fa fa-facebook-official" aria-hidden="true"></i>
							</a>
						</h2>
					</div>
					<div class="col-3 language">
						<h2>
							<a href="<?php echo e(route('lang', ['id' => 'lv'])); ?>" title="<?php echo e(__('Latviski')); ?>">
								LV
							</a>
						</h2>
					</div>
					<div class="col-3 language">
						<h2>
							<a href="<?php echo e(route('lang', ['id' => 'ru'])); ?>" title="<?php echo e(__('По-русски')); ?>">
								RU
							</a>
						</h2>
					</div>
				</div>
			</div>
		</div>
	</div>
	
	<div class="d-md-none d-flex flex-column justify-content-between mobile">
		<div class="d-flex flex-row align-items-stretch">
			<div class="col-6 text-center">
				<a href="/">
					<img src="<?php echo e(asset(Config('smpd.logo'))); ?>" class="img-fluid">
				</a>
			</div>
			<div class="col-6 language">
				<ul class="list-group d-flex flex-column h-100 justify-content-center mb-2 mt-2">
					<li class="list-group-item d-flex flex-row justify-content-end border-0">
						<a href="<?php echo e(route('lang', ['id' => 'lv'])); ?>" class="col-8 bd-green  bd-radius-sm text-center pt-2">
							<h3>
								Latviski
							</h3>
						</a>
					</li>
					<li class="list-group-item d-flex flex-row justify-content-end mb-2 mt-2 border-0">
						<a href="<?php echo e(route('lang', ['id' => 'ru'])); ?>" class="col-8 bd-green bd-radius-sm text-center justify-content-center pt-2">
							<h3>
								По-русски 
							</h3>
						</a>
					</li>
				</ul>
				
			</div>
		</div>
		<div class="d-flex flex-row mt-2 mb-2">
			<div class="col-4 text-center">
				<a href="maps://maps.google.com/?q=<?php echo e(Config('smpd.address')); ?>" class="pr-2">
					<div class="d-flex flex-row justify-content-center">
						<div class="col-12 col-sm-8 bg-green p-3 pt-4">
							<i class="fa fa-map fa-4x pb-2" aria-hidden="true"></i><br>
							<h3><?php echo e(Config('smpd.address')); ?></h3>
						</div>
					</div>
				</a> 			
			</div>
			<div class="col-4 text-center">
				<a data-toggle="collapse" data-target="#mobile" class="pr-2" id="callme">
					<div class="d-flex flex-row justify-content-center">
						<div class="col-12 col-sm-8  p-3 pt-4">
							<i class="fa fa-phone fa-4x pb-2" aria-hidden="true"></i><br>
							<h2><?php echo e(__('messages.callme')); ?></h2>
						</div>
					</div>
				</a>
			</div>
			<div class="col-4 text-center">
				<a href="tel:<?php echo e(Config('smpd.phone')); ?>" class="pr-2 mb-sm-1">
					<div class="d-flex flex-row justify-content-center">
						<div class="col-12 col-sm-8  p-3 pt-4">
							<i class="fa fa-phone fa-4x pb-2" aria-hidden="true"></i><br>
							<h2><?php echo e(Config('smpd.phone')); ?></h2>
						</div>
					</div>
				</a> 			
			</div>
		</div>
		<div class="collapse" id="mobile">
			<form method="POST" action="<?php echo e(route('callback')); ?>" role="callback">
				<?php echo $__env->make('partials.templates.callback-mobile', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
	    	</form>
		</div>
	</div>
</section>
<section role="callback">
	<div class="modal fade" id="callback" tabindex="-1" role="dialog" aria-labelledby="Callback" aria-hidden="true">
		<div class="modal-dialog modal-dialog-centered" role="document">
			<div class="modal-content">
				<form method="POST" action="<?php echo e(route('callback')); ?>" role="callback">
					<?php echo $__env->make('partials.templates.callback-desktop', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>	
				</form>
			</div>
		</div>
	</div>
</section><?php /**PATH /home/smpd/public_html/resources/views/partials/header.blade.php ENDPATH**/ ?>