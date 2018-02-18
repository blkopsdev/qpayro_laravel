<?php $__env->startSection('content'); ?>
<link rel="stylesheet" href="<?php echo e(URL::to('/')); ?>/global/vendor/bootstrap-datepicker/bootstrap-datepicker.css">
<link rel="stylesheet" href="<?php echo e(URL::to('/')); ?>/global/vendor/bootstrap-maxlength/bootstrap-maxlength.css">
<link rel="stylesheet" href="<?php echo e(URL::to('/')); ?>/global/vendor/jt-timepicker/jquery-timepicker.css">
<link rel="stylesheet" href="<?php echo e(URL::to('/')); ?>/assets/examples/css/forms/advanced.css">
<script src="<?php echo e(URL::to('assets/js')); ?>/ui-bootstrap-tpls-0.11.0.js"></script>
<script src="<?php echo e(URL::to('assets')); ?>/croppie.js"></script>
<link rel="stylesheet" href="<?php echo e(URL::to('assets')); ?>/croppie.css">
<style>
p.redcolor{color:red; font-size:16px;}
.spancolor{color:red;}
.help-block{color:red;}
</style>

<div class="page-header">
  <h1 class="page-title font_lato">Actualizar Business</h1>
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
<form  name="userForm" action="<?php echo e(URL::to('business_update',$business->business_id)); ?>" method="post" >
		<?php echo e(csrf_field()); ?>

