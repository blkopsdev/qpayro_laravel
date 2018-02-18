@extends('layouts.template')
@section('content')
<link rel="stylesheet" href="{{URL::to('/')}}/global/vendor/bootstrap-datepicker/bootstrap-datepicker.css">
<link rel="stylesheet" href="{{URL::to('/')}}/global/vendor/bootstrap-maxlength/bootstrap-maxlength.css">
<link rel="stylesheet" href="{{URL::to('/')}}/global/vendor/jt-timepicker/jquery-timepicker.css">
<link rel="stylesheet" href="{{URL::to('/')}}/assets/examples/css/forms/advanced.css">

<style>
p.redcolor{color:red; font-size:16px;}
.spancolor{color:red;}
.help-block{color:red;}
</style>

<div class="page-header">
  <h1 class="page-title font_lato">Nuevo botón</h1>
  <div class="page-header-actions">
  <ol class="breadcrumb">
		<li><a href="{{URL::to('/dashboard')}}">{{ trans('app.home')}}</a></li>
		<li><a href="{{URL::to('business_products_detail', $business->business_id)}}">Lista de botónes</a></li>
		<li class="active">{{ trans('app.create')}}</li>
	</ol>
  </div>
</div>

<div class="page-content">
<div class="panel">
<div class="panel-body container-fluid">
<!------------------------start insert, update, delete message  ---------------->
<div class="row">
@if(session('msg_success'))
	<div class="alert dark alert-icon alert-success alert-dismissible alertDismissible" role="alert">
	  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
		<span aria-hidden="true">×</span>
	  </button>
	  <i class="icon wb-check" aria-hidden="true"></i>
	  {{session('msg_success')}}
	</div>
@endif
@if(session('msg_update'))
	<div class="alert dark alert-icon alert-info alert-dismissible alertDismissible" role="alert">
	  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
		<span aria-hidden="true">×</span>
	  </button>
	  <i class="icon wb-check" aria-hidden="true"></i>
	  {{session('msg_update')}}
	</div>
@endif
@if(session('msg_delete'))
	<div class="alert dark alert-icon alert-danger alert-dismissible alertDismissible" role="alert">
	  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
		<span aria-hidden="true">×</span>
	  </button>
	  <i class="icon wb-check" aria-hidden="true"></i>
	  {{session('msg_delete')}}
	</div>
@endif
</div>
<form  name="userForm" action="{{URL::to('business_products_store')}}" method="post" enctype="multipart/form-data">
		{{ csrf_field() }}
