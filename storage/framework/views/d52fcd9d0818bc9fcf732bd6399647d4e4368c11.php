<?php $__env->startSection('title', __('messages.actions')); ?>

<?php $__env->startSection('content'); ?>

<section role="main" class="pl-sm-4 pr-sm-4 mt-1 ">
    <div id="carouselExampleControls" class="carousel slide" data-ride="carousel">
 
        <ol class="carousel-indicators">
         <?php $__currentLoopData = $photos; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $photo): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <li data-target="#carouselExampleIndicators" data-slide-to="<?php echo e($loop->index); ?>" class="<?php echo e($loop->first ? 'active' : ''); ?>" data-interval="5000"></li>
         <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </ol>
       
        <div class="carousel-inner" role="listbox">
          <?php $__currentLoopData = $photos; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $photo): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
             <div class="carousel-item <?php echo e($loop->first ? 'active' : ''); ?>">
                 <img class="d-block img-fluid mx-auto" src="<?php echo e($photo->image); ?>" alt="<?php echo e($photo->title); ?>">
                    <div class="carousel-caption d-none d-md-block">
                       <h3><?php echo e($photo->title); ?></h3>
                       <p><?php echo e($photo->descriptoin); ?></p>
                    </div>
             </div>
          <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </div>
        <a class="carousel-control-prev" href="#carouselExampleControls" role="button" data-slide="prev">
          <span class="carousel-control-prev-icon" aria-hidden="true"></span>
          <span class="sr-only">Previous</span>
        </a>
        <a class="carousel-control-next" href="#carouselExampleControls" role="button" data-slide="next">
          <span class="carousel-control-next-icon" aria-hidden="true"></span>
          <span class="sr-only">Next</span>
        </a>
      </div>
</section>

<?php $__env->stopSection(); ?>

  
<?php echo $__env->make('layouts.frontend', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /Volumes/Oleg's HD/Users/0p/Documents/dev/Local Server/www/smpd/resources/views/actions.blade.php ENDPATH**/ ?>