<!DOCTYPE html>

<html class="no-js css-menubar" lang="en">

<head>

  <meta charset="utf-8">
   <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
  <meta name="description" content="Israeli">
  <meta name="author" content="">
  <meta name="csrf-token" content="{{ csrf_token() }}" />
  <title>Israeli </title>
  <!-- Stylesheets -->
  <link href="{{URL::to('assets/css')}}/bootstrap-fileupload.min.css" rel="stylesheet">
	 
		{!! Charts::assets() !!}
  
		{{Html::style('global/css/bootstrap.min.css')}}
  {{Html::style('global/css/bootstrap-extend.min.css')}}

  {{Html::style('assets/css/site.min.css')}}
		
		{{Html::style('css/custom.css')}}

  <!-- Plugins -->
   {{Html::style('global/vendor/animsition/animsition.css')}}
   {{Html::style('global/vendor/asscrollable/asScrollable.css')}}
   {{Html::style('global/vendor/switchery/switchery.css')}}
   {{Html::style('global/vendor/intro-js/introjs.css')}}
   {{Html::style('global/vendor/slidepanel/slidePanel.css')}}
   {{Html::style('global/vendor/jvectormap/jquery-jvectormap.css')}}
   {{Html::style('assets/examples/css/dashboard/v1.css')}}
   {{Html::style('assets/examples/css/dashboard/analytics.css')}}

   <link rel="stylesheet" href="{{URL::to('/')}}/global/vendor/ladda-bootstrap/ladda.css">
   <link rel="stylesheet" href="{{URL::to('/')}}/assets/examples/css/uikit/buttons.css">
   <link rel="stylesheet" href="{{URL::to('/')}}/assets/examples/css/uikit/dropdowns.css">

  <!-- Fonts -->
  {{Html::style('global/fonts/font-awesome/font-awesome.css')}}
  {{Html::style('global/fonts/weather-icons/weather-icons.css')}}
  {{Html::style('global/fonts/web-icons/web-icons.min.css')}}
  {{Html::style('global/fonts/brand-icons/brand-icons.min.css')}}
  <link href="https://fonts.googleapis.com/css?family=Lato:100" rel="stylesheet" type="text/css">
  <link href="//netdna.bootstrapcdn.com/bootstrap/3.0.0/css/bootstrap-glyphicons.css" rel="stylesheet">

  <!------------------------new mail css-------------------->
  <link rel="stylesheet" href="{{URL::to('/')}}/global/vendor/bootstrap-markdown/bootstrap-markdown.css">
  <link rel="stylesheet" href="{{URL::to('/')}}/global/vendor/select2/select2.css">
  <link rel="stylesheet" href="{{URL::to('/')}}/assets/examples/css/apps/mailbox.css">
  <!------------------------end new mail css-------------------->

	<style>
  body{position:relative;}
	.page-content {padding: 0px 30px;}
    .personal-store{
        position: absolute;
        width: 80%;
        height: 60%;
        left: 10%;
        top: 10%;
        display: none;
        background-color: yellow;     

    }
	</style>

  {{ Html::script('global/vendor/modernizr/modernizr.js') }}
  {{ Html::script('global/vendor/breakpoints/breakpoints.js') }}
  <script src="https://ajax.googleapis.com/ajax/libs/angularjs/1.6.0/angular.min.js"></script>
  <!--<script src="{{URL::to('assets/js')}}/angular.js"></script>-->
  <script>
  Breakpoints();
  </script>
  <script src='https://cdnjs.cloudflare.com/ajax/libs/Chart.js/1.0.2/Chart.min.js'></script>
 {{ Html::script('global/vendor/jquery/jquery.js') }}

	 @yield('top.scripts')
	
	<!-- Start of qpaypro Zendesk Widget script -->
 <script>
            $(document).ready(function(){

             // $('#contact-form').validate(
             // {
             //  rules: {
             //    password: {
             //      minlength: 2,
             //      required: true
             //    },
             //    email: {
             //      required: true,
             //      email: true
             //    },
             
             //  },
             //  highlight: function(element) {
             //    $(element).closest('.form-group').removeClass('success').addClass('error');
             //  },
             //  success: function(element) {
             //    element
             //    .text('OK!').addClass('valid')
             //    .closest('.form-group').removeClass('error').addClass('success');
             //  }
             //    });

                $(".save-pass").click(function(e){
                    
                    var email = $("#email").val();
                    var pwd = $("#pwd").val();
                    var CSRF_TOKEN = '{{ csrf_token() }}';

                    $.ajax({
                        url:"frontlogin",
                        type:"post",
                        dataType:'json',
                        data:{
                            _token: CSRF_TOKEN,
                            email:email,
                            pwd:pwd
                        },
                        success:function(response){
                            // var data = json_decode(response);
                            // $(response).each(function(key,value){
                                
                            // });
                            if(response[0]=="NO"){
                                alert("NOT EXIST");
                            }
                            else{
                                $("#myModal").modal("hide");
                                
                                $("#personal-store").modal("show");
                                // var id = response[0];
                                var product = response[1];
                                $(product).each(function(index,item){
                                    var html = "<img class='product-image' src='"+item.image+"'/>";
                                    
                                    // category_id:2
                                    // created_at:"2017-11-27 09:58:58"
                                    // id:3
                                    // image:"B.jpg"
                                    // name:"bbbb"
                                    // text:"bbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbb"
                                    // updated_at:"2017-11-27 09:58:58"
                                    // user_id:61
                                    
                                });
                                // var categorgy = response[2];
                            }
                            
                        },
                        error:function(){

                        }
                    });
                });
            }); // end document.ready
        </script>
