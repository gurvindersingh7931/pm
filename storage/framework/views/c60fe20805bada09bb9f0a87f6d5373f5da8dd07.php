<?php if(session('status')): ?>
<div class="notification is-success">
	<?php echo e(session('status')); ?>

</div>
<?php endif; ?>