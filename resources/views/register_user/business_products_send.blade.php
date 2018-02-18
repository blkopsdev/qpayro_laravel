@extends('layouts.template')
@section('content')
 <!-- Stylesheets -->
<link rel="stylesheet" href="{{URL::to('/')}}/assets/examples/css/pages/profile.css">
<link rel="stylesheet" href="{{URL::to('/')}}/global/vendor/bootstrap-datepicker/bootstrap-datepicker.css">
<link rel="stylesheet" href="{{URL::to('/')}}/global/vendor/bootstrap-maxlength/bootstrap-maxlength.css">
<link rel="stylesheet" href="{{URL::to('/')}}/global/vendor/jt-timepicker/jquery-timepicker.css">
<link rel="stylesheet" href="{{URL::to('/')}}/assets/examples/css/forms/advanced.css">
<script src="{{URL::to('assets/js')}}/ui-bootstrap-tpls-0.11.0.js"></script>
<script src="{{URL::to('assets')}}/croppie.js"></script>
<link rel="stylesheet" href="{{URL::to('assets')}}/croppie.css">
<style>
p.redcolor{color:red; font-size:16px;}
.spancolor{color:red;}
.help-block{color:red;}
</style>
<div class="page-header">
  <h1 class="page-title font_lato">Enviar botón de pago</h1>
  <div class="page-header-actions">
	<ol class="breadcrumb">
		<li><a href="{{URL::to('/dashboard')}}">{{ trans('app.home')}}</a></li>
		<li><a href="{{URL::to('business_products_detail', $business->business_id)}}">Regresar a listado de botones</a></li>
		<li class="active">{{--$products->name--}}</li>
	</ol>
  </div>
</div>
<div class="page-content container-fluid page-profile">
  <div class="row">
	<div class="col-md-12">
	  <!-- Panel -->
	  <div class="panel">
		<div class="panel-body nav-tabs-animate nav-tabs-horizontal">
		<!------------------------start insert, update, delete message ---------------->
			<div class="col-lg-12">
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
      <form  name="userForm" action="{{URL::to('business_products_sending',$products->product_id)}}" method="post"  enctype="multipart/form-data">
        {{ csrf_field() }}
      <div class="bs-example" data-example-id="single-button-dropdown" style="float:right; ">
      <div class="btn-group">
          <a class="btn btn-default" href="{{URL::to('business_products_detail', $business->business_id)}}"><i class="icon wb-arrow-left"></i>Regresar</a>
      </div>
      </div>
		  <ul class="nav nav-tabs nav-tabs-line" data-plugin="nav-tabs" role="tablist">
			<li role="presentation" class=""><a data-toggle="tab" href="#profile" aria-controls="profile" role="tab" aria-expanded="true">Botones de Pago</a></li>
			<li class="dropdown" role="presentation" style="display: none;">
			  <a class="dropdown-toggle" data-toggle="dropdown" href="#" aria-expanded="false">
				<span class="caret"></span>Menu </a>
			  <ul class="dropdown-menu" role="menu">
				<li role="presentation" style="display: none;"><a data-toggle="tab" href="#profile" aria-controls="profile" role="tab">Botones de Pago</a></li>
			  </ul>
			</li>
		  </ul>
		  <div class="tab-content">

