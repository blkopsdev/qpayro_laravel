@extends('layouts.template')	
@section('content')
	
@verbatim
<script type="text/javascript">(function(o){var b="https://api.autopilothq.com/anywhere/",t="0fb1c9a94bb44754847691ce6877698cd5f3be29473c4bc794b3679d17f4349e",a=window.AutopilotAnywhere={_runQueue:[],run:function(){this._runQueue.push(arguments);}},c=encodeURIComponent,s="SCRIPT",d=document,l=d.getElementsByTagName(s)[0],p="t="+c(d.title||"")+"&u="+c(d.location.href||"")+"&r="+c(d.referrer||""),j="text/javascript",z,y;if(!window.Autopilot) window.Autopilot=a;if(o.app) p="devmode=true&"+p;z=function(src,asy){var e=d.createElement(s);e.src=src;e.type=j;e.async=asy;l.parentNode.insertBefore(e,l);};y=function(){z(b+t+'?'+p,true);};if(window.attachEvent){window.attachEvent("onload",y);}else{window.addEventListener("load",y,false);}})({"app":true});</script>
@endverbatim

<script type="text/javascript">
  Autopilot.run("associate", {
    Email: "{{ Auth::user()->email }}",
    custom: {
     "step": "1"
    }
  });
</script>
	
 <link rel="stylesheet" href="{{URL::to('/')}}/global/vendor/switchery/switchery.css">
  <link rel="stylesheet" href="{{URL::to('/')}}/global/vendor/jquery-wizard/jquery-wizard.css">
  <link rel="stylesheet" href="{{URL::to('/')}}/global/vendor/formvalidation/formValidation.css">
  <div class="row">
  @if(@success_payment)
  	<div class="alert dark alert-icon alert-success alert-dismissible alertDismissible" role="alert">
  	  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
  		<span aria-hidden="true">×</span>
  	  </button>
  	  <i class="icon wb-check" aria-hidden="true"></i>
  	  El pago fue realizado con exito. Sigue los pasos para poder completar tu afiliación
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
  @if(@$fail_payment)
  	<div class="alert dark alert-icon alert-danger alert-dismissible alertDismissible" role="alert">
  	  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
  		<span aria-hidden="true">×</span>
  	  </button>
  	  <i class="icon wb-check" aria-hidden="true"></i>
  	  {{@$fail_payment}}
  	</div>
  @endif
  </div>
  <div class="page-header">
  <h1 class="page-title font_lato">¿Qué vendes? </h1>
  <div class="page-header-actions">
  </div>