<div class="row row-lg">
	<div class="col-sm-8" style="border-right: 1px dotted #ddd;">
	  <!-- Example Basic Form -->
			<div class="row">
			<div class="col-sm-12">
			<p class="font-size-20 blue-grey-700">Detalles Business</p>
			</div>
			  <div class="form-group col-sm-6">
				<label class="control-label" for="public_key">Public Key: <span class="spancolor">*</span> </label>
				<input type="text" class="form-control" id="public_key" name="public_key" placeholder="Llave Publica" value="<?php echo e($business->public_key); ?>" >
			  </div>
        <div class="form-group col-sm-6">
				<label class="control-label" for="private_key">Private key: <span class="spancolor">*</span> </label>
				<input type="text" class="form-control" id="private_key" name="private_key" placeholder="Llave privada" value="<?php echo e($business->private_key); ?>" >
			  </div>
			</div>

			<div class="row">
        <div class="form-group col-sm-6">
        <label class="control-label" for="api_secret">Api Secret: </label>
        <input type="text" class="form-control" id="api_secret" name="api_secret" placeholder="Api Secreta" value="<?php echo e($business->api_secret); ?>" >
        </div>
					<div class="form-group col-sm-6">
        <label class="control-label" for="merchant_id">Merchant ID: </label>
        <input type="text" class="form-control" id="merchant_id" name="merchant_id" placeholder="Merchant ID" value="<?php echo e($business->merchant_id); ?>" >
        </div>
			  
			</div>

      <div class="row">
			<div class="form-group col-sm-6">
				<label class="control-label" for="business_name">Business Name: </label>
				<input type="text" class="form-control" id="business_name" name="business_name" placeholder="URL" value="<?php echo e($business->business_name); ?>" >
			  </div>
        <div class="form-group col-sm-6">
          <label class="control-label" for="ownership">Ownership: <span class="spancolor">*</span> </label>
  				<input type="text" class="form-control" id="ownership" name="ownership" placeholder="Nombre de la Tecnología" value="<?php echo e($business->ownership_type); ?>" >
			  </div>
        
			</div>

      <div class="row">

        
					<div class="form-group col-sm-6">
          <label class="control-label" for="tax_regime">Tax Regime: <span class="spancolor">*</span> </label>
  				<input type="text" class="form-control" id="tax_regime" name="tax_regime" placeholder="Regimen" value="<?php echo e($business->tax_regime); ?>" >
			  </div>
			  <div class="form-group col-sm-6">
          <label class="control-label" for="tax_id">Tax Id: <span class="spancolor">*</span> </label>
  				<input type="text" class="form-control" id="tax_id" name="tax_id" placeholder="Nombre de la Tecnología" value="<?php echo e($business->tax_id); ?>" >
			  </div>
			</div>

      <div class="row">
			<div class="form-group col-sm-6">
          <label class="control-label" for="identification_number">Legal Name: </label>
  				<input type="text" class="form-control" id="legal_name" name="legal_name" placeholder="URL" value="<?php echo e($business->legal_name); ?>" >
			  </div>
			  <div class="form-group col-sm-6">
          <label class="control-label" for="state">State: <span class="spancolor">*</span> </label>
  				<input type="text" class="form-control" id="state" name="state" placeholder="Nombre de la Tecnología" value="<?php echo e($business->state); ?>" >
			  </div>
			</div>

      <div class="row">

        <div class="form-group col-sm-6">
          <label class="control-label" for="zip_code">Zip Code: </label>
  				<input type="text" class="form-control" id="zip_code" name="zip_code" placeholder="URL" value="<?php echo e($business->zip_code); ?>" >
			  </div>
			  <div class="form-group col-sm-6">
          <label class="control-label" for="address">Adress: <span class="spancolor">*</span> </label>
          <input type="text" class="form-control" id="address" name="address" placeholder="Nombre de la Tecnología" value="<?php echo e($business->address); ?>" >
			  </div>
			</div>

      <div class="row">

        <div class="form-group col-sm-6">
          <label class="control-label" for="desc_business">Descripcion Comercio: </label>
  				<input type="text" class="form-control" id="desc_business" name="desc_business" placeholder="Descripción Comercio" value="<?php echo e($business->desc_business); ?>">
			  </div>
			  <div class="form-group col-sm-6">
          <label class="control-label" for="activity_business">Actividad Principal: <span class="spancolor">*</span> </label>
          <input type="text" class="form-control" id="activity_business" name="activity_business" placeholder="Actividad Principal" value="<?php echo e($business->activity_business); ?>">
			  </div>
			</div>

      <div class="row">

        <div class="form-group col-sm-6">
          <label class="control-label" for="url_business">URL: </label>
  				<input type="text" class="form-control" id="url_business" name="url_business" placeholder="URL" value="<?php echo e($business->url_business); ?>">
			  </div>
			  <div class="form-group col-sm-6">
          <label class="control-label" for="sales_aprox">Ventas Aproximadas: <span class="spancolor">*</span> </label>
          <input type="text" class="form-control" id="sales_aprox" name="sales_aprox" placeholder="Ventas Aproximadas" value="<?php echo e($business->sales_aprox); ?>">
			  </div>
			</div>

      <div class="row">

        <div class="form-group col-sm-6">
          <label class="control-label" for="expense_aprox">Gastos Aproximados: </label>
  				<input type="text" class="form-control" id="expense_aprox" name="expense_aprox" placeholder="Gastos Aproximados" value="<?php echo e($business->expense_aprox); ?>">
			  </div>
			  <div class="form-group col-sm-6">
          <label class="control-label" for="num_employees">Cantidad de Empleados: <span class="spancolor">*</span> </label>
          <input type="text" class="form-control" id="num_employees" name="num_employees" placeholder="Cantidad de Empleados" value="<?php echo e($business->num_employees); ?>">
			  </div>
			</div>

      <div class="row">

        <div class="form-group col-sm-6">
          <label class="control-label" for="number_afiliation">Número de Afiliación: </label>
  				<input type="text" class="form-control" id="number_afiliation" name="number_afiliation" placeholder="Número de Afiliación" value="<?php echo e($business->number_afiliation); ?>">
			  </div>
			  <div class="form-group col-sm-6">
          <label class="control-label" for="number_account">Número de Cuenta: <span class="spancolor">*</span> </label>
          <input type="text" class="form-control" id="number_account" name="number_account" placeholder="Número de Cuenta" value="<?php echo e($business->number_account); ?>">
			  </div>
			</div>

      <div class="row">

        <div class="form-group col-sm-6">
          <label class="control-label" for="owner_account">Propietario de la Cuenta: </label>
  				<input type="text" class="form-control" id="owner_account" name="owner_account" placeholder="Propietario de la Cuenta" value="<?php echo e($business->owner_account); ?>">
			  </div>
			  <div class="form-group col-sm-6">
          <label class="control-label" for="name_to_emit">Nombre a Emitir: <span class="spancolor">*</span> </label>
          <input type="text" class="form-control" id="name_to_emit" name="name_to_emit" placeholder="Nombre a Emitir" value="<?php echo e($business->name_to_emit); ?>">
			  </div>
			</div>

      <div class="row">
        <div class="form-group col-sm-6">
          <label class="control-label" for="retention_name">Retención: </label>
          <input type="text" class="form-control" id="retention_name" name="retention_name" placeholder="Retención" value="<?php echo e($business->retention_name); ?>">
        </div>
        <div class="form-group col-sm-6">
          <label class="control-label" for="bank">Banco: <span class="spancolor">*</span> </label>
          <input type="text" class="form-control" id="bank" name="bank" placeholder="Banco" value="<?php echo e($business->bank); ?>">
        </div>
      </div>

      <div class="row">
        <div class="form-group col-sm-6">
          <label class="control-label" for="currency_afiliation">Moneda de Afiliación: </label>
          <input type="text" class="form-control" id="currency_afiliation" name="currency_afiliation" placeholder="Moneda de Afiliación" value="<?php echo e($business->currency_afiliation); ?>">
        </div>
        <label class="control-label" for="have_afiliation">Posee Afiliación: </label>
        <div class="btn-group" data-toggle="buttons" role="group">
          <label class="btn btn-outline btn-primary  <?php echo e((($business->have_afiliation == '1')?'active': '')); ?>">
          <input type="radio" name="have_afiliation" autocomplete="off"  value="1">
          <i class="icon wb-check text-active" aria-hidden="true"></i>  Si
          </label>
          <label class="btn btn-outline btn-primary <?php echo e((($business->have_afiliation == '0')?'active': '')); ?>">
          <input type="radio" name="have_afiliation" autocomplete="off" value="0" >
          <i class="icon wb-check text-active" aria-hidden="true"></i> No
          </label>
        </div>
      </div>

      <div class="row">
        <div class="form-group col-sm-6">
          <label class="control-label" for="fiscal_adress">Dirección Fiscal: </label>
          <input type="text" class="form-control" id="fiscal_adress" name="fiscal_adress" placeholder="Dirección Fiscal" value="<?php echo e($business->fiscal_adress); ?>">
        </div>
        <div class="form-group col-sm-6">
          <label class="control-label" for="office_adress">Dirección de Oficinas: <span class="spancolor">*</span> </label>
          <input type="text" class="form-control" id="office_adress" name="office_adress" placeholder="Dirección de Oficinas" value="<?php echo e($business->office_adress); ?>">
        </div>
      </div>

      <div class="row">
        <div class="form-group col-sm-6">
          <label class="control-label" for="phone">Teléfono: </label>
          <input type="text" class="form-control" id="phone" name="phone" placeholder="Teléfono" value="<?php echo e($business->phone); ?>">
        </div>
        <div class="form-group col-sm-6">
          <label class="control-label" for="business_type">Tipo de Comercio: <span class="spancolor">*</span> </label>
          <input type="text" class="form-control" id="business_type" name="business_type" placeholder="Tipo de Comercio" value="<?php echo e($business->business_type); ?>">
        </div>
      </div>

      <div class="row">
        <div class="form-group col-sm-6">
          <label class="control-label" for="name_representative">Nombre Representante: </label>
          <input type="text" class="form-control" id="name_representative" name="name_representative" placeholder="Nombre Representante" value="<?php echo e($business->name_representative); ?>">
        </div>
        <div class="form-group col-sm-6">
          <label class="control-label" for="representative_type">Tipo de Representación: <span class="spancolor">*</span> </label>
          <input type="text" class="form-control" id="representative_type" name="representative_type" placeholder="Tipo de Representación" value="<?php echo e($business->representative_type); ?>">
        </div>
      </div>

      <div class="row">
        <div class="form-group col-sm-6">
          <label class="control-label" for="id_representative">Identificación Representante: </label>
          <input type="text" class="form-control" id="id_representative" name="id_representative" placeholder="Identificación Representante" value="<?php echo e($business->id_representative); ?>">
        </div>
        <div class="form-group col-sm-6">
          <label class="control-label" for="date_foundation">Fecha de Fundación: <span class="spancolor">*</span> </label>
          <input type="text" class="form-control" id="date_foundation" name="date_foundation" placeholder="Fecha de Fundación" value="<?php echo e($business->date_foundation); ?>">
        </div>
      </div>
				
			<div class="row">
        <div class="form-group col-sm-6">
          <label class="control-label" for="step">Paso: </label>
					<select name="step" class="form-control">
						<option value="steps" <?php if($business->step = 'steps'): ?> selected="selected" <?php endif; ?>>Paso 1</option>
						<option value="step2" <?php if($business->step = 'step2'): ?> selected="selected" <?php endif; ?>>Paso 2</option>
						<option value="step3" <?php if($business->step = 'step3'): ?> selected="selected" <?php endif; ?>>Paso 3</option>
						<option value="step4" <?php if($business->step = 'step4'): ?> selected="selected" <?php endif; ?>>Paso 4</option>
						<option value="step5" <?php if($business->step = 'step5'): ?> selected="selected" <?php endif; ?>>Paso 5</option>
						<option value="step6" <?php if($business->step = 'step6'): ?> selected="selected" <?php endif; ?>>Paso 6</option>
						<option value="finish" <?php if($business->step = 'finish'): ?> selected="selected" <?php endif; ?>>Finalizado</option>
					</select>
          
        </div>
					
				<label class="control-label" for="have_afiliation">Estado de pago: </label>
        <div class="btn-group" data-toggle="buttons" role="group">
          <label class="btn btn-outline btn-primary  <?php echo e((($business->payment_sucess == 1)?'active': '')); ?>">
          <input type="radio" name="payment_sucess" autocomplete="off"  value="1">
          <i class="icon wb-check text-active" aria-hidden="true"></i>  Si
          </label>
          <label class="btn btn-outline btn-primary <?php echo e((($business->payment_sucess == 0)?'active': '')); ?>">
          <input type="radio" name="payment_sucess" autocomplete="off" value="0" >
          <i class="icon wb-check text-active" aria-hidden="true"></i> No
          </label>
        </div>
        
      </div>

      <div class="row">
        <div class="form-group col-sm-6">
        <div class="btn-group" data-toggle="buttons" role="group">
  			  <label class="btn btn-outline btn-primary  <?php echo e((($business->status == '1')?'active': '')); ?>">
  				<input type="radio" name="estado" autocomplete="off"  value="1" <?php echo e($business->status == '1' ?  "checked" : ''); ?>>
  				<i class="icon wb-check text-active" aria-hidden="true"></i>  <?php echo e(trans('app.active')); ?>

  			  </label>
  			  <label class="btn btn-outline btn-primary <?php echo e((($business->status == '0')?'active': '')); ?>">
  				<input type="radio" name="estado" autocomplete="off" value="2" <?php echo e($business->status == '2' ?  "checked" : ''); ?>>
  				<i class="icon wb-check text-active" aria-hidden="true"></i> <?php echo e(trans('app.inactive')); ?>

  			  </label>
  			</div>
      </div>
				
			
				
      </div>


	</div>
	<div style="clear:both"></div>
	<div class="form-group col-sm-6">
	<button type="submit" ng-disabled="userForm.$invalid" class="btn btn-primary ladda-button" data-plugin="ladda" data-style="expand-left">
			<i class="fa fa-save"></i>  Actualizar Business
		<span class="ladda-spinner"></span><div class="ladda-progress" style="width: 0px;"></div>
		</button>
    <a class="btn btn-default" href="<?php echo e(URL::to('business')); ?>"><i class="icon wb-arrow-left"></i>Regresar</a>
	</div>
  </div>
</form>


<!-- /.row -->
</div>
<!-- /.panel -->
</div>
<!-- /.col-lg-12 -->
</div><br/>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.template', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>