<!------- Profile tab------------->
			<div class="tab-pane animation-slide-left active" id="profile" role="tabpanel">
			<table class="table table-hover table-details">
				<thead>
					<tr>
						<th rowspan="4">Información de envío</th>
					</tr>
				</thead>
				<tbody>
					<tr>
						<td>Correos destinatatorios</td>
						<td>
              <label class="control-label" for="receiver">Ingresa el email: <span class="spancolor">*</span> </label>
      				<input type="text" class="form-control" id="receiver" name="receiver" placeholder="ejemplo@midominio.com" required><br>
              <button type="submit" ng-disabled="userForm.$invalid" class="btn btn-primary ladda-button" data-plugin="ladda" data-style="expand-left">
            			<i class="icon fa-envelope-o"></i> Enviar correo
            		<span class="ladda-spinner"></span><div class="ladda-progress" style="width: 0px;"></div>
              </button>
            </td>
					</tr>
				 </tbody>
			</table>
			<p style="border-bottom:1px dashed green;"></p>
      <table class="table table-hover table-details">
				<thead>
					<tr>
						<th rowspan="4">Vista Previa de email</th>
					</tr>
				</thead>
				<tbody>
					<tr>
						<td>
              <!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
                              <html xmlns="http://www.w3.org/1999/xhtml" data-dnd="true">
                              <head>
                                <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
                                <meta name="viewport" content="width=device-width, initial-scale=1, minimum-scale=1, maximum-scale=1" />
                                <!--[if !mso]><!-->
                                <meta http-equiv="X-UA-Compatible" content="IE=Edge" />
                                <!--<![endif]-->

                                <!--[if (gte mso 9)|(IE)]><style type="text/css">
                                table {border-collapse: collapse;}
                                table, td {mso-table-lspace: 0pt;mso-table-rspace: 0pt;}
                                img {-ms-interpolation-mode: bicubic;}
                                </style>
                                <![endif]-->
                                <style type="text/css">
                                body {
                                  color: #626262;
                                }
                                body a {
                                  color: #0088cd;
                                  text-decoration: none;
                                }
                                p { margin: 0; padding: 0; }
                                table[class="wrapper"] {
                                  width:100% !important;
                                  table-layout: fixed;
                                  -webkit-font-smoothing: antialiased;
                                  -webkit-text-size-adjust: 100%;
                                  -moz-text-size-adjust: 100%;
                                  -ms-text-size-adjust: 100%;
                                }
                                img[class="max-width"] {
                                  max-width: 100% !important;
                                }
                                @media screen and (max-width:480px) {
                                  .preheader .rightColumnContent,
                                  .footer .rightColumnContent {
                                      text-align: left !important;
                                  }
                                  .preheader .rightColumnContent div,
                                  .preheader .rightColumnContent span,
                                  .footer .rightColumnContent div,
                                  .footer .rightColumnContent span {
                                    text-align: left !important;
                                  }
                                  .preheader .rightColumnContent,
                                  .preheader .leftColumnContent {
                                    font-size: 80% !important;
                                    padding: 5px 0;
                                  }
                                  table[class="wrapper-mobile"] {
                                    width: 100% !important;
                                    table-layout: fixed;
                                  }
                                  img[class="max-width"] {
                                    height: auto !important;
                                  }
                                  a[class="bulletproof-button"] {
                                    display: block !important;
                                    width: auto !important;
                                    font-size: 80%;
                                    padding-left: 0 !important;
                                    padding-right: 0 !important;
                                  }
                                  // 2 columns
                                  #templateColumns{
                                      width:100% !important;
                                  }

                                  .templateColumnContainer{
                                      display:block !important;
                                      width:100% !important;
                                      padding-left: 0 !important;
                                      padding-right: 0 !important;
                                  }
                                }
                                </style>
                                <style>
                                body, p, div { font-family: helvetica,arial,sans-serif; }
                              </style>
                                <style>
                                body, p, div { font-size: 15px; }
                              </style>
                              </head>
                              <body yahoofix="true" style="min-width: 100%; margin: 0; padding: 0; font-size: 15px; font-family: helvetica,arial,sans-serif; color: #626262; background-color: #F4F4F4; color: #626262;" data-attributes="%7B%22dropped%22%3Atrue%2C%22bodybackground%22%3A%22%23F4F4F4%22%2C%22bodyfontname%22%3A%22helvetica%2Carial%2Csans-serif%22%2C%22bodytextcolor%22%3A%22%23626262%22%2C%22bodylinkcolor%22%3A%22%230088cd%22%2C%22bodyfontsize%22%3A15%7D>
                                <center class="wrapper">
                                  <div class="webkit">
                                    <table cellpadding="0" cellspacing="0" border="0" width="100%" class="wrapper" bgcolor="#F4F4F4">
                                    <tr><td valign="top" bgcolor="#F4F4F4" width="100%">
                                    <!--[if (gte mso 9)|(IE)]>
                                    <table width="600" align="center" cellpadding="0" cellspacing="0" border="0">
                                      <tr>
                                        <td>
                                        <![endif]-->
                                          <table width="100%" role="content-container" class="outer" data-attributes="%7B%22dropped%22%3Atrue%2C%22containerpadding%22%3A%220%2C0%2C0%2C0%22%2C%22containerwidth%22%3A600%2C%22containerbackground%22%3A%22%23F4F4F4%22%7D" align="center" cellpadding="0" cellspacing="0" border="0">
                                            <tr>
                                              <td width="100%"><table width="100%" cellpadding="0" cellspacing="0" border="0">
                                                <tr>
                                                  <td>
                                                  <!--[if (gte mso 9)|(IE)]>
                                                    <table width="600" align="center" cellpadding="0" cellspacing="0" border="0">
                                                      <tr>
                                                        <td>
                                                          <![endif]-->
                                                            <table width="100%" cellpadding="0" cellspacing="0" border="0" style="width: 100%; max-width:600px;" align="center">
                                                              <tr><td role="modules-container" style="padding: 0px 0px 0px 0px; color: #626262; text-align: left;" bgcolor="#F4F4F4" width="100%" align="left">
                                                                <table border="0" cellpadding="0" cellspacing="0" align="center" width="100%" style="display:none !important; visibility:hidden; opacity:0; color:transparent; height:0; width:0;" class="module preheader preheader-hide" role="module" data-type="preheader">
                                <tr><td role="module-content"><p>Detalle del pago solicitado</p></td></tr>
                              </table>
                              <table role="module" data-type="image" border="0" align="center" cellpadding="0" cellspacing="0" width="100%" style="table-layout: fixed;" class="wrapper" data-attributes="%7B%22child%22%3Afalse%2C%22link%22%3A%22http%3A//mydev.qpaypro.com/app/public/login%22%2C%22width%22%3A%22200%22%2C%22height%22%3A%2256%22%2C%22imagebackground%22%3A%22%23f4f4f4%22%2C%22url%22%3A%22https%3A//marketing-image-production.s3.amazonaws.com/uploads/ba94eed4e75266c12c201fe15c18c1f794d6b581286d6c11eeea218d536e4913f6897d63921fccc612413d2cd5b051fc7c006dd8a6e213a29f791c531c3fdff7.png%22%2C%22alt_text%22%3A%22QPayPro%20-%20Negocios%20Electr%F3nicos%22%2C%22dropped%22%3Atrue%2C%22imagemargin%22%3A%2220%2C0%2C20%2C0%22%2C%22alignment%22%3A%22center%22%2C%22responsive%22%3Atrue%7D">
                              <tr>
                                <td style="font-size:6px;line-height:10px;background-color:#f4f4f4;padding: 20px 0px 20px 0px;" valign="top" align="center" role="module-content"><!--[if mso]>
                              <center>
                              <table width="200" border="0" cellpadding="0" cellspacing="0" style="table-layout: fixed;">
                                <tr>
                                  <td width="200" valign="top">
                              <![endif]-->
                              <a href="#" >
                                <img class="max-width"  width="200"   height=""  src="https://marketing-image-production.s3.amazonaws.com/uploads/ba94eed4e75266c12c201fe15c18c1f794d6b581286d6c11eeea218d536e4913f6897d63921fccc612413d2cd5b051fc7c006dd8a6e213a29f791c531c3fdff7.png" alt="QPayPro - Negocios Electrónicos" border="0" style="display: block; color: #000; text-decoration: none; font-family: Helvetica, arial, sans-serif; font-size: 16px;  max-width: 200px !important; width: 100% !important; height: auto !important; " />
                              </a>
                              <!--[if mso]>
                              </td></tr></table>
                              </center>
                              <![endif]--></td>
                              </tr>
                              </table><table class="module" role="module" data-type="text" border="0" cellpadding="0" cellspacing="0"  width="100%" style="table-layout: fixed;" data-attributes="%7B%22dropped%22%3Atrue%2C%22child%22%3Afalse%2C%22padding%22%3A%2234%2C23%2C10%2C23%22%2C%22containerbackground%22%3A%22%23222121%22%7D">
                              <tr>
                                <td role="module-content"  valign="top" height="100%" style="padding: 34px 23px 10px 23px;" bgcolor="#222121"><h1 style="text-align: center;"><span style="color:#FFFFFF;">Hola, {{$business->legal_name}} te ha solicitado un pago de: {{$products->name}}</span></h1> </td>
                              </tr>
                              </table>
                              <table class="module" role="module" data-type="text" border="0" cellpadding="0" cellspacing="0"  width="100%" style="table-layout: fixed;" data-attributes="%7B%22dropped%22%3Atrue%2C%22child%22%3Afalse%2C%22padding%22%3A%2234%2C23%2C34%2C23%22%2C%22containerbackground%22%3A%22%23ffffff%22%7D">
                              <tr>
                                <td role="module-content"  valign="top" height="100%" style="padding: 34px 23px 34px 23px;" bgcolor="#ffffff"><h1 style="text-align: center;"><span style="color:#2D2D2D;">Detalle del pago solicitado</span></h1>  <div style="text-align: center;">{{$products->title}}: {{$products->name}}<br></div>
                                  <div style="text-align: center;">Por un valor de: {{$products->currency}} {{$products->price}}@if($products->shipping_cost > '0') más envío {{$products->currency}} {{$products->shipping_cost}}@endif<br></div>
                                  <table border="0" cellpadding="0" cellspacing="0" class="wrapper-mobile" align="center">
                                    <tr><br>
                                      <td align="center" style="-webkit-border-radius: 6px; -moz-border-radius: 6px; border-radius: 6px; font-size: 16px;" bgcolor="#1188e6">
                                        <a href="#" class="bulletproof-button" target="_blank" style="height: px; width: px; font-size: 16px; line-height: px; font-family: Helvetica, Arial, sans-serif; color: #ffffff; padding: 12px 18px 12px 18px; text-decoration: none; color: #ffffff; text-decoration: none; -webkit-border-radius: 6px; -moz-border-radius: 6px; border-radius: 6px; border: 1px solid #1288e5; display: inline-block;">Realizar Pago</a>
                                      </td>
                                    </tr>
                                  </table>
                                </td>
                              </tr>
                              </table>
                              <table class="module" role="module" data-type="spacer" border="0" cellpadding="0" cellspacing="0" width="100%" style="table-layout: fixed;" data-attributes="%7B%22dropped%22%3Atrue%2C%22spacing%22%3A30%2C%22containerbackground%22%3A%22%23ffffff%22%7D">
                              <tr><td role="module-content" style="padding: 0px 0px 30px 0px;" bgcolor="#ffffff"></td></tr></table>
                              <table border="0" cellpadding="0" cellspacing="0" align="center" width="100%" class="module footer" role="module" data-type="footer" data-attributes="%7B%22dropped%22%3Atrue%2C%22columns%22%3A%222%22%2C%22padding%22%3A%2248%2C34%2C17%2C34%22%2C%22containerbackground%22%3A%22%2332a9d6%22%7D">

                                <tr><td style="padding: 48px 34px 17px 34px;" bgcolor="#32a9d6">

                                  <table border="0" cellpadding="0" cellspacing="0" align="center" width="100%">
                                    <tr role="module-content">
                                      <td align="center" valign="top" width="50%" height="100%" class="templateColumnContainer">
                                        <table border="0" cellpadding="0" cellspacing="0" width="100%" height="100%">
                                          <tr>
                                            <td class="leftColumnContent" role="column-one" height="100%" style="height:100%;"><table class="module" role="module" data-type="text" border="0" cellpadding="0" cellspacing="0"  width="100%" style="table-layout: fixed;" data-attributes="%7B%22dropped%22%3Atrue%2C%22child%22%3Afalse%2C%22padding%22%3A%220%2C0%2C0%2C0%22%2C%22containerbackground%22%3A%22%22%7D">
                              <tr>
                                <td role="module-content"  valign="top" height="100%" style="padding: 0px 0px 0px 0px;" bgcolor="">  <div style="font-size: 10px; line-height: 150%; margin: 0px;">&nbsp;</div><div style="font-size: 10px; line-height: 150%; margin: 0px;">&nbsp;</div><div style="font-size: 10px; line-height: 150%; margin: 0px;"><a href="[unsubscribe]"><span style="color:#FFFFFF;">Unsubscribe</span></a><span style="color:#FFFFFF;"> | </span><a href="[Unsubscribe_Preferences]"><span style="color:#FFFFFF;">Update Preferences</span></a></div>  </td>
                              </tr>
                              </table>
                              </td>
                                          </tr>
                                        </table>
                                      </td>
                                      <td align="center" valign="top" width="50%" height="100%" class="templateColumnContainer">
                                        <table border="0" cellpadding="0" cellspacing="0" width="100%" height="100%">
                                          <tr>
                                            <td class="rightColumnContent" role="column-two" height="100%" style="height:100%;"><table class="module" role="module" data-type="text" border="0" cellpadding="0" cellspacing="0"  width="100%" style="table-layout: fixed;" data-attributes="%7B%22dropped%22%3Atrue%2C%22child%22%3Afalse%2C%22padding%22%3A%220%2C0%2C0%2C0%22%2C%22containerbackground%22%3A%22%22%7D">
                              <tr>
                                <td role="module-content"  valign="top" height="100%" style="padding: 0px 0px 0px 0px;" bgcolor=""><div style="font-size: 10px; line-height: 150%; margin: 0px; text-align: right;"><font color="#ffffff">QPay, S.A.</font></div>  <div style="font-size: 10px; line-height: 150%; margin: 0px; text-align: right;"><font color="#ffffff">Km. 22.5 Carretera a El Salvador, Edif. Plaza Portal del Bosque, Nivel 4, Of. 4A, Guatemala, Centro Am&eacute;rica</font></div>  <div style="font-size: 10px; line-height: 150%; margin: 0px; text-align: right;"><font color="#ffffff">soporte@qpaypro.com</font></div> </td>
                              </tr>
                              </table>
                              </td>
                                          </tr>
                                        </table>
                                      </td>

                                    </tr>
                                  </table>
                                </td></tr>
                              </table>

                                                              </tr>
                                                              <td><div style="background-color: #32A9D6; font-size: 10px; line-height: 150%; margin: 0px; text-align: center;"><font color="#FFFFFF">Usted ha recibido este email departe de QPayPro, el cual es un servicio intermediario de pago en línea que trabaja con la entidad el comercio que generó dicha solicitud de pago.
                                            QPayPro está comprometido a prevenir correo electrónico fraudulento. El correo electrónico departe de QPayPro siempre contrendra el detalle del comercio, si desea conocer más sobre como detectar que no es un correo malicioso o phishing por favor valla a este enlace: Link a qpay sobre phishing.</font>
                            </div>
                                                              </td>
                                                            </td>
                                                            </table>
                                                          <!--[if (gte mso 9)|(IE)]>
                                                        </td>
                                                      </td>
                                                    </table>
                                                  <![endif]-->
                                                  </td>
                                                </tr>
                                              </table></td>
                                            </tr>
                                          </table>
                                        <!--[if (gte mso 9)|(IE)]>
                                        </td>
                                      </tr>
                                    </table>
                                    <![endif]-->
                                    </tr></td>
                                    </table>
                                  </div>
                                </center>
                              </body>
                              </html>

            </td>
					</tr>
				 </tbody>
			</table>
      </form>
			</div>
		  </div>
		</div>
	  </div>
	  <!-- End Panel -->
	</div>
  </div>
</div>

<br/>
@stop
