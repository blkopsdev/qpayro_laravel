    	

<?php $__env->startSection('content'); ?>

<style>
<style>
p.redcolor{color:red; font-size:16px;}
.spancolor{color:red;}
.help-block{color:red;}
</style>
</style>
<link rel="stylesheet" href="<?php echo e(URL::to('/')); ?>/global/vendor/filament-tablesaw/tablesaw.css">
<link rel="stylesheet" href="<?php echo e(URL::to('assets/css')); ?>/datepicker3.min.css" />
<script src="<?php echo e(URL::to('assets/js')); ?>/ui-bootstrap-tpls-0.11.0.js"></script>
<script src="<?php echo e(URL::to('assets')); ?>/croppie.js"></script>
 <link rel="stylesheet" href="<?php echo e(URL::to('assets')); ?>/croppie.css">

<div class="page-header">
  <h1 class="page-title font_lato"><?php echo e(trans('app.newsletter_list')); ?></h1>
  <div class="page-header-actions">
	<ol class="breadcrumb">
		<li><a href="<?php echo e(URL::to('/dashboard')); ?>"><?php echo e(trans('app.home')); ?></a></li>
		<li><a href="<?php echo e(URL::to('userlist')); ?>"><?php echo e(trans('app.users')); ?></a></li>
		
		<li class="active"><?php echo e(trans('app.edit')); ?></li>
	</ol>
  </div>
</div>
<div class="page-content" ng-app="app" ng-cloak>
<div class="panel">
<div class="panel-body container-fluid">
<!------------------------start insert, update, delete message ---------------->


<div style="clear:both;"></div><br>
<div class="tab-content">
<div id="product" class="tab-pane fade in active">
<table class="tablesaw table-striped table-bordered tablesaw-columntoggle" data-tablesaw-mode="columntoggle" data-tablesaw-minimap="" id="table-3973">
		<thead>
		  <tr>
			  <th data-tablesaw-priority="5" class="tablesaw-priority-5 tablesaw-cell-visible"><?php echo e(trans('app.name')); ?></th>
			 
			  <th id='myColumnId' data-tablesaw-priority="1"><?php echo e(trans('app.actions')); ?></th>
		  </tr>
		</thead>
		<tbody>
		<?php $__currentLoopData = $data; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $view): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
			<tr>
			  <td class="tablesaw-priority-5 tablesaw-cell-visible"><?php echo e($view->email); ?></td>
             
			  
			  <td class="tablesaw-priority-1">		
			  
				
				<button data-placement="top" data-toggle="modal" rel="tooltip" title="<?php echo e(trans('app.delete')); ?>"  data-original-title="<?php echo e(trans('app.delete')); ?>"  class="btn btn-icon btn-danger btn-outline btn-round" data-target=".exampleNiftyFlipVertical"  type="button" data-href="<?php echo e(URL::to('newsletterdestroy',$view->id)); ?>"><i class="icon fa-remove" aria-hidden="true"></i></button>
				</td>			
			</tr>
		<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
		  
		</tbody>
	  </table>
	  <div style="clear:both;"></div><br/>


</div>

</div>
</div>
<!-- /.row -->
</div>
</div>
</div>
<!-- /.panel -->
</div>
<!-- /.col-lg-12 -->
<script type="text/javascript">
$uploadCrop = $('#upload-demo').croppie({
    enableExif: true,
    viewport: {
        width: 200,
        height: 200,
        type: 'circle'
    },
    boundary: {
        width: 300,
        height: 300
    }
});

$('#upload').on('change', function () {
	var reader = new FileReader();
    reader.onload = function (e) {
    	$uploadCrop.croppie('bind', {
    		url: e.target.result
    	}).then(function(){
			//alert(123);
			$("#uploadimage").hide();
			$("#saveCancenimage").show();
    		console.log('jQuery bind complete');
    	});

    }
    reader.readAsDataURL(this.files[0]);
});



$(document).ready(function(){
	$("#cancelbutton").click(function(){
		//console.log(123);
		$("#uploadimage").show();
		$("#saveCancenimage").hide();
		$('.cr-image').attr('src', '');
	});
	$(".upload-result").click(function(){
		setTimeout(function () {
		location.reload(1);
		//setInterval(auto_refresh, 3000);
		}, 3000);
	});
});
//("#cancelbutton")
</script>

<script>
var app = angular.module('app', []);

app.directive("matchPassword", function () {
    return {
        require: "ngModel",
        scope: {
            otherModelValue: "=matchPassword"
        },
        link: function(scope, element, attributes, ngModel) {

            ngModel.$validators.matchPassword = function(modelValue) {
                return modelValue == scope.otherModelValue;
            };

            scope.$watch("otherModelValue", function() {
                ngModel.$validate();
            });
        }
    };
});
</script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.template', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>