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
  <h1 class="page-title font_lato">Actualizar credenciales de comercio</h1>
  <div class="page-header-actions">
  <ol class="breadcrumb">
		<li><a href="<?php echo e(URL::to('/dashboard')); ?>"><?php echo e(trans('app.home')); ?></a></li>
		<li><a href="<?php echo e(URL::to('business_visanet')); ?>">Comercio</a></li>
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
<form  name="userForm" action="<?php echo e(URL::to('business_visanet_update',$payment_gateway->payment_gateway_id)); ?>" method="post" >
		<?php echo e(csrf_field()); ?>

<div class="row row-lg">
	<div class="col-sm-8" style="border-right: 1px dotted #ddd;">
	  <!-- Example Basic Form -->
			<div class="row">
        <div class="col-sm-12">
  			<p class="font-size-20 blue-grey-700">Detalles credenciales de comercio</p>
  			</div>
			</div>

      <?php if(@$payment_method_show == '1'): ?>
        <?php $__currentLoopData = json_decode(@$payment_gateway->parameters, true); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <?php if($key == "terminalId"): ?>
            <?php $var_terminalId = $value  ?>
            <?php endif; ?>
            <?php if($key == "merchant"): ?>
            <?php $var_merchant = $value  ?>
            <?php endif; ?>
            <?php if($key == "visaEnCuotas"): ?>
            <?php $var_visaEnCuotas = $value  ?>
            <?php endif; ?>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            <div class="row">
              <div class="form-group col-sm-6">
                <label class="control-label" for="number_afiliation">Número de Afiliación: </label>
        				<input type="text" class="form-control" id="number_afiliation" name="number_afiliation" placeholder="Número de Afiliación" value="<?php echo e($business->number_afiliation); ?>">
      			  </div>
                <div class="form-group col-sm-6">
                <label class="control-label" for="terminal_id">Terminal ID: <span class="spancolor">*</span> </label>
                <input type="text" class="form-control" id="terminal_id" name="terminal_id" value="<?php echo e($var_terminalId); ?>" placeholder="Terminal ID" >
                </div>
                <div class="form-group col-sm-6">
                <label class="control-label" for="merchant_pg">Merchant: <span class="spancolor">*</span></label>
                <input type="text" class="form-control" id="merchant_pg" name="merchant_pg" value="<?php echo e($var_merchant); ?>" placeholder="Merchant" >
                </div>
                <div class="form-group col-sm-6">
                  <label class="control-label" for="visa_cuota">¿Acepta Visa Cuotas? <span class="spancolor">*</span></label>
                  <div class="btn-group" data-toggle="buttons" role="group">
                    <label class="btn btn-outline btn-primary  <?php echo e((($var_visaEnCuotas == '1')?'active': '')); ?>">
                    <input type="radio" name="visa_cuota" autocomplete="off"  value="1" <?php if($var_visaEnCuotas == 1): ?> checked="checked" <?php endif; ?>>
                    <i class="icon wb-check text-active" aria-hidden="true"></i> Si
                    </label>
                    <label class="btn btn-outline btn-primary <?php echo e((($var_visaEnCuotas == '0')?'active': '')); ?>">
                    <input type="radio" name="visa_cuota" autocomplete="off" value="0" <?php if($var_visaEnCuotas == 0): ?> checked="checked" <?php endif; ?>>
                    <i class="icon wb-check text-active" aria-hidden="true"></i> No
                    </label>
                  </div>
              </div>
            </div>
      <?php endif; ?>
      <?php if($payment_method_show == '2'): ?>
      <?php $__currentLoopData = json_decode($payment_gateway->parameters, true); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
          <?php if($key == "merchantId"): ?>
          <?php $var_merchantId = $value  ?>
          <?php endif; ?>
          <?php if($key == "transactionKey"): ?>
          <?php $var_transactionKey = $value  ?>
          <?php endif; ?>
      <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            <div class="row">
                <div class="form-group col-sm-6">
                <label class="control-label" for="merchant_cy">Merchant ID: <span class="spancolor">*</span> </label>
                <input type="text" class="form-control" id="merchant_cy" name="merchant_cy" value="<?php echo e($var_merchantId); ?>"  placeholder="Merchant ID" >
                </div>
                <div class="form-group col-sm-6">
                <label class="control-label" for="transaction_key">Transactión Key: <span class="spancolor">*</span></label>
                <input type="text" class="form-control" id="transaction_key" name="transaction_key" value="<?php echo e($var_transactionKey); ?>"  placeholder="Transaction Key" >
                </div>
            </div>
      <?php endif; ?>

			<div class="row">
      <div class="form-group col-sm-6">
        <div class="btn-group" data-toggle="buttons" role="group">
  			  <label class="btn btn-outline btn-primary  <?php echo e((($payment_gateway->status == '1')?'active': '')); ?>">
  				<input type="radio" name="estado" autocomplete="off"  value="1" <?php if($payment_gateway->status == 1): ?> checked="checked" <?php endif; ?>>
  				<i class="icon wb-check text-active" aria-hidden="true"></i>  <?php echo e(trans('app.active')); ?>

  			  </label>
  			  <label class="btn btn-outline btn-primary <?php echo e((($payment_gateway->status == '0')?'active': '')); ?>">
  				<input type="radio" name="estado" autocomplete="off" value="0" <?php if($payment_gateway->status == 0): ?> checked="checked" <?php endif; ?>>
  				<i class="icon wb-check text-active" aria-hidden="true"></i> <?php echo e(trans('app.inactive')); ?>

  			  </label>
  			</div>
      </div>
			</div>
			
			<div class="row">	
			<h3>Pasarela predeterminada</h3>	
			<div class="form-group col-sm-6">
        <div class="btn-group" data-toggle="buttons" role="group">
  			  <label class="btn btn-outline btn-primary  <?php echo e((($payment_gateway->default == 1)?'active': '')); ?>">
  				<input type="radio" name="default" autocomplete="off"  value="1" <?php if($payment_gateway->default == 1): ?> checked="checked" <?php endif; ?>>
  				<i class="icon wb-check text-active" aria-hidden="true"></i>  <?php echo e(trans('app.yes')); ?>

  			  </label>
  			  <label class="btn btn-outline btn-primary <?php echo e((($payment_gateway->default == 0)?'active': '')); ?>">
  				<input type="radio" name="default" autocomplete="off" value="0" <?php if($payment_gateway->default == 0): ?> checked="checked" <?php endif; ?>>
  				<i class="icon wb-check text-active" aria-hidden="true"></i> <?php echo e(trans('app.no')); ?>

  			  </label>
  			</div>
				</div>
			</div>
				
			<div class="row">	
			<h3>Modo de prueba</h3>	
			<div class="form-group col-sm-6">
        <div class="btn-group" data-toggle="buttons" role="group">
  			  <label class="btn btn-outline btn-primary  <?php echo e((($payment_gateway->test_mode == 1)?'active': '')); ?>">
  				<input type="radio" name="test_mode" autocomplete="off"  value="1" <?php if($payment_gateway->test_mode == 1): ?> checked="checked" <?php endif; ?>>
  				<i class="icon wb-check text-active" aria-hidden="true"></i>  Habilitado
  			  </label>
  			  <label class="btn btn-outline btn-primary <?php echo e((($payment_gateway->test_mode == 0)?'active': '')); ?>">
  				<input type="radio" name="test_mode" autocomplete="off" value="0" <?php if($payment_gateway->test_mode == 0): ?> checked="checked" <?php endif; ?>>
  				<i class="icon wb-check text-active" aria-hidden="true"></i> Deshabilitado
  			  </label>
  			</div>
				</div>
			</div>
			
      </div>

			
			
	</div>
	<div style="clear:both"></div>
	<div class="form-group col-sm-6">
	<button type="submit" ng-disabled="userForm.$invalid" class="btn btn-primary ladda-button" data-plugin="ladda" data-style="expand-left">
			<i class="fa fa-save"></i>  Actualizar credenciales de comercio
		<span class="ladda-spinner"></span><div class="ladda-progress" style="width: 0px;"></div>
		</button>
    <a class="btn btn-default" href="<?php echo e(URL::to('business_visanet')); ?>"><i class="icon wb-arrow-left"></i>Regresar</a>
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