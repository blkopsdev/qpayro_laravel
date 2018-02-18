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
  <h1 class="page-title font_lato">Detalle Comercio</h1>
  <div class="page-header-actions">
	<ol class="breadcrumb">
		<li><a href="{{URL::to('/dashboard')}}">{{ trans('app.home')}}</a></li>
    @if (Auth::user()->hasRole('Admin') or Auth::user()->hasRole('User'))
		<li><a href="{{URL::to('list_business')}}">Detalles de Comercio</a></li>
    @endif
    @if (Auth::user()->hasRole('VisaNet'))
		<li><a href="{{URL::to('business_visanet')}}">Detalles de Comercio</a></li>
    @endif
		<li class="active">{{$business->business_name}}</li>
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
			@if(!empty($business->logo))
				<img class="img-responsive img-circle" src="{{URL::to($business->logo)}}?<?php echo time(); ?>" width="170" height="170"  />
			@else
				<img class="img-responsive img-circle" src="{{URL::to('images/default.png')}}" width="170" height="170"  />
			@endif
			</a>
			<h4 class="profile-user">{{$business->business_name}}</h4>
		   <p class="profile-job">{{$business->legal_name}}</p>
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
			<li role="presentation" class=""><a data-toggle="tab" href="#profile" aria-controls="profile" role="tab" aria-expanded="true">Información Comercio</a></li>
			<li class="dropdown" role="presentation" style="display: none;">
			  <a class="dropdown-toggle" data-toggle="dropdown" href="#" aria-expanded="false">
				<span class="caret"></span>Menu </a>
			  <ul class="dropdown-menu" role="menu">
				<li role="presentation" style="display: none;"><a data-toggle="tab" href="#profile" aria-controls="profile" role="tab">Información Comercio</a></li>
			  </ul>
			</li>
		  </ul>
		  <div class="tab-content">
