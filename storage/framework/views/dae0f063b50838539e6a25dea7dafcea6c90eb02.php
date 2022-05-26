<?php $__env->startSection('title', 'Login'); ?>

<?php $__env->startSection('content'); ?>
<section role="login">
    <div class="d-flex flex-row justify-content-center">
        <div class="d-flex flex-column col-md-4 col-8 mt-5 pt-5">
            <div class="login-logo mt-5 pt-5">
                <a href="\">
                    <img src="/img/logo/logo.svg" class="img-fluid"/>
                </a>
            </div>
            <div class="login-box-body">
                <h3><?php echo e(__('Login')); ?></h3>
                <form method="POST" action="<?php echo e(route('login')); ?>" aria-label="<?php echo e(__('Login')); ?>">
                    <?php echo csrf_field(); ?>
                    <div class="form-group has-feedback">
                        <input 
                            id="email" 
                            type="email" 
                            class="form-control<?php echo e($errors->has('email') ? ' is-invalid' : ''); ?>" 
                            name="email" 
                            value="<?php echo e(old('email')); ?>" 
                            required 
                            autofocus>
                        <?php if($errors->has('email')): ?>
                            <span class="invalid-feedback" role="alert">
                                <strong><?php echo e($errors->first('email')); ?></strong>
                            </span>
                        <?php endif; ?>
                    </div>
                    <div class="form-group has-feedback">
                        <input 
                            id="password" 
                            type="password" 
                            class="form-control<?php echo e($errors->has('password') ? ' is-invalid' : ''); ?>" 
                            name="password" 
                            required>
                        <?php if($errors->has('password')): ?>
                            <span class="invalid-feedback" role="alert">
                                <strong><?php echo e($errors->first('password')); ?></strong>
                            </span>
                        <?php endif; ?>
                    </div>
                    <div class="row">
                        <div class="col-xs-offset-8 col-xs-4">
                            <button type="submit" class="btn btn-primary btn-block btn-flat"><?php echo e(__('Login')); ?></button>
                        </div>
                     </div>
                </form>
            </div>
        </div>
    </div>
</section>
<?php $__env->stopSection(); ?>



<?php echo $__env->make('layouts.login', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/smpd/public_html/resources/views/auth/login.blade.php ENDPATH**/ ?>