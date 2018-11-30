<?php $__env->startSection('body'); ?>
	<section>
		<div class="">
			<div class="columns">
				
				<!-- Display projects -->

				<?php if(Auth::user()->privilage <= 1): ?>
				<div class="column">
					<div class="table__wrapper">
						<table class="table is-fullwidth">
							<thead>
								<tr class="card">
									<th>Project Name</th>
									<th>Tasks</th>
									<th>Created By</th>
									<?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('assign', App\User::class)): ?>
									<th>Delete</th>
									<?php endif; ?>
								</tr>
							</thead>
							<tbody>
								<?php $__currentLoopData = $projects; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $project): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
								<tr class="card">
									<td><a href="/projects/<?php echo e($project->id); ?>"><?php echo e($project->name); ?></a></td>
									<td><?php echo e(count($project->tasks)); ?></td>
									<td><?php echo e($project->user->name); ?></td>
									<?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('delete', $project)): ?>
										<td>
											<form method="POST" action="/projects/<?php echo e($project->id); ?>">
												<?php echo e(method_field('DELETE')); ?>

												<?php echo e(csrf_field()); ?>

												<button type="submit" class="btn btn-danger">Delete</button>
											</form>
										</td>
									<?php endif; ?>

									<?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->denies('delete', $project)): ?>
									<td>
										You can't delete this
									</td>
									<?php endif; ?>
								</tr>
								<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>	
							</tbody>
						</table>
					</div>
				</div>
				<?php endif; ?>



				<!-- Display Reminders -->

				<?php if(Auth::user()->can('update', App\Notifications\Reminder::class)): ?>
				<div class="column is-one-quarter box" style="margin: 10px">
					<p class="h4 text-center">Reminders</p>
					<table class="table">
						<tbody>
							<?php if(count(Auth::user()->unreadNotifications->where('type', 'App\Notifications\Reminder')) > 0): ?>
								<?php $__currentLoopData = Auth::user()->unreadNotifications; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $notification): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
									<?php if($notification->type == App\Notifications\Reminder::class): ?>
										<tr>
											<td><?php echo e($notification['data']['message']); ?></td>
											<td>
												<form method="POST" action="/reminders/<?php echo e($notification->id); ?>/done">
													<?php echo e(csrf_field()); ?>

													<?php echo e(method_field('PATCH')); ?>


													<button class="button is-primary" type="submit">Mark as Done</button>
												</form>
											</td>
											<td>
												<form method="POST" action="/reminders/<?php echo e($notification->id); ?>/strike">
														<?php echo e(csrf_field()); ?>

													<button class="button btn-info" type="submit">Strike</button>
												</form>
											</td>
										</tr>
									<?php endif; ?>
								<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
							<?php else: ?>
								<a  class="navbar-item" href="#"><p class="h4" style="color: black">No new Reminders</p></a>
                        	<?php endif; ?>
						</tbody>
					</table>
				</div>
				<?php endif; ?>


				<!-- Display Appointments -->

				<?php if(Auth::user()->can('update', App\Notifications\Reminder::class)): ?>
				<div class="column is-one-quarter box" style="margin: 10px">
					<p class="h4 text-center">Appointments</p>
					<table class="table">
						<tbody>
							<?php if(count(Auth::user()->unreadNotifications->where('type', 'App\Notifications\Appointment')) > 0): ?>
								<?php $__currentLoopData = Auth::user()->unreadNotifications; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $notification): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
									<?php if($notification->type == App\Notifications\Appointment::class): ?>
										<tr>
											<td><?php echo e($notification['data']['message']); ?></td>
											<td>
												<form method="POST" action="/appointment/<?php echo e($notification->id); ?>/done">
													<?php echo e(csrf_field()); ?>

													<?php echo e(method_field('PATCH')); ?>


													<button class="button is-primary" type="submit">Mark as Done</button>
												
												</form>
											</td>
										</tr>
									<?php endif; ?>
								<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
							<?php else: ?>
								<a  class="navbar-item" href="#"><p class="h4" style="color: black">No new Appointments</p></a>
                        	<?php endif; ?>
						</tbody>
					</table>
				</div>
				<?php endif; ?>
			</div>

			<div class="columns">
				<?php if(Auth::user()->privilage == 0): ?>
				<div class="column">
					<p class="title">Tasks</p>
					<table class="table">
						<thead class="is-primary">
							<tr class="card">
								<th>Project Name</th>
								<th>Task</th>
								<th>Progress</th>
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
								<td><?php echo e($task->progress); ?> %</td>
								<td><a href="/tasks/<?php echo e($task->id); ?>">Notes</a></td>
								<td>
									<?php if(count($task->issues) > 0): ?>
									<a href="/tasks/<?php echo e($task->id); ?>/issues">View</a>
									<?php else: ?>
									No Issues
									<?php endif; ?>
								</td>
								<td><a href="/issues/<?php echo e($task->id); ?>/create" class="button is-outlined">Create Issue</a></td>
							</tr>
							<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>	
						</tbody>
					</table>
				</div>
				<div class="column is-one-third">
					<p class="title">Employees</p>
					
					<table class="table">
						<tbody>
						<?php $__currentLoopData = $employees; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $emp): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
						<tr>
							<td><?php echo e($emp->name); ?></td>
							<td>
								<?php echo e($emp->email); ?>

							</td>
						</tr>
						<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
						</tbody>
					</table>
				</div>
				<?php endif; ?>
			</div>
		</div>
	</section>
	
<?php $__env->stopSection(); ?>



<style type="text/css">
	.table__wrapper {
	  overflow-x: auto;
	}
</style>
<?php echo $__env->make('partials.nav', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>