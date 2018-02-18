 	

    	
@extends('layouts.template')
@section('content')

<style>
<style>
p.redcolor{color:red; font-size:16px;}
.spancolor{color:red;}
.help-block{color:red;}
</style>
</style>
<link rel="stylesheet" href="{{URL::to('assets/css')}}/datepicker3.min.css" />
<script src="{{URL::to('assets/js')}}/ui-bootstrap-tpls-0.11.0.js"></script>
<script src="{{URL::to('assets')}}/croppie.js"></script>
  <link rel="stylesheet" href="{{URL::to('assets')}}/croppie.css">

<div class="page-header">
  <h1 class="page-title font_lato">{{ trans('app.update_details')}}</h1>
  <div class="page-header-actions">
	<ol class="breadcrumb">
		<li><a href="{{URL::to('/dashboard')}}">{{ trans('app.home')}}</a></li>
		<li><a href="{{URL::to('userlist')}}">{{ trans('app.users')}}</a></li>
		<li><a href="{{URL::to('show')}}/{{$userdata->id}}">{{$userdata->first_name}} {{$userdata->last_name}}</a></li>
		<li class="active">{{ trans('app.edit')}}</li>
	</ol>
  </div>
</div>
<div class="page-content" ng-app="app" ng-cloak>
<div class="panel">
<div class="panel-body container-fluid">
<!------------------------start insert, update, delete message ---------------->
<ul class="nav nav-tabs nav-tabs-line" data-plugin="nav-tabs" role="tablist">
	<li class="active"><a class="overview" data-toggle="tab" href="#product" title="View Area Data"><i class="glyphicon glyphicon-th"></i> {{ trans('app.product')}} </a></li>
	<li><a data-toggle="tab" href="#category" title="Social Networks"><i class="fa fa-youtube"></i> {{ trans('app.category')}} </a></li>
</ul>

<div style="clear:both;"></div><br>
<div class="tab-content">
<div id="product" class="tab-pane fade in active">
<table class="tablesaw table-striped table-bordered tablesaw-columntoggle" data-tablesaw-mode="columntoggle" data-tablesaw-minimap="" id="table-3973">
		<thead>
		  <tr>
			  <th data-tablesaw-priority="5" class="tablesaw-priority-5 tablesaw-cell-visible">{{ trans('app.name')}}</th>
			  <th data-tablesaw-priority="4">{{ trans('app.category')}}</th>
			  <th data-tablesaw-priority="4">{{ trans('app.image')}}</th>
			  <th data-tablesaw-priority="3">{{ trans('app.username')}}</th>	 
			  <th id='myColumnId' data-tablesaw-priority="1">{{ trans('app.actions')}}</th>
		  </tr>
		</thead>
		<tbody>
		@foreach($userdata as $view)
			<tr>
			  <td class="tablesaw-priority-5 tablesaw-cell-visible">{{$view->name}}</td>
			  <td class="tablesaw-priority-3">{{$view->catgory}}</td>	
			  <td class="tablesaw-priority-3">{{$view->image}}</td>	
			  <td class="tablesaw-priority-3">{{$view->username}}</td>		
			  <td class="tablesaw-priority-1">		
			  <a title="{{ trans('app.edit')}}" data-toggle="tooltip" data-placement="top" data-original-title="{{ trans('app.edit')}}" class="btn btn-icon btn-info btn-outline btn-round" href="{{URL::to('couponedit',$view->id)}}"><i class="icon wb-pencil" aria-hidden="true"></i> </a> 
				
				<button data-placement="top" data-toggle="modal" rel="tooltip" title="{{ trans('app.delete')}}"  data-original-title="{{ trans('app.delete')}}"  class="btn btn-icon btn-danger btn-outline btn-round" data-target=".exampleNiftyFlipVertical"  type="button" data-href="{{URL::to('coupondestroy',$view->id)}}"><i class="icon fa-remove" aria-hidden="true"></i></button>
				</td>			
			</tr>
		@endforeach
		  
		</tbody>
	  </table>
</div>

