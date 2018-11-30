<?php $__env->startSection('body'); ?>
<div class="">
			<h3>Completed Reminders:</h3>
	<div class="columns">

		<!-- Display Completed Reminders -->
		<?php if(Auth::user()->privilage <= 1): ?>
		<div class="column">
			<div class="table__wrapper">
				<table class="table is-fullwidth">
					<thead>
						<tr class="card">
							<th>Title</th>
							<th>Priority</th>
							<th>Created On</th>
							<th>Completed On</th>
						</tr>
					</thead>
					<tbody>
						<?php if($reminders->count() > 0): ?>
							<?php $__currentLoopData = $reminders; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $reminder): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
							<tr class="card">
								<td><?php echo e($reminder->data); ?></a></td>
								<td><?php echo e($reminder->priority); ?></td>
								<td><?php echo e($reminder->created_at); ?></td>
								<td><?php echo e($reminder->updated_at); ?></td>
							</tr>
							<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>	
						<?php else: ?>
							<tr class="card"><td colspan="4"><center>No Reminders are marked as done yet.</center></td></tr>
						<?php endif; ?>
					</tbody>
				</table>
			</div>
		</div>
		<?php endif; ?>
	</div>
</div>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('partials.nav', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>