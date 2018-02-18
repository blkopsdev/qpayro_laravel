@extends('layouts.template')
@section('content')
<link rel="stylesheet" href="{{URL::to('/')}}/global/vendor/filament-tablesaw/tablesaw.css">
<style>
canvas{
	width: 95% !important;
	max-width: 100%;
	height: auto !important;
}
</style>
<div class="page-content padding-20 container-fluid">
<!------------------------------ Start Alert message--------------->
<!--<div class="alert alert-primary alert-dismissible alertDismissible" role="alert">
  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
	<span aria-hidden="true">×</span>
  </button>
 {{ trans('app.welcome')}}  {{Auth::user()->first_name}} {{Auth::user()->last_name}} !
</div> -->
<!-------------------------------- End alert message--------------->
	<!------------------------------ Start Alert message--------------->
	<div role="alert" class="alert dark alert-primary alert-dismissible">
    <button aria-label="Close" data-dismiss="alert" class="close" type="button">
      <span aria-hidden="true">×</span>
    </button>
    <h4>{{ trans('app.welcome')}}  {{Auth::user()->first_name}}!</h4>
    <p class="margin-top-15">
			@if(@$business)
			@foreach($business as $view)
				@if($view->step == 'step2' or $view->step == 'step3' or $view->step == 'step4' or $view->step == 'step5' or $view->step == 'step6')
				<p>
				 Aun tienes información pendiente para completar tu aplicación.
				</p>
	      <a class="btn btn-primary btn-inverse btn-outline" href="{{URL::to($view->step,$view->business_id)}}">Completar</a>
				@endif
			@endforeach
			@endif
    </p>
  </div>
	@if(@$business)
	@foreach($business as $view)
	@if($view->step == 'complete' and $view->number_afiliation == null)
	<a href="list_business" class="btn btn-block btn-warning"><span class="icon fa-warning"></span> Aún tienes el comerio {{$view->business_name}}  pendiente de confirmación.</a>
	@endif
	@if($view->step == 'complete' and $view->number_afiliation != null)
	<a href="payment/{{$view->business_id}}" class="btn btn-block btn-success"><span class="icon fa-credit-card"></span> Tu comercio {{$view->business_name}} fue autorizado, haz click aqui para realizar el pago.</a>
	@endif
	@if($view->step == 'finish' and $view->number_afiliation != null and $view->payment_success == '1' and $view->status == '0')
	<a href="list_business" class="btn btn-block btn-warning"><span class="icon fa-credit-card"></span> Tu pago fue procesado exitosamente, estaremos informandote cuando tus credenciales esten configuradas. (3-5 días habiles)</a>
	@endif
	@if($view->step == 'finish' and $view->number_afiliation != null and $view->payment_success == '1' and $view->status == '1')
	<a href="list_business" class="btn btn-block btn-success"><span class="icon fa-check"></span> Tu comerio {{$view->business_name}} esta listo para efectuar cobros</a>
	@endif
	@endforeach
	@endif
		<!-------------------------------- End alert message--------------->
</div>

<!-------------------------------- start second step graph--------------->
<div class="row">
<div class="col-md-12">
<div class="widget widget-shadow widget-responsive">
<h3 class="panel-title">Ventas ultimos 6 meses</h3>

{!! $chart_gtq->render() !!}

</div>

</div>

</div>
 <!-------------------------------- end second step graph--------------->
 <!-------------------------------- start second step graph--------------->
 <div class="row">
 <div class="col-md-12">
 <div class="widget widget-shadow widget-responsive">
 <h3 class="panel-title">Ventas ultimos 6 meses</h3>

 {!! $chart_usd->render() !!}

 </div>

 </div>

 </div>
  <!-------------------------------- end second step graph--------------->
 <!-------------------------------- start second step graph--------------->
 <div class="row">
 <div class="col-md-12">
 <div class="widget widget-shadow widget-responsive">
 <h3 class="panel-title">Ultimas 10 transacciones</h3>
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
		 @if(@$transactions)
   @foreach($transactions as $view)
         <tr>
           <td class="tablesaw-priority-6 tablesaw-cell-visible"><a href="{{URL::to('detail_transaction',$view->transaction_id)}}">{{$view->cc_name}}</a></td>
           <td class="tablesaw-priority-5 tablesaw-cell-visible">{{$view->currency}} {{$view->amount}}</td>
           <td class="tablesaw-priority-4">{{$view->response_text}}</td>
					 <td class="tablesaw-priority-4">
						 @foreach(json_decode($view->additional_data, true) as $value)
		             @if($value!=0 and $view->status == '1')
								 	Pago realizado en {{$value}} visacuotas
								 @endif
								 @if($value!=0 and $view->status == '0')
								 	Intento realizado con {{$value}} visacuotas
								@endif
		         @endforeach
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
		 @endif
   </tbody>
   </table>
 </div>

 </div>

 </div>
  <!-------------------------------- end second step graph--------------->
</div>

@stop
