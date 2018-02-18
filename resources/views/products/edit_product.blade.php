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
.fileUpload {
    position: relative;
    overflow: hidden;
    margin: 10px;
}
.fileUpload input.upload {
    position: absolute;
    top: 0;
    right: 0;
    margin: 0;
    padding: 0;
    font-size: 20px;
    cursor: pointer;
    opacity: 0;
    filter: alpha(opacity=0);
}
</style>

<div class="page-header">
  <h1 class="page-title font_lato">{{ trans('app.update_product')}}</h1>
</div>
	
<div class="page-content" ng-app="app" ng-cloak>	
<div class="panel">
<div class="panel-body container-fluid">
<!------------------------start insert, update, delete message  ---------------->

<form name="userForm" action="{{URL::to('productupdate',$id2)}}" ng-submit="submitForm(userForm.$valid)" novalidate  id="demo-form2" data-parsley-validate="" method="post" novalidate="" enctype="multipart/form-data">
		{{ csrf_field() }}
<div class="row row-lg">
	<div class="col-sm-12" style="border-right: 1px dotted #ddd;">
	  <!-- Example Basic Form -->	              
			<div class="row">
			<div class="col-sm-12">
			<p class="font-size-20 blue-grey-700">Product Details</p>
			</div>
			  <div class="form-group col-sm-6">
				<label class="control-label" for="inputBasicFirstName">{{ trans('app.name')}}<span class="spancolor">*</span> </label>
				<input type="text" class="form-control" value="" id="name" ng-model="name" name="product_name" ng-init="name='{{$productdata->name}}'" placeholder="{{ trans('app.name')}}" required>
			  </div>
			
			   <div class="form-group col-sm-6">
				<label class="control-label">{{ trans('app.category')}} <span class="text-danger">*</span></label>
				<select class="form-control" name="category_id" required >
					<option>{{ trans('app.category')}} </option>	
					@foreach($categorydata as $view)
					@if($productdata->category_id===$view->id){
					<option value="{{$view->id}}" selected>{{$view->name}}</option>}
					@else{<option value="{{$view->id}}">{{$view->name}}</option>}
					@endif	
					@endforeach
				</select>
				
			  </div>
			</div>
			<div class="row">			  
			  <div class="form-group col-sm-6">
			  	<div class="row">
			            <div class="row">
			            <div class="fileUpload btn btn-primary">
                            <span> <i class="fa fa-file-image-o"></i>&nbsp;Upload Image</span>*
                            <input type="file" class="upload" id="upload-image" name="image" value="{{URL::to('/images/')}}{{$productdata->image}}" />
                        </div>
                    </div>
					<img id="product-image" src="/images/{{$productdata->image}}" style="width:30%;">
                </div>
			  </div>
               <div class="form-group col-sm-6">
				<label class="control-label" for="inputBasicFirstName">{{ trans('app.description')}}</label>
				<textarea type="text" style="height:300px" ng-model="description" class="form-control" id="coupon_value" name="description" ng-init="description='{{$productdata->text}}'" placeholder="{{ trans('app.coupon_value')}}" value="" required></textarea>
			  </div>			  
			</div> 	

		<div class="row">
			    <div class="form-group col-sm-6">
			        <div class="row">
			            <div class="fileUpload btn btn-success">
                            <span> <i class="fa fa-file-video-o"></i>&nbsp;Upload Video</span>*
                            <input type="file" class="upload" id="upload-video" name="video" value="{{URL::to('/videos/')}}{{$productdata->video}}" />
                        </div>
                    </div>
			    </div>
			    
			    <video id="product-video" width="400" controls>
                      <source src="/videos/{{$productdata->video}}" type="video/mp4">
                      <source src="/videos/{{$productdata->video}}" type="video/ogg">
                </video>
	  </div>			
	  
	</div>
	<div style="clear:both"></div>
	<div class="form-group col-sm-6">
	<a class="btn btn-default" href="http://israel.dev/product/{{$id1}}">
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

       $('input[type=file]').change(function (){
    	if (this.files && this.files[0]) {
		    var reader2 = new FileReader();
		    reader2.onload = function(e) {
		      $('#product-video').attr('src', e.target.result);
		    }
		    reader2.readAsDataURL(this.files[0]);
		  }
	});

});
</script>
@stop