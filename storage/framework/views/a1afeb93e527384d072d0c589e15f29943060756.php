<?php $__env->startSection('title', __('messages.services')); ?>

<?php $__env->startSection('content'); ?>
	<div class="d-flex flex-row justify-content-center">
		<div class="col-11 col-md-10">
			<?php echo $__env->make('pricelist.pricelist', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
		</div>
	</div>
	<script>
		const page = "cenas";
	</script>
<?php $__env->stopSection(); ?>


  
<?php echo $__env->make('layouts.frontend', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/smpd/public_html/resources/views/pricelist/main.blade.php ENDPATH**/ ?>