<!------- Profile tab------------->
			<div class="tab-pane animation-slide-left active" id="profile" role="tabpanel">
			<table class="table table-hover table-details">
				<thead>
					<tr>
						<th rowspan="4">Información General</th>
					</tr>
				</thead>
				<tbody>
					<tr>
						<td>Fecha de Registro</td>
						<td>{{$business->created_at}}</td>
					</tr>
					<tr>
						<td>Número de Afiliación</td>
						<td>{{$business->number_afiliation}}</td>
					</tr>
          <tr>
            <td>Tipo Afiliación</td>
            <td>{{$business->ownership_type}}</td>
          </tr>
          <tr>
            <td>Cantidad de Sucursales</td>
            <td>1</td>
          </tr>
          <tr>
            <td>Afiliar A:</td>
            <td>Visanet y ACEPTA</td>
          </tr>
				 </tbody>
			</table>
			<p style="border-bottom:1px dashed green;"></p>

			<table class="table table-hover dataTable table-striped width-full dtr-inline">
				<thead>
				<tr>
					<th rowspan="4">1. Datos del Solicitante</th>
				</tr>
				</thead>
				<tbody>
				<tr>
					<td>Tipo de solicitante</td>
					<td>{{$business->tax_regime}}</td>
				</tr>
        <tr>
					<td>Nombre o Razón Social</td>
					<td>{{$business->legal_name}}</td>
				</tr>
				<tr>
					<td>Nombre Comercial</td>
					<td>{{$business->business_name}}</td>
				</tr>
				<tr>
					<td>Actividade Ecónomica Principal</td>
					<td>{{$business->desc_business}}</td>
				</tr>
				<tr>
					<td>Sector ecónomico al que pertenece</td>
					<td>{{$business->business_type}}</td>
				</tr>
        <tr>
					<td>NIT</td>
					<td>{{$business->tax_id}}</td>
				</tr>
        <tr>
					<td>Regimen Tributario</td>
					<td>{{$business->ownership_type}}</td>
				</tr>
        <tr>
					<td>Fecha de inicio de operaciones o de constitución</td>
					<td>{{$business->date_foundation}}</td>
				</tr>
        <tr>
					<td>Dirección Fiscal</td>
					<td>{{$business->fiscal_adress}}</td>
				</tr>
        <tr>
					<td>Dirección de Oficinas</td>
					<td>{{$business->office_adress}}</td>
				</tr>
        <tr>
					<td>Teléfono</td>
					<td>{{$business->phone}}</td>
				</tr>
        <tr>
					<td>Monto aprox. ventas por mes</td>
					<td>{{$business->sales_aprox}}</td>
				</tr>
        <tr>
					<td>Monto aprox. egresos por mes</td>
					<td>{{$business->expense_aprox}}</td>
				</tr>
        <tr>
					<td>Cantidad de empleados</td>
					<td>{{$business->num_employees}}</td>
				</tr>
        @if (Auth::user()->hasRole('Admin') or Auth::user()->hasRole('VisaNet'))
				<tr>
					<td>Referencias Comerciales</td>
					<td>{{ $business->references_information['business_references'][1]['name'] }} - {{ $business->references_information['business_references'][1]['phone'] }}</td>
          <td>{{ $business->references_information['business_references'][2]['name'] }} - {{ $business->references_information['business_references'][2]['phone'] }}</td>
				</tr>
				<tr>
          <td>Referencias Personales</td>
          <td>{{ $business->references_information['personal_references'][1]['name'] }} - {{ $business->references_information['personal_references'][1]['phone'] }}</td>
          <td>{{ $business->references_information['personal_references'][2]['name'] }} - {{ $business->references_information['personal_references'][2]['phone'] }}</td>
        </tr>
        <tr>
					<td>Referencias Bancarias</td>
					<td>{{ $business->references_information['banking_references'][1]['name'] }}</td>
          <td>{{ $business->references_information['banking_references'][2]['name'] }}</td>
				</tr>
        @endif
				</tbody>
			</table>
      <p style="border-bottom:1px dashed green;"></p>
      <table class="table table-hover dataTable table-striped width-full dtr-inline">
        <thead>
        <tr>
          <th rowspan="4">2. Datos del Propietario / Representante Legal</th>
        </tr>
        </thead>
        <tbody>
        <tr>
          <td>Datos de:</td>
          <td>{{$business->tax_regime}}</td>
        </tr>
        <tr>
          <td>Nombre</td>
          <td>{{$business->name_representative}}</td>
        </tr>
        <tr>
          <td>Tipo de Documento</td>
          <td>{{$business->representative_type}}</td>
        </tr>
        <tr>
          <td>Número de Documento</td>
          <td>{{$business->id_representative}}</td>
        </tr>
				<tr>
          <td>Email</td>
          <td>{{$business->representative_email}}</td>
        </tr>
				<tr>
          <td>Teléfono</td>
          <td>{{$business->representative_phone}}</td>
        </tr>
        <tr>
          <td>Sector ecónomico al que pertenece</td>
          <td>{{$business->business_type}}</td>
        </tr>
        <tr>
          <td>Teléfono</td>
          <td>{{$business->phone}}</td>
        </tr>
        <tr>
          <td>Actua unicamente en beneficio de la entidad antes descrita</td>
          <td>Si</td>
        </tr>
       
        </tbody>
      </table>
      <p style="border-bottom:1px dashed green;"></p>
      <table class="table table-hover dataTable table-striped width-full dtr-inline">
        <thead>
        <tr>
          <th rowspan="4">3. Datos para le gestión de pago</th>
        </tr>
        </thead>
        <tbody>
        <tr>
          <td>Nombre para emisión de pago</td>
          <td>{{$business->name_to_emit}}</td>
        </tr>
        <tr>
          <td>Tipo de Cuenta</td>
          <td>DM</td>
        </tr>
        <tr>
          <td>Nombre del titular de la cuenta bancaria</td>
          <td>{{$business->owner_account}}</td>
        </tr>
        <tr>
          <td>Moneda</td>
          <td>{{$business->currency_afiliation}}</td>
        </tr>
        <tr>
          <td>Cuenta Bancaria</td>
          <td>{{$business->number_account}}</td>
        </tr>
        <tr>
          <td>Banco a Depositar</td>
          <td>{{$business->bank}}</td>
        </tr>
        <tr>
          <td>Nombre para emisión de factura y retención</td>
          <td>{{$business->retention_name}}</td>
        </tr>
        </tbody>
      </table>
      <p style="border-bottom:1px dashed green;"></p>
      <table class="table table-hover dataTable table-striped width-full dtr-inline">
        <thead>
        <tr>
          <th rowspan="4">4. Pasarelas de Pago Registradas</th>
        </tr>
        </thead>
        <tbody>
        @foreach($paymentgateway as $view)
        <thead>
        <tr>
          <th rowspan="4">{{$view->business_owner_name}}</th>
        </tr>
        </thead>
        <tr>
          <td>Propietario Comercio: </td>
          <td>{{$view->business_owner_name}}</td>
        </tr>
        <tr>
          <td>Dirección de Comercio: </td>
          <td>{{$view->business_owner_address}}</td>
        </tr>
        <tr>
          <td>Moneda: </td>
          <td>{{$view->currency}}</td>
        </tr>
        <tr>
          <td>Banco: </td>
          <td>{{$view->bank}}</td>
        </tr>
        <tr>
          <td>Propietario de la cuenta: </td>
          <td>{{$view->bank_account_name}}</td>
        </tr>
        <tr>
          <td>Número de la cuenta: </td>
          <td>{{$view->bank_account_number}}</td>
        </tr>
        <tr>
          <td>Tecnología</td>
          <td>@if($view->payment_method_id == '1')
            QPayPro Standard
            @endif
          @if($view->payment_method_id == '2')
          QPayPro Business
          @endif</td>
        </tr>
        @endforeach
        </tbody>
      </table>
      @if (Auth::user()->hasRole('Admin') or Auth::user()->hasRole('VisaNet'))
      <p style="border-bottom:1px dashed green;"></p>
      <table class="table table-hover dataTable table-striped width-full dtr-inline">
        <thead>
        <tr>
          <th rowspan="4">4. Documentos Adjuntos</th>
        </tr>
        </thead>
        <tbody>
        <tr>
          <td>{{$business->representative_type}}</td>
          <td><a target="_blank" href="{{ url('/').'/'.$business->path_document_id}}">Documento de identificación</a></td>
        </tr>
        <tr>
          <td>RTU</td>
          <td><a target="_blank" href="{{ url('/').'/'.$business->path_rtu}}">RTU</a></td>
        </tr>
        <tr>
          <td>Factura de Servicios</td>
          <td><a target="_blank" href="{{ url('/').'/'.$business->path_service}}">Factura de Servicios</a></td>
        </tr>
        <tr>
          <td>Cheque de banco anulado</td>
          <td><a target="_blank" href="{{ url('/').'/'.$business->path_document_canceled}}">Cheque de banco anulado</a></td>
        </tr>
        @if($business->ownership_type == "Persona Juridica" OR $business->ownership_type == "Comerciante Individual" OR $business->ownership_type == "Copropiedades")
        <tr>
          <td>Patente de comercio</td>
          <td><a target="_blank" href="{{ url('/').'/'.$business->path_document_patent}}">Patente de comercio</a></td>
        </tr>
        @endif
        @if($business->ownership_type == "Persona Juridica")
        <tr>
          <td>Patente de comercio de sociedad</td>
          <td><a target="_blank" href="{{ url('/').'/'.$business->path_document_patent_business}}">Patente de comercio de sociedad</a></td>
        </tr>
        @endif
        @if($business->ownership_type == "Persona Juridica" OR $business->ownership_type == "Fundaciones, Iglesias, Universidades" OR $business->ownership_type == "Copropiedades")
        <tr>
          <td>Representación legal</td>
          <td><a target="_blank" href="{{ url('/').'/'.$business->path_document_representation}}">Representación legal</a></td>
        </tr>
        @endif
        @if($business->ownership_type == "Fundaciones, Iglesias, Universidades")
        <tr>
          <td>Acuerdo gubernativo u otro</td>
          <td><a target="_blank" href="{{ url('/').'/'.$business->path_document_gob}}">Acuerdo gubernativo u otro</a></td>
        </tr>
        @endif
        @if($business->ownership_type == "Medico")
        <tr>
          <td>Carnet Colegiado</td>
          <td><a target="_blank" href="{{ url('/').'/'.$business->path_document_med}}">Carnet Colegiado</a></td>
        </tr>
        @endif
				<tr>
          <td>Cuestionario de riesgo</td>
          <td><a target="_blank" href="{{ url('/').'/'.$business->file_risk_evaluation}}">Cuestionario de riesgo</a></td>
        </tr>
        <tr>
          <td>Firma autorizada</td>
          <td><img src="{{ url('/').'/'.$business->path_signature}}"></td>
        </tr>
        <tr>
          <td>Descargar carta de autorización de QPayPro</td>
          <td>
            @if($business->number_afiliation != null)
            <a target="_blank" title="{{ trans('app.edit')}}" data-toggle="tooltip" data-placement="top" data-original-title="{{ trans('app.edit')}}" class="btn btn-icon btn-info btn-outline btn-round" href="{{URL::to('business_afiliation',$business->business_id)}}"><i class="icon fa-download" aria-hidden="true"></i> Descargar Documento</a>
            <a target="_blank" title="{{ trans('app.edit')}}" data-toggle="tooltip" data-placement="top" data-original-title="{{ trans('app.edit')}}" class="btn btn-icon btn-info btn-outline btn-round" href="{{URL::to('business_afiliation_sf',$business->business_id)}}"><i class="icon fa-download" aria-hidden="true"></i> Descargar Documento sin firma</a>
            @endif
            @if($business->number_afiliation === null)
            No se puede generar la carta debido a que no se a indicado el número de afiliación del comercio
            @endif
          </td>
        </tr>
        <tr>
          <td>Descargar contrato de VisaNet</td>
          <td>
            <a target="_blank" title="{{ trans('app.edit')}}" data-toggle="tooltip" data-placement="top" data-original-title="{{ trans('app.edit')}}" class="btn btn-icon btn-info btn-outline btn-round" href="{{URL::to('business_contract_visanet',$business->business_id)}}"><i class="icon fa-download" aria-hidden="true"></i> Descargar Contrato</a>
            <a target="_blank" title="{{ trans('app.edit')}}" data-toggle="tooltip" data-placement="top" data-original-title="{{ trans('app.edit')}}" class="btn btn-icon btn-info btn-outline btn-round" href="{{URL::to('business_contract_visanet_sf',$business->business_id)}}"><i class="icon fa-download" aria-hidden="true"></i> Descargar Contrato sin firma</a>
          </td>
        </tr>
        <tr>
          <td>Descargar Solicitud de Payment Gateway</td>
          <td>
            <a target="_blank" title="{{ trans('app.edit')}}" data-toggle="tooltip" data-placement="top" data-original-title="{{ trans('app.edit')}}" class="btn btn-icon btn-info btn-outline btn-round" href="{{URL::to('business_request_pg',$business->business_id)}}"><i class="icon fa-download" aria-hidden="true"></i> Descargar solicitud de Payment Gateway</a>
            <a target="_blank" title="{{ trans('app.edit')}}" data-toggle="tooltip" data-placement="top" data-original-title="{{ trans('app.edit')}}" class="btn btn-icon btn-info btn-outline btn-round" href="{{URL::to('business_request_pg_sf',$business->business_id)}}"><i class="icon fa-download" aria-hidden="true"></i> Descargar solicitud de Payment Gateway sin firma</a>
          </td>
        </tr>
        </tbody>
      </table>
      @endif
			</div>
      <?php
      $url=$business->business_id;
      echo Form::open(array('url' => '/business_upload_change/'.$url,'files'=>'true'));
      ?>
      {{ csrf_field() }}
      <div class="row">
          <div class="form-group col-sm-6">
            <strong>Elite tu logo</strong>
              <label class="control-label" for="inputUserName">Elige el logo que deseas agregar al formulario de pago</label>
              <div class="input-group input-group-file">
                <input class="form-control" readonly="" type="text" required>
                <span class="input-group-btn">
                  <span class="btn btn-success btn-file">
                    <i class="icon wb-upload" aria-hidden="true"></i>
                    <?php
                    echo Form::file('logo');
                    ?>
                  </span>
                </span>

              </div><br>
              <button type="submit" class="btn btn-block btn-primary" style="float: center;">Cargar Logo</button>
          </div>
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
