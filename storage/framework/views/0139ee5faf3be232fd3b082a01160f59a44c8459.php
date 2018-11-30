<?php $__env->startSection('body'); ?>
<div class="container">
	<div class="content">
		<table class="table">
			<thead>
				<tr>
					<th>Name</th>
					<th>Email</th>
					<th>Privilage</th>
					<th>Edit</th>
				</tr>
			</thead>
			<tbody>
				<?php $__currentLoopData = $users; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $user): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
					<tr>
						<td><?php echo e($user->name); ?></td>
						<td><?php echo e($user->email); ?></td>
						<?php if($user->privilage == 0): ?>
						<td>Super Admin</td>
						<?php elseif($user->privilage == 1): ?>
						<td>Manager</td>
						<?php elseif( $user->privilege == 2): ?>
						<td>Employee</td>
						<?php else: ?>
						<td>Blocked</td>
						<?php endif; ?>
						<?php if($user->id != 1 || auth()->user()->id == $user->id): ?>
						<td><a href="/users/<?php echo e($user->id); ?>/edit">Edit User</a></td>
						<?php else: ?>
						<td><span class="badge badge-pill badge-danger">You can't edit this user.</span></td>
						<?php endif; ?>
					</tr>
				<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
			</tbody>
		</table>
	</div>
</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('partials.nav', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>