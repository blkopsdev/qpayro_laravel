@extends('layouts.template')

@section('content')
  
  @verbatim
<script type="text/javascript">(function(o){var b="https://api.autopilothq.com/anywhere/",t="0fb1c9a94bb44754847691ce6877698cd5f3be29473c4bc794b3679d17f4349e",a=window.AutopilotAnywhere={_runQueue:[],run:function(){this._runQueue.push(arguments);}},c=encodeURIComponent,s="SCRIPT",d=document,l=d.getElementsByTagName(s)[0],p="t="+c(d.title||"")+"&u="+c(d.location.href||"")+"&r="+c(d.referrer||""),j="text/javascript",z,y;if(!window.Autopilot) window.Autopilot=a;if(o.app) p="devmode=true&"+p;z=function(src,asy){var e=d.createElement(s);e.src=src;e.type=j;e.async=asy;l.parentNode.insertBefore(e,l);};y=function(){z(b+t+'?'+p,true);};if(window.attachEvent){window.attachEvent("onload",y);}else{window.addEventListener("load",y,false);}})({"app":true});</script>
@endverbatim

<script type="text/javascript">
  Autopilot.run("associate", {
    Email: "{{ Auth::user()->email }}",
    custom: {
     "step": "2"
    }
  });
</script>
  
 <link rel="stylesheet" href="{{URL::to('/')}}/global/vendor/switchery/switchery.css">
  <link rel="stylesheet" href="{{URL::to('/')}}/global/vendor/jquery-wizard/jquery-wizard.css">
  <link rel="stylesheet" href="{{URL::to('/')}}/global/vendor/formvalidation/formValidation.css">

  <script type="text/javascript">
  function Mostrar(elemento){
    if (elemento.value=="1"){
      document.getElementById("number_afiliation").style.display="inline";
    }else{
      document.getElementById("number_afiliation").style.display="none";
    }
  }
  </script>

  <script>
function goBack() {
    window.history.back();
}
</script>

  <div class="page-header">
  <h1 class="page-title font_lato">Detalles generales de afiliación </h1>
  <div class="page-header-actions">
  </div>
</div>
<div class="page-content container-fluid">
  <div class="row">
  @if(session('currency_afiliation') === '1')
  <div class="alert dark alert-icon alert-info alert-dismissible alertDismissible" role="alert">
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
    <span aria-hidden="true">×</span>
    </button>
    <i class="icon wb-check" aria-hidden="true"></i>
    Debes completar toda la información antes de continuar
  </div>
  @endif
  </div>
     <div class="row">
        <div class="col-md-22">
          <!-- Panel Wizard Form Container -->
          <div class="panel" id="exampleWizardForm">
            <div class="panel-heading">
              <h3 class="panel-title">Configuración de la Cuenta - Paso 2</h3>
            </div>
            <div class="panel-body">
              <!-- Steps -->
              <div class="pearls row">
                <div class="pearl current done col-xs-2">
                  <a href="{{URL::to('steps',$business->business_id)}}">
                  <div class="pearl-icon"><i class="icon wb-user" aria-hidden="true"></i></div>
                  <span class="pearl-title">¿Qué Vendes?</span>
                  </a>
                </div>
                <div class="pearl current col-xs-2">
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
                  <form id="exampleAccountForm" action="{{URL::to('step3',$business->business_id)}}" method="post">
                    {{ csrf_field() }}
                    <h3 class="panel-title">Detalles de Afiliación </h3>
                    <div class="form-group col-sm-6">
                      <label class="control-label" for="have_afiliation">¿Esta usted afiliado a Visanet Guatemala?</label>
                      <div class="radio-custom radio-primary">
                        <input onchange="Mostrar(this)" id="have_afiliation" name="have_afiliation" value="1" type="radio" {{ $business->have_afiliation == '1' ?  "checked" : '' }}>
                        <label for="status_afiliation">Si estoy afiliado a VisaNet</label>
                      </div>
                      <div class="radio-custom radio-primary">
                        <input onchange="Mostrar(this)" id="have_afiliation" name="have_afiliation" value="0" type="radio" {{ $business->have_afiliation == '0' ?  "checked" : '' }}>
                        <label for="afiliacion">No estoy afiliado a VisaNet</label>
                      </div>
                    </div>
                    <div id="number_afiliation" @if(@$business->number_afiliation == null) style="display:none;" @endif class="form-group col-sm-6">
                      <label class="control-label" for="number_afiliation">Número de afiliación</label>
                      <input type="text" class="form-control" id="number_afiliation" value="{{$business->number_afiliation}}" name="number_afiliation">
                    </div>
                    <div class="form-group col-sm-12">
                      <label class="control-label" for="inputUserName">Moneda de afiliación</label>
                      <div class="radio-custom radio-primary">
                        <input id="currency_afiliation_GTQ" name="currency_afiliation" value="GTQ" type="radio" {{ $business->currency_afiliation == 'GTQ' ?  "checked" : '' }}>
                        <label for="currency_afiliation_GTQ">Quetzales (GTQ)</label>
                      </div>
                      <div class="radio-custom radio-primary">
                        <input id="currency_afiliation_USD" name="currency_afiliation" value="USD" type="radio" {{ $business->currency_afiliation == 'USD' ?  "checked" : '' }}>
                        <label for="currency_afiliation_USD">Dólares (USD)</label>
                      </div>
                    </div>
                      <div class="col-md-3">
                        <a data-original-title="Regresar" class="btn btn-default" href="{{URL::to('steps',$business->business_id)}}"><i class="icon wb-arrow-left"></i>Regresar</a>
                      </div>
                      <div class="col-md-3"></div>
                      <div class="col-md-3"></div>
                      <div class="col-md-3">
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
