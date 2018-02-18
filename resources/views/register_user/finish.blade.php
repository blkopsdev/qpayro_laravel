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
  <h1 class="page-title font_lato"></h1>
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
<div class="row row-lg">
	<div class="col-sm-8" style="border-right: 1px dotted #ddd;">
	  <!-- Example Basic Form -->
			<div class="row">
			     <h1 class="page-title font_lato">Gracias, tu pago ha sido acreditado</h1>
			</div>

			<div class="row">
        <p>En estos momentos estaremos procesando tus credenciales de pago, este proceso puede tardar de 3-5 días hábiles.</p>
        <p>Te estaremos notificando por correo electrónico en cuanto el sistema esté listo para ser usado y empieces a integrar tu comercio electrónico con QPay.</p>
        <a class="btn btn-block btn-primary" href="{{URL::to('list_business')}}">Ver el estado de la afiliación</a>
        <p>Si tienes alguna duda respecto a la información ingresada o sobre el proceso de autorización de la afiliación agradeceremos te comuniques al correo afiliaciones@qpaypro.com</p>
			</div>
	</div>
	<div style="clear:both"></div>
  </div>
</div>
<!-- /.panel -->
</div>
<!-- /.col-lg-12 -->
</div><br/>

@stop
