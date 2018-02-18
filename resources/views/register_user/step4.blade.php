@extends('layouts.template')

@section('content')
  
  @verbatim
<script type="text/javascript">(function(o){var b="https://api.autopilothq.com/anywhere/",t="0fb1c9a94bb44754847691ce6877698cd5f3be29473c4bc794b3679d17f4349e",a=window.AutopilotAnywhere={_runQueue:[],run:function(){this._runQueue.push(arguments);}},c=encodeURIComponent,s="SCRIPT",d=document,l=d.getElementsByTagName(s)[0],p="t="+c(d.title||"")+"&u="+c(d.location.href||"")+"&r="+c(d.referrer||""),j="text/javascript",z,y;if(!window.Autopilot) window.Autopilot=a;if(o.app) p="devmode=true&"+p;z=function(src,asy){var e=d.createElement(s);e.src=src;e.type=j;e.async=asy;l.parentNode.insertBefore(e,l);};y=function(){z(b+t+'?'+p,true);};if(window.attachEvent){window.attachEvent("onload",y);}else{window.addEventListener("load",y,false);}})({"app":true});</script>
@endverbatim

<script type="text/javascript">
  Autopilot.run("associate", {
    Email: "{{ Auth::user()->email }}",
    custom: {
     "step": "4"
    }
  });
</script>
  
 <link rel="stylesheet" href="{{URL::to('/')}}/global/vendor/switchery/switchery.css">
  <link rel="stylesheet" href="{{URL::to('/')}}/global/vendor/jquery-wizard/jquery-wizard.css">
  <link rel="stylesheet" href="{{URL::to('/')}}/global/vendor/formvalidation/formValidation.css">

  <script type="text/javascript">
  function Mostrar(elemento){
    if (elemento.value=="no"){
      document.getElementById("banks").style.display="inline";
      document.getElementById("bank_accounts").style.display="inline";
      document.getElementById("diferent_accounts").style.display="inline";
    }else{
      document.getElementById("banks").style.display="none";
      document.getElementById("bank_accounts").style.display="none";
      document.getElementById("diferent_accounts").style.display="none";
    }
  }
  </script>
  <script>
function goBack() {
    window.history.back();
}
</script>

  <div class="page-header">
  <h1 class="page-title font_lato">Gestión de bancos</h1>
  <div class="page-header-actions">

  </div>
</div>
<div class="page-content container-fluid">
  <div class="row">
  @if(session('diferent_currency') === '1')
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
              <h3 class="panel-title">Configuración de la Cuenta - Paso 4</h3>
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
                <div class="pearl current done col-xs-2">
                  <a href="{{URL::to('step2',$business->business_id)}}">
                  <div class="pearl-icon"><i class="icon fa-file-text-o" aria-hidden="true"></i></div>
                  <span class="pearl-title">Detalles generales<br> de afiliación</span>
                  </a>
                </div>
                <div class="pearl current done col-xs-2">
                  <a href="{{URL::to('step3',$business->business_id)}}">
                  <div class="pearl-icon"><i class="icon fa-folder-open-o" aria-hidden="true"></i></div>
                  <span class="pearl-title">Información de negocio</span>
                  </a>
                </div>
                <div class="pearl current col-xs-2">
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
                  <form id="exampleAccountForm" action="{{URL::to('step5',$business->business_id)}}" method="post">
                    {{ csrf_field() }}
                    <p>* Los montos a depositar  sera el monto cobrado menos las comisiones por transacción establecidas por QPayPro y aceptadas por el cliente.</p>
                    <div class="row">
                      <div class="form-group col-sm-6">
                        <label class="control-label" for="name_to_emit">Nombre para emisión de pago</label>
                        <input type="text" class="form-control" id="name_to_emit" name="name_to_emit" value="{{$business->name_to_emit}}" required>
                      </div>
                      <div class="form-group col-sm-6">
                        <label class="control-label" for="bank">Banco</label>
                          <select name="bank" id="bank" class="form-control" required>
                            <option value="{{$business->bank}}">{{$business->bank}}</option>
                            <option value="ACEPTA">ACEPTA</option>
                            <option value="BAC Reformador">BAC Reformador</option>
                            <option value="Banco Agromercantil">Banco Agromercantil</option>
                            <option value="Banco Industrial">Banco Industrial</option>
                            <option value="Banrural">Banrural</option>
                            <option value="BANTRAB">BANTRAB</option>
                            <option value="CITI">CITI</option>
                            <option value="FICOHSA">FICOHSA</option>
                            <option value="G&T Continental">G&T Continental</option>
                            <option value="Interbanco">Interbanco</option>
                            <option value="Promerica">Promerica</option>
                            <option value="TRT Banrural">TRT Banrural</option>
                            <option value="VISANET GUATEMALA">VISANET GUATEMALA</option>
                          </select>
                      </div>
                    </div>
                    <div class="row">
                      <div class="form-group col-sm-6">
                        <label class="control-label" for="owner_account">Nombre del titular de la cuenta</label>
                        <input type="text" class="form-control" id="owner_account" name="owner_account" value="{{$business->owner_account}}" required>
                      </div>
                      <div class="form-group col-sm-6">
                        <label class="control-label" for="number_account">Número de cuenta</label>
                        <input type="text" class="form-control" id="number_account" name="number_account" value="{{$business->number_account}}" required>
                      </div>
                    </div>
                    <div class="row">
                      <div class="form-group col-sm-6">
                        <label class="control-label" for="retention_name">Nombre para emisión de factura y retención</label>
                        <input type="text" class="form-control" id="retention_name" name="retention_name" value="{{$business->retention_name}}" required>
                      </div>
                      <div id="diferent_accounts"class="form-group col-sm-12">
                        <label class="control-label" for="inputUserName">Moneda de la cuenta</label>
                        <div class="radio-custom radio-primary">
                          <input id="diferent_currency" name="diferent_currency" value="GTQ" type="radio" {{ $business->diferent_currency == 'GTQ' ?  "checked" : '' }}>
                          <label for="diferent_currency">Quetzales (GTQ)</label>
                        </div>
                        <div class="radio-custom radio-primary">
                          <input id="diferent_currency" name="diferent_currency" value="USD" type="radio" {{ $business->diferent_currency == 'USD' ?  "checked" : '' }}>
                          <label for="diferent_currency">Dólares (USD)</label>
                        </div>
                      </div>
                    </div>
                    <div class="row">
                      <div class="col-md-3">
                        <a data-original-title="Regresar" class="btn btn-default" href="{{URL::to('step3',$business->business_id)}}"><i class="icon wb-arrow-left"></i>Regresar</a>
                      </div>
                      <div class="col-md-3"></div>
                      <div class="col-md-3"></div>
                      <div class="col-md-3">
                        <button type="submit" class="btn btn-block btn-primary" style="float: center;">Siguiente</button>
                      </div>
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
