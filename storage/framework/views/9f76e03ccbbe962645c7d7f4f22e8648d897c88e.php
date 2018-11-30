<?php $__env->startSection('content'); ?>
	<section>
		<div class="container">
			<div class="columns">
				<div class="column">
					<table class="table">
						<thead>
							<tr>
								<th>Read</th>
								<th>Data</th>
								<th>Project Nam</th>
								<th>Task Name</th>

							</tr>
						</thead>
						<tbody>
							<?php $__currentLoopData = $notifications; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $notification): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
							<tr>
								<?php if($notification->read_at == null): ?>
								<td><a href="/notifications/read/<?php echo e($notification->id); ?>">Mark As Read</a></td>
								<?php else: ?>
								<td>Read at <?php echo e($notification->read_at); ?></td>
								<?php endif; ?>
								<td><?php echo e($notification->data['message']); ?></td>
								<td><?php echo e(App\Task::find($notification->data['task_id'])->project->name); ?></td>
								<td><?php echo e(App\Task::find($notification->data['task_id'])->name); ?></td>
							</tr>
							<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>	
						</tbody>
					</table>
				</div>
			</div>
		</div>
	</section>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layout', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>