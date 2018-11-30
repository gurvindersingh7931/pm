<?php $__env->startSection('body'); ?>
<section>
	<div class="container text-center">
		<div class="columns is-multiline">
			<?php $__currentLoopData = $users; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $user): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
			<div class="column is-one-quarter">
				<article class="box">
					<p class="title"><?php echo e($user->name); ?></p>
					<!-- <?php $__currentLoopData = $user->unreadNotifications; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $notification): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?> -->
					<!-- <?php echo e($notification['data']['message']); ?> -->
					<!-- <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?> -->
					<form method="POST" action="users/<?php echo e($user->id); ?>/reminders">
						<?php echo e(csrf_field()); ?>

						<input type="text" name="message" class="form-control">
						<br>
						<button type="submit" class="button is-primary">Create Reminder</button>
					</form>
				</article>
			</div>
			<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
		</div>
	</div>
</section>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('partials.nav', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>