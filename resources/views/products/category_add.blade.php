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
  <h1 class="page-title font_lato">{{ trans('app.create_new_category')}}</h1>
</div>
	
<div class="page-content" ng-app="app" ng-cloak>	
<div class="panel">
<div class="panel-body container-fluid">
<!------------------------start insert, update, delete message  ---------------->

<form name="userForm" action="{{URL::to('categorystore',$id)}}" ng-submit="submitForm(userForm.$valid)" novalidate  id="demo-form2" data-parsley-validate="" method="post" novalidate="" enctype="multipart/form-data">
	
		{{ csrf_field() }}
<div class="row row-lg">
	<div class="col-sm-12" style="border-right: 1px dotted #ddd;">
	  <!-- Example Basic Form -->	              
			<div class="row">
			<div class="col-sm-12">
			<p class="font-size-20 blue-grey-700">Category Details</p>
			</div>
			  <div class="form-group col-sm-6">
				<label class="control-label" for="inputBasicFirstName">{{ trans('app.name')}}<span class="spancolor">*</span> </label>
				<input type="text" class="form-control" id="name" ng-model="first_name" name="category_name" ng-init="coupon_name='{{ old('coupon_name') }}'" placeholder="{{ trans('app.name')}}" required>
			  </div>
			
			</div>
				
	  
	</div>
	<div style="clear:both"></div>
	<div class="form-group col-sm-6">
	<a class="btn btn-default" href="http://israel.dev/product/{{$id}}">
	<i class="icon wb-arrow-left"></i>
	Cancelar
	</a>	
	<button type="submit" ng-disabled="userForm.$invalid" class="btn btn-primary ladda-button" data-plugin="ladda" data-style="expand-left">
			<i class="fa fa-save"></i>  {{ trans('app.create_an_product')}}
		<span class="ladda-spinner"></span><div class="ladda-progress" style="width: 0px;"></div>
		</button>
	
	</div>
  </div>
</form> 
</div>
<!-- /.panel -->
</div>
<!-- /.col-lg-12 -->
</div><br/>
		
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
jQuery(function($){
	$("#upload-image").change(function(){
		// var url = $(this).files[0].mozFullPath;

		if (this.files && this.files[0]) {
		    var reader = new FileReader();

		    reader.onload = function(e) {
		      $('#product-image').attr('src', e.target.result);
		    }

		    reader.readAsDataURL(this.files[0]);
		  }
		
	});
});
</script>
@stop