<?php $__env->startSection('body'); ?>
	<section>
		<div class="container">
			
			<div class="columns">
				<div class="column is-4 is-offset-4">
					<div class="card" style="margin-top: 64px;">
						<div class="card-content">
							<div class="content">
								<h1 class="has-text-centered">Register</h1>
							</div>
							<form method="POST" action="/users/<?php echo e($user->id); ?>">
								<?php echo e(method_field('PATCH')); ?>

								<?php echo e(csrf_field()); ?>

								<?php echo $__env->make('partials.status', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
								<div class="field">
									<div class="control has-icons-left">
										<input class="input" type="text" name="name" placeholder="Full Name" value="<?php echo e($user->name); ?>">
										<span class="icon is-left">
										    <i class="fa fa-user"></i>
										</span>
									</div>
								</div>
								<div class="field">
									<div class="control has-icons-left">
										<input class="input" type="email" name="email" placeholder="Email" value="<?php echo e($user->email); ?>">
										<span class="icon is-left">
										    <i class="fa fa-envelope"></i>
										</span>
									</div>
								</div>
								<div class="field">
									<div class="control">
										<div class="select">
											<select name="privilage">
												<?php $__currentLoopData = $privilages; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $privilage): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
													<?php if($user->privilage == $privilage['value']): ?>
														<option value="<?php echo e($privilage['value']); ?>" selected><?php echo e($privilage['name']); ?></option>
													<?php else: ?>
														<option value="<?php echo e($privilage['value']); ?>"><?php echo e($privilage['name']); ?></option>
													<?php endif; ?>
												<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
											</select>
										</div>
									</div>
								</div>
								<div class="field">
									<div class="control">
										<button type="submit" class="button is-full-width">Update Data</button>
									</div>
								</div>
								<?php echo $__env->make('partials.errors', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
							</form>
						</div>
					</div>
				</div>
			</div>
		</div>
	</section>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('partials.nav', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>