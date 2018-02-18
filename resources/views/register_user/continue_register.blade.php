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
  <h1 class="page-title font_lato">Hola, vamos a completar tu aplicación QPay</h1>
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
<form  name="userForm" action="{{URL::to($business->step,Session::get('business_id'))}}" method="post" >
		{{ csrf_field() }}
<div class="row row-lg">
	<div class="col-sm-6" style="border-right: 1px dotted #ddd;">
	  <!-- Example Basic Form -->
			<div class="row">
			     <h1 class="page-title font_lato">Continua tu registro</h1>
			</div>

			<div class="row">
        <p>Empieza a aceptar pagos en línea en tu página web o tienda en línea rapidamente ingresando a tu aplicación QPayPro, solo te tomara unos minutos.
        Una vez completada, estaremos enviando tu información y nos pondremos en contacto en no mas de 3 días con el resultado de tu aplicación.</p>
        <button class="btn btn-primary" type="submit">Continuar Aplicación</button>
        </br><p>Mientras tanto, puedes explorar nuestra herramienta y crear tus productos, botones de pago o iniciar la integración a tu tienda en línea.</p>
			</div>
	</div>
  <div class="col-md-6 form-group">
    <p>Papelería que puedes necesitar</p>
    <ul>
      <li>Afiliación actual de VisaNet (Cliente existente)</li>
      <li>Información local de tu negocio</li>
      <li>RTU</li>
      <li>Patentes de Comercio / Sociedad</li>
      <li>Cheque anulado para verificación bancaria</li>
    </ul>
  </div>
	<div style="clear:both"></div>
  </div>
</form>
</div>
<!-- /.panel -->
</div>
<!-- /.col-lg-12 -->
</div><br/>

@stop