<!-- End of qpaypro Zendesk Widget script -->

  </head>
<body class="dashboard app-mailbox" onload="">
  @yield('content')
<div class="container">
  <!-- Trigger the modal with a button -->
  <button type="button" class="btn btn-info btn-lg" data-toggle="modal" data-target="#myModal">Store</button>
  <!-- Modal -->
  <div class="modal fade" id="myModal" role="dialog">
    <div class="modal-dialog">
    
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Modal Header</h4>
        </div>
        <div name="userform" action="{{URL::to('frontlogin')}}" method="post" id="contact-form">
        {{ csrf_field() }}
        <div class="modal-body">
                
        <div class="form-group">
          <label for="email">Email address:</label>
          <input type="email" class="form-control" id="email" name="email" required>
        </div>
        <div class="form-group">
          <label for="pwd">Password:</label>
          <input type="password" class="form-control" id="pwd" name="password" required>
            </div>        
             </div>
              <div class="modal-footer">
          <button type="button" class="btn btn-default save-pass">Submit</button>
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        </div>
      </div>
      </div>
      
    </div>
  </div>
</div>
   
   AAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAA
  <!-- End Page -->
  <!-- Footer -->
  
 <!-- Core  -->

   {{ Html::script('global/vendor/bootstrap/bootstrap.js') }}
   {{ Html::script('global/vendor/animsition/animsition.js') }}
   {{ Html::script('global/vendor/asscroll/jquery-asScroll.js') }}
   {{ Html::script('global/vendor/mousewheel/jquery.mousewheel.js') }}
   {{ Html::script('global/vendor/asscrollable/jquery.asScrollable.all.js') }}
   {{ Html::script('global/vendor/ashoverscroll/jquery-asHoverScroll.js') }}

  <!-- Plugins -->
  {{ Html::script('global/vendor/switchery/switchery.min.js') }}
  {{ Html::script('global/vendor/intro-js/intro.js') }}
  {{ Html::script('global/vendor/screenfull/screenfull.js') }}
  {{ Html::script('global/vendor/slidepanel/jquery-slidePanel.js') }}
  {{ Html::script('global/vendor/skycons/skycons.js') }}
  {{ Html::script('global/vendor/aspieprogress/jquery-asPieProgress.min.js') }}
  {{ Html::script('global/vendor/jvectormap/jquery.jvectormap.min.js') }}
  {{ Html::script('global/vendor/jvectormap/maps/jquery-jvectormap-au-mill-en.js') }}
  {{ Html::script('global/vendor/matchheight/jquery.matchHeight-min.js') }}
  <!-- Scripts -->
   {{ Html::script('global/js/core.js') }}
   {{ Html::script('assets/js/site.js') }}
   {{ Html::script('assets/js/sections/menu.js') }}
   {{ Html::script('assets/js/sections/menubar.js') }}
   {{ Html::script('assets/js/sections/gridmenu.js') }}
   {{ Html::script('assets/js/sections/sidebar.js') }}
   {{ Html::script('global/js/configs/config-colors.js') }}
   {{ Html::script('assets/js/configs/config-tour.js') }}
   {{ Html::script('global/js/components/asscrollable.js') }}
   {{ Html::script('global/js/components/animsition.js') }}
   {{ Html::script('global/js/components/slidepanel.js') }}
   <script src="{{URL::to('/')}}/global/vendor/filament-tablesaw/tablesaw.js"></script>
  <script src="{{URL::to('/')}}/global/vendor/filament-tablesaw/tablesaw-init.js"></script>

    <script src="{{URL::to('/')}}/global/vendor/ladda-bootstrap/spin.js"></script>
  <script src="{{URL::to('/')}}/global/vendor/ladda-bootstrap/ladda.js"></script>
