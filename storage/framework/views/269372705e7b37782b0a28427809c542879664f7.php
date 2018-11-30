<?php $__env->startSection('body'); ?>
<section>
	<div class="container">
		<div class="columns">
			<div class="column">
				<div class="content">
					<h1>
						<?php if($issue->is_resolved): ?>
						<span class="icon has-text-success">
						  <i class="fa fa-check-square"></i>
						</span>
						<?php else: ?>
						<span class="icon has-text-danger">
						  <i class="fa fa-ban"></i>
						</span>
						<?php endif; ?>
						<?php echo e($issue->title); ?>

					</h1>
					<p><?php echo e($issue->description); ?></p>
					<?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('update', $issue)): ?>
					<form method="POST" action="/issues/<?php echo e($issue->id); ?>">
						<?php echo e(csrf_field()); ?>

						<?php echo e(method_field('PATCH')); ?>

						<?php if($issue->is_resolved): ?>
						<button class="button is-success">Re-open Issue</button>
						<?php else: ?>
						<button type="Submit" class="button is-danger">Mark as Resolved</button>
						<?php endif; ?>
					</form>
					<?php endif; ?>
				</div>
				<hr>
				<article class="media">
					<div class="media-content">
						<div class="content">
							<?php $__currentLoopData = $issue->comments; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $comment): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
							<p>
								<strong><?php echo e(App\User::find($comment->created_by)->name); ?></strong> <small><?php echo e($comment->created_at->diffForHumans()); ?></small>
								<p><?php echo e($comment->body); ?></p>
								<?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('delete', $comment)): ?>
								<form method="POST" action="/comments/<?php echo e($comment->id); ?>">
									<?php echo e(csrf_field()); ?>

									<?php echo e(method_field('DELETE')); ?>

									<button type="Submit" class="button is-danger">
										<span class="icon is-small">
										  <i class="fa fa-trash"></i>
										</span>
									</button>
								</form>
								<?php endif; ?>
							</p>
							<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>			
						</div>
					</div>
				</article>
				<?php if(!$issue->is_resolved): ?>
				<article class="media">
					<div class="media-content">
						
						<form method="POST" action="/issues/<?php echo e($issue->id); ?>/comments">
							<?php echo e(csrf_field()); ?>

							<div class="field">
								<textarea class="textarea" name="body"></textarea>
							</div>
							<div class="field">
								<button class="button is-primary" type="Submit">Add comment</button>
							</div>
						</form>
					</div>
				</article>
				<?php endif; ?>
			</div>
		</div>
	</div>
</section>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('partials.nav', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>