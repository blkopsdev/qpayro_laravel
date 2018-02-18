@extends('layouts.template')
@section('content')
<link rel="stylesheet" href="{{URL::to('/')}}/global/vendor/filament-tablesaw/tablesaw.css">


<div class="page-header">
  <h1 class="page-title font_lato">Links de Pago del comercio @if($business) {{$business->business_name}} @endif</h1>
  <div class="page-header-actions">
	<ol class="breadcrumb">
		<li><a href="{{URL::to('/dashboard')}}">{{ trans('app.home')}}</a></li>
		<li class="active">Links de Pago</li>
	</ol>
  </div>
</div>

	
<div class="page-content">
<div class="panel">
<div class="panel-body container-fluid">

<!------------------------start insert, update, delete message ---------------->
<div class="row">

@if($business)
	@if($business->status == null)
	<p>
	<a class="btn btn-warning"><span class="icon fa-warning"></span>Esta opción estara habilitada al realizar el proceso correspondiente de afiliación</a>
	</p>
	@endif

@else
	<p>
	No tienes un comercio registrado, para registrarlo <a href="{{ URL::to('/register_user') }}" class="btn btn-info">click aquí</a>
	</p>
@endif
	
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

@if($business)
	@if($business->step == 'finish' and $business->number_afiliation != null and $business->payment_success == '1' and $business->status == '1')
		@if($plans)
			@if($limit < $plans->quantity_buttons OR $plans->quantity_buttons == '-1')
			<div class="bs-example" data-example-id="single-button-dropdown" style="float:left; ">
				<div class="btn-group">
					<a href="{{URL::to('business_products_register',$business->business_id)}}" class="btn btn-outline btn-default" data-toggle="tooltip" data-placement="top" data-original-title="{{ trans('app.add_user')}}"><i class="icon fa-plus" aria-hidden="true"></i> Nuevo Link de Pago</a><br/>
				</div>
			</div>
			@endif
		
		
			@if($plans->custom_payment_form=='1')
			<div class="bs-example" data-example-id="single-button-dropdown" style="float:right; ">
				<div class="btn-group">
					<a href="{{URL::to('custom_form_payment',$business->business_id)}}" class="btn btn-outline btn-default" data-toggle="tooltip" data-placement="top" data-original-title="{{ trans('app.add_user')}}"><i class="icon fa-plus" aria-hidden="true"></i> Personalizar pagina de pago</a><br/>
				</div>
			</div>
			@endif
		@endif
	@endif
@endif

<div class="btn-group">
	<form class="form-inline ng-pristine ng-valid" action="{{URL::to('business_products_view')}}" method="get">
		<!--<div class="form-group">
			<input type="text" name="search" class="form-control" id="search" placeholder="{{ trans('app.search_for_action')}}" value="{{Request::get('search')}}">

		<button type="submit" class="btn btn-outline btn-default"><i class="icon fa-search" aria-hidden="true"></i></button>

		@if (Request::get('search') != '')
	   <a href="{{URL::to('business_products_view')}}" class="btn btn-outline btn-danger" type="button">
		  <i class="icon fa-remove" aria-hidden="true"></i>
		</a>
	@endif
	</div>-->
</form>
</div>
</div>
<div style="clear:both;"></div><br/>