<div class="row row-lg">
	<div class="col-sm-8" style="border-right: 1px dotted #ddd;">
	  <!-- Example Basic Form -->
			<div class="row">
        <div class="form-group col-sm-6" {{ (($count == '1')?'style=display:none':'')}}>
        <label class="control-label">Comercio<span class="spancolor">*</span></label>
        <input type="hidden" name="business_id" id="business_id" value="{{$business->business_id}}" required>
        </div>
        <div class="form-group col-sm-6">
  				<label class="control-label" for="name">Nombre de Producto o Servicio: <span class="spancolor">*</span> </label>
  				<input type="text" class="form-control" id="name" name="name" placeholder="Nombre" required>
			  </div>
        <div class="form-group col-sm-6">
				<label class="control-label" for="description">Descripción: <span class="spancolor">*</span></label>
				<textarea maxlength="250" class="form-control" id="description" name="description" placeholder="Un maximo de 250 caracteres" required></textarea>
			  </div>
			</div>

			<div class="row">
        <!-- <div class="form-group col-sm-6">
          <label class="control-label" for="charge_type">Pago Recurrente<span class="spancolor">*</span> </label><br>
          <div class="btn-group" data-toggle="buttons" role="group">
            <label class="btn btn-outline btn-primary  {{'active'}}">
            <input type="radio" name="charge_type" autocomplete="off"  value="1" checked="checked">
            <i class="icon wb-check text-active" aria-hidden="true"></i>  Si
            </label>
            <label class="btn btn-outline btn-primary ">
            <input type="radio" name="charge_type" autocomplete="off" value="0" >
            <i class="icon wb-check text-active" aria-hidden="true"></i> No
            </label>
          </div>
        </div> -->
			</div>

        <div class="row">
          <div class="form-group col-sm-6">
  				<label class="control-label" for="price">Precio: <span class="spancolor">*</span> </label>
  				<input type="text" class="form-control" id="price" name="price" placeholder="Precio" required>
  			  </div>
          <div class="form-group col-sm-6">
          <label class="control-label">Moneda<span class="spancolor">*</span></label>
          <select ng-model="role"  class="form-control" id="currency" name="currency" required>
            <option value="GTQ">Quetzales</option>
            <option value="USD">Dólares</option>
          </select>
          </div>
          @if($plans->open_button == '1')
          <div class="form-group col-sm-6">
            <label class="control-label" for="price_editable">Precio Editable<span class="spancolor">*</span> </label><br>
            <div class="btn-group" data-toggle="buttons" role="group">
              <label class="btn btn-outline btn-primary  {{'active'}}" onclick="document.getElementById('price_range').disabled = false;">
              <input type="radio" name="price_editable" autocomplete="off"  value="1" checked="checked">
              <i class="icon wb-check text-active" aria-hidden="true"></i>  Si
              </label>
              <label class="btn btn-outline btn-primary " onclick="document.getElementById('price_range').value=0; document.getElementById('price_range').disabled = true;">
              <input type="radio" name="price_editable" autocomplete="off" value="0" >
              <i class="icon wb-check text-active" aria-hidden="true"></i> No
              </label>
            </div>
          </div>

          <!-- <div class="form-group col-sm-6">
            <label class="control-label" for="quantity">Rango: <span class="spancolor">*</span> </label>
            <input type="text" class="form-control" id="price_range" name="price_range" placeholder="Ejemplo: 0:1000"required>
          </div> -->

          @endif
  			</div>
        <div class="row">
          <div class="form-group col-sm-6">
            <label class="control-label" for="quantity_edit">Cantidad Editable<span class="spancolor">*</span> </label><br>
            <div class="btn-group" data-toggle="buttons" role="group">
              <label class="btn btn-outline btn-primary  {{'active'}}">
              <input type="radio" name="quantity_edit" autocomplete="off"  value="1" checked="checked">
              <i class="icon wb-check text-active" aria-hidden="true"></i>  Si
              </label>
              <label class="btn btn-outline btn-primary ">
              <input type="radio" name="quantity_edit" autocomplete="off" value="0" >
              <i class="icon wb-check text-active" aria-hidden="true"></i> No
              </label>
            </div>
          </div>
          <div class="form-group col-sm-6">
            <label class="control-label" for="quantity">Cantidad: <span class="spancolor">*</span> </label>
            <input type="text" class="form-control" id="quantity" name="quantity" placeholder="Cantidad" value="1" required>
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
              <input type="text" class="form-control" id="charge_until" name="charge_until" data-plugin="datepicker">
            </div>
          </div>
  			</div> -->

        <div class="row">
          <div class="form-group col-sm-6">
          <label class="control-label" for="price">Envío<span class="spancolor">*</span><br>
          <div class="btn-group" data-toggle="buttons" role="group">
          <label class="btn btn-outline btn-primary  {{'active'}}" onclick="document.getElementById('charge_shipping').disabled = false;">
          <input type="radio" name="enabled_shipping" autocomplete="off"  value="1" checked="checked">
          <i class="icon wb-check text-active" aria-hidden="true"></i>  Si
          </label>
          <label class="btn btn-outline btn-primary " onclick="document.getElementById('charge_shipping').value=0; document.getElementById('charge_shipping').disabled = true;">
          <input type="radio" name="enabled_shipping" autocomplete="off" value="0" >
          <i class="icon wb-check text-active" aria-hidden="true"></i> No
          </label>
          </div>
        </div>
          <div class="form-group col-sm-6">
    				<label class="control-label" for="charge_shipping">Costo Envío: <span class="spancolor">*</span> </label>
    				<input type="text" class="form-control" id="charge_shipping" name="charge_shipping" placeholder="Precio" value="0" required>
  			  </div>
			   </div>
         <div class="row">
           <div class="form-group col-sm-6">
           <label class="control-label" for="price">Visa Cuotas<span class="spancolor">*</span> </label><br>
           <div class="btn-group" data-toggle="buttons" role="group">
             <label class="btn btn-outline btn-primary  {{'active'}}">
             <input type="radio" name="enabled_visa_cuota" autocomplete="off"  value="1" checked="checked">
             <i class="icon wb-check text-active" aria-hidden="true"></i>  Si
             </label>
             <label class="btn btn-outline btn-primary ">
             <input type="radio" name="enabled_visa_cuota" autocomplete="off" value="0" >
             <i class="icon wb-check text-active" aria-hidden="true"></i> No
             </label>
           </div>
           </div>
         <div class="form-group col-sm-6">
           </label>
           <label class="control-label" for="price">Estado<span class="spancolor">*</span><br>
           <div class="btn-group" data-toggle="buttons" role="group">
            <label class="btn btn-outline btn-primary  {{'active'}}">
            <input type="radio" name="estado" autocomplete="off"  value="1" checked="checked">
            <i class="icon wb-check text-active" aria-hidden="true"></i>  {{ trans('app.active')}}
            </label>
            <label class="btn btn-outline btn-primary ">
            <input type="radio" name="estado" autocomplete="off" value="0" >
            <i class="icon wb-check text-active" aria-hidden="true"></i> {{ trans('app.inactive')}}
            </label>
          </div>
          </label>
        </div>
         </div>
         <div class="row">
           <div class="form-group col-sm-6">
     				<label class="control-label" for="button_text">Texto del Boton: <span class="spancolor">*</span> </label>
     				<input type="text" class="form-control" id="button_text" name="button_text" value="Pagar Ahora" required>
   			  </div>
           <div class="form-group col-sm-6">
             <label class="control-label">Color<span class="spancolor">*</span></label>
             <select ng-model="role"  class="form-control" id="color" name="color" required>
               <option value="#0091E2">Azúl</option>
               <option value="#4EC9F5">Celeste</option>
               <option value="#4D4D4D">Gris</option>
               <option value="#FF1D25">Rojo</option>
               <option value="#7AC943">Verde</option>
               <option value="#FF931E">Naranja</option>
               <option value="#FF7BAC">Rosado</option>
               <option value="#736357">Café</option>
               <option value="#B3B3B3">Gris Claro</option>
             </select>
           </div>
         </div>
<div style="clear:both"></div>
	</div>
	<div style="clear:both"></div>
	<div class="form-group col-sm-6">
	<button type="submit" ng-disabled="userForm.$invalid" class="btn btn-primary ladda-button" data-plugin="ladda" data-style="expand-left">
			<i class="fa fa-save"></i>  Crear Botón de Pago
		<span class="ladda-spinner"></span><div class="ladda-progress" style="width: 0px;"></div>
		</button>
    <a class="btn btn-default" href="{{URL::to('business_products_detail', $business->business_id)}}"><i class="icon wb-arrow-left"></i>Regresar</a>
	</div>
  </div>
</form>
</div>
<!-- /.panel -->
</div>
<!-- /.col-lg-12 -->
</div><br/>

@stop
