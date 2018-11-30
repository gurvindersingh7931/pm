<?php $__env->startSection('content'); ?>
<div class="content has-text-centered" style="margin-top: 15%">
	<h1><?php echo e($exception->getMessage()); ?></h1>
</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('error_layout', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>