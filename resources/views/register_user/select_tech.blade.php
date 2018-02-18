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
  <h1 class="page-title font_lato">Selecciona el plan que deseas contratar</h1>
</div>

<div class="page-content">
		 <!-- Panel -->
		 <div class="panel">
			 <div class="panel-body container-fluid">
				 <!-- Example Pricing List2 -->
				 <div class="example-wrap">
					 <div class="example">
						 <div class="row">
               <p style="display:none;">{{ $k=0 }}</p>
               @foreach($plans as $plan)
							 <div class="col-sm-6 col-xlg-3">
								 <div class="pricing-list text-left">
									 <div class="pricing-header bg-blue-grey-600">
										 <div class="pricing-title">
                       <h3>{{$plan->plan_name}}</h3>
                       <p>{{$plan->description}}</p>
                       <div class="pricing-price">
  											 <span class="pricing-amount">${{$plan->installation}}</span>
                       </div>
                     </div>
                     <p class="padding-horizontal-30 padding-bottom-25">Precio anual de ${{$plan->price_year}} @if($plan->price_year > '0') (Un mes gratis) @endif</p>
										 <p class="padding-horizontal-30 padding-bottom-25">Ún solo pago de instalación y configuración de {{$plan->installation}}</p>
									 </div>
                   <div class="pricing-footer text-center bg-blue-grey-100">
                     <form  name="userForm" action="{{URL::to('temp_payment')}}" method="post" >
                         {{ csrf_field() }}
                       <input type="submit" id="mensual" class="btn btn-primary btn-lg" value="Seleccionar Mensual" onclick="document.getElementById('total{{$k}}').value = {{$plan->price_month}};"/>
                       <input type="submit" id="anual" class="btn btn-primary btn-lg" value="Seleccionar Anual" onclick="document.getElementById('total{{$k}}').value = {{$plan->price_year}};"/>
                       <input type="hidden" value="{{$plan->plan_id}}" name="plan_id">
                       <input type="hidden" id="total{{$k}}" name="total" value="{{$plan->price_month}}" name="plan_id">
                     </form>
                   </div>
									 <ul class="pricing-features">
										 <li>Cantidad de links de pago: {{$plan->quantity_buttons}}</li>
                     <li>Botón abierto: {{$plan->open_button}}</li>
                     <li>Campos personalizados: {{$plan->custom_fields}}</li>
                     <li>Pesonalización de formulario de pago: {{$plan->custom_payment_form}}</li>
									 </ul>
								 </div>
							 </div>
               <p style="display:none;">{{$k++}}</p>
               @endforeach
							 <!-- <div class="col-sm-6 col-xlg-3">
								 <div class="pricing-list text-left">
									 <div class="pricing-header bg-blue-600">
										 <div class="pricing-title">
                       <h3>QPay Business</h3>
                       <p>Con Seguridad Antifraude y sin limite de cobros mensuales (RECOMENDADO)</p></div>
                       <div class="pricing-price">
  											 <span class="pricing-amount">$89</span>
                       </div>
										 <p class="padding-horizontal-30 padding-bottom-25">Un solo pago de instalación y configuración</p>
									 </div>
                   <div class="pricing-footer text-center bg-blue-grey-100">
                     <input type="submit" class="btn btn-primary btn-lg"  name="tech_id" value="2" />
                   </div>
                   <ul class="pricing-features">
                     <li>Acepta Visa Cuotas</li>
										 <li>Sin límite de cobros mensual</li>
										 <li>%5.5 de comisión por transacción</li>
										 <li>$0.25c por transacción y manejo de seguridad</li>
										 <li>90% de bloqueo antifraude</li>
									 </ul>
								 </div>
							 </div>-->
						 </div>
					 </div>
				 </div>
				 <!-- End Example Pricing List2 -->
			 </div>
		 </form>
		 </div>
		 <!-- End Panel -->
	 </div>
@stop
