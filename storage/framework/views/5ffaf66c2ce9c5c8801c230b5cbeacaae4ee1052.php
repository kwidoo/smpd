
<?php if($service->prices()->exists()): ?>
<?php if($service->prices()->where('type', 0)->first() !== null): ?>
	<?php if($service->prices()->where('type', 0)->first()->value_from > 0): ?>
		<?php if($service->prices()->where('type', 0)->first()->discounts()->first() !== NULL): ?>
			no <strike><?php echo e(number_format($service->prices()->where('type', 0)->first()->value_from,2)); ?></strike>
			<?php echo e(number_format($service->prices()->where('type', 0)->first()->discounts()->first()->value, 2)); ?> EUR
		<?php else: ?>
			no <?php echo e(number_format($service->prices()->where('type', 0)->first()->value_from,2)); ?> EUR
		<?php endif; ?>
	<?php else: ?>
		<?php if($service->prices()->where('type', 0)->first()->discounts()->first() !== NULL): ?>
			<strike><?php echo e(number_format($service->prices()->where('type', 0)->first()->value,2)); ?></strike>
			<?php echo e(number_format($service->prices()->where('type', 0)->first()->discounts()->first()->value, 2)); ?> EUR
		<?php else: ?>
			<?php echo e(number_format($service->prices()->where('type', 0)->first()->value,2)); ?> EUR	
		<?php endif; ?>
	<?php endif; ?>
<?php else: ?>
<?php echo e(info($service->id)); ?>

<?php endif; ?>
<?php endif; ?>
<?php /**PATH /home/smpd/public_html/resources/views/pricelist/price_field.blade.php ENDPATH**/ ?>