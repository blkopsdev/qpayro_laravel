@extends('layouts.template')
@section('content')
<link rel="stylesheet" href="{{URL::to('/')}}/global/vendor/filament-tablesaw/tablesaw.css">
<div class="page-header">
  <h1 class="page-title font_lato">Transacciones</h1>
  <div class="page-header-actions">
	<ol class="breadcrumb">
		<li><a href="{{URL::to('/dashboard')}}">{{ trans('app.home')}}</a></li>
		<li class="active">Transacciones</li>
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
		<div class="bs-example" data-example-id="single-button-dropdown" style="float:right; ">
			<div class="btn-group">
				<a href="{{URL::to('list_business')}}" class="btn btn-outline btn-default" data-toggle="tooltip" data-placement="top" data-original-title="{{ trans('app.add_user')}}"><i class="icon wb-arrow-left" aria-hidden="true"></i>Regresar</a>
			</div>
		</div>
		@if($business)
		<div class="btn-group">
			<form class="form-inline ng-pristine ng-valid" action="{{URL::to('transactions_list',$business->business_id)}}" method="get">
				<div class="form-group">
					<input type="text" name="search" class="form-control" id="search" placeholder="Buscar Cliente..." value="{{Request::get('search')}}">
		
				<button type="submit" class="btn btn-outline btn-default"><i class="icon fa-search" aria-hidden="true"></i></button>
		
				@if (Request::get('search') != '')
				 <a href="{{URL::to('transactions_list',$business->business_id)}}" class="btn btn-outline btn-danger" type="button">
					<i class="icon fa-remove" aria-hidden="true"></i>
				</a>
			@endif
			</div>
			</form>
		</div>
		@endif
	</div>
	<div style="clear:both;"></div>

	@if($transactions)
	<table class="tablesaw table-striped table-bordered tablesaw-columntoggle" data-tablesaw-mode="columntoggle" data-tablesaw-minimap="" id="table-3973">
  <thead>
    <tr>
      <th data-tablesaw-priority="5" class="tablesaw-priority-5 tablesaw-cell-visible">Cliente</th>
      <th data-tablesaw-priority="4" class="tablesaw-priority-5 tablesaw-cell-visible">Monto</th>
      <th data-tablesaw-priority="3">Razón</th>
      <th data-tablesaw-priority="3">Visa Cuota</th>
      <th data-tablesaw-priority="3">Fecha y hora</th>
      <th data-tablesaw-priority="3">Detalle</th>
      <th data-tablesaw-priority="2" class="tablesaw-priority-5 tablesaw-cell-visible">Estado</th>
    </tr>
  </thead>
  <tbody>
    <?php $var_visaencuotas = ""  ?>
	
  @foreach($transactions as $view)
        <tr>
          <td class="tablesaw-priority-6 tablesaw-cell-visible"><a href="{{URL::to('detail_transaction',$view->transaction_id)}}">{{$view->cc_name}}</a></td>
          <td class="tablesaw-priority-5 tablesaw-cell-visible">{{$view->currency}} {{$view->amount}}</td>
          <td class="tablesaw-priority-4">{{$view->response_text}}</td>
          <td class="tablesaw-priority-4">
					@if($view->additional_data)
            @foreach(json_decode($view->additional_data, true) as $value)
                @if($value!=0)
                 Pago realizado en {{$value}} visacuotas
                @endif
            @endforeach
					@endif
          </td>
          <td class="tablesaw-priority-4">{{$view->created_at}}</td>
          <td class="tablesaw-priority-4 ">
            <a href="{{URL::to('detail_transaction',$view->transaction_id)}}" class="btn btn-outline @if($view->status == '1') btn-success @endif @if($view->status == '0') btn-warning @endif">Ver detalle</a>
          </td>
          <td class="tablesaw-priority-2 tablesaw-cell-visible">
          @if($view->status == '1')
            <button type="button" class="btn btn-floating btn-success btn-xs" data-toggle="tooltip" data-placement="top" data-original-title="{{ trans('app.active')}}">  <i class="icon fa-check" aria-hidden="true"></i></button>
          @else
            <button type="button" class="btn btn-floating btn-warning btn-xs" data-toggle="tooltip" data-placement="top" data-original-title="{{ trans('app.inactive')}}"><i class="icon fa-close" aria-hidden="true"></i></button>
          @endif
          </td>

        </tr>
    @endforeach

  </tbody>
  </table>
	<div style="clear:both;"></div>
		
	{{ $transactions->links() }}
	
	@else
	<p class="text-center">No existen registros a mostrar.</p>	
	@endif
  <!-- /.panel -->
  </div>
  
  <!-- /.col-lg-12 -->
  </div>
  <!-- /.row -->
  </div><br/>
  @stop
