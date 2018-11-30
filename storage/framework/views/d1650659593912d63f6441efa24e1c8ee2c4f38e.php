<?php $__env->startSection('body'); ?>
<section>
	<div class="container">
		<a class="button is-full-width is-outlined btn-success" href="/issues/<?php echo e($task->id); ?>/create" style="font-size: 20px">Open a new Issue</a>
		<div class="columns" style="margin-top: 16px;">
			<div class="column">
						<?php $__currentLoopData = $task->issues; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $issue): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
							<div class="card" style="margin-top: 16px">
								<header class="card-header">
									<p class="card-header-title">
										<?php echo e($issue->title); ?>

									</p>
								</header>
								<div class="card-content">
									<div class="content">
										<?php echo e($issue->description); ?>

										<br>
										<time><?php echo e($issue->created_at->diffForHumans()); ?></time>
									</div>
								</div>
								<footer class="card-footer">
								<div class="card-footer-item">
									Status:
								<?php if($issue->is_resolved): ?>
								<span class="icon has-text-success">
								  <i class="fa fa-check-square"></i>
								</span>
								<?php else: ?>
								<span class="icon has-text-danger">
								  <i class="fa fa-ban"></i>
								</span>
								<?php endif; ?>		
								</div>
								<a href="/tasks/<?php echo e($task->id); ?>/issues/<?php echo e($issue->id); ?>" class="card-footer-item">View</a>
								<div class="card-footer-item">Created By: <?php echo e(App\User::find($issue->user_id)->name); ?></div>
								</footer>
							</div>
						
						<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
					
				</table>
			</div>
		</div>
	</div>
</section>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('partials.nav', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>