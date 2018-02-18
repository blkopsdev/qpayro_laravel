<?php $__env->startSection('content'); ?> 
<link rel="stylesheet" href="<?php echo e(URL::to('/')); ?>/global/vendor/bootstrap-datepicker/bootstrap-datepicker.css">
<link rel="stylesheet" href="<?php echo e(URL::to('/')); ?>/global/vendor/bootstrap-maxlength/bootstrap-maxlength.css">
<link rel="stylesheet" href="<?php echo e(URL::to('/')); ?>/global/vendor/jt-timepicker/jquery-timepicker.css">
<link rel="stylesheet" href="<?php echo e(URL::to('/')); ?>/assets/examples/css/forms/advanced.css">

<link rel="stylesheet" href="<?php echo e(URL::to('/')); ?>/css/animate.min.css">
<!-- carousel -->
  <?php echo e(Html::script('js/theta-carousel.min.js')); ?>

  <?php echo e(Html::script('js/example.js')); ?>

  <?php echo e(Html::script('js/jquery.popupoverlay.js')); ?>

  <?php echo e(Html::script('js/mustache.min.js')); ?>

  <!-- <?php echo e(Html::script('js/jquery-2.1.4.min.js')); ?> -->

<style type="text/css">
    #carousel-container{
        width: 70%;
        margin: auto;
    }
</style>

<header>

</header>
    <div id="container" style="top: 0px; bottom: 0px; position: absolute; right: 0px; left: 0px;">
        <style type="text/css">          
            * {
                -webkit-box-sizing: border-box;
                -moz-box-sizing: border-box;
                box-sizing: border-box;
            }
            
              .ex-item {
                height: 256px;
                width: 256px;
                display: none;
                -webkit-box-sizing: border-box;
                -moz-box-sizing: border-box;
                box-sizing: border-box;
            }
            
            
            .button-hover-transition {
                -webkit-transition: all 0.5s cubic-bezier(0.42, 0, 0.15, 1.61);
                -moz-transition: all 0.5s cubic-bezier(0.42, 0, 0.15, 1.61);
                -ms-transition: all 0.5s cubic-bezier(0.42, 0, 0.15, 1.61);
                -o-transition: all 0.5s cubic-bezier(0.42, 0, 0.15, 1.61);
            }
            .store-button{
                bottom: 0px;
                cursor: pointer;
                z-index: 30;
                margin-left: 2%;
                margin-bottom: 2%;
                position: fixed;
                width: 100px;
            }
            .store-button:hover{
                width:110px;
            }
        </style>

            <div id="carousel-container" style="top: 0px; bottom: 0px; position: absolute; right: 0px; left: 0px; width: 100%; height:100%; margin-top: -150px">
         <?php $__currentLoopData = $allproduct; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $product): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
               <div class="ex-item">  
                    <img src="images/<?php echo e($product->image); ?>" style="width:300px; border:solid 5px white;" />
               </div>
          <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
     </div>
    </div>
    <div id="popup" style="display: none; overflow: hidden;"></div>
    <img src="images/shop1.png" class="store-button" data-toggle="modal" data-target="#myModal" />    
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.front_template', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>