<?php $__env->startSection('body'); ?>
	<section>
		<div class="container card">
			<form method="POST" action="/projects">
				<?php echo e(csrf_field()); ?>

				<div class="field">
					<label for="name">Project Name</label>
					<div class="control">
						<input type="text" name="name" class="form-control">
					</div>
				</div>
				<div class="field">
					<div class="control">
						<button class="button btn-lg is-primary center-block" type="Submit">Create a project</button>
					</div>
				</div>
				<?php echo $__env->make('partials.errors', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
			</form>
		</div>
	</section>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('partials.nav', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>