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
  <h1 class="page-title font_lato">Integraciones con terceros</h1>
</div>

<div class="page-content">
<div class="panel">
<div class="panel-body container-fluid">
<!------------------------start insert, update, delete message  ---------------->

<div class="row row-lg">
	<div class="col-sm-6" style="border-right: 1px dotted #ddd;">
	  <!-- Example Basic Form -->
			<div class="row">
			     <p>A continuación se detalla el listado de los modulos de terceros para la ingreación de pagos por medio de QPayPro</p>
			</div>

			<div class="row">
        <a href="https://qpaypro.zendesk.com/hc/es/categories/115000204552-Integraciones" target="_blank" class="btn btn-primary" type="submit"
				>Ir a página de descargas</a>
        
			</div>
	</div>
  <div class="col-md-6 form-group">
    <p>Para configurar tus módulos esta información es indispensable: </p>
    @foreach($business as $view)
    <p>Comercio: {{$view->business_name}}</p>
    <ul>
      <li>Llave Pública: {{$view->public_key}}</li>
      <li>Llave Privada: {{$view->private_key}}</li>
      <li>API Secret: {{$view->api_secret}}</li>
			<li>Merchant ID: {{$view->merchant_id}}</li>
    </ul>
    @endforeach
  </div>
	<div style="clear:both"></div>
  </div>
</div>
<!-- /.panel -->
</div>
<!-- /.col-lg-12 -->
</div><br/>

@stop