</div>
<div class="page-content container-fluid">
     <div class="row">
        <div class="col-md-22">
          <!-- Panel Wizard Form Container -->
          <div class="panel" id="exampleWizardForm">
            <div class="panel-heading">
              <h3 class="panel-title">Configuración de la Cuenta- Paso 1</h3>
            </div>
            <div class="panel-body">
              <!-- Steps -->
              <div class="pearls row">
                <div class="pearl current col-xs-2">
                  <div class="pearl-icon"><i class="icon wb-user" aria-hidden="true"></i></div>
                  <span class="pearl-title">¿Qué Vendes?</span>
                </div>
                <div class="pearl col-xs-2">
                  <div class="pearl-icon"><i class="icon fa-file-text-o" aria-hidden="true"></i></div>
                  <span class="pearl-title">Detalles generales<br> de afiliación</span>
                </div>
                <div class="pearl col-xs-2">
                  <div class="pearl-icon"><i class="icon fa-folder-open-o" aria-hidden="true"></i></div>
                  <span class="pearl-title">Información de negocio</span>
                </div>
                <div class="pearl col-xs-2">
                  <div class="pearl-icon"><i class="icon fa-bank" aria-hidden="true"></i></div>
                  <span class="pearl-title">Gestión de bancos</span>
                </div>
                <div class="pearl col-xs-2">
                  <div class="pearl-icon"><i class="icon fa-file-pdf-o" aria-hidden="true"></i></div>
                  <span class="pearl-title">Documentación</span>
                </div>
                <div class="pearl col-xs-2">
                  <div class="pearl-icon"><i class="icon wb-check" aria-hidden="true"></i></div>
                  <span class="pearl-title">Completar afiliación <br>y firma</span>
                </div>
              </div>
              <!-- End Steps -->
              <!-- Wizard Content -->
              <div class="wizard-content">
                <div class="wizard-pane active" id="exampleAccount" role="tabpanel">
                  <form id="exampleAccountForm" action="{{URL::to('step2',$business->business_id)}}" method="post">
                    {{ csrf_field() }}
                    <div class="row">
                    <div class="form-group col-sm-6">
                      <label class="control-label" for="business_industry">Sector comercial al que perteneces</label>
                        <select class="form-control" name="business_industry" id="business_industry" required>
                          <option value="{{@$business->business_industry}}">{{@$business->business_industry}}</option>
                          <option value="Agropecuario">Agropecuario </option>
                          <option value="Alimentos Y Bebidas">Alimentos Y Bebidas </option>
                          <option value="Artes Graficas">Artes Gráficas </option>
                          <option value="Asociaciones Y Cooperativas">Asociaciones Y Cooperativas </option>
                          <option value="Automotriz">Automotriz </option>
                          <option value="Belleza Y Estetica">Belleza Y Estética </option>
                          <option value="Calzado">Calzado </option>
                          <option value="Comercio">Comercio </option>
                          <option value="Construccion">Construcción </option>
                          <option value="Cultural Recreacion Y Deporte">Cultural Recreación Y Deporte </option>
                          <option value="Editorial">Editorial </option>
                          <option value="Educacion">Educación </option>
                          <option value="Electrico">Eléctrico </option>
                          <option value="Electronico">Electrónico </option>
                          <option value="Farmaceutico">Farmacéutico </option>
                          <option value="Financiero">Financiero </option>
                          <option value="Informatico Y Software">Informático Y Software </option>
                          <option value="Inmobiliario">Inmobiliario </option>
                          <option value="Medio Ambiente">Medio Ambiente </option>
                          <option value="Metalurgico">Metalúrgico </option>
                          <option value="Minero Y Petroleo">Minero Y Petróleo </option>
                          <option value="Muebles Y Maderas">Muebles Y Maderas </option>
                          <option value="Papel Y Carton">Papel Y Cartón </option>
                          <option value="Plasticos">Plásticos </option>
                          <option value="Postal">Postal </option>
                          <option value="Publico">Publico </option>
                          <option value="Quimico">Químico </option>
                          <option value="Salud">Salud </option>
                          <option value="Seguridad Social">Seguridad Social </option>
                          <option value="Servicios">Servicios </option>
                          <option value="Telecomunicaciones">Telecomunicaciones </option>
                          <option value="Textil Y Confeccion">Textil Y Confección </option>
                          <option value="Transportes Y Almacenamiento">Transportes Y Almacenamiento </option>
                          <option value="Turistico">Turístico </option>
                          <option value="Sectores Otros">Sectores Otros</option>
                        </select>
                    </div>
                    <div class="form-group col-sm-6">
                      <label class="control-label" for="desc_business">Indícanos una breve descripción de tu negocio</label>
                      <textarea class="form-control" id="desc_business" name="desc_business" placeholder="" value="{{@$business->desc_business}}" required>{{@$business->desc_business}}</textarea>
                    </div>
                  </div>
                      <div class="row">
                    <div class="form-group col-sm-6">
                      <label class="control-label" for="activity_business">Cuéntanos brevemente cuál es tu principal producto o servicio</label>
                      <textarea class="form-control" id="activity_business" name="activity_business" placeholder="" value="{{@$business->activity_business}}" required>{{@$business->activity_business}}</textarea>
                    </div>
                    <div class="form-group col-sm-6">
                      <label class="control-label" for="url_business">URL de tu sitio web (Si tienes)</label>
                      <input type="text" class="form-control" id="url_business" name="url_business" value="{{@$business->url_business}}">
                    </div>
                  </div>
                      <div class="row">
                    <div class="form-group col-sm-6">
                      <label class="control-label" for="sales_aprox">Monto aproximado de ventas al mes (GTQ)</label>
                      <div class="input-group">
                        <span class="input-group-addon">Q</span>
                        <input class="form-control" id="sales_aprox" name="sales_aprox" placeholder="" type="text" value="{{@$business->sales_aprox}}" required="required">
                      </div>
                    </div>
                    <div class="form-group col-sm-6">
                      <label class="control-label" for="expense_aprox">Montos egresados aproximados al mes (GTQ)</label>
                      <div class="input-group">
                        <span class="input-group-addon">Q</span>
                        <input class="form-control" id="expense_aprox" name="expense_aprox" placeholder="" type="text" value="{{@$business->expense_aprox}}" required="required">
                      </div>
                    </div>
                  </div>
                      <div class="row">
                    <div class="form-group col-sm-6">
                      <label class="control-label" for="num_employees">Cantidad de empleados</label>
                      <input type="text" class="form-control" id="num_employees" name="num_employees" value="{{@$business->num_employees}}" required="required">
                    </div>
                  </div>
                  <div class="col-md-3">
                  </div>
                  <div class="col-md-3"></div>
                  <div class="col-md-3"></div>
                  <div class="form-group col-sm-2">
                    <button type="submit" class="btn btn-block btn-primary" style="float: center;">Siguiente</button>
                  </div>
                  </form>
                </div>
              </div>
              <!-- End Wizard Content -->
            </div>
          </div>
          <!-- End Panel Wizard Form Container -->
        </div>
      </div>
    </div>
    @stop
