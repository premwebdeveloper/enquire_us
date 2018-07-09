<?php echo $__env->make('includes.public_head', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>

<?php echo $__env->make('includes.public_header', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>

    <?php echo $__env->yieldContent('content'); ?>

<?php echo $__env->make('includes.public_footer', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>