@if($business_products)
	
	<table class="tablesaw table-striped table-bordered tablesaw-columntoggle" data-tablesaw-mode="columntoggle" data-tablesaw-minimap="" id="table-3973">
		<thead>
			<tr>
				<th data-tablesaw-priority="4" class="tablesaw-priority-5 tablesaw-cell-visible">Nombre Link de Pago</th>
				<th data-tablesaw-priority="5">Comercio</th>
				<th data-tablesaw-priority="2" class="tablesaw-priority-5 tablesaw-cell-visible">Monto</th>
				<th data-tablesaw-priority="3" class="tablesaw-priority-5 tablesaw-cell-visible">Moneda</th>
				<th data-tablesaw-priority="3" class="tablesaw-priority-5 tablesaw-cell-visible">Estado</th>
				<th id='myColumnId' data-tablesaw-priority="1" class="tablesaw-priority-5 tablesaw-cell-visible">{{ trans('app.actions')}}</th>
			</tr>
		</thead>
		<tbody>
	
			@foreach($business_products as $view)
				<tr>
					<td class="tablesaw-priority-1 tablesaw-cell-visible"><a href="{{URL::to('business_products_edit',$view->product_id)}}">{{$view->name}}</a></td>
					<td class="tablesaw-priority-4">{{$business->business_name}}</td>
					<td class="tablesaw-priority-3 tablesaw-cell-visible">{{$view->price}}</td>
					<td class="tablesaw-priority-4">{{$view->currency}}</td>
					<td class="tablesaw-priority-4">
						@if($view->status == '1')
							<button type="button" class="btn btn-floating btn-success btn-xs" data-toggle="tooltip" data-placement="top" data-original-title="{{ trans('app.active')}}">  <i class="icon fa-check" aria-hidden="true"></i></button>
						@else
							<button type="button" class="btn btn-floating btn-default btn-xs" data-toggle="tooltip" data-placement="top" data-original-title="{{ trans('app.inactive')}}"><i class="icon fa-ban" aria-hidden="true"></i></button>
						@endif
					</td>
					<td class="tablesaw-priority-2 tablesaw-cell-visible">
					@if($plans)
						@if($plans->custom_fields == '1')
							<a title="Crear campos personalizados" data-toggle="tooltip" data-placement="top" data-original-title="Crear campos personalizados" class="btn btn-icon btn-info btn-outline btn-round" href="{{URL::to('custom_fields',$view->product_id)}}"><i class="icon fa-bars" aria-hidden="true"></i></a>
						@endif
					@endif
					<a title="Editar" data-toggle="tooltip" data-placement="top" data-original-title="Editar" class="btn btn-icon btn-info btn-outline btn-round" href="{{URL::to('business_products_edit',$view->product_id)}}"><i class="icon wb-pencil" aria-hidden="true"></i> </a>
					<a title="Ver link de pago" data-toggle="tooltip" data-placement="top" data-original-title="Ver Link de Pago" class="btn btn-icon btn-primary btn-outline btn-round " href="{{URL::to('business_products_embed',$view->product_id)}}"><i class="icon fa-code" aria-hidden="true"></i></a>
					@if($view->status == 1)
						{{-- <a data-placement="top" data-toggle="modal" rel="tooltip" title="Deshabilitar"  data-original-title="Deshabilitar"  class="btn btn-icon btn-success btn-outline btn-round" type="button"
						href="{{URL::to('business_products_destroy',$view->product_id)}}/{{$business->business_id}}"
						><i class="icon fa-toggle-on" aria-hidden="true"></i></a> --}}
						<a data-placement="top" data-toggle="modal" rel="tooltip" title="Enviar"  data-original-title="Enviar"  class="btn btn-icon btn-success btn-outline btn-round" type="button" href="{{URL::to('business_products_send',$view->product_id)}}"><i class="icon fa-paper-plane" aria-hidden="true"></i></a>
					@else
						{{-- <a data-placement="top" data-toggle="modal" rel="tooltip" title="Habilitar"  data-original-title="Habilitar"  class="btn btn-icon btn-danger btn-outline btn-round" type="button"
						href="{{URL::to('business_products_active',$view->product_id)}}/{{$business->business_id}}"
						><i class="icon fa-toggle-off" aria-hidden="true"></i></a>--}}
					@endif
					</td>
				</tr>
			@endforeach

		</tbody>
		</table>
  <div style="clear:both;"></div>

	{{ $business_products->links() }}
	
	@else
	<p class="text-center">No existen registros a mostrar.</p>		
	@endif
	
  <!-- /.panel -->
  </div>
  
  <!-- /.col-lg-12 -->
  </div>
  <!-- /.row -->
  </div><br/>
@endsection
