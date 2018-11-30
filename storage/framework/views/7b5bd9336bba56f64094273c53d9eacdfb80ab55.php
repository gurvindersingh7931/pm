<?php $__env->startSection('content'); ?>
	<section>
		<div class="container">
			
			<div class="columns">
				<div class="column is-4 is-offset-4">
					<div class="card" style="margin-top: 64px;">
						<div class="card-content">
							<div class="content">
								<h1 class="has-text-centered">Register</h1>
							</div>
							<form method="POST" action="/register">
								<?php echo e(csrf_field()); ?>

								<div class="field">
									<div class="control has-icons-left">
										<input class="input" type="text" name="name" placeholder="Full Name">
										<span class="icon is-left">
										    <i class="fa fa-user"></i>
										</span>
									</div>
								</div>
								<div class="field">
									<div class="control has-icons-left">
										<input class="input" type="email" name="email" placeholder="Email">
										<span class="icon is-left">
										    <i class="fa fa-envelope"></i>
										</span>
									</div>
								</div>
								<div class="field">
									<div class="control has-icons-left">
										<input class="input" type="password" name="password" placeholder="Password">
										<span class="icon is-left">
										    <i class="fa fa-key"></i>
										</span>
									</div>
								</div>
								<div class="field">
									<div class="control has-icons-left">
										<input class="input" type="password" name="password_confirmation" placeholder="Confirm Password">
										<span class="icon is-left">
										    <i class="fa fa-key"></i>
										</span>
									</div>
								</div>
								<div class="field">
									<div class="control">
										<button type="submit" class="button is-full-width">Sign Up</button>
									</div>
								</div>
								<div class="has-text-centered">Already a member? <a href="/login">Login</a></div>
								<?php echo $__env->make('partials.errors', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
							</form>
						</div>
					</div>
				</div>
			</div>
		</div>
	</section>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layout', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>