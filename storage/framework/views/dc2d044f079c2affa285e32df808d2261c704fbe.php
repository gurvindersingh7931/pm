<?php $__env->startSection('body'); ?>
<section>
	<div class="container">
		<div class="columns">
			<div class="column is-one-quarter">
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

			</div>
		</div>
	</div>
</section>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('partials.nav', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>