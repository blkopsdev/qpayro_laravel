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
<div class="page-header">
  <h1 class="page-title font_lato">@if(@$sucess){{@$sucess}} @else Codigo Embed Botón @endif</h1>
  <div class="page-header-actions">
	<ol class="breadcrumb">
		<li><a href="{{URL::to('/dashboard')}}">{{ trans('app.home')}}</a></li>
		<li><a href="{{URL::to('business_products_detail', $business->business_id)}}">Regresar a listado de botones</a></li>
		<li class="active">{{$products->name}}</li>
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
      <div class="bs-example" data-example-id="single-button-dropdown" style="float:right; ">
      <div class="btn-group">
      <a href="{{URL::to('business_products_send',$products->product_id)}}" class="btn btn-outline btn-default" data-toggle="tooltip" data-placement="top" data-original-title="{{ trans('app.add_user')}}"><i class="icon fa-send" aria-hidden="true"></i>Enviar link de pago</a><br/>
      </div>
      </div>
		  <ul class="nav nav-tabs nav-tabs-line" data-plugin="nav-tabs" role="tablist">
			<li role="presentation" class=""><a data-toggle="tab" href="#profile" aria-controls="profile" role="tab" aria-expanded="true">Detalles</a></li>
			<li class="dropdown" role="presentation" style="display: none;">
			  <a class="dropdown-toggle" data-toggle="dropdown" href="#" aria-expanded="false">
				<span class="caret"></span>Menu </a>
			  <ul class="dropdown-menu" role="menu">
				<li role="presentation" style="display: none;"><a data-toggle="tab" href="#profile" aria-controls="profile" role="tab">Detalles</a></li>
			  </ul>
			</li>
		  </ul>
		  <div class="tab-content">

<!------- Profile tab------------->
			<div class="tab-pane animation-slide-left active" id="profile" role="tabpanel">
			<table class="table table-hover table-details">
				<thead>
					<tr>
						<th rowspan="4">Tu link de pago es: <a target="_blank" href="{{ env('APP_PAYMENTS') }}{{$business->public_key}}/{{$products->product_id}}" target="_blank">{{ env('APP_PAYMENTS') }}{{$business->public_key}}/{{$products->product_id}}</a></th>
					</tr>
				</thead>
      </table>
      <table class="table table-hover table-details">
				<tbody>
					<tr>
						<td>Vista Previa:<br><br> <a href="#">{{$products->button_text}}</a></td>
					</tr>
          <tr>
            <td>Codigo Embed
              <pre>&lta href="{{ env('APP_PAYMENTS') }}{{$business->public_key}}/{{$products->product_id}}" target="_blank" &gt {{$products->button_text}} &lt/a&gt</pre>
            </td>
          </tr>
				 </tbody>
			</table>
			<p style="border-bottom:1px dashed green;"></p>
      <table class="table table-hover table-details">
				<thead>
					<tr>
						<th rowspan="4">Vista Previa de Botón</th>
					</tr>
				</thead>
				<tbody>
					<tr>
						<td>Vista Previa:<br><br>
              <a href="#" style="
                -webkit-border-radius: 28;
                -moz-border-radius: 28;
                border-radius: 5px;
                font-family: Arial;
                color: #ffffff;
                font-size: 20px;
                background: {{$products->color}};
                padding: 10px 20px 10px 20px;
                text-decoration: none;">{{$products->button_text}}</a></td>
					</tr>
          <tr>
						<td><pre>&lta href="{{ env('APP_PAYMENTS') }}{{$business->public_key}}/{{$products->product_id}}" target="_blank" style="-webkit-border-radius: 28;-moz-border-radius: 28;border-radius: 5px;font-family: Arial;color: #ffffff;font-size: 20px;background: {{$products->color}};padding: 10px 20px 10px 20px;text-decoration: none;"&gt {{$products->button_text}} &lt/a&gt</pre></td>
					</tr>
				 </tbody>
			</table>
			</div>
		  </div>
		</div>
	  </div>
	  <!-- End Panel -->
	</div>
  </div>
</div>

<br/>
@stop
