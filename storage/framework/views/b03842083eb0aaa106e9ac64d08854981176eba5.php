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
  <h1 class="page-title font_lato">Editar botón de pago</h1>
  <div class="page-header-actions">
  <ol class="breadcrumb">
		<li><a href="<?php echo e(URL::to('/dashboard')); ?>"><?php echo e(trans('app.home')); ?></a></li>
		<li><a href="<?php echo e(URL::to('business_products_detail', $business->business_id)); ?>">Lista de botones</a></li>
		<li class="active"><?php echo e(trans('app.edit')); ?></li>
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
<form  name="userForm" action="<?php echo e(URL::to('business_products_update',$products->product_id)); ?>" method="post"  enctype="multipart/form-data">
		<?php echo e(csrf_field()); ?>

<div class="row row-lg">
	<div class="col-sm-8" style="border-right: 1px dotted #ddd;">
	  <!-- Example Basic Form -->
			<div class="row">
        <div class="form-group col-sm-6" <?php echo e((($count == '1')?'style=display:none':'')); ?>>
        <label class="control-label">Comercio<span class="spancolor">*</span></label>
        <input type="hidden" name="business_id" id="business_id" value="<?php echo e($business->business_id); ?>" required>
        </div>
        <div class="form-group col-sm-6">
  				<label class="control-label" for="name">Nombre de Producto o Servicio: <span class="spancolor">*</span> </label>
  				<input type="text" class="form-control" id="name" name="name" placeholder="Nombre" value="<?php echo e($products->name); ?>" required>
			  </div>
        <div class="form-group col-sm-6">
				<label class="control-label" for="description">Descripción: <span class="spancolor">*</span></label>
        <textarea maxlength="250" class="form-control" id="description" name="description" placeholder="Un maximo de 250 caracteres" required><?php echo e($products->description); ?></textarea>
			  </div>
			</div>

			<div class="row">
        <!-- <div class="form-group col-sm-6">
          <label class="control-label" for="charge_type">Pago Recurrente<span class="spancolor">*</span> </label><br>
          <div class="btn-group" data-toggle="buttons" role="group">
            <label class="btn btn-outline btn-primary <?php echo e((($products->charge_type == '1')?'active': '')); ?>">
            <input id="charge_type" name="charge_type" value="1" type="radio" <?php echo e($products->charge_type == '1' ?  "checked" : ''); ?>>
            <i class="icon wb-check text-active" aria-hidden="true"></i>  Si
            </label>
            <label class="btn btn-outline btn-primary <?php echo e((($products->charge_type == '0')?'active': '')); ?>">
            <input id="charge_type" name="charge_type" value="0" type="radio" <?php echo e($products->charge_type == '0' ?  "checked" : ''); ?>>
            <i class="icon wb-check text-active" aria-hidden="true"></i> No
            </label>
          </div>
        </div> -->
			</div>

        <div class="row">
          <div class="form-group col-sm-6">
  				<label class="control-label" for="price">Precio: <span class="spancolor">*</span> </label>
  				<input type="text" class="form-control" id="price" name="price" placeholder="Tipo" value="<?php echo e($products->price); ?>" required>
  			  </div>
          <div class="form-group col-sm-6">
          <label class="control-label">Moneda<span class="spancolor">*</span></label>
          <select ng-model="role"  class="form-control" id="currency" name="currency" required>
            <option value=""></option>
            <option value="GTQ" <?php if($products->currency == 'GTQ'): ?> selected <?php endif; ?>>Quetzales</option>
            <option value="USD" <?php if($products->currency == 'USD'): ?> selected <?php endif; ?>>Dólares</option>
          </select>
          </div>
					<?php if($plans): ?>
          <?php if($plans->open_button == '1'): ?>
          <div class="form-group col-sm-6">
            <label class="control-label" for="price_editable">Precio Editable<span class="spancolor">*</span> </label><br>
            <div class="btn-group" data-toggle="buttons" role="group">
              <label class="btn btn-outline btn-primary  <?php echo e((($products->price_editable == 1)?'active': '')); ?>" onclick="document.getElementById('price_range').disabled = false;">
              <input type="radio" name="price_editable" autocomplete="off" value="1" <?php echo e($products->price_editable == 1 ?  "checked" : ''); ?>>
              <i class="icon wb-check text-active" aria-hidden="true"></i>  Si
              </label>
              <label class="btn btn-outline btn-primary <?php echo e((($products->price_editable == 0)?'active': '')); ?>" onclick="document.getElementById('price_range').value=0; document.getElementById('price_range').disabled = true;">
              <input type="radio" name="price_editable" autocomplete="off" value="0" <?php echo e($products->price_editable == 0 ?  "checked" : ''); ?>>
              <i class="icon wb-check text-active" aria-hidden="true"></i> No
              </label>
            </div>
          </div>

          <!--<div class="form-group col-sm-6">
            <label class="control-label" for="quantity">Rango de precio: <span class="spancolor">*</span> </label>
            <input type="text" class="form-control" id="price_range" name="price_range" placeholder="Rango de Precio" value="<?php echo e($products->price_range); ?>" required>
          </div>-->

          <?php endif; ?>
					<?php endif; ?>
  			</div>
        <div class="row">
          <div class="form-group col-sm-6">
            <label class="control-label" for="quantity_edit">Cantidad Editable<span class="spancolor">*</span> </label><br>
            <div class="btn-group" data-toggle="buttons" role="group">
              <label class="btn btn-outline btn-primary  <?php echo e((($products->quantity_edit == '1')?'active': '')); ?>">
              <input type="radio" name="quantity_edit" autocomplete="off" value="1" <?php echo e($products->quantity_edit == '1' ?  "checked" : ''); ?>>
              <i class="icon wb-check text-active" aria-hidden="true"></i>  Si
              </label>
              <label class="btn btn-outline btn-primary <?php echo e((($products->quantity_edit == '0')?'active': '')); ?>">
              <input type="radio" name="quantity_edit" autocomplete="off" value="0" <?php echo e($products->quantity_edit == '0' ?  "checked" : ''); ?>>
              <i class="icon wb-check text-active" aria-hidden="true"></i> No
              </label>
            </div>
          </div>
          <div class="form-group col-sm-6">
            <label class="control-label" for="quantity">Cantidad: <span class="spancolor">*</span> </label>
            <input type="text" class="form-control" id="quantity" name="quantity" placeholder="Cantidad" value="<?php echo e($products->quantity); ?>" required>
          </div>
  			</div>
        <!-- <div class="row">
          <div class="form-group col-sm-6">
          <label class="control-label">Frecuencia<span class="spancolor">*</span></label>
          <select ng-model="role"  class="form-control" id="frequency" name="frequency">
            <option value="0"></option>
            <option value="1">Diario</option>
            <option value="2">Mensual</option>
            <option value="3">Anual</option>
          </select>
          </div>
          <div class="form-group col-sm-6">
  			  <label class="control-label" for="charge_until">Cobrar Hasta: </label>
            <div class="input-group">
              <span class="input-group-addon">
                <i class="icon wb-calendar" aria-hidden="true"></i>
              </span>
              <input type="text" class="form-control" id="charge_until" name="charge_until" value="<?php echo e($products->charge_until); ?>" data-plugin="datepicker">
            </div>
          </div>
  			</div> -->

        <div class="row">
          <div class="form-group col-sm-6">
          <label class="control-label" for="price">Envío<span class="spancolor">*</span><br>
          <div class="btn-group" data-toggle="buttons" role="group">
          <label class="btn btn-outline btn-primary  <?php echo e((($products->enabled_shipping == '1')?'active': '')); ?>" onclick="document.getElementById('charge_shipping').disabled = false;">
          <input type="radio" name="enabled_shipping" autocomplete="off" value="1" <?php echo e($products->enabled_shipping == '1' ?  "checked" : ''); ?>>
          <i class="icon wb-check text-active" aria-hidden="true"></i>  Si
          </label>
          <label class="btn btn-outline btn-primary <?php echo e((($products->enabled_shipping == '0')?'active': '')); ?>" onclick="document.getElementById('charge_shipping').value=0; document.getElementById('charge_shipping').disabled = true;">
          <input type="radio" name="enabled_shipping" autocomplete="off" value="0" <?php echo e($products->enabled_shipping == '0' ?  "checked" : ''); ?>>
          <i class="icon wb-check text-active" aria-hidden="true"></i> No
          </label>
          </div>
        </div>
          <div class="form-group col-sm-6">
    				<label class="control-label" for="charge_shipping">Costo Envío: <span class="spancolor">*</span> </label>
    				<input type="text" class="form-control" id="charge_shipping" name="charge_shipping" placeholder="Precio" value="<?php echo e($products->shipping_cost); ?>" required  <?php echo e((($products->enabled_shipping == '0')?'disabled ': '')); ?>>
  			  </div>
			   </div>
         <div class="row">
           <div class="form-group col-sm-6">
           <label class="control-label" for="price">Visa Cuotas<span class="spancolor">*</span> </label><br>
           <div class="btn-group" data-toggle="buttons" role="group">
             <label class="btn btn-outline btn-primary  <?php echo e((($products->enabled_visa_cuota == '1')?'active': '')); ?>">
             <input type="radio" name="enabled_visa_cuota" autocomplete="off" value="1" <?php echo e($products->enabled_visa_cuota == '1' ?  "checked" : ''); ?>>
             <i class="icon wb-check text-active" aria-hidden="true"></i>  Si
             </label>
             <label class="btn btn-outline btn-primary <?php echo e((($products->enabled_visa_cuota == '0')?'active': '')); ?>">
             <input type="radio" name="enabled_visa_cuota" autocomplete="off" value="0" <?php echo e($products->enabled_visa_cuota == '0' ?  "checked" : ''); ?>>
             <i class="icon wb-check text-active" aria-hidden="true"></i> No
             </label>
           </div>
           </div>
         <div class="form-group col-sm-6">
           </label>
           <label class="control-label" for="price">Estado<span class="spancolor">*</span><br>
           <div class="btn-group" data-toggle="buttons" role="group">
            <label class="btn btn-outline btn-primary  <?php echo e((($products->status == 1)?'active': '')); ?>">
            <input type="radio" name="estado" autocomplete="off" value="1" <?php echo e($products->status == 1 ?  "checked" : ''); ?>>
            <i class="icon wb-check text-active" aria-hidden="true"></i>  <?php echo e(trans('app.active')); ?>

            </label>
            <label class="btn btn-outline btn-primary <?php echo e((($products->status != 1)?'active': '')); ?>">
            <input type="radio" name="estado" autocomplete="off" value="0" <?php echo e($products->status != 1 ?  "checked" : ''); ?>>
            <i class="icon wb-check text-active" aria-hidden="true"></i> <?php echo e(trans('app.inactive')); ?>

            </label>
							
						<p style="clear:both;">
						<div class="alert alert-warning"><?php echo e($buttonStatus); ?></div>
						</p>
          </div>
          </label>
        </div>
         </div>
         <div class="row">
           <div class="form-group col-sm-6">
     				<label class="control-label" for="button_text">Texto de Boton: <span class="spancolor">*</span> </label>
     				<input type="text" class="form-control" id="button_text" name="button_text" placeholder="Nombre" value="<?php echo e($products->button_text); ?>" required>
   			  </div>
           <div class="form-group col-sm-6">
             <label class="control-label">Opciones<span class="spancolor">*</span></label>
             <select ng-model="role"  class="form-control" id="color" name="color" required>
               <option value="#0091E2" <?php if($products->color == '#0091E2'): ?> selected <?php endif; ?>>Azul</option>
               <option value="#4EC9F5" <?php if($products->color == '#4EC9F5'): ?> selected <?php endif; ?>>Celeste</option>
               <option value="#4D4D4D" <?php if($products->color == '#4D4D4D'): ?> selected <?php endif; ?>>Gris</option>
               <option value="#FF1D25" <?php if($products->color == '#FF1D25'): ?> selected <?php endif; ?>>Rojo</option>
               <option value="#7AC943" <?php if($products->color == '#7AC943'): ?> selected <?php endif; ?>>Verde</option>
               <option value="#FF931E" <?php if($products->color == '#FF931E'): ?> selected <?php endif; ?>>Naranja</option>
               <option value="#FF7BAC" <?php if($products->color == '#FF7BAC'): ?> selected <?php endif; ?>>Rosado</option>
               <option value="#736357" <?php if($products->color == '#736357'): ?> selected <?php endif; ?>>Café</option>
               <option value="#B3B3B3" <?php if($products->color == '#B3B3B3'): ?> selected <?php endif; ?>>Gris Claro</option>
             </select>
           </div>
         </div>
<div style="clear:both"></div>
	</div>
	<div style="clear:both"></div>
	<div class="form-group col-sm-6">
	<button type="submit" ng-disabled="userForm.$invalid" class="btn btn-primary ladda-button" data-plugin="ladda" data-style="expand-left">
			<i class="fa fa-save"></i>  Actualizar
		<span class="ladda-spinner"></span><div class="ladda-progress" style="width: 0px;"></div>
		</button>
    <a class="btn btn-default" href="<?php echo e(URL::to('business_products_detail', $business->business_id)); ?>"><i class="icon wb-arrow-left"></i>Regresar</a>
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