<?php $__env->startSection('title', __('messages.doctors')); ?>

<?php $__env->startSection('content'); ?>

<section role="main" class="pl-sm-4 pr-sm-4 mt-1">
	<?php echo $__env->make('partials.doctor', ['doctor' => $doctor], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
</section>
<script>
	const page="arsti"
</script>
<?php $__env->stopSection(); ?>

  
<?php echo $__env->make('layouts.frontend', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/smpd/public_html/resources/views/doctor.blade.php ENDPATH**/ ?>