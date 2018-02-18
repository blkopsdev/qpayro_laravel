@extends('layouts.template')
@section('content')
<link rel="stylesheet" href="{{URL::to('/')}}/global/vendor/filament-tablesaw/tablesaw.css">
<div class="page-header">
  <h1 class="page-title font_lato">Listado de Comercios</h1>
  <div class="page-header-actions">
	<ol class="breadcrumb">

	</ol>
  </div>
</div>
<div class="page-content">
<div class="panel">
<div class="panel-body container-fluid">
<!------------------------start insert, update, delete message ---------------->
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
@if (Auth::user()->hasRole('Admin'))
<div class="bs-example" data-example-id="single-button-dropdown" style="float:right; ">
<div class="btn-group">
<a href="{{URL::to('register_user')}}" class="btn btn-outline btn-default" data-toggle="tooltip" data-placement="top" data-original-title="{{ trans('app.add_user')}}"><i class="icon fa-plus" aria-hidden="true"></i>Agregar nuevo comercio</a>
</div>
</div>
@endif
@if (Auth::user()->hasRole('User'))
<div class="bs-example" data-example-id="single-button-dropdown" style="float:right; ">
<div class="btn-group">
<a href="{{URL::to('register_user')}}" class="btn btn-outline btn-default" data-toggle="tooltip" data-placement="top" data-original-title="{{ trans('app.add_user')}}"><i class="icon fa-plus" aria-hidden="true"></i>Agregar nuevo comercio</a>
</div>
</div>
@endif
</div>
<div style="clear:both;"></div><br/> @if($business)
<table class="tablesaw table-striped table-bordered tablesaw-columntoggle" data-tablesaw-mode="columntoggle" data-tablesaw-minimap="" id="table-3973">
  <thead>
    <tr>
      <th data-tablesaw-priority="5" class="tablesaw-priority-5 tablesaw-cell-visible">Comercio</th>
      <th data-tablesaw-priority="4">Propietario</th>
      <th data-tablesaw-priority="3">Número de Afiliación</th>
      <th data-tablesaw-priority="2">Estado</th>
      <th id='myColumnId' data-tablesaw-priority="1">Acción</th>
    </tr>
  </thead>
  <tbody>
   
  @foreach($business as $view)
        <tr>
          <td class="tablesaw-priority-6 tablesaw-cell-visible">{{$view->business_name}}</td>
          <td class="tablesaw-priority-5">{{$view->name_representative}}</td>
          <td class="tablesaw-priority-4">{{$view->number_afiliation}}</td>
          <td class="tablesaw-priority-2">
          @if($view->number_afiliation === null)
            <button type="button" class="btn btn-outline btn-warning">Pendiente de Autorización</button>
          @endif
          @if($view->number_afiliation != null and $view->payment_success == null)
            <button type="button" class="btn btn-outline btn-success">Comercio Autorizado</button>
          @endif
          @if($view->number_afiliation != null and $view->payment_success == '1' and $view->step == 'complete')
            <button type="button" class="btn btn-outline btn-success">Pago realizado</button>
          @endif
          @if($view->number_afiliation != null and $view->payment_success == '1' and $view->step == 'finish' and $view->status =='0')
            <button type="button" class="btn btn-outline btn-warning">Credenciales en Proceso (3-5 días habiles)</button>
          @endif
          @if($view->number_afiliation != null and $view->payment_success == '1' and $view->step == 'finish' and $view->status =='1')
            <button type="button" class="btn btn-block btn-success">Tu comercio esta listo para efectuar cobros</button>
          @endif
          @if($view->step == 'finish' and $view->number_afiliation != null and $view->payment_success == '0' and $view->status == '2')
        	 <button type="button" class="btn btn-outline btn-danger"> Tu comercio {{$view->business_name}} no fue aprovado por VisaNet</button>
        	@endif
          </td>
          <td>
            <a title="{{ trans('app.user_details')}}" data-toggle="tooltip" data-placement="top" data-original-title="View details" class="btn btn-icon btn-primary btn-outline btn-round " href="{{URL::to('dashboard_business',$view->business_id)}}"><i class="icon fa-bar-chart-o" aria-hidden="true"></i></a>
            <a title="{{ trans('app.user_details')}}" data-toggle="tooltip" data-placement="top" data-original-title="View details" class="btn btn-icon btn-primary btn-outline btn-round " href="{{URL::to('transactions_list',$view->business_id)}}"><i class="icon fa-exchange" aria-hidden="true"></i></a>
            <a title="{{ trans('app.user_details')}}" data-toggle="tooltip" data-placement="top" data-original-title="View details" class="btn btn-icon btn-primary btn-outline btn-round " href="{{URL::to('business_products_detail',$view->business_id)}}"><i class="icon fa-cube" aria-hidden="true"></i></a>
            <a title="{{ trans('app.user_details')}}" data-toggle="tooltip" data-placement="top" data-original-title="View details" class="btn btn-icon btn-primary btn-outline btn-round " href="{{URL::to('details_business',$view->business_id)}}"><i class="icon fa-eye" aria-hidden="true"></i></a>
            <a title="{{ trans('app.user_details')}}" data-toggle="tooltip" data-placement="top" data-original-title="View details" class="btn btn-icon btn-primary btn-outline btn-round " href="{{URL::to('details_business',$view->business_id)}}"><i class="icon fa-upload" aria-hidden="true"></i>Subir Logo</a>
            @if (Auth::user()->hasRole('Admin'))
            <a title="{{ trans('app.edit')}}" data-toggle="tooltip" data-placement="top" data-original-title="{{ trans('app.edit')}}" class="btn btn-icon btn-info btn-outline btn-round" href="{{URL::to('business_edit',$view->business_id)}}"><i class="icon wb-pencil" aria-hidden="true"></i> </a>
            @endif
            @if($view->step == 'steps' or $view->step == 'step2' or $view->step == 'step3' or $view->step == 'step4' or $view->step == 'step5' or $view->step == 'step6')
            <a title="{{ trans('app.edit')}}" data-toggle="tooltip" data-placement="top" data-original-title="{{ trans('app.edit')}}" class="btn btn-icon btn-info btn-outline btn-round" href="{{URL::to($view->step,$view->business_id)}}"><i class="icon wb-pencil" aria-hidden="true"></i> Completar Afiliación</a>
            @endif
            @if($view->status == null and $view->payment_success == null and $view->number_afiliation != null)
            <a title="{{ trans('app.edit')}}" data-toggle="tooltip" data-placement="top" data-original-title="{{ trans('app.edit')}}" class="btn btn-icon btn-info btn-outline btn-round" href="{{URL::to('payment',$view->business_id)}}"><i class="icon fa-credit-card" aria-hidden="true"></i> Hacer Pago</a>
            @endif
          </td>
        </tr>
    @endforeach
    
  </tbody>
  </table>
	
	{{ $business->links() }}
	@endif
	
		<div>
			
		</div>

  <div style="clear:both;"></div><br/>


  <!-- /.panel -->
  </div>
  <!-- /.col-lg-12 -->
  </div>

  <!-- /.row -->
  </div><br/>
  @stop
