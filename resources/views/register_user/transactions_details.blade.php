@extends('layouts.template')
@section('content')
 <!-- Stylesheets -->
<link rel="stylesheet" href="{{URL::to('/')}}/assets/examples/css/pages/profile.css">
<div class="page-header">
  <h1 class="page-title font_lato">Detalle Suscripción</h1>
  <div class="page-header-actions">
	<ol class="breadcrumb">
		<li><a href="{{URL::to('/dashboard')}}">{{ trans('app.home')}}</a></li>
		<li><a href="{{URL::to('suscripcion')}}">Suscripción</a></li>
	</ol>
  </div>
</div>
<div class="page-content container-fluid page-profile">
  <div class="row">
	<div class="col-md-3">
	  <!-- Page Widget -->
	  <div class="widget widget-shadow text-center">
		<div class="widget-header">
		  <div class="widget-header-content">
			<a class="avatar avatar-lg" href="javascript:void(0)">
			@if(!empty($transactions->image))
				<img class="img-responsive img-circle" src="{{URL::to('uploads')}}/{{$transactions->image}}" width="170" height="170"  />
			@else
				<img class="img-responsive img-circle" src="{{URL::to('images/default.png')}}" width="170" height="170"  />
			@endif
			</a>
		   <p class="profile-job">Estado - {{$transactions->status}}</p>
		  </div>
		</div>

	  </div>
	  <!-- End Page Widget -->
	</div>


	<div class="col-md-9">
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

		  <ul class="nav nav-tabs nav-tabs-line" data-plugin="nav-tabs" role="tablist">
			<li role="presentation" class=""><a data-toggle="tab" href="#profile" aria-controls="profile" role="tab" aria-expanded="true">{{ trans('app.profile')}}</a></li>
			<li class="dropdown" role="presentation" style="display: none;">
			  <a class="dropdown-toggle" data-toggle="dropdown" href="#" aria-expanded="false">
				<span class="caret"></span>Menu </a>
			  <ul class="dropdown-menu" role="menu">
				<li role="presentation" style="display: none;"><a data-toggle="tab" href="#profile" aria-controls="profile" role="tab">{{ trans('app.profile')}}</a></li>
			  </ul>
			</li>
		  </ul>
		  <div class="tab-content">
<!------- Profile tab------------->
			<div class="tab-pane animation-slide-left active" id="profile" role="tabpanel">
			<table class="table table-hover table-details">
				<thead>
					<tr>
						<th rowspan="4">{{ trans('app.contact_informations')}}</th>
					</tr>
				</thead>
				<tbody>
					<tr>
						<td>Detalle de Producto: </td>
						<td><a href="#">{{$transactions->product_id}}</a></td>
					</tr>
					<tr>
						<td>Audit Number</td>
						<td><a href="#">{{$transactions->audit_number}}</a></td>
					</tr>
				 </tbody>
			</table>
			<p style="border-bottom:1px dashed green;"></p>

			<table class="table table-hover dataTable table-striped width-full dtr-inline">
				<thead>
				<tr>
					<th rowspan="4">Información Adicional</th>
				</tr>
				</thead>
				<tbody>
				<tr>
					<td>Moneda</td>
					<td>{{$transactions->currency}}</td>
				</tr>
        <tr>
					<td>Monto</td>
					<td>{{$transactions->amount}}</td>
				</tr>
				<tr>
					<td>Freight</td>
					<td>{{$transactions->freight}}</td>
				</tr>
				<tr>
					<td>Email</td>
					<td>{{$transactions->email}}</td>
				</tr>
        <thead>
				<tr>
					<th rowspan="4">Datos de Tarjeta</th>
				</tr>
				</thead>
				<tr>
					<td>CC Nombre</td>
					<td>{{$transactions->cc_name}}</td>
				</tr>
        <tr>
					<td>Ultimos cuatro digitos</td>
					<td>**** **** **** {{$transactions->cc_last4digits}}</td>
				</tr>

        <tr>
					<td>Fecha de expiración (Mes)</td>
					<td>{{$transactions->cc_expire_month}}</td>
				</tr>
        <tr>
					<td>Fecha de Expiracion (Año)</td>
					<td>{{$transactions->cc_expire_year}}</td>
				</tr>
        <thead>
				<tr>
					<th rowspan="4">Detalles de Facturación</th>
				</tr>
				</thead>
        <tr>
					<td>Nombre</td>
					<td>{{$transactions->bill_to_name}}</td>
				</tr>
        <tr>
					<td>Impuesto</td>
					<td>{{$transactions->bill_to_tax_id}}</td>
				</tr>

        <tr>
					<td>Dirección</td>
					<td>{{$transactions->bill_to_address}}</td>
				</tr>
        <tr>
					<td>Ciudad</td>
					<td>{{$transactions->bill_to_city}}</td>
				</tr>

        <tr>
					<td>Estado</td>
					<td>{{$transactions->bill_to_state}}</td>
				</tr>
        <tr>
					<td>País</td>
					<td>{{$transactions->bill_to_country}}</td>
				</tr>


        <tr>
					<td>Codigo ZIP</td>
					<td>{{$transactions->bill_to_zip}}</td>
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
