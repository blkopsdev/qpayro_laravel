@extends('layouts.front_template')
@section('content') 
<link rel="stylesheet" href="{{URL::to('/')}}/global/vendor/bootstrap-datepicker/bootstrap-datepicker.css">
<link rel="stylesheet" href="{{URL::to('/')}}/global/vendor/bootstrap-maxlength/bootstrap-maxlength.css">
<link rel="stylesheet" href="{{URL::to('/')}}/global/vendor/jt-timepicker/jquery-timepicker.css">
<link rel="stylesheet" href="{{URL::to('/')}}/assets/examples/css/forms/advanced.css">
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.9.0/moment.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/2.2.7/fullcalendar.min.js"></script>
   
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/2.2.7/fullcalendar.min.css"/>

<style>
	.page-content {padding: 0px 30px;}
    #personal-store{
        position: relative;

        width: 100%;
        height: 100%;
        /*left: 21%;
        top: 100px;*/
        display:inline-block;
        background-color: rgba(204, 255, 230,0.2);  
        /*z-index: 9999;*/
        overflow: hidden;
    }
	.products-gallery{
		/*position: absolute;*/
	}
    
    .products-gallery li,.events-gallery li{
    	display: inline-block;
    	margin:10px;
    }
    .products-gallery li img{
    	width: 200px;
    	height: 200px;
    	border: 1px solid #ccc;
    	cursor: pointer;
    }
    .products-gallery li img:hover, .events-gallery li img:hover{
    	border: 1px solid #777;
    }
    .events-gallery li img{
    	width: 150px;
    	height: 150px;
    	border: 1px solid #ccc;
    	cursor: pointer;
    }
    .events-gallery{
    	margin-top: 4%;
    	margin-left: 23%;
    }
    #event-button{
    	/*width: 100px;*/
    	/*height: 100px;*/
    	position: absolute;
    	left: 20px;
    	bottom: 0px;
    	width: 80px;
    	height: 80px;
    	cursor: pointer
    }
    .prev, .next {
	  cursor: pointer;
	  position: absolute;
	  top: 40.5%;
	  width: auto;
	  margin-top: -22px;
	  padding: 16px;
	  color: white;
	  font-weight: bold;
	  font-size: 18px;
	  transition: 0.6s ease;
	  border-radius: 0 3px 3px 0;	
	  text-decoration: none !important;  	  
	}
	.prev{
		left: 2px;
	}
	.next {
	  right: 0px;
	  border-radius: 3px 0 0 3px;
	}	
	.prev:hover, .next:hover {
	  	background-color: rgba(0,0,0,0.8);
	}
	
	#calendar_modal1{
		width: 100%;
		height: 850px;
		z-index: 10000;
	}
	.product-box{
		width: 10000px;
		/*position: absolute;*/
	}
	
	#product_detail_modal .modal-dialog{
		margin-top: 10%;
	}
	#calendar_modal1 .modal-content{
		color: black;
	}
    #calendar_modal2 .modal-content{
		color: black;
	}
	#calendar_modal3 .modal-content{
		color: black;
	}
	#calendar_modal4 .modal-content{
		color: black;
	}


	.all-content{
		padding:50px;
	}
	.category-menu{
		margin-top:5%;
		margin-right: 5%;
	}
	.back-button{
		position: absolute;
		position: fixed;
		right: 20px;
		top: 50px;
		cursor: pointer;
	}
	.back-button:hover{
		transform: scale(1.2);		
	}
	.parent-product-box{
		margin: auto;
		/*height: 462px;*/
		width: 80%;
		overflow: hidden;
		position: relative;
		/*padding: 2px 30px;*/
	}
	.newsletter{/*
		margin-left: 250px;
		margin-top: 0px;*/
		cursor: pointer;
		float: right;
	}
	.newsletter:hover{
		zoom: 1.1;
	}
	#product-image-box img{
		width: 140px;
		height: 140px;
		margin-top: 60px;
		margin-bottom: 30px;
		box-shadow: 0px 1px 2px rgba(0,0,0,.4);
	}
	#product-video-box video{
		width: 300px;
		box-shadow: 0px 1px 2px rgba(0,0,0,.4);
	}
	#product_detail_modal .modal-content{
		background-color: rgba(0,0,0,0.8);
	}
	#product_detail_modal .description{
		width: 90%;
		height: 200px;
		color:black;		
	}
	#newsletter table{
		color:black;
	}
	.nav-tabs{
		border-bottom: 0px;!important
	}
	.category-menu{
		margin-top: 2%;
	}

	.nav{
		margin-bottom: 50px;
		padding-right: 60px;
	}
    .nav > li{
    	padding-right: 60px !important;
    }
    .category-menu li a{
    	background-color: #62a8ea;
    	color: white;
    }
    .category-menu li.active a{
    	background-color: #3399ff;
    }
    .category-menu>li>a:hover{
    	color: #62a8ea;
    }
    .event-box{
    	/*background-color: white;*/
    	display: inline-block;
    	margin-left: 200px;
    }
    .event-box>div{
    	width: 200px;
    	height: 220px;
    	display: inline-block;
    	margin: 10px;
    	box-shadow: 2px 2px 2px gray;
    }
    .panel{
		border-color: #bce8f1;
	}
    .panel-heading {
	    padding: 5px 5px;
	    border-bottom: 1px solid transparent;
	    border-top-left-radius: 3px;
	    border-top-right-radius: 3px;
		color: #31708f;
		background-color: #d9edf7;
		border-color: #bce8f1;
	}
	.event-box .panel{
		border:1px solid #bce8f1;
		height: 100%;
	}
	.panel-body{
		padding: 15px;
	}
	.panel-heading a{
		color: white;
		text-decoration: none;
		font-weight: bold;
	}
	body{
		overflow: hidden;
	}
	#newsletterlist table thead tr{
		font-weight: bold important;
		color: blue important;
	}
	#product-media-box{
		background-color: #e3e3e3;
	}
	#product-text-box{
		height: 405px;
		max-height: 405px;
		background-color: #FFF;
		box-shadow: 0px 0px 3px rgba(0,0,0,.7);
	}
	#product_detail_modal .modal-body{
		box-shadow: 0px 0px 2px rgba(0,0,0,.4);
		height: 435px;
		padding:15px 0px;
	}
	#product_detail_modal{
		font-family: "Times New Roman", Times, serif;
	}
	#product_detail_modal .title{
		font: italic bold 24px/30px Georgia, serif;
	}
	/*.product-box{
		display: none;
	}*/
	#myCarousel img{
		width: 250px;
		height: 250px;		
		display: block;
		margin:10px 15px;
	}
	#myCarousel img:hover{
		border: 1px solid #777;
		cursor: pointer;
	}
	#myCarousel div.inline-div{
		display: inline-block;
	}
	.newsletter{
		padding-top: 40px;
	/*	width: 300px;
		height: 200px;*/
	}
	.newsletter img:hover{
		content:url("{{URL::to('images/newsletter_hover.png')}}");
	}
	</style>

