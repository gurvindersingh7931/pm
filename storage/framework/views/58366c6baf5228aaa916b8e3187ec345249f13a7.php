<?php $__env->startSection('body'); ?>
    <div class="container">
        <h3 class="text-center">Search Result</h3>
        <hr>
        <h3 class="text-center">Users:</h3>
        <?php if(count($users) > 0): ?>
            <div class="row">
                <?php $__currentLoopData = $users; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $user): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <div class="col-sm-3">
                        <p class="lead-details"><?php echo e($user->name); ?></p>
                        <p class="details"><?php echo e($user->email); ?></p>
                        <?php if($user->privilage == 0): ?>
                            <p class="details">Super Admin</p>
                        <?php endif; ?>

                        <?php if($user->privilage == 1): ?>
                            <p class="details">Manager</p>
                        <?php endif; ?>

                        <?php if($user->privilage == 2): ?>
                            <p class="details">Employee</p>
                        <?php endif; ?>
                    </div>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </div>
        <?php else: ?>
            <h4>No Users found</h4>
        <?php endif; ?>
        <hr>
        <h3 class="text-center">Projects:</h3>
        <?php if(count($projects) > 0): ?>
            <div class="row">
                <br>
                <?php $__currentLoopData = $projects; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $project): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <div class="col-sm-3">
                        <a class="lead-details" href="/projects/<?php echo e($project->id); ?>"><?php echo e($project->name); ?></a>
                        <p class="details">Start Date: <?php echo e($project->created_at); ?></p>
                    </div>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </div>
        <?php else: ?>
            <h4>No Projects found</h4>
        <?php endif; ?>
    </div>
<?php $__env->stopSection(); ?>


<?php echo $__env->make('partials.nav', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>