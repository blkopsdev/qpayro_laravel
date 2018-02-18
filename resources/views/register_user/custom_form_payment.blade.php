@extends('layouts.template')
@section('content')
 <!-- Stylesheets -->
<link rel="stylesheet" href="{{URL::to('/')}}/assets/examples/css/pages/profile.css">
<link rel="stylesheet" href="{{URL::to('/')}}/global/vendor/bootstrap-datepicker/bootstrap-datepicker.css">
<link rel="stylesheet" href="{{URL::to('/')}}/global/vendor/bootstrap-maxlength/bootstrap-maxlength.css">
<link rel="stylesheet" href="{{URL::to('/')}}/global/vendor/jt-timepicker/jquery-timepicker.css">
<link rel="stylesheet" href="{{URL::to('/')}}/assets/examples/css/forms/advanced.css">
<script src="{{URL::to('assets/js')}}/ui-bootstrap-tpls-0.11.0.js"></script>
<script src="{{URL::to('assets')}}/croppie.js"></script>
<link rel="stylesheet" href="{{URL::to('assets')}}/croppie.css">
<style>
p.redcolor{color:red; font-size:16px;}
.spancolor{color:red;}
.help-block{color:red;}
</style>
<script>
$(function(){
	$('#palete').on('change', function(c){
		var url = "{{ url('/uploads/form/') }}/";
		var val = $(this).val().replace('#','');
		
		$('#preview_form').attr('src', url+val+'.png');
	});
});
</script>
<div class="page-header">
  <h1 class="page-title font_lato">Personalizar Página de Pago</h1>
  <div class="page-header-actions">
	<ol class="breadcrumb">
		<li><a href="{{URL::to('/dashboard')}}">{{ trans('app.home')}}</a></li>
		@if($business)
		<li><a href="{{URL::to('business_products_detail', $business->business_id)}}">Regresar a listado de botones</a></li>
		@endif
		<li class="active">Personalizar formulario</li>
	</ol>
  </div>
</div>
<div class="page-content container-fluid page-profile">
  <div class="row">
	<div class="col-md-12">
	  <!-- Panel -->
	  <div class="panel">
		<div class="panel-body nav-tabs-animate nav-tabs-horizontal">
		<!------------------------start insert, update, delete message ---------------->
			<div class="col-lg-12">
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
      
	  @if($business)
	  
		<div class="bs-example" data-example-id="single-button-dropdown" style="float:right; ">
		  <div class="btn-group">
			<a class="btn btn-default" href="{{URL::to('business_products_detail', $business->business_id)}}"><i class="icon wb-arrow-left"></i>Regresar</a>
		  </div>
		</div>
		
		  <ul class="nav nav-tabs nav-tabs-line" data-plugin="nav-tabs" role="tablist">
			<li role="presentation" class=""><a data-toggle="tab" href="#profile" aria-controls="profile" role="tab" aria-expanded="true">Personalizar Formulario</a></li>
			<li class="dropdown" role="presentation" style="display: none;">
			  <a class="dropdown-toggle" data-toggle="dropdown" href="#" aria-expanded="false">
				<span class="caret"></span>Menu </a>
			  <ul class="dropdown-menu" role="menu">
				<li role="presentation" style="display: none;"><a data-toggle="tab" href="#profile" aria-controls="profile" role="tab">Personalizar Formulario</a></li>
			  </ul>
			</li>
		  </ul>
			
		<form  name="userForm" action="{{URL::to('custom_form_payment_store')}}/{{$business->business_id}}" method="post" enctype="multipart/form-data">
      		{{ csrf_field() }}
		  <div class="tab-content">

