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
  <h1 class="page-title font_lato"><?php echo e(trans('app.create_new_plan')); ?></h1>
</div>
	
<div class="page-content" ng-app="app" ng-cloak>	
<div class="panel">
<div class="panel-body container-fluid">
<!------------------------start insert, update, delete message  ---------------->

<form  name="userForm" action="<?php echo e(URL::to('planupdate',$userdata->id)); ?>" ng-submit="submitForm(userForm.$valid)" novalidate  id="demo-form2" data-parsley-validate="" method="post" novalidate="">
		<?php echo e(csrf_field()); ?>

<div class="row row-lg">
	<div class="col-sm-12" style="border-right: 1px dotted #ddd;">
	  <!-- Example Basic Form -->	              
			<div class="row">
			<div class="col-sm-12">
			<p class="font-size-20 blue-grey-700">Plan Details</p>
			</div>
			  <div class="form-group col-sm-6">
				<label class="control-label" for="inputBasicFirstName"><?php echo e(trans('app.plan_name')); ?><span class="spancolor">*</span> </label>
				<input type="text" class="form-control" id="coupon_name" ng-model="plan_name" name="plan_name"  ng-init="plan_name='<?php echo e($userdata->plan_name); ?>'" placeholder="<?php echo e(trans('app.plan_name')); ?>" required>
			  </div>		
			    <div class="form-group col-sm-6">
				<label class="control-label"><?php echo e(trans('app.business_id')); ?> <span class="text-danger">*</span></label>
				<select   class="form-control" name="business_id" required  >
					<option value=""><?php echo e(trans('app.business_id')); ?> </option>						
					<?php $__currentLoopData = $businessdata; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $view): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
					<?php if($userdata->business_id===$view->business_id): ?>{<option value="<?php echo e($view->business_id); ?>" selected><?php echo e($view->business_name); ?></option>}
					<?php else: ?>{
					<option value="<?php echo e($view->business_id); ?>"><?php echo e($view->business_name); ?></option>	}
					<?php endif; ?>
					<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
				</select>
			  </div>
			</div>
			
			<div class="row">			  
			  <div class="form-group col-sm-2">
				<label class="control-label" for="plan_price"><?php echo e(trans('app.currency')); ?><span class="spancolor">*</span> </label>
				<select  class="form-control" name="plan_currency">
                   <?php if($userdata->plan_currency==="USD"): ?>
				{
					<option value="USD" selected>USD</option>
					<option value="GTQ">GTQ</option>
                 }
                   <?php else: ?>{		
					<option value="USD">USD</option>
					<option value="GTQ" selected>GTQ</option>
			}
			<?php endif; ?>
				</select>
			   </div>
               <div class="form-group col-sm-4">
               	<label class="control-label" for="plan_amount"><?php echo e(trans('app.amount')); ?><span class="spancolor">*</span> </label>
				<input type="text" ng-model="plan_amount" class="form-control" id="plan_amount" name="plan_amount" placeholder="<?php echo e(trans('app.plan_amount')); ?>" ng-init="plan_amount='<?php echo e($userdata->plan_amount); ?>'" required>
			  	</div>	
			  	<div class="form-group col-sm-6">
                 <label class="control-label" for="plan_trial"><?php echo e(trans('app.plan_trial')); ?><span class="spancolor">*</span> </label>
				<input type="text" class="form-control" id="plan_trial" name="plan_trial" placeholder="<?php echo e(trans('app.plan_trial')); ?>" ng-model="plan_trial" value="<?php echo e($userdata->plan_trial); ?>" ng-init="plan_trial='<?php echo e($userdata->plan_trial); ?>'" required>
			  	</div>	  
			</div>
			<div class="row">			  
			  <div class="form-group col-sm-6">			  
			  <label class="control-label" for="inputBasicFirstName"><?php echo e(trans('app.interval_number')); ?></label>
                  <div class="input-group">
                   
                    <input type="text" ng-model="plan_interval_number" ng-init="plan_interval_number='<?php echo e($userdata->plan_interval_number); ?>'" class="form-control" name="plan_interval_number" value="" placeholder="<?php echo e(trans('app.interval_number')); ?>" required>
                  </div>
                </div>			  
			  <div class="form-group col-sm-6">
				<label class="control-label"><?php echo e(trans('app.interval_term')); ?> <span class="spancolor">*</span></label>
				<select  class="form-control" name="plan_interval_term" required>	
				<?php if($userdata->plan_interval_term==='Annual'): ?>{		
				<option value=""><?php echo e(trans('app.interval_term')); ?> </option>						
					<option value="Annual" selected><?php echo e(trans('app.year')); ?></option>
					<option value="Monthly"><?php echo e(trans('app.month')); ?></option>
					<option value="Weekly"><?php echo e(trans('app.week')); ?></option>
					<option value="Daily"><?php echo e(trans('app.day')); ?></option>}
				<?php elseif($userdata->plan_interval_term==='Monthly'): ?>{
                    <option value=""><?php echo e(trans('app.interval_term')); ?> </option>						
					<option value="Annual"><?php echo e(trans('app.year')); ?></option>
					<option value="Monthly" selected><?php echo e(trans('app.month')); ?></option>
					<option value="Weekly"><?php echo e(trans('app.week')); ?></option>
					<option value="Daily"><?php echo e(trans('app.day')); ?></option>
				}
				<?php elseif($userdata->plan_interval_term==='Weekly'): ?>{
                     <option value=""><?php echo e(trans('app.interval_term')); ?> </option>						
					<option value="Annual"><?php echo e(trans('app.year')); ?></option>
					<option value="Monthly"><?php echo e(trans('app.month')); ?></option>
					<option value="Weekly" selected><?php echo e(trans('app.week')); ?></option>
					<option value="Daily"><?php echo e(trans('app.day')); ?></option>
			     }
			     <?php else: ?>{
			         <option value=""><?php echo e(trans('app.interval_term')); ?> </option>						
					<option value="Annual"><?php echo e(trans('app.year')); ?></option>
					<option value="Monthly"><?php echo e(trans('app.month')); ?></option>
					<option value="Weekly"><?php echo e(trans('app.week')); ?></option>
					<option value="Daily" selected><?php echo e(trans('app.day')); ?></option>
			 }
			 <?php endif; ?>
				</select>
			  </div>			  
			</div>
			<div class="row">
				<div class="form-group col-sm-6">
				<label class="control-label"><?php echo e(trans('app.status')); ?></label>
			  <div>
			  <div class="btn-group" data-toggle="buttons" role="group">

				  <label class="btn btn-outline btn-primary  <?php echo e((($userdata->plan_status == 'Enable')?'active' : '')); ?>">
					<input type="radio" name="status" autocomplete="off"  value="Enable"  <?php echo e((($userdata->plan_status == 'Enable')?'checked' : '')); ?>>
					<i class="icon wb-check text-active" aria-hidden="true"></i>  <?php echo e(trans('app.enable')); ?>

				  </label>
				  <label class="btn btn-outline btn-primary <?php echo e((($userdata->plan_status == 'Disable')?'active' : '')); ?>">
					<input type="radio" name="status" autocomplete="off" value="Disable" <?php echo e((($userdata->plan_status == 'Disable')?'checked' : '')); ?> >
					<i class="icon wb-check text-active" aria-hidden="true"></i> <?php echo e(trans('app.disable')); ?>

				  </label>                     
				</div>
				</div>					
			  </div>			  			  
			</div>
	  
	</div>
	<div style="clear:both"></div>
	<div class="form-group col-sm-6">
	<a class="btn btn-default" href="http://demo.qpaypro.com/planes_list_detail">
	<i class="icon wb-arrow-left"></i>
	Cancelar
	</a>	
	<button type="submit" ng-disabled="userForm.$invalid" class="btn btn-primary ladda-button" data-plugin="ladda" data-style="expand-left">
			<i class="fa fa-save"></i>  <?php echo e(trans('app.update_an_plan')); ?>

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