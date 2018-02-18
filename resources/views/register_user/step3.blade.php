@extends('layouts.template')


@section('content')
    
    @verbatim
<script type="text/javascript">(function(o){var b="https://api.autopilothq.com/anywhere/",t="0fb1c9a94bb44754847691ce6877698cd5f3be29473c4bc794b3679d17f4349e",a=window.AutopilotAnywhere={_runQueue:[],run:function(){this._runQueue.push(arguments);}},c=encodeURIComponent,s="SCRIPT",d=document,l=d.getElementsByTagName(s)[0],p="t="+c(d.title||"")+"&u="+c(d.location.href||"")+"&r="+c(d.referrer||""),j="text/javascript",z,y;if(!window.Autopilot) window.Autopilot=a;if(o.app) p="devmode=true&"+p;z=function(src,asy){var e=d.createElement(s);e.src=src;e.type=j;e.async=asy;l.parentNode.insertBefore(e,l);};y=function(){z(b+t+'?'+p,true);};if(window.attachEvent){window.attachEvent("onload",y);}else{window.addEventListener("load",y,false);}})({"app":true});</script>
@endverbatim

<script type="text/javascript">
  Autopilot.run("associate", {
    Email: "{{ Auth::user()->email }}",
    custom: {
     "step": "3"
    }
  });
</script>
  
  <script>
    $(function(){
      $("input[name=business_surveillance]").on('click', function(c){
        if($(this).val() == 'OTRO')
        $('#business_surveillance-other').removeAttr('disabled');
        else
        $('#business_surveillance-other').attr('disabled', 'disabled');
      });
      
      $("input[name=address_location_reference]").on('click', function(c){
        if($(this).val() == 'OTRO')
        $('#address_location_reference-other').removeAttr('disabled');
        else
        $('#address_location_reference-other').attr('disabled', 'disabled');
      });
      
      $("input[name=business_advertising]").on('click', function(c){
        if($(this).val() == 'OTRO')
        $('#business_advertising-other').removeAttr('disabled');
        else
        $('#business_advertising-other').attr('disabled', 'disabled');
      });
      
    });
  </script>
  
 <link rel="stylesheet" href="{{URL::to('/')}}/global/vendor/switchery/switchery.css">
  <link rel="stylesheet" href="{{URL::to('/')}}/global/vendor/jquery-wizard/jquery-wizard.css">
  <link rel="stylesheet" href="{{URL::to('/')}}/global/vendor/formvalidation/formValidation.css">
  <script>
function goBack() {
    window.history.back();
}
</script>
  <div class="page-header">
  <h1 class="page-title font_lato">Información de negocio</h1>
  <div class="page-header-actions">
  </div>