<script type="text/javascript">
	
</script>
	
 	<div class="row">
 		<div class="panel-body container-fluid">
 			
			<!--start insert, update, delete message -->
			<!-- <a class="back-button" href="front" title="Back" data-toggle="tootip">
				<img style="width:50px;" src="/images/back.png">
			</a> -->

			<ul class="nav nav-tabs pull-right category-menu" data-plugin="nav-tabs" role="tablist">
				@php
					$all_active = "";
					if($certain_cate == 'all')
						$all_active = "active";
				@endphp	
				<li class="{{$all_active}}" style="width:300px;">
					<a class="overview"  href="{{URL::to('frontspecial?cat=all')}}" style="font-size: 22px;" title="View Area Data">
						<i class="glyphicon glyphicon-th"></i> All 
					</a>
				</li>
				@foreach($category as $view)
					@php
						$active = "";
						if($view->id==$certain_cate) $active = "active";
					@endphp
					<li  class="{{$active}}" style="width:300px;">						
						<a href="{{URL::to('frontspecial?cat=')}}{{$view->id}}" style="font-size: 20px;" title="Social Networks">
							<i class="fa "></i>{{$view->name}}
						</a>
					</li>
			  	@endforeach
			</ul><br>	
		
				@php
					$num = count($products)/2;
					$product_count = count($products);
					$carousel_item_num = ceil($product_count/12);
					$first_num = ($carousel_item_num<=12)?$carousel_item_num:12;
				@endphp

					<div class="parent-product-box" style="width:100%;">
						<div class="container" style="width:95%;">
							<div id="myCarousel" class="carousel slide text-center" data-ride="carousel">
							    <div class="carousel-inner">
							    	@for($num=0;$num<$carousel_item_num;$num++)
							    		@php
							    			if($num==0) $active="active";
							    			else $active="";

							    			$start = $num*12+1;
							    			$end = ($num+1)*12;
							    			if($end>$product_count) $end= $product_count;
							    		@endphp
							    	<div class="item {{$active}} aaaaaa">
							    		@for($i=$start;$i<$end;$i=$i+2)
							    			@php
							    				$item1 = $i-1;
							    				$item2 = $i;
							    			@endphp
							    			<div class="inline-div">
							    				<img onclick="show_detail('{{$products[$item1]->name}}','{{$products[$item1]->text}}','/images/{{$products[$item1]->image}}','/videos/{{$products[$item1]->video}}');" class="img-rounded" src="/images/{{$products[$item1]->image}}">
							    				<img onclick="show_detail('{{$products[$item2]->name}}','{{$products[$item2]->text}}','/images/{{$products[$item2]->image}}','/videos/{{$products[$item1]->video}}');" class="img-rounded" src="/images/{{$products[$item2]->image}}">
							    			</div>
							    		@endfor
							    	</div>
							    	@endfor
							    </div>							   
						  </div>
						   <!-- Left and right controls -->
							    <a class="left carousel-control" href="#myCarousel" data-slide="prev" style="max-width: 5px!important;">
							      	<span class="glyphicon glyphicon-chevron-left"></span>
							      	<span class="sr-only">Previous</span>
							    </a>
							    <a class="right carousel-control" href="#myCarousel" data-slide="next" style="max-width: 5px!important;">
							      	<span class="glyphicon glyphicon-chevron-right"></span>
							      	<span class="sr-only">Next</span>
							    </a>
					</div>	
				</div>		
				
		</div>
	</div>

	<div class="row">
			<div class="col-lg-3 col-md-3 col-sm-12">
				<div class="newsletter">
					<img onclick="show_newsletter()" src="{{URL::to('images/newsletter.png')}}">
				</div>	
			</div>
			<div class="col-lg-9 col-md-9 col-sm-12">	
				<div class="event-box">			
					<div class="sport-event">
						<div class="panel panel-info">
						    <div class="panel-heading text-center">
						    	<a href="javascript:show_calendar1();">Sport</a>  		
						    </div>
					      	<div class="panel-body">
					      		The first major, modern, multi-sport event of international significance is the modern Olympic Games. Many regional multi-sport events ...
					      	</div>
					    </div>
					</div>	
					<div class="fashion-event">
						<div class="panel panel-info">
					      	<div class="panel-heading text-center">
					      		<a href="javascript:show_calendar2();">Fashion</a>  		
					      	</div>
					      <div class="panel-body">Panel Content</div>
					    </div>
					</div>	
					<div class="jerusalem">
						<div class="panel panel-info">
					      	<div class="panel-heading text-center">
					      		<a href="javascript:show_calendar3();">Jerusalem</a>  		
					      	</div>
					      	<div class="panel-body">Panel Content</div>
					    </div>
					</div>	
					<div class="around-me">
						<div class="panel panel-info">
					      	<div class="panel-heading text-center">
					      		<a href="javascript:show_calendar4();">Around Me</a>  		
					      	</div>
					      <div class="panel-body">Panel Content</div>
					    </div>
					</div>	
				</div>
			</div>			 
	   </div>	
