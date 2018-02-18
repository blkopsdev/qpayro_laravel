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
  <h1 class="page-title font_lato">Registrar Business</h1>
  <div class="page-header-actions">
  <ol class="breadcrumb">
		<li><a href="<?php echo e(URL::to('/dashboard')); ?>"><?php echo e(trans('app.home')); ?></a></li>
		<li><a href="<?php echo e(URL::to('business')); ?>">Business</a></li>
		<li class="active"><?php echo e(trans('app.create')); ?></li>
	</ol>
  </div>
</div>

<div class="page-content">
<div class="panel">
<div class="panel-body container-fluid">
<!------------------------start insert, update, delete message  ---------------->
<div class="row">
<?php if(session('msg_success')): ?>
	<div class="alert dark alert-icon alert-success alert-dismissible alertDismissible" role="alert">
	  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
		<span aria-hidden="true">×</span>
	  </button>
	  <i class="icon wb-check" aria-hidden="true"></i>
	  <?php echo e(session('msg_success')); ?>

	</div>
<?php endif; ?>
<?php if(session('msg_update')): ?>
	<div class="alert dark alert-icon alert-info alert-dismissible alertDismissible" role="alert">
	  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
		<span aria-hidden="true">×</span>
	  </button>
	  <i class="icon wb-check" aria-hidden="true"></i>
	  <?php echo e(session('msg_update')); ?>

	</div>
<?php endif; ?>
<?php if(session('msg_delete')): ?>
	<div class="alert dark alert-icon alert-danger alert-dismissible alertDismissible" role="alert">
	  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
		<span aria-hidden="true">×</span>
	  </button>
	  <i class="icon wb-check" aria-hidden="true"></i>
	  <?php echo e(session('msg_delete')); ?>

	</div>
<?php endif; ?>
</div>
<form  name="userForm" action="<?php echo e(URL::to('business_store')); ?>" method="post" >
		<?php echo e(csrf_field()); ?>

<div class="row row-lg">
	<div class="col-sm-8" style="border-right: 1px dotted #ddd;">
	  <!-- Example Basic Form -->
			<div class="row">
			<div class="col-sm-12">
			<p class="font-size-20 blue-grey-700">Detalles Business</p>
			</div>
      <div class="form-group col-sm-6">
			<label class="control-label">Account<span class="spancolor">*</span></label>
			<select ng-model="role"  class="form-control" name="nombre_merchant" required>
				<?php $__currentLoopData = $users; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $view): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
				<option value="<?php echo e($view->id); ?>"><?php echo e($view->username); ?></option>
				<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
			</select>
		  </div>
			  <div class="form-group col-sm-6">
				<label class="control-label" for="public_key">Public Key: <span class="spancolor">*</span> </label>
				<input type="text" class="form-control" id="public_key" name="public_key" placeholder="Public Key" required>
			  </div>
			</div>

			<div class="row">

        <div class="form-group col-sm-6">
				<label class="control-label" for="api_secret">Api Secret: <span class="spancolor">*</span> </label>
				<input type="text" class="form-control" id="api_secret" name="api_secret" placeholder="API Secret" required>
			  </div>
			  <div class="form-group col-sm-6">
				<label class="control-label" for="business_name">Business Name: <span class="spancolor">*</span></label>
				<input type="text" class="form-control" id="business_name" name="business_name" placeholder="Nombre del Comercio" required>
			  </div>
			</div>

        <div class="row">

          <div class="form-group col-sm-6">
  				<label class="control-label" for="logo">Logo: <span class="spancolor">*</span> </label>
  				<input type="text" class="form-control" id="logo" name="logo" placeholder="Logo" required>
  			  </div>
  			  <div class="form-group col-sm-6">
  				<label class="control-label" for="identification_number">Identification Number: <span class="spancolor">*</span></label>
  				<input type="text" class="form-control" id="identification_number" name="identification_number" placeholder="Identification Number" required>
  			  </div>
  			</div>

        <div class="row">

          <div class="form-group col-sm-6">
  				<label class="control-label" for="ownership">Ownership: <span class="spancolor">*</span> </label>
  				<input type="text" class="form-control" id="ownership" name="ownership" placeholder="Ownership" required>
  			  </div>
  			  <div class="form-group col-sm-6">
  				<label class="control-label" for="legal_name">Legal Name: <span class="spancolor">*</span></label>
  				<input type="text" class="form-control" id="legal_name" name="legal_name" placeholder="Legal Name" required>
  			  </div>
  			</div>

        <div class="row">

          <div class="form-group col-sm-6">
  				<label class="control-label" for="tax_id">Tax Id: <span class="spancolor">*</span> </label>
  				<input type="text" class="form-control" id="tax_id" name="tax_id" placeholder="Tax Id" required>
  			  </div>
  			  <div class="form-group col-sm-6">
            <label class="control-label">Country<span class="spancolor">*</span></label>
      			<select ng-model="role"  class="form-control" name="country" required>
      				<?php $__currentLoopData = $country; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $view): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
      				<option value="<?php echo e($view->nicename); ?>"><?php echo e($view->nicename); ?></option>
      				<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
      			</select>
  			  </div>
  			</div>

        <div class="row">

          <div class="form-group col-sm-6">
          <label class="control-label" for="state">State: <span class="spancolor">*</span> </label>
          <input type="text" class="form-control" id="state" name="state" placeholder="State" required>
          </div>
          <div class="form-group col-sm-6">
          <label class="control-label" for="zip_code">Zip Code: <span class="spancolor">*</span></label>
          <input type="text" class="form-control" id="zip_code" name="zip_code" placeholder="Zip Code" required>
          </div>
        </div>


  			<div class="row">

        <div class="form-group col-sm-6">
				<label class="control-label" for="address">Adress: <span class="spancolor">*</span> </label>
				<input type="text" class="form-control" id="address" name="address" placeholder="Adress" required>
			  </div>

        <div class="btn-group" data-toggle="buttons" role="group">
  			  <label class="btn btn-outline btn-primary  <?php echo e('active'); ?>">
  				<input type="radio" name="estado" autocomplete="off"  value="1" checked="checked">
  				<i class="icon wb-check text-active" aria-hidden="true"></i>  <?php echo e(trans('app.active')); ?>

  			  </label>
  			  <label class="btn btn-outline btn-primary ">
  				<input type="radio" name="estado" autocomplete="off" value="0" >
  				<i class="icon wb-check text-active" aria-hidden="true"></i> <?php echo e(trans('app.inactive')); ?>

  			  </label>
  			</div>

			</div>

	</div>
	<div style="clear:both"></div>
	<div class="form-group col-sm-6">
	<button type="submit" ng-disabled="userForm.$invalid" class="btn btn-primary ladda-button" data-plugin="ladda" data-style="expand-left">
			<i class="fa fa-save"></i>  Crear Business
		<span class="ladda-spinner"></span><div class="ladda-progress" style="width: 0px;"></div>
		</button>
    <a class="btn btn-default" href="<?php echo e(URL::to('business')); ?>"><i class="icon wb-arrow-left"></i>Regresar</a>
	</div>
  </div>
</form>
</div>
<!-- /.panel -->
</div>
<!-- /.col-lg-12 -->
</div><br/>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.template', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>