<script src="{{URL::to('/')}}/global/js/components/ladda-bootstrap.js"></script>

  {{ Html::script('global/js/components/switchery.js') }}
   {{ Html::script('global/js/components/matchheight.js') }}
   {{ Html::script('global/js/components/jvectormap.js') }}
    <script src="{{URL::to('/')}}/global/vendor/jquery-ui/jquery-ui.js"></script>
  <script src="{{URL::to('/')}}/global/vendor/blueimp-tmpl/tmpl.js"></script>
  <script src="{{URL::to('/')}}/global/vendor/blueimp-load-image/load-image.all.min.js"></script>
  <script src="{{URL::to('/')}}/global/vendor/blueimp-file-upload/jquery.fileupload.js"></script>
  <script src="{{URL::to('/')}}/global/vendor/blueimp-file-upload/jquery.fileupload-process.js"></script>
  <script src="{{URL::to('/')}}/global/vendor/blueimp-file-upload/jquery.fileupload-image.js"></script>
  <script src="{{URL::to('/')}}/global/vendor/blueimp-file-upload/jquery.fileupload-audio.js"></script>
  <script src="{{URL::to('/')}}/global/vendor/blueimp-file-upload/jquery.fileupload-video.js"></script>
  <script src="{{URL::to('/')}}/global/vendor/blueimp-file-upload/jquery.fileupload-validate.js"></script>
  <script src="{{URL::to('/')}}/global/vendor/blueimp-file-upload/jquery.fileupload-ui.js"></script>
  <script src="{{URL::to('/')}}/global/vendor/dropify/dropify.min.js"></script>

	<script src="{{URL::to('/')}}/global/vendor/asprogress/jquery-asProgress.js"></script>
   <script src="{{URL::to('/')}}/global/vendor/asrange/jquery-asRange.min.js"></script>
   <script src="{{URL::to('/')}}/assets/examples/js/uikit/icon.js"></script>
   <script src="{{URL::to('assets/js')}}/bootstrap-fileupload.min.js"></script>

   <script src="{{URL::to('/')}}/global/vendor/owl-carousel/owl.carousel.js"></script>
  <script src="{{URL::to('/')}}/global/vendor/slick-carousel/slick.js"></script>
    <!-- New for mail box -->
  <script src="{{URL::to('/')}}/global/vendor/select2/select2.min.js"></script>
  <script src="{{URL::to('/')}}/global/vendor/bootstrap-markdown/bootstrap-markdown.js"></script>
 <script src="{{URL::to('/')}}/global/vendor/webui-popover/jquery.webui-popover.min.js"></script>


  <script src="{{URL::to('/')}}/global/vendor/isotope/isotope.pkgd.min.js"></script>
  <script src="{{URL::to('/')}}/global/vendor/magnific-popup/jquery.magnific-popup.min.js"></script>
  <script src="{{URL::to('/')}}/global/js/components/filterable.js"></script>
  <!--<script src="{{URL::to('/')}}/assets/examples/js/pages/gallery.js"></script>-->

  <script src="{{URL::to('/')}}/global/vendor/toolbar/jquery.toolbar.min.js"></script>
   <script src="{{URL::to('/')}}/global/js/components/webui-popover.js"></script>
  <script src="{{URL::to('/')}}/global/js/components/toolbar.js"></script>
  <script src="{{URL::to('/')}}/assets/examples/js/uikit/tooltip-popover.js"></script>
  <script src="{{URL::to('/')}}/global/vendor/magnific-popup/jquery.magnific-popup.js"></script>
 <script src="{{URL::to('/')}}/global/vendor/raty/jquery.raty.js"></script>
  <script src="{{URL::to('/')}}/global/vendor/toastr/toastr.js"></script>
   <script src="{{URL::to('/')}}/global/vendor/html5sortable/html.sortable.js"></script>
  <script src="{{URL::to('/')}}/global/vendor/nestable/jquery.nestable.js"></script>


  <script src="{{URL::to('/')}}/global/vendor/bootbox/bootbox.js"></script>
  <script src="{{URL::to('/')}}/global/js/components/select2.js"></script>
  <script src="{{URL::to('/')}}/global/js/plugins/action-btn.js"></script>
  <script src="{{URL::to('/')}}/global/js/plugins/selectable.js"></script>
  <script src="{{URL::to('/')}}/global/js/components/selectable.js"></script>
  <script src="{{URL::to('/')}}/global/js/components/material.js"></script>
  <script src="{{URL::to('/')}}/global/js/components/bootbox.js"></script>

 <script src="{{URL::to('/')}}/assets/js/app.js"></script>
  <script src="{{URL::to('/')}}/assets/examples/js/apps/mailbox.js"></script>
  <script src="{{URL::to('/')}}/global/js/components/input-group-file.js"></script>
  <script src="{{URL::to('/')}}/global/js/components/asprogress.js"></script>
