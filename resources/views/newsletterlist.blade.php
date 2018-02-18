
    	
@extends('layouts.template')
@section('content')

<style>
<style>
p.redcolor{color:red; font-size:16px;}
.spancolor{color:red;}
.help-block{color:red;}
</style>
</style>
<link rel="stylesheet" href="{{URL::to('/')}}/global/vendor/filament-tablesaw/tablesaw.css">
<link rel="stylesheet" href="{{URL::to('assets/css')}}/datepicker3.min.css" />
<script src="{{URL::to('assets/js')}}/ui-bootstrap-tpls-0.11.0.js"></script>
<script src="{{URL::to('assets')}}/croppie.js"></script>
 <link rel="stylesheet" href="{{URL::to('assets')}}/croppie.css">

<div class="page-header">
  <h1 class="page-title font_lato">{{ trans('app.newsletter_list')}}</h1>
  <div class="page-header-actions">
	<ol class="breadcrumb">
		<li><a href="{{URL::to('/dashboard')}}">{{ trans('app.home')}}</a></li>
		<li><a href="{{URL::to('userlist')}}">{{ trans('app.users')}}</a></li>
		
		<li class="active">{{ trans('app.edit')}}</li>
	</ol>
  </div>
</div>
<div class="page-content" ng-app="app" ng-cloak>
<div class="panel">
<div class="panel-body container-fluid">
<!------------------------start insert, update, delete message ---------------->


<div style="clear:both;"></div><br>
<div class="tab-content">
<div id="product" class="tab-pane fade in active">
<table class="tablesaw table-striped table-bordered tablesaw-columntoggle" data-tablesaw-mode="columntoggle" data-tablesaw-minimap="" id="table-3973">
		<thead>
		  <tr>
			  <th data-tablesaw-priority="5" class="tablesaw-priority-5 tablesaw-cell-visible">{{ trans('app.name')}}</th>
			 
			  <th id='myColumnId' data-tablesaw-priority="1">{{ trans('app.actions')}}</th>
		  </tr>
		</thead>
		<tbody>
		@foreach($data as $view)
			<tr>
			  <td class="tablesaw-priority-5 tablesaw-cell-visible">{{$view->email}}</td>
             
			  
			  <td class="tablesaw-priority-1">		
			  
				
				<button data-placement="top" data-toggle="modal" rel="tooltip" title="{{ trans('app.delete')}}"  data-original-title="{{ trans('app.delete')}}"  class="btn btn-icon btn-danger btn-outline btn-round" data-target=".exampleNiftyFlipVertical"  type="button" data-href="{{URL::to('newsletterdestroy',$view->id)}}"><i class="icon fa-remove" aria-hidden="true"></i></button>
				</td>			
			</tr>
		@endforeach
		  
		</tbody>
	  </table>
	  <div style="clear:both;"></div><br/>


</div>

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
