@extends('layouts.template')
@section('content')
<link rel="stylesheet" href="{{URL::to('/')}}/global/vendor/filament-tablesaw/tablesaw.css">
<div class="page-header">
  <h1 class="page-title font_lato">Tansactions</h1>
  <div class="page-header-actions">
	<ol class="breadcrumb">
		<li><a href="{{URL::to('/dashboard')}}">{{ trans('app.home')}}</a></li>
		<li class="active">Transactions</li>
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

</div>

<div class="btn-group">
	<form class="form-inline ng-pristine ng-valid" action="{{URL::to('transactions')}}" method="get">
		<div class="form-group">
			<input type="text" name="search" class="form-control" id="search" placeholder="{{ trans('app.search_for_action')}}" value="{{Request::get('search')}}">

		<button type="submit" class="btn btn-outline btn-default"><i class="icon fa-search" aria-hidden="true"></i></button>

		@if (Request::get('search') != '')
	   <a href="{{URL::to('transactions')}}" class="btn btn-outline btn-danger" type="button">
		  <i class="icon fa-remove" aria-hidden="true"></i>
		</a>
	@endif
	</div>
</form>
</div>
</div>
<div style="clear:both;"></div><br/>

<table class="tablesaw table-striped table-bordered tablesaw-columntoggle" data-tablesaw-mode="columntoggle" data-tablesaw-minimap="" id="table-3973">
  <thead>
    <tr>
      <th data-tablesaw-priority="5" class="tablesaw-priority-5 tablesaw-cell-visible">Business Id</th>
      <th data-tablesaw-priority="4">Payment Gateway Id</th>
      <th data-tablesaw-priority="3">Product Id</th>
      <th data-tablesaw-priority="2">Audit Number</th>
      <th data-tablesaw-priority="2">Estado</th>
      <th id='myColumnId' data-tablesaw-priority="1">{{ trans('app.actions')}}</th>
    </tr>
  </thead>
  <tbody>
  @foreach($transactions as $view)
    <tr>
      <td class="tablesaw-priority-6 tablesaw-cell-visible">{{$view->business_id}}</td>
      <td class="tablesaw-priority-5">{{$view->payment_gateway_id}}</td>
      <td class="tablesaw-priority-4">{{$view->product_id}}</td>
      <td class="tablesaw-priority-3">{{$view->audit_number}}</td>
      <td class="tablesaw-priority-2">
      @if($view->status == '1')
      <button ng-if="status == 1" type="button" class="btn btn-floating btn-success btn-xs" data-toggle="tooltip" data-placement="top" data-original-title="{{ trans('app.active')}}">  <i class="icon fa-check" aria-hidden="true"></i></button>
     @else
      <button ng-if="status == 0" type="button" class="btn btn-floating btn-warning btn-xs" data-toggle="tooltip" data-placement="top" data-original-title="{{ trans('app.inactive')}}"><i class="icon fa-close" aria-hidden="true"></i></button>
    @endif
      </td>
      <td class="tablesaw-priority-1">
        <a title="{{ trans('app.user_details')}}" data-toggle="tooltip" data-placement="top" data-original-title="View details" class="btn btn-icon btn-primary btn-outline btn-round " href="{{URL::to('transactions_detalles',$view->transaction_id)}}"><i class="icon fa-eye" aria-hidden="true"></i></a>
      </td>
    </tr>
  @endforeach

  </tbody>
  </table>
  <div style="clear:both;"></div><br/>


  <!-- /.panel -->
  </div>
  <!-- /.col-lg-12 -->
  </div>
  <!-- /.row -->
  </div><br/>
  @stop
