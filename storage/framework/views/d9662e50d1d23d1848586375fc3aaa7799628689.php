<section role="prices" class="pl-sm-4 pr-sm-4 mt-1">
	<div  id="accordion" 
		class="d-flex flex-column pt-2 p-0 align-items-center">
	
	<?php $__currentLoopData = \App\Categories::where('published',1)->with('services.prices')->orderBy('order', 'ASC')->get(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $category): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
			
         <?php if(count($category->parent()->where('published',1)->get()) == 0 || 
         	  in_array(0, $category->parent()->pluck('parent_id')->toArray())
         	  ): ?>
				<div class="d-flex col-12  flex-row mt-2 p-2 justify-content-between" 
						data-toggle="collapse" 
						data-target="#category-<?php echo e($category->id); ?>" 
						aria-controls="service-<?php echo e($category->id); ?>">
					<h4 class="pl-2 pt-2"><?php echo e($category->{'name_'.App::getLocale()}); ?></h4>
					<h4 class="pt-2"><i class="fa fa-chevron-left" aria-hidden="true"></i></h4>
				</div>

				<div class="col-12 p-2 collapse" id="category-<?php echo e($category->id); ?>" data-parent="#accordion" role="open">
					<div class="d-flex flex-column mt-2 p-0 justify-content-between">
						 <?php $__currentLoopData = $category->services()->where('published', 1)->orderBy('pivot_order', 'ASC')->get(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $service): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
						 	<div class="d-flex flex-row justify-content-start-left pt-2 pl-4 pr-4 interlaced">
							 	<?php if(isset($id)): ?>
							 		<input type="checkbox" class="icheckbox_flat-green" name="services[]" value="<?php echo e($service->id); ?>"
							 			<?php if(in_array($id, $service->services()->pluck('services_id')->toArray())): ?>
							 				 checked 
						 				<?php endif; ?>	
						 			/>&nbsp;							 	
						 		<?php endif; ?>
							 	<h5><?php echo e($service->code); ?></h5>
							 	<h5 class="pl-2"><?php echo e($service->{'name_'.App::getLocale()}); ?></h5>
							 	<h5 class="ml-auto">
									<?php echo $__env->make('pricelist.price_field', ['service' => $service], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
							 	</h5>
						 	</div>
						 <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
					</div>
					
					<?php if(count($category->children()->where('published', 1)->get()) > 0): ?>
						
						<?php echo $__env->make('pricelist.subcat', [
								'parent' => $category->children()->where('published',1)->orderBy('pivot_order', 'ASC')->get(),
								'parent_id' => $category->id
							], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
					<?php endif; ?>
				</div>
			<?php endif; ?>
		<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
	</div>
</section>


  <?php /**PATH /Volumes/Oleg's HD/Users/0p/Documents/dev/Local Server/www/smpd/resources/views/pricelist/pricelist.blade.php ENDPATH**/ ?>