</div>
<div class="page-content container-fluid">
     <div class="row">
        <div class="col-md-22">
          <!-- Panel Wizard Form Container -->
          <div class="panel" id="exampleWizardForm">
            <div class="panel-heading">
              <h3 class="panel-title">Configuración de la Cuenta - Paso 3</h3>
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
                <div class="pearl current col-xs-2">
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
                <h3 class="panel-title">Información de tu negocio</h3>
                <div class="wizard-pane active" id="exampleAccount" role="tabpanel">
                  <form id="exampleAccountForm" action="{{URL::to('step4',$business->business_id)}}" method="post">
                    {{ csrf_field() }}
                    <div class="row">
                      <div class="form-group col-sm-6">
                        <label class="control-label" for="fiscal_adress">Dirección fiscal</label>
                        <input type="text" class="form-control" id="fiscal_adress" name="fiscal_adress" value="{{$business->fiscal_adress}}" required>
                      </div>
                      <div class="form-group col-sm-6">
                        <label class="control-label" for="office_adress">Dirección de oficinas</label>
                        <input type="text" class="form-control" id="office_adress" name="office_adress"value="{{$business->office_adress}}" required>
                      </div>
                    </div>
                    <div class="row">
                      <div class="form-group col-sm-6">
                        <label class="control-label" for="phone">Teléfono</label>
                        <input type="text" class="form-control" id="phone" name="phone" value="{{$business->phone}}" required>
                      </div>
                      <div class="form-group col-sm-6">
                        <label class="control-label" for="tax_id">NIT</label>
                        <input type="text" class="form-control" id="tax_id" name="tax_id" value="{{$business->tax_id}}" required>
                      </div>
                    </div>
                    <div class="row">
                      <div class="form-group col-sm-6">
                        <label class="control-label" for="business_name">Nombre Comercial</label>
                        <input type="text" class="form-control" id="business_name" name="business_name" value="{{$business->business_name}}" required>
                      </div>
                      <div class="form-group col-sm-6">
                        <label class="control-label" for="legal_name">Razón Social</label>
                        <input type="text" class="form-control" id="legal_name" name="legal_name" value="{{$business->legal_name}}" required>
                      </div>
                    </div>
                    <div class="row">
                      <div class="form-group col-sm-6">
                        <label class="control-label" for="ownership_type">Regimen tributario</label>
                          <select name="ownership_type" id="ownership_type" class="form-control" required>
                            <option value="{{$business->ownership_type}}">{{$business->ownership_type}}</option>
                              <option value="Comerciante Individual">Comerciante Individual</option>
                              <option value="Persona Juridica">Persona Juridica (Sociedades)</option>
                              <option value="Pequeño Contribuyente">Pequeño Contribuyente</option>
                              <option value="Profesion Liberal">Profesion Liberal</option>
                              <option value="Medico">Médicos</option>
                              <option value="Fundaciones, Iglesias, Universidades">Fundaciones, Iglesias, Universidades, ONG</option>
                              <option value="Copropiedades">Copropiedades con representación legal</option>
                          </select>
                      </div>
                      <div class="form-group col-sm-6">
                        <label class="control-label" for="date_foundation">Fecha de inicio de operaciones o constitución</label>
                        <input type="date" class="form-control" id="date_foundation" name="date_foundation" value="{{$business->date_foundation}}" required>
                      </div>
                    </div>
                    <h3 class="panel-title">Representante / Propietario</h3>
                    <div class="row">
                      <div class="form-group col-sm-6">
                        <label class="control-label" for="tax_regime">Datos de: </label>
                          <select name="tax_regime" id="tax_regime" class="form-control" required>
                            <option value="{{$business->tax_regime}}" required>{{$business->tax_regime}}</option>
                              <option value="Representante Legal">Representante Legal</option>
                              <option value="Propietario">Propietario</option>
                          </select>
                      </div>
                      <div class="form-group col-sm-6">
                        <label class="control-label" for="name_representative">Nombre Completo</label>
                        <input type="text" class="form-control" id="name_representative" name="name_representative" value="{{$business->name_representative}}" required>
                      </div>
                    </div>
                    <div class="row">
                      <div class="form-group col-sm-6">
                        <label class="control-label" for="representative_type">Tipo de Documento: </label>
                          <select name="representative_type" id="representative_type" class="form-control" required>
                            <option value="{{$business->representative_type}}">{{$business->representative_type}}</option>
                              <option value="DPI">DPI</option>
                              <option value="Pasaporte">Pasaporte</option>
                          </select>
                      </div>
                      <div class="form-group col-sm-6">
                        <label class="control-label" for="id_representative">No. de Documento</label>
                        <input type="text" class="form-control" id="id_representative" name="id_representative" value="{{$business->id_representative}}" required>
                      </div>
                    </div>
										
										<div class="row">
                      <div class="form-group col-sm-6">
                        <label class="control-label" for="representative_email">Correo electrónico: </label>
                          <input type="text" class="form-control" name="representative_email" value="{{$business->representative_email}}" required>
                      </div>
                      <div class="form-group col-sm-6">
                        <label class="control-label" for="representative_phone">Teléfono</label>
                        <input type="text" class="form-control" name="representative_phone" value="{{$business->representative_phone}}" required>
                      </div>
                    </div>
											
										
											
											<h3 class="panel-title">Referencias comerciales</h3>
                    <div class="row">
                      <div class="form-group col-sm-6">
											   <label class="control-label" for="representative_type">Nombre: </label>
                         <input type="text" class="form-control" name="references_information[business_references][1][name]" value="{{$business->references_information['business_references']['1']['name']}}" required>
                          
                      </div>
                      <div class="form-group col-sm-6">
											   <label class="control-label" for="representative_type">Teléfono: </label>
                         <input type="text" class="form-control" name="references_information[business_references][1][phone]" value="{{$business->references_information['business_references']['1']['phone']}}" required>
                          
                      </div>
											
                    </div>
										
										<div class="row">
                      <div class="form-group col-sm-6">
											   <label class="control-label" for="representative_type">Nombre: </label>
                         <input type="text" class="form-control" name="references_information[business_references][2][name]" value="{{$business->references_information['business_references']['2']['name']}}" required>
                          
                      </div>
                      <div class="form-group col-sm-6">
											   <label class="control-label" for="representative_type">Teléfono: </label>
                         <input type="text" class="form-control" name="references_information[business_references][2][phone]" value="{{$business->references_information['business_references']['2']['phone']}}"  required>
                          
                      </div>
											
                    </div>
											
											
											
										<h3 class="panel-title">Referencias personales (no familiares)</h3>
                    <div class="row">
                      <div class="form-group col-sm-6">
											   <label class="control-label" for="representative_type">Nombre: </label>
                         <input type="text" class="form-control" name="references_information[personal_references][1][name]" value="{{$business->references_information['personal_references']['1']['name']}}" required>
                          
                      </div>
                      <div class="form-group col-sm-6">
											   <label class="control-label" for="representative_type">Teléfono: </label>
                         <input type="text" class="form-control" name="references_information[personal_references][1][phone]" value="{{$business->references_information['personal_references']['1']['phone']}}" required>
                          
                      </div>
											
                    </div>
											
										<div class="row">
                      <div class="form-group col-sm-6">
											   <label class="control-label" for="representative_type">Nombre: </label>
                         <input type="text" class="form-control" name="references_information[personal_references][2][name]" value="{{$business->references_information['personal_references']['2']['name']}}" required>
                          
                      </div>
                      <div class="form-group col-sm-6">
											   <label class="control-label" for="representative_type">Teléfono: </label>
                         <input type="text" class="form-control" name="references_information[personal_references][2][phone]" value="{{$business->references_information['personal_references']['2']['phone']}}" required>
                          
                      </div>
											
                    </div>
										
											
										<h3 class="panel-title">Referencias bancarias</h3>
											
										<div class="row">
                      <div class="form-group col-sm-6">
											   <label class="control-label" for="representative_type">Referencia #1: </label>
                         <input type="text" class="form-control" name="references_information[banking_references][1][name]" value="{{$business->references_information['banking_references']['1']['name']}}" required>
                          
                      </div>
                      <div class="form-group col-sm-6">
											   <label class="control-label" for="representative_type">Referencia #2: </label>
                         <input type="text" class="form-control"  name="references_information[banking_references][2][name]" value="{{$business->references_information['banking_references']['2']['name']}}" required>
                          
                      </div>
											
                    </div>
											
										<h3 class="panel-title">Información adicional de comercio</h3>
											
										<div class="row">
											<div class="form-group col-sm-6">
											   <label class="control-label" for="dangerous_neighborhood">¿Su comercio está ubicado en zona roja? </label>
                         
												 
												 <div class="radio-custom radio-primary">
													<input id="dangerous_neighborhood_1" name="dangerous_neighborhood" value="1" type="radio" {{ $business->dangerous_neighborhood == 1 ?  "checked" : '' }}>
													<label for="dangerous_neighborhood_1">Sí</label>
												 </div>
												<div class="radio-custom radio-primary">
														
													<input id="dangerous_neighborhood_0" name="dangerous_neighborhood" value="0" type="radio" {{ $business->dangerous_neighborhood == 0 ?  "checked" : '' }}>
													<label for="dangerous_neighborhood_0">No</label>
												 </div>  
													
													
                      </div>
                      
											<div class="form-group col-sm-6">
											   <label class="control-label" for="business_surveillance">¿Cuáles son sus sistemas de seguridad (ej: alarmas, cámaras, guardias de seguridad)? </label>
                         
												 <div class="radio-custom radio-primary">
													<input id="business_surveillance" name="business_surveillance" value="ALARMA" type="radio" {{ $business->business_surveillance == 'ALARMA' ?  "checked" : '' }}>
													<label for="business_surveillance">Alarma</label>
												 </div>
												 
												 <div class="radio-custom radio-primary">
													<input id="business_surveillance" name="business_surveillance" value="CAMARA" type="radio" {{ $business->business_surveillance == 'CAMARA' ?  "checked" : '' }}>
													<label for="business_surveillance">Cámaras</label>
												 </div>
													
													<div class="radio-custom radio-primary">
													<input id="business_surveillance" name="business_surveillance" value="GUARDIAS DE SEGURIDAD" type="radio" {{ $business->business_surveillance == 'GUARDIAS DE SEGURIDAD' ?  "checked" : '' }}>
													<label for="business_surveillance">Guardias de seguridad</label>
												 </div>
                        
                         
                          <div class="radio-custom radio-primary">
													<input id="business_surveillance" name="business_surveillance" value="OTRO" type="radio"
                            @if( !in_array($business->business_surveillance, ['ALARMA', 'CAMARA', 'GUARDIAS DE SEGURIDAD']) ) checked @endif
                          >
													<label for="business_surveillance">Otro</label>
                            <input type="text" class="form-control" id="business_surveillance-other" name="business_surveillance_other"
                            value="@if( !in_array($business->business_surveillance, ['ALARMA', 'CAMARA', 'GUARDIAS DE SEGURIDAD']) ) {{ $business->business_surveillance }} @endif" maxlength="100" required
                            @if( in_array($business->business_surveillance, ['ALARMA', 'CAMARA', 'GUARDIAS DE SEGURIDAD']) ) disabled @endif
                            >
												 </div>
                          
                    
  
                      </div>
										
            
                    </div>
										
										<div class="row">
                      
											<div class="form-group col-sm-6">
											   <label class="control-label" for="address_location_reference">¿Su comercio está ubicado en algún edificio, centro comercial o zona residencial? </label>
                         
												 
												<div class="radio-custom radio-primary">
													<input id="address_location_reference" name="address_location_reference" value="EDIFICIO" type="radio" {{ $business->address_location_reference == 'EDIFICIO' ?  "checked" : '' }}>
													<label for="address_location_reference">Edificio</label>
												 </div>
													
												<div class="radio-custom radio-primary">
													<input id="address_location_reference" name="address_location_reference" value="CENTRO COMERCIAL" type="radio" {{ $business->address_location_reference == 'CENTRO COMERCIAL' ?  "checked" : '' }}>
													<label for="address_location_reference">Centro comercial</label>
												 </div>
													
												<div class="radio-custom radio-primary">
													<input id="address_location_reference" name="address_location_reference" value="ZONA RESIDENCIAL" type="radio" {{ $business->address_location_reference == 'ZONA RESIDENCIAL' ?  "checked" : '' }}>
													<label for="address_location_reference">Zona residencial</label>
												 </div>
												
                        <div class="radio-custom radio-primary">
													<input id="address_location_reference" name="address_location_reference" value="OTRO" type="radio"
                            @if( !in_array($business->address_location_reference, ['EDIFICIO', 'CENTRO COMERCIAL', 'ZONA RESIDENCIAL']) ) checked @endif
                          >
													<label for="address_location_reference">Otro</label>
                            <input type="text" class="form-control" id="address_location_reference-other" name="address_location_reference_other"
                            value="@if( !in_array($business->address_location_reference, ['EDIFICIO', 'CENTRO COMERCIAL', 'ZONA RESIDENCIAL']) ) {{ $business->address_location_reference }} @endif" maxlength="100" required
                            @if( in_array($business->address_location_reference, ['EDIFICIO', 'CENTRO COMERCIAL', 'ZONA RESIDENCIAL']) ) disabled @endif
                            >
												 </div>
													
                      </div>
												
												<div class="form-group col-sm-6">
											   <label class="control-label" for="business_advertising">¿Su comercio está señalizado (ej: vallas, rótulos, etc.) o tiene mercadería a la vista? </label>
                         
												 <div class="radio-custom radio-primary">
													<input id="business_advertising" name="business_advertising" value="VALLAS" type="radio" {{ $business->business_advertising == 'VALLAS' ?  "checked" : '' }}>
													<label for="business_advertising">Vallas</label>
												 </div>
													
													<div class="radio-custom radio-primary">
													<input id="business_advertising" name="business_advertising" value="ROTULOS" type="radio" {{ $business->business_advertising == 'ROTULOS' ?  "checked" : '' }}>
													<label for="business_advertising">Rótulos</label>
												 </div>
													
													<div class="radio-custom radio-primary">
													<input id="business_advertising" name="business_advertising" value="MERCADERIA A LA VISTA" type="radio" {{ $business->business_advertising == 'MERCADERIA A LA VISTA' ?  "checked" : '' }}>
													<label for="business_advertising">Mercadería a la vista</label>
												 </div>
                          
                          
                         <div class="radio-custom radio-primary">
													<input id="business_advertising" name="business_advertising" value="OTRO" type="radio"
                            @if( !in_array($business->business_advertising, ['VALLAS', 'ROTULOS', 'MERCADERIA A LA VISTA']) ) checked @endif
                          >
													<label for="business_advertising">Otro</label>
                            <input type="text" class="form-control" id="business_advertising-other" name="business_advertising_other"
                            value="@if( !in_array($business->business_advertising, ['VALLAS', 'ROTULOS', 'MERCADERIA A LA VISTA']) ) {{ $business->business_advertising }} @endif" maxlength="100" required
                             @if( in_array($business->business_advertising, ['VALLAS', 'ROTULOS', 'MERCADERIA A LA VISTA']) ) disabled @endif
                            >
												 </div>
                          
                      </div>
											
                    </div>
											
										
                         
										
                    <div class="form-group col-sm-12"></div>
                      <div class="col-md-3">
                        <a data-original-title="Regresar" class="btn btn-default" href="{{URL::to('step2',$business->business_id)}}"><i class="icon wb-arrow-left"></i>Regresar</a>
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