<!----------------- social networks ----------------->
<div id="category" class="tab-pane fade">
<table class="tablesaw table-striped table-bordered tablesaw-columntoggle" data-tablesaw-mode="columntoggle" data-tablesaw-minimap="" id="table-3973">
		<thead>
		  <tr>
			  <th data-tablesaw-priority="5" class="tablesaw-priority-5 tablesaw-cell-visible">{{ trans('app.name')}}</th>
			  <th data-tablesaw-priority="3">{{ trans('app.username')}}</th>	 
			  <th id='myColumnId' data-tablesaw-priority="1">{{ trans('app.actions')}}</th>
		  </tr>
		</thead>
		<tbody>
		@foreach($userdata as $view)
			<tr>
			  <td class="tablesaw-priority-5 tablesaw-cell-visible">{{$view->name}}</td>
			  <td class="tablesaw-priority-3">{{$view->username}}</td>		
			  <td class="tablesaw-priority-1">		
			  <a title="{{ trans('app.edit')}}" data-toggle="tooltip" data-placement="top" data-original-title="{{ trans('app.edit')}}" class="btn btn-icon btn-info btn-outline btn-round" href="{{URL::to('couponedit',$view->id)}}"><i class="icon wb-pencil" aria-hidden="true"></i> </a> 
				
				<button data-placement="top" data-toggle="modal" rel="tooltip" title="{{ trans('app.delete')}}"  data-original-title="{{ trans('app.delete')}}"  class="btn btn-icon btn-danger btn-outline btn-round" data-target=".exampleNiftyFlipVertical"  type="button" data-href="{{URL::to('coupondestroy',$view->id)}}"><i class="icon fa-remove" aria-hidden="true"></i></button>
				</td>			
			</tr>
		@endforeach
		  
		</tbody>
	  </table>
</div>
</div>
<!-- /.row -->
</div>
</div>
</div>
<!-- /.panel -->
</div>
<!-- /.col-lg-12 -->
<script type="text/javascript">
$uploadCrop = $('#upload-demo').croppie({
    enableExif: true,
    viewport: {
        width: 200,
        height: 200,
        type: 'circle'
    },
    boundary: {
        width: 300,
        height: 300
    }
});

$('#upload').on('change', function () {
	var reader = new FileReader();
    reader.onload = function (e) {
    	$uploadCrop.croppie('bind', {
    		url: e.target.result
    	}).then(function(){
			//alert(123);
			$("#uploadimage").hide();
			$("#saveCancenimage").show();
    		console.log('jQuery bind complete');
    	});

    }
    reader.readAsDataURL(this.files[0]);
});

$('.upload-result').on('click', function (ev) {
	$uploadCrop.croppie('result', {
		type: 'canvas',
		size: 'viewport'
	}).then(function (resp) {
		var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
		$.ajax({
			//url: "{{URL::to('upload')}}/{{$userdata->id}}",
			url: "{{URL::to('upload')}}/{{$userdata->id}}",
			 //data: {_token: CSRF_TOKEN},
			type: "POST",
			data: {"image":resp, '_token': CSRF_TOKEN},
			success: function (data) {
				console.log(data);
				html = '<img src="' + resp + '" />';
				$("#upload-demo-i").html(html);
			}
		});
	});
});

$(document).ready(function(){
	$("#cancelbutton").click(function(){
		//console.log(123);
		$("#uploadimage").show();
		$("#saveCancenimage").hide();
		$('.cr-image').attr('src', '');
	});
	$(".upload-result").click(function(){
		setTimeout(function () {
		location.reload(1);
		//setInterval(auto_refresh, 3000);
		}, 3000);
	});
});
//("#cancelbutton")
</script>

<script>
var app = angular.module('app', []);

app.directive("matchPassword", function () {
    return {
        require: "ngModel",
        scope: {
            otherModelValue: "=matchPassword"
        },
        link: function(scope, element, attributes, ngModel) {

            ngModel.$validators.matchPassword = function(modelValue) {
                return modelValue == scope.otherModelValue;
            };

            scope.$watch("otherModelValue", function() {
                ngModel.$validate();
            });
        }
    };
});
</script>
@stop