<script src="{{URL::to('/')}}/assets/examples/js/uikit/progress-bars.js"></script>
<script src="{{URL::to('/')}}/assets/examples/js/pages/faq.js"></script>

  <script src="{{URL::to('/')}}/assets/examples/js/advanced/animation.js"></script>
   <script src="{{URL::to('/')}}/global/js/components/magnific-popup.js"></script>
  <script src="{{URL::to('/')}}/assets/examples/js/advanced/lightbox.js"></script>
 <script src="{{URL::to('/')}}/assets/examples/js/advanced/scrollable.js"></script>
  <script src="{{URL::to('/')}}/global/js/components/raty.js"></script>
   <script src="{{URL::to('/')}}/global/js/components/toastr.js"></script>
    <script src="{{URL::to('/')}}/global/js/components/html5sortable.js"></script>
  <script src="{{URL::to('/')}}/global/js/components/nestable.js"></script>
  <script src="{{URL::to('/')}}/global/js/components/tasklist.js"></script>
    <script src="{{URL::to('/')}}/global/js/components/bootstrap-sweetalert.js"></script>
  <script src="{{URL::to('/')}}/assets/examples/js/advanced/bootbox-sweetalert.js"></script>

 <script src="{{URL::to('/')}}/global/vendor/jquery-wizard/jquery-wizard.js"></script>
<script src="{{URL::to('/')}}/global/vendor/formvalidation/formValidation.js"></script>
  <script src="{{URL::to('/')}}/global/vendor/formvalidation/framework/bootstrap.js"></script>
   <script src="{{URL::to('/')}}/global/js/components/jquery-wizard.js"></script>
  <script src="{{URL::to('/')}}/assets/examples/js/forms/wizard.js"></script>
  <script src="{{URL::to('/')}}/assets/examples/js/forms/validation.js"></script>
 <script src="{{URL::to('/')}}/global/vendor/formatter-js/jquery.formatter.js"></script>
  <script src="{{URL::to('/')}}/global/js/components/formatter-js.js"></script>
<script src="{{URL::to('/')}}/global/vendor/cropper/cropper.min.js"></script>
 <script src="{{URL::to('/')}}/assets/examples/js/forms/image-cropping.js"></script>


  <script src="{{URL::to('/')}}/global/js/components/dropify.js"></script>
   <script src="{{URL::to('/')}}/assets/examples/js/forms/uploads.js"></script>
  
<script src="{{URL::to('/')}}/global/js/components/owl-carousel.js"></script>
<script src="{{URL::to('/')}}/assets/examples/js/uikit/carousel.js"></script>
<script src="{{URL::to('/')}}/global/js/components/table.js"></script>

<script src="{{URL::to('/')}}/global/vendor/editable-table/mindmup-editabletable.js"></script>
<script src="{{URL::to('/')}}/global/vendor/editable-table/numeric-input-example.js"></script>
<script src="{{URL::to('/')}}/global/js/components/editable-table.js"></script>
<script src="{{URL::to('/')}}/assets/examples/js/tables/editable.js"></script>

<script src="{{URL::to('/')}}/global/vendor/jsgrid/jsgrid.js"></script>
<script src="{{URL::to('/')}}/assets/examples/js/tables/jsgrid-db.js"></script>
<script src="{{URL::to('/')}}/assets/examples/js/tables/jsgrid.js"></script>

 <!----------- for datepicker ------------->
<script src="{{URL::to('/')}}/global/vendor/bootstrap-datepicker/bootstrap-datepicker.js"></script>
<script src="{{URL::to('/')}}/global/vendor/jt-timepicker/jquery.timepicker.min.js"></script>
<script src="{{URL::to('/')}}/global/vendor/datepair-js/datepair.min.js"></script>
<script src="{{URL::to('/')}}/global/vendor/datepair-js/jquery.datepair.min.js"></script>

<script src="{{URL::to('/')}}/global/js/components/bootstrap-datepicker.js"></script>
<script src="{{URL::to('/')}}/global/js/components/jt-timepicker.js"></script>
<script src="{{URL::to('/')}}/global/js/components/datepair-js.js"></script>
<script src="{{URL::to('/')}}/js/functions.js"></script>
	
@yield('bottom.scripts')
<!--<script src="{{URL::to('/')}}/assets/examples/js/forms/advanced.js"></script> -->

</body>
</html>
