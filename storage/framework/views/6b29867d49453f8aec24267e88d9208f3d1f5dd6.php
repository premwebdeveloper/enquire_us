<?php $__env->startSection('content'); ?>

<!-- #header -->
<div id="main" class="site-main">
	<div class="container">
		<div class="row">

            <!--Banner-->
            <div class="col-sm-12 banner-slider">
                <div class="row">

                    <div class="col-sm-8">
                        <div class="slider-wrapper theme-default">
                            <div id="slider" class="nivoSlider">
                                <?php $__currentLoopData = $sliders; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $slider): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <a href="javascript:;">
                                        <img class="img-responsive" src="storage/app/uploads/<?php echo e($slider->image); ?>" alt="Grand Sultan Tea Resort & Golf" />
                                    </a>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </div>
                        </div>
                    </div>

                    <div class="col-sm-4">
                        <div class="slider-wrapper theme-default">
                            <div id="slider1" class="nivoSlider">
                                
                                <a href="javascript:;">
                                    <img class="img-responsive" src="storage/app/uploads/apple.png" alt="Apple Caterers" />
                                </a>                                
                                <a href="javascript:;">
                                    <img class="img-responsive" src="storage/app/uploads/legal-dekho.png" alt="Legal Dekho" />
                                </a>                                
                                <a href="javascript:;">
                                    <img class="img-responsive" src="storage/app/uploads/mt-sales.png" alt="MT Sales Corp" />
                                </a>
                                
                            </div>
                        </div>
                        <div class="slider-wrapper theme-default">
                            <div id="slider2" class="nivoSlider">
                                
                                <a href="javascript:;">
                                    <img class="img-responsive" src="storage/app/uploads/saras-kripa.png" alt="Saras Kripa" />
                                </a>                                
                                <a href="javascript:;">
                                    <img class="img-responsive" src="storage/app/uploads/system-indus.png" alt="System Indus" />
                                </a>
                                
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <script type="text/javascript">
                $(document).ready(function() {
                    $('#slider').nivoSlider({
                        effect: 'random',                 // Specify sets like: 'fold,fade,sliceDown'
                        animSpeed: 1500,                   // Slide transition speed
                        pauseTime: 6000,                  // How long each slide will show
                        startSlide: 0,                    // Set starting Slide (0 index)
                        directionNav: true,               // Next & Prev navigation
                        controlNav: false,                 // 1,2,3... navigation
                        controlNavThumbs: false,          // Use thumbnails for Control Nav
                        pauseOnHover: true,               // Stop animation while hovering
                        manualAdvance: false,
                    });                    
                    $('#slider1').nivoSlider({
                        effect: 'random',                 // Specify sets like: 'fold,fade,sliceDown'
                        animSpeed: 1500,                   // Slide transition speed
                        pauseTime: 6000,                  // How long each slide will show
                        startSlide: 0,                    // Set starting Slide (0 index)
                        directionNav: true,               // Next & Prev navigation
                        controlNav: false,                 // 1,2,3... navigation
                        controlNavThumbs: false,          // Use thumbnails for Control Nav
                        pauseOnHover: true,               // Stop animation while hovering
                        manualAdvance: false,
                    });                    
                    $('#slider2').nivoSlider({
                        effect: 'random',                 // Specify sets like: 'fold,fade,sliceDown'
                        animSpeed: 1500,                   // Slide transition speed
                        pauseTime: 6000,                  // How long each slide will show
                        startSlide: 0,                    // Set starting Slide (0 index)
                        directionNav: true,               // Next & Prev navigation
                        controlNav: false,                 // 1,2,3... navigation
                        controlNavThumbs: false,          // Use thumbnails for Control Nav
                        pauseOnHover: true,               // Stop animation while hovering
                        manualAdvance: false,
                    });
                });
            </script>
            
            <!-- Show all super category -->
            <div class="col-sm-12 banner-slider">
                <div class="row">
                    <?php $__currentLoopData = $super_catgory; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $super_cat): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>                    
                        <div class="col-sm-2">
                            <div class="row">
                                <div class="col-lg-12 res-catagories text-center">
                                    <a href="<?php echo e(route('categories', ['super_cat_id' => $super_cat->id])); ?>" class="list-group-item super_caties">                                       
                                        <img src="storage/app/uploads/super_category/<?php echo e($super_cat->image); ?>" alt="<?php echo e($super_cat->name); ?>" width="120" />
                                        <br>
                                        <?php echo e($super_cat->name); ?>

                                    </a>                                    
                                </div>
                            </div>
                        </div>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </div>
            </div>

            <!--
            Old show all categories 
            <div class="col-sm-12 banner-slider">
                <div class="row">
                    <?php $__currentLoopData = $category; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $cat): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <?php
                        $cat_name = $cat->category;
                        $cat_name = preg_replace('/[^A-Za-z0-9\-]/', '-', $cat_name);
                        $encrypted = Crypt::encrypt($cat->id);
                        ?>
                        <div class="col-sm-2">
                            <div class="row">
                                <div class="col-lg-12 res-catagories">
                                    
                                    get all clients according to this category by js url
                                    <a href="javascript:;" class="list-group-item cat_ies" id="cate_<?= $cat->id; ?>">
                                        <span>
                                            <img src="resources/frontend_assets//images/food.png" alt="<?php echo e($cat->category); ?>" />
                                        </span>
                                        <?php echo e($cat->category); ?>

                                    </a>                                    
                                </div>
                            </div>
                        </div>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </div>
            </div> -->

			<!-- Our partners -->
			<div class="col-sm-12 offset-margin-2">
				<div class="row">
					<div class="col-sm-12 top30">
						<h1 class="brand-header">Our Partners </h1>
					</div>
					<div class="col-sm-12">
						<div class="row">
                            <?php $__currentLoopData = $home_page_clients; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $home_page_client): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
    							<div class="col-lg-55 col-md-55 col-sm-55 col-xs-12 res-cop-box">
    								<div class="offer-small offer">
    									<div class="vendor-image amit">

                                            <a title="<?php echo e($home_page_client->business_name); ?>" href="javascript:;" class="client_view_details" id="client-view_<?php echo e($home_page_client->user_id); ?>">
                                                <?php
                                                    if(!empty($home_page_client->logo))
                                                    {
                                                        ?>
                                                        <img alt="" src="<?php echo e(url('/')); ?>/storage/app/uploads/<?php echo e($home_page_client->logo); ?>" class="img-responsive" style="height: 125px;">  
                                                        <?php
                                                    }
                                                    else
                                                    {
                                                        ?>
                                                        <img alt="" src="<?php echo e(url('/')); ?>/resources/frontend_assets/images/logo.png" class="img-responsive">
                                                        <?php
                                                    }
                                                ?>
                                            </a>

    									</div>
                                        
    								</div>
    							</div>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
						</div>
					</div>
				</div>
			</div>

			<!-- Lattest clients -->
			<div class="col-sm-12 offset-margin-2">
				<div class="row">
					<div class="col-sm-12 top30">
						<h1 class="brand-header">Latest</h1>
					</div>
					<div class="col-sm-12">
						<div class="row">
                            <?php $__currentLoopData = $latest_home_page_clients; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $latest_home_page_client): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <div class="col-lg-55 col-md-55 col-sm-55 col-xs-12 res-cop-box">
                                <div class="offer-small offer">
                                    <div class="vendor-image amit">

                                        <a title="<?php echo e($latest_home_page_client->business_name); ?>" href="javascript:;" class="client_view_details" id="client-view_<?php echo e($latest_home_page_client->user_id); ?>">
                                            <?php
                                                if(!empty($latest_home_page_client->logo))
                                                {
                                            ?>
                                                <img alt="" src="<?php echo e(url('/')); ?>/storage/app/uploads/<?php echo e($latest_home_page_client->logo); ?>" class="img-responsive" style="height: 125px;">
                                            <?php
                                                }
                                                else
                                                {
                                            ?>
                                                <img alt="" src="<?php echo e(url('/')); ?>/resources/frontend_assets/images/logo.png" class="img-responsive">
                                            <?php
                                                }
                                            ?>
                                        </a>
                                    </div>
                                    
                                </div>
                            </div>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
						</div>
					</div>
				</div>
			</div>

		</div>
	</div>
</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.public_app', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>