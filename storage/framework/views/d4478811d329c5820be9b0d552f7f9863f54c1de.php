<?php $__env->startSection('content'); ?>
    <div>
        <loading ref="loading"></loading>

        <transition name="fade" mode="out-in">
            <router-view :key="$route.name + ($route.params.resourceName || '')"></router-view>
        </transition>

        <portal-target name="modals" multiple></portal-target>
    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('nova::layout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /Volumes/Oleg's HD/Users/0p/Documents/dev/Local Server/www/smpd/packages/nova/src/../resources/views/router.blade.php ENDPATH**/ ?>