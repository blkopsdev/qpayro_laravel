@extends('layouts.template')
@section('content')
<link rel="stylesheet" href="{{URL::to('/')}}/global/vendor/bootstrap-datepicker/bootstrap-datepicker.css">
<link rel="stylesheet" href="{{URL::to('/')}}/global/vendor/bootstrap-maxlength/bootstrap-maxlength.css">
<link rel="stylesheet" href="{{URL::to('/')}}/global/vendor/jt-timepicker/jquery-timepicker.css">
<link rel="stylesheet" href="{{URL::to('/')}}/assets/examples/css/forms/advanced.css">
<script type="text/javascript">

</script>
<style>
p.redcolor{color:red; font-size:16px;}
.spancolor{color:red;}
.help-block{color:red;}
</style>

<div class="page-header">
  <h1 class="page-title font_lato">Promoción especial de afiliación a QPayPro </h1>
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
@if(@$fail_payment)
	<div class="alert dark alert-icon alert-danger alert-dismissible alertDismissible" role="alert">
	  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
		<span aria-hidden="true">×</span>
	  </button>
	  <i class="icon wb-check" aria-hidden="true"></i>
	  {{@$fail_payment}}
	</div>
@endif
</div>
<form  name="userForm" action="{{URL::to('process_payment_temp')}}" method="post" >
		{{ csrf_field() }}
<div class="row row-lg">
	<div class="col-sm-6" style="border-right: 1px dotted #ddd;">
	  <!-- Example Basic Form -->
			<div class="row">
			     <h1 class="page-title font_lato">Datos de Tarjeta de crédito o débito</h1><br>
			</div>

			<div class="row">
        <h4 class="example-title">Nombre de la tarjeta:</h4>
        <input class="form-control round empty" id="cc_name" name="cc_name" placeholder="Nombre del Titual de la Tarjeta" type="text" required>
        <h4 class="example-title">Número de tarjeta:</h4>
        <input class="form-control round empty" id="cc_number" name="cc_number" placeholder="XXXX-XXXX-XXXX-XXXX" maxlength="16" type="text" required>
        <h4 class="example-title">Fecha de Vencimiento:</h4>
        <input class="form-control round empty" id="cc_exp" placeholder="MM/YY" name="cc_exp" type="text" oninput="this.value = this.value.replace(/[^0-9.]/g, ''); this.value = this.value.replace(/(\..*)\./g, '$1');" maxlength="4" required>
        <h4 class="example-title">CVV:</h4>
        <input class="form-control round empty" id="cc_cvv" name="cc_cvv" type="text" maxlength="4" required>
        <h4 class="example-title">Monto a Pagar:</h4>
        <div class="input-group">
            <span class="input-group-addon">Q</span>
            <input class="form-control" name="cc_amount" id="cc_amount" type="text" value="1250.00" readonly required>
            <input type="hidden" class="form-control" name="plan_id" id="plan_id" type="text" value="1" required>
        </div><br>
        <a data-original-title="Regresar" class="btn btn-default" href="{{URL::to('list_business')}}"><i class="icon wb-arrow-left"></i>Regresar</a>
        <button class="btn btn-primary" type="submit">Pagar</button>
			</div>
	</div>
  <div class="col-sm-6 col-xlg-3">
    <div class="pricing-list text-left">
      <div class="pricing-header bg-blue-600">
        <div class="pricing-title">
          <h3>QPayPro</h3>
          <div class="pricing-price">
            <span class="pricing-amount">$169</span>
          </div>
        </div>
        <p class="padding-horizontal-30 padding-bottom-25">Pago único por organización</p>
      </div>
			<div class="" style="padding:20px;">
				<p><b>Promoción especial</b> con el apoyo de VisaNet de Guatemala y Visa global para incentivar el comercio electrónico en Guatemala.</p>
				<p>La Afiliación incluye plan básico QPaypro:</p>
<p>
-Un <b>link de pago abierto</b> (cliente coloca monto a pagar)<br/>
-<b>Acreditación automática</b> por VisaNet en cuenta local de Guatemala en 24 horas<br/>
-Afiliación en <b>Quetzales ó Dólares</b><br/>
-Protección anti-fraude y seguridad a través de Cybersource<br/>
-<b>Notificaciones</b> por correo electrónico<br/>
-<b>Módulos</b> para integración con tiendas en línea populares<br/>
</p>

<p>
Con el plan básico puedes vender/cobrar por correo electrónico, redes sociales como Facebook, Whastapp, SMS o desde cualquier dispositivo móvil.
</p>
<p>	
Puedes usar tu link de pago como una terminal virtual de cobro (cobros por teléfono o en persona) y si tienes página web, puedes colocar el link de pago como un botón.
</p>
			</div>
      <ul class="pricing-features">
        
      </ul>
    </div>
    El cobro se realizara con un calculo de referencia de Q7.40 por $1.00
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
