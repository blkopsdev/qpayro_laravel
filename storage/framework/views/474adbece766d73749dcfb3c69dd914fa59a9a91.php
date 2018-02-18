<!DOCTYPE html>

<html class="no-js css-menubar" lang="en">

<head>

  <meta charset="utf-8">
   <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
  <meta name="description" content="Israeli">
  <meta name="author" content="">
  <meta name="csrf-token" content="<?php echo e(csrf_token()); ?>" />
  <title>Israeli </title>
  <!-- Stylesheets -->
  <link href="<?php echo e(URL::to('assets/css')); ?>/bootstrap-fileupload.min.css" rel="stylesheet">
	 
		<?php echo Charts::assets(); ?>

  
		<?php echo e(Html::style('global/css/bootstrap.min.css')); ?>

  <?php echo e(Html::style('global/css/bootstrap-extend.min.css')); ?>


  <?php echo e(Html::style('assets/css/site.min.css')); ?>

		
		<?php echo e(Html::style('css/custom.css')); ?>


  <!-- Plugins -->
   <?php echo e(Html::style('global/vendor/animsition/animsition.css')); ?>

   <?php echo e(Html::style('global/vendor/asscrollable/asScrollable.css')); ?>

   <?php echo e(Html::style('global/vendor/switchery/switchery.css')); ?>

   <?php echo e(Html::style('global/vendor/intro-js/introjs.css')); ?>

   <?php echo e(Html::style('global/vendor/slidepanel/slidePanel.css')); ?>

   <?php echo e(Html::style('global/vendor/jvectormap/jquery-jvectormap.css')); ?>

   <?php echo e(Html::style('assets/examples/css/dashboard/v1.css')); ?>

   <?php echo e(Html::style('assets/examples/css/dashboard/analytics.css')); ?>



   <link rel="stylesheet" href="<?php echo e(URL::to('/')); ?>/global/vendor/ladda-bootstrap/ladda.css">
   <link rel="stylesheet" href="<?php echo e(URL::to('/')); ?>/assets/examples/css/uikit/buttons.css">
   <link rel="stylesheet" href="<?php echo e(URL::to('/')); ?>/assets/examples/css/uikit/dropdowns.css">

  <!-- Fonts -->
  <?php echo e(Html::style('global/fonts/font-awesome/font-awesome.css')); ?>

  <?php echo e(Html::style('global/fonts/weather-icons/weather-icons.css')); ?>

  <?php echo e(Html::style('global/fonts/web-icons/web-icons.min.css')); ?>

  <?php echo e(Html::style('global/fonts/brand-icons/brand-icons.min.css')); ?>

  <link href="https://fonts.googleapis.com/css?family=Lato:100" rel="stylesheet" type="text/css">
  <link href="//netdna.bootstrapcdn.com/bootstrap/3.0.0/css/bootstrap-glyphicons.css" rel="stylesheet">

  <!------------------------new mail css-------------------->
  <link rel="stylesheet" href="<?php echo e(URL::to('/')); ?>/global/vendor/bootstrap-markdown/bootstrap-markdown.css">
  <link rel="stylesheet" href="<?php echo e(URL::to('/')); ?>/global/vendor/select2/select2.css">
  <link rel="stylesheet" href="<?php echo e(URL::to('/')); ?>/assets/examples/css/apps/mailbox.css">

   
  <!------------------------end new mail css-------------------->

	<style>
	.page-content {padding: 0px 30px;}
     .container{
      min-height: 0px;
  }
  body{
    background-attachment: fixed;
    padding-top: 0px !important;
    background-image: url("./images/background.png");
    background-repeat: no-repeat;
    background-size: 100% 100%;
  }
  .language-box{
    position: fixed;
    bottom: 20px;
    right: 30px;
  }
  .language-box>div{
      width:110px;
      height:110px;
  }
  .language-box a img:hover{
      width:110px;
  }
	</style>

  <?php echo e(Html::script('global/vendor/modernizr/modernizr.js')); ?>

  <?php echo e(Html::script('global/vendor/breakpoints/breakpoints.js')); ?>

  
