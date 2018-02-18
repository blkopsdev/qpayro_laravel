<?php $__env->startSection('content'); ?> 
<link rel="stylesheet" href="<?php echo e(URL::to('/')); ?>/global/vendor/bootstrap-datepicker/bootstrap-datepicker.css">
<link rel="stylesheet" href="<?php echo e(URL::to('/')); ?>/global/vendor/bootstrap-maxlength/bootstrap-maxlength.css">
<link rel="stylesheet" href="<?php echo e(URL::to('/')); ?>/global/vendor/jt-timepicker/jquery-timepicker.css">
<link rel="stylesheet" href="<?php echo e(URL::to('/')); ?>/assets/examples/css/forms/advanced.css">

<style>
p.redcolor{color:red; font-size:16px;}
.spancolor{color:red;}
.help-block{color:red;}
</style>

<div class="page-header">
  <h1 class="page-title font_lato"><?php echo e(trans('app.create_new_coupon')); ?></h1>
</div>
	
<div class="page-content" ng-app="app" ng-cloak>	
<div class="panel">
<div class="panel-body container-fluid">
<!------------------------start insert, update, delete message  ---------------->

<form  name="userForm" action="<?php echo e(URL::to('couponstore')); ?>" ng-submit="submitForm(userForm.$valid)" novalidate  id="demo-form2" data-parsley-validate="" method="post" novalidate="">
		<?php echo e(csrf_field()); ?>

<div class="row row-lg">
	<div class="col-sm-12" style="border-right: 1px dotted #ddd;">
	  <!-- Example Basic Form -->	              
			<div class="row">
			<div class="col-sm-12">
			<p class="font-size-20 blue-grey-700">Coupon Details</p>
			</div>
			  <div class="form-group col-sm-6">
				<label class="control-label" for="inputBasicFirstName"><?php echo e(trans('app.coupon_name')); ?><span class="spancolor">*</span> </label>
				<input type="text" class="form-control" id="coupon_name" ng-model="first_name" name="coupon_name" ng-init="coupon_name='<?php echo e(old('coupon_name')); ?>'" placeholder="<?php echo e(trans('app.coupon_name')); ?>" required>
			  </div>
			
			   <div class="form-group col-sm-6">
				<label class="control-label"><?php echo e(trans('app.business_id')); ?> <span class="text-danger">*</span></label>
				<select ng-model="business_id"  class="form-control" name="business_id" required ng-init="role = '<?php echo e(old('business_id')); ?>'">
					<option><?php echo e(trans('app.business_id')); ?> </option>	
					<?php $__currentLoopData = $businessdata; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $view): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
					<option value="<?php echo e($view->business_id); ?>"><?php echo e($view->business_name); ?></option>	
					<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
				</select>
			  </div>
			</div>
			
			<div class="row">			  
			  <div class="form-group col-sm-6">
				<label class="control-label" for="coupon_code"><?php echo e(trans('app.coupon_code')); ?><span class="spancolor">*</span> </label>
				<input type="text" class="form-control" id="coupon_code" name="coupon_code"  value="" placeholder="<?php echo e(trans('app.coupon_code')); ?>" required>
			  </div>
               <div class="form-group col-sm-6">
				<label class="control-label" for="inputBasicFirstName"><?php echo e(trans('app.coupon_value')); ?></label>
				<input type="text" ng-model="coupon_value" class="form-control" id="coupon_value" name="coupon_value" placeholder="<?php echo e(trans('app.coupon_value')); ?>" value="" required>
			  </div>			  
			</div>
			<div class="row">			  
			  <div class="form-group col-sm-6">			  
			  <label class="control-label" for="inputBasicFirstName"><?php echo e(trans('app.coupon_max_redemptions')); ?></label>
                  <div class="input-group">
                   
                    <input type="text" class="form-control" name="coupon_max_redemptions" value="" placeholder="<?php echo e(trans('app.coupon_max_redemptions')); ?>">
                  </div>
                </div>			  
			  <div class="form-group col-sm-6">
				<label class="control-label"><?php echo e(trans('app.expire')); ?> <span class="spancolor">*</span></label>
				<select  ng-model="duration" class="form-control" required name="duration">		
					<option><?php echo e(trans('app.expire')); ?> </option>						
					<option value="Once"><?php echo e(trans('app.once')); ?></option>
					<option value="Until date"><?php echo e(trans('app.until_date')); ?></option>
					<option value="Forever"><?php echo e(trans('app.forever')); ?></option>
				</select>
			  </div>			  
			</div>
			<div class="row">
				<div class="form-group col-sm-6">
				<label class="control-label"><?php echo e(trans('app.status')); ?></label>
			  <div>
			  <div class="btn-group" data-toggle="buttons" role="group">

				  <label class="btn btn-outline btn-primary  <?php echo e(((old('status')== 'Active')?'active': '')); ?> <?php echo e((empty(old('status'))?'active': '')); ?>">
					<input type="radio" name="status" autocomplete="off"  value="Active"  checked="">
					<i class="icon wb-check text-active" aria-hidden="true"></i>  <?php echo e(trans('app.active')); ?>

				  </label>
				  <label class="btn btn-outline btn-primary <?php echo e(((old('status')== 'Inactive')?'active': '')); ?>">
					<input type="radio" name="status" autocomplete="off" value="Inactive" <?php echo e(((old('status') == 'Inactive')?'checked' : '')); ?> >
					<i class="icon wb-check text-active" aria-hidden="true"></i> <?php echo e(trans('app.inactive')); ?>

				  </label>                     
				</div>
				</div>					
			  </div>
			  
			  
				<div class="form-group col-sm-6">
				<label class="control-label"><?php echo e(trans('app.coupon_type')); ?> <span class="spancolor">*</span></label>
				<select ng-model="coupon_type"  class="form-control" name="coupon_type" required ng-init="country = '<?php echo e(old('coupon_type')); ?>'">	<option><?php echo e(trans('app.coupon_type')); ?> </option>		
					<option value="amount"><?php echo e(trans('app.amount')); ?></option>
					<option value="percentaje"><?php echo e(trans('app.percentage')); ?></option>
					
				</select>
			  </div>
			  
			</div>
			<div class="row">
				<div class="form-group col-sm-12">			  
			  <label class="control-label" for="inputBasicFirstName"><?php echo e(trans('app.coupon_birthday')); ?></label>
                  <div class="input-group">
                    <span class="input-group-addon">
                      <i class="icon wb-calendar" aria-hidden="true"></i>
                    </span>
                    <input type="text" class="form-control" name="date_of_birth" value="<?php echo e(old('date_of_birth')); ?>" placeholder="<?php echo e(trans('app.coupon_birthday')); ?>" data-plugin="datepicker">
                  </div>
                </div>
			  
			</div>
	  
	</div>
	<div style="clear:both"></div>
	<div class="form-group col-sm-6">
	<a class="btn btn-default" href="http://demo.qpaypro.com/coupons_list_detail">
	<i class="icon wb-arrow-left"></i>
	Cancelar
	</a>	
	<button type="submit" ng-disabled="userForm.$invalid" class="btn btn-primary ladda-button" data-plugin="ladda" data-style="expand-left">
			<i class="fa fa-save"></i>  <?php echo e(trans('app.create_an_coupon')); ?>

		<span class="ladda-spinner"></span><div class="ladda-progress" style="width: 0px;"></div>
		</button>
	
	</div>
  </div>
</form> 
</div>
<!-- /.panel -->
</div>
<!-- /.col-lg-12 -->
</div><br/>
		
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