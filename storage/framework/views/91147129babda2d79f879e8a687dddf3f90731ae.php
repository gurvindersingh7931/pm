<?php $__env->startSection('body'); ?>
<section>
	<div class="container">
		<div class="columns">
			<div class="column is-one-quarter">
				<?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('assign', App\User::class)): ?>
				<form method="POST" action="/projects/<?php echo e($project->id); ?>/tasks">
					<?php echo e(csrf_field()); ?>

					<div class="field">
						<label for="name">Task</label>
						<div class="control">
							<input class="input form-control" type="text" name="name" required>
						</div>
					</div>
					<div class="field">
						<label for="User">Employee</label>
						<div class="control">
							<select name="assigned_to" class="form-control">
								<?php $__currentLoopData = $employees; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $employee): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
									<option class="form-control" value="<?php echo e($employee->id); ?>"><?php echo e($employee->name); ?></option>
								<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
							</select>
						</div>
					</div>
					<div class="field">
						<label for="target">Deadline</label>
						<div class="control">
							<input class="input form-control" type="date" name="target">
						</div>
					</div>
					<div class="field">
						<div class="control">
							<button class="button is-primary form-control" type="submit">Create new task</button>
						</div>
					</div>
				</form>
				<?php else: ?>
				<form method="POST" action="/projects/<?php echo e($project->id); ?>/tasks">
					<?php echo e(csrf_field()); ?>

					<div class="field">
						<label for="name">Task</label>
						<div class="control">
							<input class="input" type="text" name="name">
						</div>
					</div>
					<div class="field">
						<label for="target">Deadline</label>
						<div class="control">
							<input class="input" type="date" name="target">
						</div>
					</div>
					<div class="field">
						<div class="control">
							<button class="button is-primary" type="submit">Create new task</button>
						</div>
					</div>
				</form>	
				<?php endif; ?>	
			</div>
			<div class="column">
				<div class="content">
					<h1><?php echo e($project->name); ?></h1>
					<table class="table">
						<thead>
							<tr class="card">
								<th>Task</th>
								<th>Progress</th>
								<th>Deadline</th>	
								<th>Assigned To</th>
								<th>Issues</th>
								<th>Action</th>
							</tr>
						</thead>
						<tbody>
							<?php $__currentLoopData = $project->tasks; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $task): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
							<tr class="card">
								<td>
									<a href="/tasks/<?php echo e($task->id); ?>"><?php echo e($task->name); ?></a>
								</td>
								<td><?php echo e($task->progress); ?> %</td>
								<td><?php echo e($task->target->diffForHumans()); ?></td>
								<td><?php echo e($task->user->name); ?></td>
								<td>
									<?php if(count($task->issues) > 0): ?>
									<a href="/tasks/<?php echo e($task->id); ?>/issues">View</a>
									<?php else: ?>
									No Issues
									<?php endif; ?>
								</td>
								<td><a href="/issues/<?php echo e($task->id); ?>/create" class="button is-outlined form-control">Create Issue</a></td>
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