<!-- carousel -->
  <?php echo e(Html::script('js/theta-carousel.min.js')); ?>

  <?php echo e(Html::script('js/example.js')); ?>

  <?php echo e(Html::script('js/jquery.popupoverlay.js')); ?>

  <?php echo e(Html::script('js/mustache.min.js')); ?>

  <!-- <?php echo e(Html::script('js/jquery-2.1.4.min.js')); ?> -->
  <script src="https://ajax.googleapis.com/ajax/libs/angularjs/1.6.0/angular.min.js"></script>


  <!-- <link rel="stylesheet" href="<?php echo e(URL::to('/')); ?>/css/animate.min.css"> -->
  <!--<script src="<?php echo e(URL::to('assets/js')); ?>/angular.js"></script>-->
  <script>
  Breakpoints();
  </script>
  <script src='https://cdnjs.cloudflare.com/ajax/libs/Chart.js/1.0.2/Chart.min.js'></script>
 <?php echo e(Html::script('global/vendor/jquery/jquery.js')); ?>


	 <?php echo $__env->yieldContent('top.scripts'); ?>
	
	<!-- Start of qpaypro Zendesk Widget script -->
 <script>
            $(document).ready(function(){

             $('#contact-form').validate(
             {
              rules: {
                password: {
                  minlength: 2,
                  required: true
                },
                email: {
                  required: true,
                  email: true
                },
             
              },
              highlight: function(element) {
                $(element).closest('.form-group').removeClass('success').addClass('error');
              },
              success: function(element) {
                element
                .text('OK!').addClass('valid')
                .closest('.form-group').removeClass('error').addClass('success');
              }
             });
            }); // end document.ready
        </script>


  </head>
<body onload="">
  <?php echo $__env->yieldContent('content'); ?>

<style type="text/css">
    .modal-header{
        color: white !important;
    }
    .modal-content{
        color:white;
    }
    .modal-content input{
        background-color: lightgray;
    }
</style>
<div class="container">
  
  <!-- Trigger the modal with a button -->
  

  <!-- Modal -->
  <div class="modal fade" id="myModal" role="dialog" >
    <div class="modal-dialog">
    
      <!-- Modal content-->
      <div class="modal-content"  style="background: rgba(40, 41, 41, 0.77);">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title text-center" style="color: white;">Sign In</h4>
        </div>
        <form name=userform action="<?php echo e(URL::to('frontlogin')); ?>" method="get" id="contact-form">
        <?php echo e(csrf_field()); ?>

        <div class="modal-body">
                
        <div class="form-group">
          <label for="email">Email address:</label>
          <input type="email" class="form-control" id="email" name="email" required>
        </div>
        <div class="form-group">
          <label for="pwd">Password:</label>
          <input type="password" class="form-control" id="pwd" name="password" required>
        </div>        
             </div>
              <div class="modal-footer">
          <button type="submit" class="btn btn-default">Submit</button>
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        </div>
      </form>
      </div>
      
    </div>
  </div>  
</div>
    <div class="pull-right language-box">
                <div>  
                    <a href="./LanguageController/chooser_language/en">
                        <img src="./assets/flags/united_kingdom_640.png"  width="100px" class="img-circle" />
                    </a>
                </div>
                <div>
                    <a href="./LanguageController/chooser_language/he">
                        <img src="./assets/flags/israel_640.png"  width="100px" class="img-circle" />
                    </a>
                </div>
            </div>


  


   <?php echo e(Html::script('global/vendor/bootstrap/bootstrap.js')); ?>

   <?php echo e(Html::script('global/vendor/animsition/animsition.js')); ?>

   <?php echo e(Html::script('global/vendor/asscroll/jquery-asScroll.js')); ?>

   <?php echo e(Html::script('global/vendor/mousewheel/jquery.mousewheel.js')); ?>

   <?php echo e(Html::script('global/vendor/asscrollable/jquery.asScrollable.all.js')); ?>

   <?php echo e(Html::script('global/vendor/ashoverscroll/jquery-asHoverScroll.js')); ?>



	


</body>
</html>
