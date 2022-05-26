<?php $__currentLoopData = $parent; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $category): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
	<div class="d-flex col-12 flex-row mt-2 ml-auto mr-auto p-2 justify-content-between" 
			data-toggle="collapse" 
			data-target="#sub_category-<?php echo e($category->id); ?>" 
			aria-controls="category-<?php echo e($category->id); ?>">
		<h4 class="pl-2 pt-2">
			<?php echo e($category->{'name_'.App::getLocale()}); ?>

		</h4>
		<h4 class="pt-2">
			<i class="fa fa-chevron-left" aria-hidden="true"></i>
		</h4>
	</div>
	<div class="col-12 ml-auto mr-auto p-0 collapse" 
			id="sub_category-<?php echo e($category->id); ?>" 
			data-parent="#category-<?php echo e($parent_id); ?>" 
			role="open">
		<div class="d-flex flex-column mt-2 p-0 justify-content-between">
			 <?php $__currentLoopData = $category->services()->where('published', 1)->orderBy('pivot_order', 'ASC')->get(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $service): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
			 	<div class="d-flex flex-row justify-content-start-left pt-2 pl-4 pr-4 interlaced"> 
				 	<h5><?php echo e($service->code); ?></h5>
				 	<h5 class="pl-2"><?php echo e($service->{'name_'.App::getLocale()}); ?></h5>
				 	<h5 class="ml-auto">
				 		<?php echo $__env->make('pricelist.price_field', ['service' => $service], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
 					</h5>
			 	</div>
			 <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
		</div>
	</div>
	
	<?php if(count($category->children()->where('published', 1)->get()) > 0): ?>
		
		<?php echo $__env->make('pricelist.subcat', [
				'parent' => $category->children()->where('published',1)->orderBy('pivot_order', 'ASC')->get(),
				'parent_id' => $category->id
			], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
	<?php endif; ?>
	
<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
	

  <?php /**PATH /home/smpd/public_html/resources/views/pricelist/subcat.blade.php ENDPATH**/ ?>