<?php $__env->startSection('title', __('messages.services')); ?>

<?php $__env->startSection('content'); ?>

<section role="main" class="pl-sm-4 pr-sm-4 mt-1">
	<div id="accordeon" 
		 class="d-flex flex-row flex-wrap pt-2 p-0" 
		 <?php if(auth()->guard()->check()): ?>
			data-target="services.order"
		 <?php endif; ?>
		>
		
		<div class="collapse ontop" id="service" data-parent="#accordeon" role="open">
		</div>
		<?php $__currentLoopData = \App\Services::where('published','1')->orderBy('order','ASC')->get(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $service): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
			<?php echo $__env->make('partials.templates.main_service', ['service' => $service], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
		<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>    	
		
	</div>
</section>
<script>
	const page = "pakalpojumi";
</script>
<?php $__env->stopSection(); ?>


  
<?php echo $__env->make('layouts.frontend', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/smpd/public_html/resources/views/main.blade.php ENDPATH**/ ?>