</div>

<div class="modal fade" id="product_detail_modal" tabindex="-1" role="dialog" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">      
      <div class="modal-body">
       	<div class="container-fluid">
       		<div id="product-text-box" class="col-lg-7 col-md-7 col-sm-12  clear">
       			<h3>
       				<p class="title"></p>
       			</h3>
       			<div class="description">
       			</div>
       		</div>
       		<div id="product-media-box" class="col-lg-5 col-md-5 col-sm-12 text-center">
       			<div id="product-image-box">
       				<img src=""/>       			
	       		</div>
	       		<div id="product-video-box">
	       			<video id="product-video" width="400" controls>
	                      <source src="{{URL::to('videos/mov_bbb.mp4')}}" type="video/mp4">
	                      <source src="{{URL::to('videos/mov_bbb.ogg')}}" type="video/ogg">
	                </video>
	       		</div>
       		</div>     
       	</div>
      </div>
    </div>
  </div>
</div>


<div class="modal fade" id="newsletterlist" tabindex="-1" role="dialog" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">      
      <div class="modal-body">
         @php $cnt=0; @endphp      
   
         	<table class="table table-striped" style="color:black;" data-tablesaw-mode="columntoggle" >
         		<thead>
         			<tr>
	          			<th class="text-center" class="text-center" style="font-weight: bold;">NO</th>
	          	  		<th class="text-center" class="text-center" style="font-weight: bold;">Newsletter</th>
	          		<tr>	
         		</thead>
          		<tbody>
		            @foreach($newsletterlist as $item)
		            @php $cnt++;  @endphp
		            <tr  class="text-center">
		            	<td>{{$cnt}}</td>
		            	<td>{{$item->email}}</td>
		            </tr>
		            @endforeach	
		        </tbody>
         </table>
      </div>
    </div>
  </div>
