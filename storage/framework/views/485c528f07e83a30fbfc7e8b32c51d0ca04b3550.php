<!DOCTYPE html>
<html lang="<?php echo e(app()->getLocale()); ?>">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title><?php echo $__env->yieldContent('title'); ?> | SMP Doktorāts</title>
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport"> 
    <meta name="csrf-token" content="<?php echo e(csrf_token()); ?>">

    <link href="<?php echo e(asset('css/app.css')); ?>" rel="stylesheet">
   
</head>
<body class="hold-transition <?php echo e(config('adminltelaravel.skin','skin-blue')); ?> sidebar-mini">
    <?php echo $__env->yieldContent('content'); ?>
    <script src="<?php echo e(asset('js/app.js')); ?>"></script>     
	<script>
	  	const page = "login";
	</script>
</body>
</html>
<?php /**PATH /home/smpd/public_html/resources/views/layouts/login.blade.php ENDPATH**/ ?>