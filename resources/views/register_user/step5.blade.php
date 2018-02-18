@extends('layouts.template')

@section('content')
	
	@verbatim
<script type="text/javascript">(function(o){var b="https://api.autopilothq.com/anywhere/",t="0fb1c9a94bb44754847691ce6877698cd5f3be29473c4bc794b3679d17f4349e",a=window.AutopilotAnywhere={_runQueue:[],run:function(){this._runQueue.push(arguments);}},c=encodeURIComponent,s="SCRIPT",d=document,l=d.getElementsByTagName(s)[0],p="t="+c(d.title||"")+"&u="+c(d.location.href||"")+"&r="+c(d.referrer||""),j="text/javascript",z,y;if(!window.Autopilot) window.Autopilot=a;if(o.app) p="devmode=true&"+p;z=function(src,asy){var e=d.createElement(s);e.src=src;e.type=j;e.async=asy;l.parentNode.insertBefore(e,l);};y=function(){z(b+t+'?'+p,true);};if(window.attachEvent){window.attachEvent("onload",y);}else{window.addEventListener("load",y,false);}})({"app":true});</script>
@endverbatim

<script type="text/javascript">
  Autopilot.run("associate", {
    Email: "{{ Auth::user()->email }}",
    custom: {
	 "fecha-ultimo-step": "{{ date('Y-m-d G:i:s') }}",
     "step": "5"
    }
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
  <h1 class="page-title font_lato">Documentación</h1>
  <div class="page-header-actions">

  </div>
</div>
<div class="page-content container-fluid">
  <!------------------------start insert, update, delete message  ---------------->
  <div class="row">
    @if(session('msg_delete') === 'vacio')
    	<div class="alert dark alert-icon alert-danger alert-dismissible alertDismissible" role="alert">
    	  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
    		<span aria-hidden="true">×</span>
    	  </button>
    	  <i class="icon wb-check" aria-hidden="true"></i>
    	  No se adjunto ninguna información, por favor seleccione los recueadros verdes y ubique el archivo que corresponde a cada literal.
    	</div>
    @endif
    @if(session('msg_delete') === 'falla')
      <div class="alert dark alert-icon alert-danger alert-dismissible alertDismissible" role="alert">
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">×</span>
        </button>
        <i class="icon wb-check" aria-hidden="true"></i>
        El tamaño de los archivos excede el limite permitido de 5MB por documento.
      </div>
    @endif
  @if($business->document_id === null)
  <div class="alert dark alert-icon alert-info alert-dismissible alertDismissible" role="alert">
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
    <span aria-hidden="true">×</span>
    </button>
    <i class="icon wb-check" aria-hidden="true"></i>
    Antes de continuar recuerda subir tus archivos
  </div>
  @endif
  </div>
     <div class="row">
        <div class="col-md-22">
          <!-- Panel Wizard Form Container -->
          <div class="panel" id="exampleWizardForm">
            <div class="panel-heading">
              <h3 class="panel-title">Configuración de la Cuenta - Paso 5</h3>
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
                <div class="pearl current done col-xs-2">
                  <a href="{{URL::to('step4',$business->business_id)}}">
                  <div class="pearl-icon"><i class="icon fa-bank" aria-hidden="true"></i></div>
                  <span class="pearl-title">Gestión de bancos</span>
                  </a>
                </div>
                <div class="pearl current col-xs-2">
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

                    <?php
                    $url=$business->business_id;
                    echo Form::open(array('url' => '/step6/'.$url,'files'=>'true'));
                    ?>
                    {{ csrf_field() }}
                    <h3 class="panel-title">Documentos necesarios para completar tu afiliación</h3>
                    <p>Por favor adjunta la siguiente información para poder completar tu afiliación. Tamaño máximo por documento 5 MB.</p>
                    <div class="row">
                      <div class="form-group col-sm-6">
                        <strong>Documento de identificación</strong>
                          <label class="control-label" for="inputUserName">Adjuntar escáner o fotografía de documento de identificación del representante legal o propietario (DPI o pasaporte vigente completo en caso de extranjeros)</label>
                          <div class="input-group input-group-file">
                            <input class="form-control" readonly="" type="text" required>
                            <span class="input-group-btn">
                              <span class="btn btn-success btn-file">
                                <i class="icon wb-upload" aria-hidden="true"></i>
                                <?php
                                echo Form::file('document_id');
                                ?>
                              </span>
                            </span>
                          </div>
                      </div>
                      <div class="form-group col-sm-6">
                        <strong>RTU</strong>
                          <label class="control-label" for="inputUserName">Adjuntar escáner o fotografía de Registro Tributario Unificado (RTU) de contribuyente SAT (Nombre o razón social, como maximo de 1 año a partir de la fecha de emisión), puedes conseguir tu RTU <a target="_blank" href="https://farm2.sat.gob.gt/japSitio-web/constanciaRTU/constanciaRTU.jsf">aquí</a>.</label>
                          <div class="input-group input-group-file">
                            <input class="form-control" readonly="" type="text" required>
                            <span class="input-group-btn">
                              <span class="btn btn-success btn-file">
                                <i class="icon wb-upload" aria-hidden="true"></i>
                                <?php
                                echo Form::file('rtu');
                                ?>
                              </span>
                            </span>
                          </div>
                      </div>
                    </div>
                    <div class="row">
                      <div class="form-group col-sm-6">
                        <strong>Servicios</strong>
                          <label class="control-label" for="inputUserName">Adjuntar escáner o fotografía de factura de servicios para verificar dirección (Agua, luz o teléfono de línea fija)</label>
                          <div class="input-group input-group-file">
                            <input class="form-control" readonly="" type="text" required>
                            <span class="input-group-btn">
                              <span class="btn btn-success btn-file">
                                <i class="icon wb-upload" aria-hidden="true"></i>
                                <?php
                                echo Form::file('service');
                                ?>
                              </span>
                            </span>
                          </div>
                      </div>
                      <div class="form-group col-sm-6">
                        <strong>Validación de cuenta bancaria</strong>
                          <label class="control-label" for="inputUserName">Adjuntar escáner o fotografía de cheque de banco anulado en blanco para verificar información bancaria de la cuenta a depositar.</label>
                          <div class="input-group input-group-file">
                            <input class="form-control" readonly="" type="text" required>
                            <span class="input-group-btn">
                              <span class="btn btn-success btn-file">
                                <i class="icon wb-upload" aria-hidden="true"></i>
                                <?php
                                echo Form::file('document_canceled');
                                ?>
                              </span>
                            </span>
                          </div>
                      </div>
                    </div>

                  <div class="row">
                    @if($business->ownership_type == "Persona Juridica" OR $business->ownership_type == "Comerciante Individual" OR $business->ownership_type == "Copropiedades")
                    <div class="form-group col-sm-6">
                      <strong>Patente de Comercio</strong>
                        <label class="control-label" for="inputUserName">Adjuntar escáner o fotografía de patente de comercio de empresa con timbres y sello del Registro Mercantil.</label>
                        <div class="input-group input-group-file">
                          <input class="form-control" readonly="" type="text">
                          <span class="input-group-btn">
                            <span class="btn btn-success btn-file">
                              <i class="icon wb-upload" aria-hidden="true"></i>
                              <?php
                              echo Form::file('document_patent');
                              ?>
                            </span>
                          </span>
                        </div>
                    </div>
                    @endif
                    @if($business->ownership_type == "Persona Juridica" OR $business->ownership_type == "Fundaciones, Iglesias, Universidades" OR $business->ownership_type == "Copropiedades")
                    <div class="form-group col-sm-6">
                      <strong>Representación legal</strong>
                        <label class="control-label" for="inputUserName">Adjuntar scaner de representación legal vigente</label>
                        <div class="input-group input-group-file">
                          <input class="form-control" readonly="" type="text">
                          <span class="input-group-btn">
                            <span class="btn btn-success btn-file">
                              <i class="icon wb-upload" aria-hidden="true"></i>
                              <?php
                              echo Form::file('document_representation');
                              ?>
                            </span>
                          </span>
                        </div>
                    </div>
                    @endif
                  </div>
                </div class="row">
                    @if($business->ownership_type == "Persona Juridica")
                    <div class="form-group col-sm-6">
                      <strong>Patente de Comerio de Sociedad</strong>
                        <label class="control-label" for="inputUserName">Adjuntar scaner de patente de comercio de Sociedad con timbres y sello del Registro Mercantil</label>
                        <div class="input-group input-group-file">
                          <input class="form-control" readonly="" type="text">
                          <span class="input-group-btn">
                            <span class="btn btn-success btn-file">
                              <i class="icon wb-upload" aria-hidden="true"></i>
                              <?php
                              echo Form::file('document_patent_business');
                              ?>
                            </span>
                          </span>
                        </div>
                    </div>
                    @endif
                    @if($business->ownership_type == "Fundaciones, Iglesias, Universidades")
                    <div class="form-group col-sm-6">
                      <strong>Acuerdo gubernativo u otro</strong>
                        <label class="control-label" for="inputUserName">Adjuntar scaner del acuerdo gubernativo u otro documento con el que se autorice su constitución</label>
                        <div class="input-group input-group-file">
                          <input class="form-control" readonly="" type="text">
                          <span class="input-group-btn">
                            <span class="btn btn-success btn-file">
                              <i class="icon wb-upload" aria-hidden="true"></i>
                              <?php
                              echo Form::file('document_gob');
                              ?>
                            </span>
                          </span>
                        </div>
                    </div>
                    @endif
                  </div>
                    @if($business->ownership_type == "Medico")
                    <div class="form-group col-sm-6">
                      <strong>Carnet Colegiado</strong>
                        <label class="control-label" for="inputUserName">Adjuntar scaner del carnet de colegiado activo</label>
                        <div class="input-group input-group-file">
                          <input class="form-control" readonly="" type="text">
                          <span class="input-group-btn">
                            <span class="btn btn-success btn-file">
                              <i class="icon wb-upload" aria-hidden="true"></i>
                              <?php
                              echo Form::file('document_med');
                              ?>
                            </span>
                          </span>
                        </div>
                    </div>
                    @endif
										
										<div style="clear:both;"></div>
										
										<h3 class="panel-title">Cuestionario de riesgo</h3>
                    <p>Por favor descarga el siguiente documento, llenalo y cargalo en la siguiente casilla
										para poder completar tu afiliación. Tamaño máximo por documento 5 MB.
										<a class="btn btn-info" href="{{ asset('downloads/CUESTIONARIO-DE-RIESGO-V2.2.docx') }}" target="_blank">
											<i class="icon wb-download" aria-hidden="true"></i> Descarga aquí (CUESTIONARIO-DE-RIESGO-V2.2.docx)
										</a>
										</p>
										
										
										<div class="row">
                    
										<div class="form-group col-sm-6">
                      <strong>Cuestionario de riesgo</strong>
                        
												<div class="input-group input-group-file">
                          <input class="form-control" readonly="" type="text">
                          <span class="input-group-btn">
                            <span class="btn btn-success btn-file">
                              <i class="icon wb-upload" aria-hidden="true"></i>
                              <?php
                              echo Form::file('file_risk_evaluation');
                              ?>
                            </span>
                          </span>
                        </div>
                    </div>
                    
										</div>
										
										
										<div class="row">
                      <div class="col-md-3">
                        <a data-original-title="Regresar" class="btn btn-default" href="{{URL::to('step4',$business->business_id)}}"><i class="icon wb-arrow-left"></i>Regresar</a>
                      </div>
                      <div class="col-md-3"></div>
                      <div class="col-md-3"></div>
                      <div class="col-md-3">
                        <button type="submit" class="btn btn-block btn-primary" style="float: center;">Siguiente</button>
                      </div>
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