<!------- Profile tab------------->
			<div class="tab-pane animation-slide-left active" id="profile" role="tabpanel">
			<table class="table table-hover table-details">
				<thead>
					<tr>
						<th rowspan="4">Personalización</th>
					</tr>
				</thead>
				<tbody>
            <tr {{ (($count != '1')?'style=display:none':'')}}>
              <td>Selecciona el comercio que deseas personalizar</td>
              <td>
                <label class="control-label">Comercio<span class="spancolor">*</span></label>
                <input type="hidden" name="business_id" id="business_id" value="{{$business->business_id}}" required>
              </td>
            </tr>
					<tr>
						<td>Seleccionar paleta de colores</td>
						<td>
              <label class="control-label">Opciones<span class="spancolor">*</span></label>
              <select ng-model="role"  class="form-control" id="palete" name="palete" required>
				<option value="">Predeterminado</option>
                <option value="#0091E2" @if($business->palette == '#0091E2') selected @endif>Azul</option>
                <option value="#4EC9F5" @if($business->palette == '#4EC9F5') selected @endif>Celeste</option>
                <option value="#4D4D4D" @if($business->palette == '#4D4D4D') selected @endif>Gris</option>
                <option value="#FF1D25" @if($business->palette == '#FF1D25') selected @endif>Rojo</option>
                <option value="#7AC943" @if($business->palette == '#7AC943') selected @endif>Verde</option>
                <option value="#FF931E" @if($business->palette == '#FF931E') selected @endif>Naranja</option>
                <option value="#FF7BAC" @if($business->palette == '#FF7BAC') selected @endif>Rosado</option>
                <option value="#736357" @if($business->palette == '#736357') selected @endif>Café</option>
                <option value="#B3B3B3" @if($business->palette == '#B3B3B3') selected @endif>Gris Claro</option>
              </select>
              
            </td>
					</tr>
            <td align="center">
              {{$temp=''}}
			  
			  @if($business->palette)
              <img id="preview_form" src="{{ url('/uploads/form/'.str_replace('#','',$business->palette)) }}.png"
				 height="auto" width="auto" style="max-width: 100%;" align="center">
			  @else
			  <img id="preview_form" src="{{ url('/uploads/form/0091E2.png') }}"
				 height="auto" width="auto" style="max-width: 100%;" align="center">
				@endif
            </td>
				 </tbody>
       </table>
       <table class="table table-hover table-details">
          <tbody>
          <tr>
            <td>
              Selecciona Logo
            </td>
            <td>
              <label class="control-label" for="inputUserName">Elige el logo que deseas agregar al formulario de pago. (Tamaño máximo 2MB)</label>
              <div class="input-group input-group-file">
                <input class="form-control" readonly="" type="text" required>
                <span class="input-group-btn">
                  <span class="btn btn-success btn-file">
                    <i class="icon wb-upload" aria-hidden="true"></i>
                    <input type="file" name="logo" id="logo">
                  </span>
                </span>
              </div>
            </td>
            @if($business->logo)
            <td>
              Logo Actual:<br>
              <img id="preview_form" src="{{ URL::to('/') }}/{{$business->logo}}" height="50" width="auto" align="center">
            </td>
            @endif
          </tr>
          <tr>
            <td>
              Selecciona tu banner
            </td>
            <td>
              <label class="control-label" for="inputUserName">Elige el banner que deseas agregar al formulario de pago (Tamaño máximo 3MB)</label>
              <div class="input-group input-group-file">
                <input class="form-control" readonly="" type="text" required>
                <span class="input-group-btn">
                  <span class="btn btn-success btn-file">
                    <i class="icon wb-upload" aria-hidden="true"></i>
                    <input type="file" name="banner" id="banner">
                  </span>
                </span>
              </div>
            </td>
            @if($business->background)
            <td>
              Banner Actual:<br>
              <img id="preview_form" src="{{ URL::to('/') }}/{{$business->background}}" height="auto" width="auto" style="max-width: 50%;" align="center">
            </td>
            @endif
          </tr>
          <tr>
            <td></td>
            <td><button type="submit" ng-disabled="userForm.$invalid" class="btn btn-primary ladda-button" data-plugin="ladda" data-style="expand-left">
                <i class="fa fa-save"></i> Guardar
              <span class="ladda-spinner"></span><div class="ladda-progress" style="width: 0px;"></div>
            </button></td>
          </tr>
				 </tbody>
			</table>
      </form>
			</div>
		  </div>
      </form>
	  
	  @else
		<p>No tienes un comercio registrado, para registrarlo <a href="{{ URL::to('/register_user') }}" class="btn btn-info">click aquí</a>
		</p>   
	  @endif
	  
		</div>
	     
	
	</div>
	  <!-- End Panel -->
	</div>
  </div>
</div>

<br/>
@stop