</div>




<div class="modal fade" id="calendar_modal1"  role="dialog" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">       	
       		{!! $calendar->calendar1() !!}
       		<script type="text/javascript">
       			jQuery(function(){
       				$("#calendar_modal1").show();
       			});
       		</script>
       		{!! $calendar->script1() !!}       		
       		<script type="text/javascript">
       			jQuery(function(){
       				$("#calendar_modal1").hide();
       			});
       		</script>
       		{!! $calendar->script1() !!} 
      </div>
    </div>
  </div>
</div>

 <div class="modal fade" id="calendar_modal2"  role="dialog" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">       	
       		{!! $calendar->calendar2() !!}
       		<script type="text/javascript">
       			jQuery(function(){
       				$("#calendar_modal2").show();
       			});
       		</script>
       		{!! $calendar->script2() !!}       		
       		<script type="text/javascript">
       			jQuery(function(){
       				$("#calendar_modal2").hide();
       			});
       		</script>

      </div>
    </div>
  </div>
</div>
{!! $calendar->script2() !!}
<div class="modal fade" id="calendar_modal3"  role="dialog" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">       	
       		{!! $calendar->calendar3() !!}
       		<script type="text/javascript">
       			jQuery(function(){
       				$("#calendar_modal3").show();
       			});
       		</script>
       		{!! $calendar->script3() !!}       		
       		<script type="text/javascript">
       			jQuery(function(){
       				$("#calendar_modal3").hide();
       			});
       		</script>
      </div>
    </div>
  </div>
</div>
{!! $calendar->script3() !!}
<div class="modal fade" id="calendar_modal4"  role="dialog" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">       	
       		{!! $calendar->calendar4() !!}
       		<script type="text/javascript">
       			jQuery(function(){
       				$("#calendar_modal4").show();
       			});
       		</script>
       		{!! $calendar->script4() !!}       		
       		<script type="text/javascript">
       			jQuery(function(){
       				$("#calendar_modal4").hide();
       			});
       		</script>
      </div>
    </div>
  </div>
</div>
{!! $calendar->script4() !!}     	
<script type="text/javascript">	
	jQuery(function(){
		$("#event-button").tooltip();
		$(".back-button").tooltip();

		$(".newsletter img").mouseover(function(){
			$(this).attr("src","{{URL::to('images/newsletter_hover.png')}}");
		});
		$(".newsletter img").mouseout(function(){
			$(this).attr("src","{{URL::to('images/newsletter.png')}}");
		});
	});
	function show_detail(title, desciption,src,src1){
		$("#product_detail_modal #product-image-box img").attr("src",src);
		$("#product_detail_modal #product-video-box #product-video source").attr("src",src1);
		$("#product_detail_modal #product-text-box p.title").text(title);
		$("#product_detail_modal #product-text-box .description").text(desciption);

		$("#product_detail_modal").modal("show");
	}
    
    function show_calendar(){


    }

	function show_calendar1(){
		$.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
            }
        });
        var formData = {
            name: 'fashion'
        }
        // alert("AAA");
        $.ajax({
            type: 'post',
            url: './get_calendar',
            data: formData,
            dataType: 'json',
            success: function (data) {
            	alert();                
                $('#frmProducts').trigger("reset");
                $('#myModal').modal('hide')
            },
            error: function (data) {
                console.log('Error:', data);
            }
        });
    

	
		$("#calendar_modal1").modal("show"); 
		
		$("#calendar_modal1 .fc-month-button").trigger("onclick");
	}
	function show_calendar2(){
		$("#calendar_modal2").modal("show"); 
		
		$("#calendar_modal2 .fc-week").trigger("onclick");
	}
	function show_calendar3(){
		$("#calendar_modal3").modal("show"); 
		
		$("#calendar_modal3 .fc-month-button").trigger("onclick");
	}
	function show_calendar4(){
		$("#calendar_modal4").modal("show"); 
		
		$("#calendar_modal4 .fc-month-button").trigger("onclick");
	}

	function show_newsletter(){
		$("#newsletterlist").modal("show"); 
		
		//$("#calendar_modal4 .fc-month-button").trigger("onclick");
	}

</script>

@stop