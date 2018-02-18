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

<div class="page-content">
<div class="panel">
<div class="panel-body container-fluid">
<!------------------------start insert, update, delete message  ---------------->

<div class="row row-lg">
	<div class="col-sm-8" style="border-right: 1px dotted #ddd;">
	  <!-- Example Basic Form -->
			<div class="row">
			     <h1 class="page-title font_lato">Gracias por completar tu registro</h1>
			</div>

			<div class="row">
        <p>Mientras se valida la información te recomendamos afinar los ultimos detalles de tu página web para comenzar a vender en línea</p>
        <form  name="userForm" action="{{URL::to('list_business')}}" method="post" >
            {{ csrf_field() }}
        <a href="{{URL::to('list_business')}}" type="submit" class="btn btn-block btn-primary" style="float: center;">Ver listado de comercios</a>
        </form>
        <p>Si tienes una duda respecto a la información ingresada o sobre el proceso de autorización de VisaNet agradeceremos te comuniques al 2311-5001 o al correo afiliaciones@qpaypro.com</p>
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
