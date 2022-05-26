<?php $__env->startSection('title', __('messages.doctors')); ?>

<?php $__env->startSection('content'); ?>

<section role="main" class="pl-sm-4 pr-sm-4 mt-1">
	<div id="accordeon" 
		 class="d-flex flex-row flex-wrap pt-2 p-0" 
		 <?php if(auth()->guard()->check()): ?>
			data-target="doctors.order"
		 <?php endif; ?>
		>
		
		<div class="collapse ontop" id="doctor" data-parent="#accordeon" role="open">
		</div>
		<?php $__currentLoopData = \App\Doctors::where('published','1')->orderBy('order','ASC')->get(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $doctor): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
			<?php echo $__env->make('partials.templates.main_doctor', ['doctor' => $doctor], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
		<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
	</div>
</section>
<script>
	const page="arsti"
</script>
<?php $__env->stopSection(); ?>

  
<?php echo $__env->make('layouts.frontend', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /Volumes/Oleg's HD/Users/0p/Documents/dev/Local Server/www/smpd/resources/views/doctors.blade.php ENDPATH**/ ?>