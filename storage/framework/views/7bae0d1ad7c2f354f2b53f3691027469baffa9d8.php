<?php $__env->startSection('body'); ?>
	<section>
		<div class="container">
			<div class="columns">
				<div class="column">
					<div class="content">
						<h1>My Tasks</h1>
						<table class="table">
							<thead class="is-primary">
								<tr class="card">
									<th>Project Name</th>
									<th>Task</th>
									<th>Progress</th>
									<th>Deadline</th>
									<th>Start Date</th>
									<th>Notes</th>
									<th>Issues</th>
									<th>Action</th>
								</tr>
							</thead>
							<tbody>
								<?php $__currentLoopData = $tasks; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $task): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
								<tr class="card">
									<td><?php echo e($task->project->name); ?></td>
									<td><?php echo e($task->name); ?></td>
									<td><?php echo e($task->progress); ?> </td>
									<td><?php echo e($task->target); ?></td>
									<td><?php echo e($task->created_at); ?> </td>
									<td><a href="/tasks/<?php echo e($task->id); ?>">Notes</a></td>
									<td>
										<?php if(count($task->issues) > 0): ?>
										<a href="/tasks/<?php echo e($task->id); ?>/issues">View</a>
										<?php else: ?>
										No Issues
										<?php endif; ?>
									</td>
									<td><a href="/issues/<?php echo e($task->id); ?>/create" class="button is-outlined">Create Issue</a><a href="/task/create/<?php echo e($task->project_id); ?>" class="button is-outlined">Create Task</a></td>
								</tr>
								<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>	
							</tbody>
						</table>
					</div>	
				</div>
			</div>
		</div>
	</section>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('partials.nav', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>