 </div>

    <!-- Scripts -->
     <?php echo $__env->make('includes.public_scripts', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
     <?php echo $__env->make('includes.public_custom_scripts', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>

</body>
</html>
