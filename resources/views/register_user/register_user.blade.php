@extends('layouts.template')

@section('content')
<link rel="stylesheet" href="{{URL::to('/')}}/global/vendor/bootstrap-datepicker/bootstrap-datepicker.css">
<link rel="stylesheet" href="{{URL::to('/')}}/global/vendor/bootstrap-maxlength/bootstrap-maxlength.css">
<link rel="stylesheet" href="{{URL::to('/')}}/global/vendor/jt-timepicker/jquery-timepicker.css">
<link rel="stylesheet" href="{{URL::to('/')}}/assets/examples/css/forms/advanced.css">

@verbatim
<script type="text/javascript">(function(o){var b="https://api.autopilothq.com/anywhere/",t="0fb1c9a94bb44754847691ce6877698cd5f3be29473c4bc794b3679d17f4349e",a=window.AutopilotAnywhere={_runQueue:[],run:function(){this._runQueue.push(arguments);}},c=encodeURIComponent,s="SCRIPT",d=document,l=d.getElementsByTagName(s)[0],p="t="+c(d.title||"")+"&u="+c(d.location.href||"")+"&r="+c(d.referrer||""),j="text/javascript",z,y;if(!window.Autopilot) window.Autopilot=a;if(o.app) p="devmode=true&"+p;z=function(src,asy){var e=d.createElement(s);e.src=src;e.type=j;e.async=asy;l.parentNode.insertBefore(e,l);};y=function(){z(b+t+'?'+p,true);};if(window.attachEvent){window.attachEvent("onload",y);}else{window.addEventListener("load",y,false);}})({"app":true});</script>
@endverbatim

<script type="text/javascript">
  Autopilot.run("associate", {
    Email: "{{ Auth::user()->email }}",
    custom: {
     "step": "0"
    }
  });
</script>

<style>
p.redcolor{color:red; font-size:16px;}
.spancolor{color:red;}
.help-block{color:red;}
</style>

<div class="page-header">
  <h1 class="page-title font_lato">Hola, bienvenido a QPayPro, vamos a completar tu afiliación.</h1>
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
<form  name="userForm" action="{{URL::to('select_payment')}}" method="post" >
		{{ csrf_field() }}
<div class="row row-lg">
	<div class="col-sm-6" style="border-right: 1px dotted #ddd;">
	  <!-- Example Basic Form -->

			<div class="row">
        <p>Empieza a aceptar pagos en línea en tu página web o tienda en línea rápidamente ingresando a tu aplicación QPayPro, solo te tomara unos minutos.
        </p>
        <button class="btn btn-primary btn-lg ladda-button" type="submit">Aplica Ahora</button><br>
      </br><p>Una vez completada, estaremos enviando tu información y nos pondremos en contacto en las próximas 48 horas con el resultado de tu afiliación.</p>
			</div>
	</div>
  <div class="col-md-6 form-group">
    <p>Papelería que necesitas:</p>
    <ul>
      <li>Afiliación actual con VisaNet Guatemala (Si ya cuentas con una)</li>
      <li>Información de tu negocio</li>
      <li>RTU, puedes obtener el tuyo <a href="https://farm2.sat.gob.gt/japSitio-web/constanciaRTU/constanciaRTU.jsf" target="_blank"> aquí</a></li>
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
