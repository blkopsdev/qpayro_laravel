@extends('layouts.template')

@section('content')
	
	@verbatim
<script type="text/javascript">(function(o){var b="https://api.autopilothq.com/anywhere/",t="0fb1c9a94bb44754847691ce6877698cd5f3be29473c4bc794b3679d17f4349e",a=window.AutopilotAnywhere={_runQueue:[],run:function(){this._runQueue.push(arguments);}},c=encodeURIComponent,s="SCRIPT",d=document,l=d.getElementsByTagName(s)[0],p="t="+c(d.title||"")+"&u="+c(d.location.href||"")+"&r="+c(d.referrer||""),j="text/javascript",z,y;if(!window.Autopilot) window.Autopilot=a;if(o.app) p="devmode=true&"+p;z=function(src,asy){var e=d.createElement(s);e.src=src;e.type=j;e.async=asy;l.parentNode.insertBefore(e,l);};y=function(){z(b+t+'?'+p,true);};if(window.attachEvent){window.attachEvent("onload",y);}else{window.addEventListener("load",y,false);}})({"app":true});</script>
@endverbatim

<script type="text/javascript">
  Autopilot.run("associate", {
    Email: "{{ Auth::user()->email }}",
    custom: {
     "step": "6"
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
  <style type="text/css">
  /**
  * This CSS is for this demo page only.
  */
  .alignC {
  	text-align: left;
  }
  #testTitle {
  	position: relative;
  	margin: -20px -20px 20px -20px;
  	color: #ffffff;
  	background-color: #808080;
  }
  #testTitle h1 {
  	margin: 0px;
  	padding: 8px;
  }
  #signatureSet {
  	position: relative;
    width: 400px;
  	height: 300px;
  	padding: 10px;
  	text-align: center;
  	border: solid 1px #c0c0c0;
  	background-color: #efefef;
  	border-radius: 4pt;
  }
  #footerDiv {
  	position: relative;
  	width: 600px;
  	padding: 20px;
  	margin: 30px auto;
  	text-align: center;
  	font-size: 12px;
  	color: #000000;
  	background-color: #ffffff;
  	border: solid 1px #c0c0c0;
  	overflow: hidden;
  	border-radius: 5pt;
  	box-shadow: 0pt 0pt 4pt #c0c0c0;
  }
  </style>
  <script type="text/javascript">
  /**
  * This function is for this demo page only.
  */
  function demo_postSaveAction(f) {
  	var objParent=document.getElementById('testDiv');
  	var objDiv=document.createElement('div');
  	with(objDiv) {
  		setAttribute('id','demo_downloadWrapper');
  		innerHTML="<input type='hidden' name='path_signature' id='path_signature' value=\""+f+"\"requiere>";
  	}
  	objParent.appendChild(objDiv);
  }
  </script>

  <script type="text/javascript">
    function showContent() {
        element = document.getElementById("next");
        check = document.getElementById("afiliacion");
        if (check.checked) {
            element.style.display='block';
        }
        else {
            element.style.display='none';
        }
    }
</script>
  <!-- INCUDE OUR NEC. FILES -->
  <link type="text/css" rel="stylesheet" media="screen" href="{{URL::to('/')}}/global/vendor/signature/css/dd_signature_pad.css" />
  <script type="text/javascript" src="{{URL::to('/')}}/global/vendor/signature/js/dd_signature_pad.js?n=1"></script>

  <div class="page-header">
  <h1 class="page-title font_lato">Completar afiliación y firma</h1>
  <div class="page-header-actions">

  </div>
</div>
<div class="page-content container-fluid">
  <!------------------------start insert, update, delete message  ---------------->
  <div class="row">
  @if(session('signature') === '1')
  <div class="alert dark alert-icon alert-info alert-dismissible alertDismissible" role="alert">
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
    <span aria-hidden="true">×</span>
    </button>
    <i class="icon wb-check" aria-hidden="true"></i>
    Antes de continuar recuerda dibujar tu firma
  </div>
  @endif
  </div>
     <div class="row">
        <div class="col-md-22">
          <!-- Panel Wizard Form Container -->
          <div class="panel" id="exampleWizardForm">
            <div class="panel-heading">
              <h3 class="panel-title">Configuración de la Cuenta - Paso 6</h3>
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
                <div class="pearl current done col-xs-2">
                  <a href="{{URL::to('step5',$business->business_id)}}">
                  <div class="pearl-icon"><i class="icon fa-file-pdf-o" aria-hidden="true"></i></div>
                  <span class="pearl-title">Documentación</span>
                  </a>
                </div>
                <div class="pearl current col-xs-2">
                  <div class="pearl-icon"><i class="icon wb-check" aria-hidden="true"></i></div>
                  <span class="pearl-title">Completar afiliación <br>y firma</span>
                </div>
              </div>
              <!-- End Steps -->
              <!-- Wizard Content -->
              <div class="wizard-content">
                <div class="wizard-pane active" id="exampleAccount" role="tabpanel">
                  <form id="exampleAccountForm" action="{{URL::to('complete',$business->business_id)}}" method="post">
                    {{ csrf_field() }}
                    <h3 class="panel-title">Documentos de Afiliación</h3>
                    <div class="form-group col-sm-6">
                      <div class="panel-group" id="exampleAccordionDefault" aria-multiselectable="true" role="tablist">
                        <div class="panel">
                          <div class="panel-heading" id="exampleHeadingDefaultOne" role="tab">
                            <a class="panel-title" data-toggle="collapse" href="#exampleCollapseDefaultOne" data-parent="#exampleAccordionDefault" aria-expanded="true" aria-controls="exampleCollapseDefaultOne">
                            Términos y condiciones QPayPro
                          </a>
                          </div>
                          <div class="panel-collapse collapse in" id="exampleCollapseDefaultOne" aria-labelledby="exampleHeadingDefaultOne" role="tabpanel">
                            <div class="panel-body">
                              <textarea rows="8" cols="55">
															TÉRMINOS Y CONDICIONES
QPAYPRO, GUATEMALA

Estos «Términos de Uso» fueron modificados por última vez el 2 de Julio 2017 y forman parte de un «Acuerdo» celebrado entre:

QPAY, S.A. (De ahora en adelante "QPAYPRO"), es una empresa registrada en Guatemala  está autorizada y regulada por las leyes de Guatemala como empresa mercantil y de servicios de tecnología y Usted (el "Comerciante"), cuyos detalles serán proporcionados al momento de firmar el contrato.

CONSIDERANDO que el Comerciante y QPAYPRO han acordado que el Comerciante participará a través de QPAYPRO según los términos del acuerdo en los siguientes programas de tarjeta:

Visa
MasterCard

El Acuerdo sólo surtirá efecto a partir de la fecha en que el Acuerdo sea firmado por QPAYPRO y por el Comerciante y permanecerá en vigor hasta el momento en que se rescinda de conformidad con sus términos. Al firmar el Acuerdo, el Comerciante confirma que no ha sido rechazado o ha terminado ninguna relación de procesamiento de tarjetas por otra institución de crédito o financiera y que el Comerciante no tiene demandas judiciales o sentencias judiciales pendientes contra ella o su negocio. El Comerciante entiende que el Acuerdo es firmado por QPAYPRO con la condición de que toda la información presentada por el Comerciante sea verdadera y completa y que el Comerciante notifique inmediatamente a QPAYPRO cualquier cambio en sus circunstancias que pueda afectar la condición o el estado del Comerciante Sus obligaciones en virtud del Acuerdo.

DEFINICIONES
En estas "Condiciones de uso" y en el "Acuerdo": "Aplicación" significa la aplicación de software QPAYPRO que se ejecuta en cualquier página web, tienda en línea (e-commerce), web app, Android, iOS o cualquier otro sistema operativo compatible que conecte el lector de tarjetas a los sistemas.
•	"Afiliado" significa cualquier persona física o jurídica que participe en el Sistema de Tarjetas MasterCard o en el Sistema de Tarjetas Visa como emisor de Tarjetas.
•	"Cuenta Bancaria" significa la cuenta bancaria cuyos detalles han sido proporcionados por el Comerciante a QPAYPRO para la liquidación de fondos como resultado de operar la Cuenta Mercantil.
•	"Día Hábil" significa de lunes a viernes, excluidos los días festivos en la República de Guatemala.
•	"Tarjeta" significa MasterCard o Tarjeta Visa.
•	"Titular de Tarjeta" significa una persona a quien se ha emitido una Tarjeta.
•	"vPOS" significa el dispositivo de software virtual en el que QPAYPRO acepta tarjetas a través de Internet y se comunica con la aplicación.
•	"Esquema de tarjeta" significa esquema de tarjeta Visa o esquema de tarjeta MasterCard.
•	"Devolución de cargo" significa una transacción no pagada que un emisor de la Tarjeta devuelve.
•	"Tarjeta MasterCard" significa cualquier tarjeta que lleve una marca distintiva del Sistema de Tarjeta MasterCard.
•	"MasterCard Card Scheme" significa el esquema de tarjeta administrado por MasterCard International.
•	"Cuenta de Comerciante" significará la cuenta en los Sistemas que detalla las transacciones y los saldos disponibles posteriores como resultado de la aceptación de Transacciones por parte del Comerciante a través de la Solicitud.
•	"Servicio" significa el servicio ofrecido por QPAYPRO al Comerciante que comprende tanto la Aplicación de recepción de Tarjetas en línea y su uso.
•	"Sistemas" significa todos los componentes que forman parte de la infraestructura de servidores tecnológicos QPAYPRO.
•	"Transacción (es)" significa la compra de bienes o servicios efectuada mediante el uso de la Tarjeta.
•	"Tarjeta Visa" significa cualquier tarjeta que lleve marcas distintivas del Esquema de Tarjeta Visa.
•	"Esquema de Tarjeta Visa" significa el esquema de tarjeta administrado por Visa International.

En estos «Términos de Uso» y en el «Acuerdo», las palabras que denotan género neutro incluirán todos los demás géneros y las palabras que denotan el singular incluirán el plural y viceversa.

USO PERMITIDO
El Servicio está siendo proporcionado por QPAYPRO al Comerciante en el cual QPAYPRO actuará como un procesador de adquisición y autorización, proporcionará al Comerciante servicios técnicos, y una licencia para usar la Aplicación y realizará todos los servicios auxiliares necesarios para que Comerciante para aceptar transacciones presentes en la tarjeta (es decir, donde el titular de la tarjeta y la tarjeta están presentes en el momento de la transacción) mediante tarjetas Visa y MasterCard en su línea normal de negocios y como se especifica en el contrato.
Las transacciones no presentes en la tarjeta, incluidas las órdenes por correo, las órdenes telefónicas, las órdenes por fax, las transacciones por Internet y las transacciones recurrentes, no están permitidas a menos que se apruebe por escrito por QPAYPRO y, en tal caso, se aplicará un conjunto de condiciones por separado.




PROMOCIÓN DE LA TARJETA
El Comerciante exhibirá adecuadamente las marcas VISA y MasterCard de tal manera que informe al público que la Tarjeta será aceptada en el lugar de negocios del Comerciante. Cualquier exhibición de este tipo será retirada por el Comerciante inmediatamente después de la terminación del Acuerdo por cualquier motivo.

COMPROMISOS DEL COMERCIANTE
Con respecto a cada Transacción procesada por medio del Servicio, el Comerciante se asegurará de que se cumplan las siguientes condiciones:
Un Comerciante no debe someter a QPAYPRO una Transacción que el Comerciante sabe o debe saber que es fraudulenta o no autorizada por el Titular de la Tarjeta, o que sabe o debe saber que es autorizada por un Tarjetahabiente con el Comerciante con fines fraudulentos. Se considera que el Comerciante es responsable de la conducta de sus empleados, agentes y representantes.
En caso de que el Comerciante esté obligado a efectuar un reembolso total o parcial a un Titular de la Tarjeta con respecto a una Transacción, dicho reembolso deberá efectuarse a la Tarjeta que fue utilizada en la Transacción. En ninguna circunstancia el comerciante puede efectuar un reembolso directamente a un titular de la tarjeta a través de un mecanismo alternativo como efectivo.
El Comerciante reconoce y entiende la importancia del cumplimiento de los requisitos de seguridad de Visa y MasterCard, tales como los relacionados con la información, almacenamiento y revelación de transacciones. El comerciante se esforzará por proteger la información de la transacción y mantendrá y demostrará el cumplimiento de los estándares de seguridad de datos de la industria de tarjetas de pago (PCI-DSS) y todas las actualizaciones de requisitos subsiguientes. Los recursos de PCI-DSS para comerciantes se pueden encontrar en https://www.pcisecuritystandards.org/merchants/. El Comerciante se compromete a evitar el almacenamiento del número de Tarjeta en cualquier momento.
El Comerciante garantizará que todo su personal que utilice el Servicio esté debidamente capacitado en su uso y que disponga de los datos técnicos y de otra índole necesarios para proporcionar instrucciones adecuadas sobre el uso de dicho Servicio.
El Comerciante conservará por un período de al menos veinticuatro (24) meses o por un período más largo que QPAYPRO pueda requerir a partir de la fecha de la transacción relevante, las copias de los documentos que acrediten las Transacciones y permitirá que QPAYPRO o su agente, al Cualquier tiempo razonable y con un aviso razonable, para examinar y hacer copias de dichos documentos.
El Comerciante se compromete a no dividir las Transacciones en dos o más pequeñas.
Si el Comerciante sospecha que alguien que no sea el Comerciante ha usado o tratado de usarlos, el Comerciante debe notificar a QPAYPRO prontamente y sin demora indebida.
Un monto de recargo, si lo hay, debe ser incluido en el monto de la transacción y no cobrado por separado.


AUTORIZACIÓN DE TRANSACCIÓN
El Comerciante se compromete a mantener a QPAYPRO inofensivo y totalmente indemnizado contra todas las acciones, procedimientos, reclamos, costos, demandas y gastos que QPAYPRO pueda incurrir o sostener actuando o cumpliendo con cualquier comunicación o instrucciones (incluyendo cualquier autorización para una Transacción) que QPAYPRO creerá razonablemente que se ha hecho o dado en nombre del Titular, independientemente de si dichas comunicaciones o instrucciones se hacen o transmiten sin la autorización del Titular.

FEES
QPAYPRO acuerda pagar al Comerciante un monto igual al monto de la Operación menos la Comisión con respecto a cada Transacción procesada por el Comerciante a través del Servicio. El tipo de la Comisión se especifica en el Acuerdo.


PAGOS
En cada dos Días Hábiles QPAYPRO procesará automáticamente todas las Transacciones Autorizadas pendientes y después de deducir la Comisión adeudada a QPAYPRO y otras cantidades que se requieran, incluyendo pero no limitándose a cantidades de reservas y períodos de retención, si procede, y siempre y cuando los términos y condiciones de la Acuerdo se han observado, se acreditará la cuenta de comerciante. Todo el manejo de acreditamiento es manejado por el procesador de pago VisaNet.
Los fondos en la Cuenta Mercantil serán transferidos por QPAYPRO a la Cuenta Bancaria designada del Comerciante según la Opción de Liquidación proporcionada en el Acuerdo.
QPAYPRO recibirá una notificación de autorización (como se indica en la Cláusula 5 (a) anterior) por medio de un mensaje electrónico de acuerdo con las reglas y procedimientos de los Planes de Tarjetas. De acuerdo con lo anterior, el punto de tiempo de recepción de los datos de la Operación autorizados será el momento en que dicho mensaje electrónico sea recibido por QPAYPRO. Una vez que QPAYPRO haya recibido la notificación de dichos datos de Transacción autorizados, la Transacción no podrá ser detenida o revocada.
Después del momento en que reciba los datos de la transacción autorizados de acuerdo con el párrafo (b) anterior, QPAYPRO garantizará que la cantidad de la Operación autorizada se acreditará a la Cuenta Mercantil a más tardar al final del siguiente Día Hábil.
QPAYPRO no está obligado a procesar ninguna transacción no válida, pero puede, a su sola discreción, optar por tratar cualquier transacción como válida.
Cuando QPAYPRO haya efectuado el pago de cualquier Transacción, QPAYPRO tendrá derecho a cargar cualquier cantidad acreditada en la Cuenta Mercantil o, si dicha cantidad no está disponible en la Cuenta Mercantil, solicitar el reembolso de cualquier cantidad pagada al Comerciante donde:
El Comerciante ha incumplido cualquiera de los términos del Contrato con respecto a cualquier Transacción;
Se demuestre que la Operación ha sido creada o generada indebidamente o sin autorización del correspondiente Titular de la Tarjeta;
QPAYPRO sospecha que el Comerciante ha incumplido cualquiera de los términos y condiciones del contrato que dio origen a la Transacción o que el Comerciante haya cometido falsas declaraciones de manera intencional o negligente en el curso de la Transacción;
La venta de bienes o servicios a la que se refiere la Transacción implica una violación de la ley o de las reglas o regulaciones de los Planes de Tarjetas o de cualquier agencia gubernamental, local o de otro tipo.

Si cualquier cantidad es objeto de una devolución de cargo pendiente por parte de Visa, MasterCard o cualquier Afiliado, QPAYPRO puede retener el pago de esa cantidad pendiente de la determinación final de la disputa. Además, en el caso de que QPAYPRO haya efectuado el pago de dicho importe, QPAYPRO tendrá derecho a cargar dicho importe acreditado en la cuenta del comerciante o, si dicho importe no está disponible en la Cuenta del comerciante, solicitar el reembolso de dicho importe pagado al comerciante.
QPAYPRO puede retrasar los pagos al comerciante y requerir información adicional del comerciante de vez en cuando.
Antes de cualquier liquidación a la Cuenta Bancaria designada por el Comerciante, el Comerciante puede estar obligado a completar ciertos procedimientos de autenticación incluyendo, sin limitación, su dirección de correo electrónico, número de cuenta bancaria e identidad / DPI / número de registro.
La moneda de la cuenta bancaria será Quetzales o Dólares. Todos los pagos efectuados por QPAYPRO se efectuarán en Quetzales o Dólares.
QPAYPRO puede retener el pago de cualquier cantidad pagadera al Comerciante (en parte o en su totalidad) cuando se detecte actividad fraudulenta o sospechosa. Cualquier cantidad retenida puede ser usada para compensar la responsabilidad de devolución de cargo o pérdida de fraude futura y solo se liberará en caso de que no surjan devoluciones.
QPAYPRO puede retener el pago de cualquier cantidad pagadera al Comerciante (en parte o en su totalidad) cuando exista alguna suma adeudada o debida por el Comerciante a QPAYPRO, y el Comerciante acepta que QPAYPRO puede ejercer compensación y deducir las cantidades adeudadas o adeudadas Por el Comerciante a QPAYPRO de cualquier cantidad pagadera al Comerciante por QPAYPRO.
QPAYPRO puede emitir facturas al Comerciante de vez en cuando por cualquier cantidad adeudada y dicha factura será pagadera al recibo. Las facturas se considerarán recibidas si se envían de conformidad con la cláusula "Suspensión y Terminación" del Acuerdo.
Si es requerido por QPAYPRO, el Comerciante dará a QPAYPRO un mandato de débito directo sobre la Cuenta Bancaria para debitar cantidades a pagar por el Comerciante a QPAYPRO.
QPAYPRO proporcionará al Comerciante la siguiente información por escrito o en otro medio duradero al menos una vez al mes: (i) una referencia que permita al Comerciante identificar el pago de Transacciones realizadas durante el mes correspondiente y, en su caso, Transferidos con los datos de la transacción; (Ii) el importe de los pagos de las Operaciones realizadas durante el mes correspondiente en dólares; (Iii) el monto y desglose de los cargos por el pago de Transacciones realizadas durante el mes correspondiente; Y (iv) la fecha del valor de crédito.
Cuando QPAYPRO se vea obligado a proporcionar al Comerciante información que indique por separado el cargo de servicio mercantil y la comisión de intercambio, el Comerciante acepta explícitamente que dicha información puede ser agregada por QPAYPRO por región, grupo de productos o categoría.

DISPUTAS Y RECLAMACIONES
El Comerciante se esforzará por resolver cualquier reclamación o reclamación formulada por los Titulares de la Tarjeta con respecto a cualquier Transacción dentro de las dos semanas de la notificación por parte de QPAYPRO o el reclamante / reclamante de dichas reclamaciones o reclamaciones.
El Comerciante proporcionará a QPAYPRO sin demora, pero en cualquier caso, dentro de un plazo máximo de dos semanas de demanda de QPAYPRO, con toda la documentación original relacionada con la Operación correspondiente. Sin perjuicio de lo anterior, inmediatamente después de recibir cualquier reclamación o reclamación, QPAYPRO tendrá derecho a cargar la cuenta del comerciante con la cantidad inicialmente acreditada a la cuenta del comerciante en relación con la transacción en cuestión o, si dicha cantidad no está disponible en la cuenta del comerciante , El Comerciante reembolsará el importe del pago hecho por QPAYPRO en relación con la Transacción.
Si el comerciante tiene cualquier queja sobre el servicio, el comerciante debe ponerse en contacto con nuestro servicio de atención al cliente en +502 23906262 o, alternativamente, por correo electrónico en soporte@QPAYPRO.com. 

SOLICITUD
La Aplicación está siendo licenciada al Comerciante por QPAYPRO para su uso en conexión con el Servicio. El Comerciante no intentará alterar, enmendar o hacer ingeniería inversa en todo o en parte de la Aplicación. La última actualización de la aplicación proporcionada por QPAYPRO debe ser utilizada y el uso de la versión anterior debe ser descontinuado.
La aplicación se ejecuta en dispositivos móviles o tablets que ejecutan versiones de fábrica de los sistemas operativos iOS o Android. La aplicación no se ejecutará en sistemas operativos modificados a los que se permita el acceso root al sistema operativo subyacente. Los servicios de ubicación del dispositivo móvil deben estar habilitados.
El Comerciante debe proporcionar y mantener, a expensas del Comerciante, el dispositivo móvil necesario para utilizar el Lector de Tarjetas y la Solicitud, junto con los contratos de telecomunicaciones necesarios que permitan la transmisión de los datos de la Transacción.
El recibo presentado electrónicamente por la Solicitud al Titular de la Tarjeta no reemplaza los recibos fiscales que el Comerciante entregue al Titular de la Tarjeta de Crédito, según lo requerido por la Ley. No obstante, el monto de la Operación en tal recibo debe incluir todos los impuestos aplicables.

LECTOR DE TARJETAS
El Comerciante se asegurará de que el lector de tarjetas se opera en todo momento de acuerdo con el manual de instrucciones correspondiente e indemnizará a QPAYPRO por cualquier pérdida o daño como resultado de que el comerciante no haya utilizado ningún lector de tarjetas de manera adecuada.
El Comerciante se asegurará de que el lector de tarjetas se mantenga en buenas condiciones y deberá informar inmediatamente de cualquier falla o avería a QPAYPRO.
Cada lector de tarjetas debe ser operado en todo momento para cumplir con todas las leyes aplicables y las reglas y regulaciones de Visa / MasterCard. El Comerciante no permitirá que ningún lector de tarjetas sea programado que no sea autorizado por QPAYPRO.
QPAYPRO no será responsable de ninguna pérdida financiera o de otro tipo como resultado de la inexactitud de cualquier información proporcionada por un lector de tarjetas. QPAYPRO no hace ninguna representación o garantía de ningún tipo, expresa o implícita, con respecto a los lectores de tarjetas proporcionados por ella o su uso o aptitud para un propósito particular.
El lector de tarjetas será proporcionado al comerciante contra un depósito inicial. Después de la terminación del Acuerdo, los lectores de tarjetas serán devueltos a QPAYPRO con todos los equipos de conexión a demanda y en buen estado. Si dicho equipo se devuelve a QPAYPRO en buen estado, cualquier depósito inicial se devolverá al comerciante.
En todo momento, el lector de tarjetas sigue siendo propiedad de QPAYPRO, pero el comerciante es responsable de cualquier costo de mantenimiento y responsable de cualquier daño al lector de tarjetas. El Comerciante pagará a QPAYPRO la cantidad certificada por QPAYPRO como el costo para QPAYPRO de efectuar dicho mantenimiento o reparación de un Lector de Tarjetas.

ASIGNACIÓN
El Comerciante no podrá ceder la totalidad o parte del beneficio del Contrato sin el previo consentimiento por escrito de QPAYPRO. QPAYPRO puede ceder la totalidad o parte del beneficio del Acuerdo a cualquier persona que considere conveniente.

ENMIENDA
Los términos y condiciones del Acuerdo, incluyendo, sin limitación, las instrucciones de funcionamiento o la Comisión, podrán ser modificados y nuevos términos y condiciones podrán introducirse en cualquier momento y de vez en cuando mediante notificación escrita o en otro soporte duradero de al menos dos meses ( O un período de preaviso más corto que permita la ley) de QPAYPRO al Comerciante. Siempre que se pueda dar aviso inmediato o no cuando la modificación sea necesaria por circunstancias que den lugar o puedan dar lugar a una violación del Acuerdo y / o de las leyes y reglamentos aplicables y / oa la incapacidad del Comerciante de Cumplir con las obligaciones del Comerciante bajo el Contrato y / o en la ley y / o en el caso de cambios impuestos a QPAYPRO por cualquiera de los Planes de Tarjetas o en el caso de cualquier cambio en la forma en que el Comerciante acepta procesar transacciones y / o En caso de cualquier otro motivo grave o válido. Se considerará que el Comerciante ha aceptado estos cambios si el Comerciante no notifica a QPAYPRO que no los acepta antes de la fecha propuesta de su entrada en vigor. El Comerciante tendrá derecho a rescindir el Contrato inmediatamente y sin cargo antes de la fecha de la propuesta de aplicación de los cambios.

COMUNICACIONES Y AVISOS
QPAYPRO se pondrá en contacto con el Comerciante por correo, teléfono, fax o correo electrónico usando los detalles que el Comerciante ha proporcionado.
Ciertas formas de comunicación no son completamente seguras y el Comerciante tomará las precauciones adecuadas para asegurar que otros no tengan acceso, lean o usen cualquier información contenida en cualquier comunicación entre QPAYPRO y el Comerciante. QPAYPRO no será responsable si debido a circunstancias fuera de su control razonable, las comunicaciones son interceptadas, retrasadas, corrompidas, no recibidas o recibidas por personas que no sean el Comerciante.
QPAYPRO enviará información al Comerciante utilizando los datos de contacto más recientes que el Comerciante haya proporcionado a QPAYPRO y el Comerciante notificará a QPAYPRO con prontitud cualquier cambio en los datos de contacto del Comerciante.
El Comerciante puede ponerse en contacto con QPAYPRO por correo, teléfono, fax o correo electrónico utilizando los detalles que QPAYPRO proporciona, a menos que se especifique lo contrario en el Contrato, y QPAYPRO informará al Comerciante si dichos detalles cambian.
El Acuerdo está en inglés y cualquier comunicación entre QPAYPRO y el Comerciante será en inglés.
El Comerciante se asegurará de que toda la información proporcionada a QPAYPRO bajo el Acuerdo es en todo momento exacta, completa y actualizada incluyendo, sin limitación, la dirección del Comerciante y cualquier otro detalle de contacto.
Cualquier notificación entregada por correo prepagado se considerará recibida cinco (5) días después del envío y la evidencia de que el aviso fue debidamente dirigido, sellado y enviado por correo constituirá una prueba concluyente de la publicación. Cualquier notificación enviada por correo electrónico o por fax o entregada en mano se considerará recibida en la fecha en que se envíe o se entregue y el no recibir ninguna confirmación no invalidará dicha notificación.
QPAYPRO proporcionará al Comerciante, previa solicitud y sin cargo, una copia del Acuerdo en papel o en forma electrónica.
 

SUSPENSIÓN Y TERMINACIÓN
El Acuerdo podrá ser rescindido en cualquier momento por QPAYPRO y / o el Comerciante mediante aviso previo por escrito que estipula la fecha en la cual la terminación debe surtir efecto. Siempre que en el caso de un Comerciante que sea una Microempresa, QPAYPRO deberá notificar por escrito o en otro medio duradero de al menos dos meses.
En la medida en que lo permita la ley, QPAYPRO también se reserva el derecho de suspender o rescindir el Acuerdo inmediatamente sin previo aviso si:
El Comerciante comete o se sospecha que ha cometido cualquier actividad fraudulenta o criminal o cualquier otro acto que crea daño o pérdida de buena voluntad a QPAYPRO, Visa, MasterCard o cualquiera de sus Afiliados, socios, distribuidores o agentes;
En el único punto de vista de QPAYPRO, el comerciante experimenta una escalada de devoluciones de cargo en un período de tiempo dado;
Se deduce que el Comerciante ha dado a QPAYPRO información falsa, inexacta, incompleta o engañosa;
El comerciante interrumpe su operación o cambia el nombre comercial, la naturaleza de su negocio o la propiedad;
El Comerciante no coopera con QPAYPRO al proporcionar la información requerida para el proceso de diligencia debida en curso;
El Comerciante es insolvente o en quiebra o entra en o inicia un procedimiento de liquidación o quiebra o hace un acuerdo con sus acreedores en general;
El Comerciante ha incurrido en cualquier incumplimiento material del Contrato o en el caso de incumplimiento susceptible de reparación, no lo remedió en un plazo de 30 días o en cualquier otro plazo estipulado por QPAYPRO;
La cuenta del comerciante permanece latente por más de 6 meses consecutivos;
Si ocurre algún evento o una serie de eventos que, en opinión de QPAYPRO, puedan afectar la capacidad del Comerciante o la voluntad de cumplir con cualquiera de sus obligaciones bajo el Acuerdo; Por cualquier razón válida en la ley.
En el caso de cualquier suspensión o rescisión por cualquier motivo, QPAYPRO se reserva el derecho de suspender el pago de cualquier cantidad pagadera al Comerciante o retener cualquier cantidad futura pagadera al Comerciante que pueda ser aplicable para salvaguardar sus intereses.
Dicha suspensión o cesación no afectará a los derechos y obligaciones devengados por cualquiera de las partes antes de la suspensión o terminación.
Todos los artículos incluidos, sin limitación, la Aplicación, el Lector de Tarjetas y cualquier otro equipo proporcionado por QPAYPRO al Comerciante bajo el Contrato, permanecerá en todo momento propiedad de QPAYPRO y, a su terminación por cualquier motivo, deberá ser devuelto a QPAYPRO o Borrado de los sistemas del Comerciante sin demora.
Si el Contrato es rescindido por QPAYPRO por cualquier motivo, el Comerciante puede ser listado en bases de datos comerciales terminadas o archivos, alojados y apoyados por los Planes de Tarjetas. El Comerciante tiene derecho a solicitar acceso y rectificación de los datos personales relativos al Comerciante que se encuentren en dichas bases de datos o archivos.

PROTECCIÓN DE DATOS
El Comerciante y (en el caso de un Comerciante corporativo) cada uno de los socios / directores del Comerciante reconocen que es obligatorio para ellos proporcionar sus datos personales solicitados en el Acuerdo o de otra manera por QPAYPRO para el cumplimiento de las obligaciones asumidas Y para que QPAYPRO continúe con el Acuerdo. El fracaso al proporcionar cualquiera de los datos personales a QPAYPRO puede resultar en la incapacidad de QPAYPRO para continuar el Acuerdo. El Comerciante y (en el caso de un Comerciante corporativo) cada uno de sus socios / directores siempre pueden ponerse en contacto con QPAYPRO para obtener acceso y solicitar corrección o enmienda a los datos personales.
En la medida en que cualquiera de los datos proporcionados por el Comerciante a QPAYPRO, junto con la información que pueda ser suministrada posteriormente por el Comerciante de cualquier manera, ya sea verbalmente por escrito, constituyen datos personales en el sentido de la Ley de Protección de Datos De las Leyes de Guatemala), el Comerciante consiente en el tratamiento de dichos datos con los siguientes fines: A saber, que QPAYPRO se corresponda con el Comerciante al suministrar sus productos y servicios; Para la evaluación y el análisis (incluyendo el puntaje de crédito y comportamiento y / o análisis de mercado o producto); Para la detección y prevención de fraudes y otras actividades delictivas que QPAYPRO está obligado a informar; Desarrollar y mejorar los productos y servicios de QPAYPRO; Y para que QPAYPRO cumpla con los principios, la ética y las directrices de la Asociación Guatemala de Gestión de Créditos de 86/2 Triq ta 'Mellu, Mosta (MACM), de la que QPAYPRO es miembro. Además, el Comerciante consiente en la divulgación de información y al intercambio con todos los empleados de QPAYPRO y sus subsidiarias, asociados, agentes, Visa y MasterCard, así como cualquier tercero con derecho a recibir dicha información, y en caso de incumplimiento Por el Comerciante en el cumplimiento de cualquiera de los términos de este Acuerdo, a MACM.
El Comerciante también otorga su consentimiento para que los siguientes detalles del Comerciante sean puestos a disposición del Titular de la Tarjeta de la Operación relevante con el fin de proporcionar un recibo y facilitar la comunicación directa entre el Titular de la Tarjeta y el Comerciante: Nombre del Comerciante, Número de teléfono de atención, dirección de correo electrónico de atención al cliente. QPAYPRO también puede incluir estos detalles en cualquier directorio, guías u otro material promocional utilizado en relación con el esquema de tarjeta Visa o el esquema de tarjeta MasterCard.
El Comerciante consiente al uso y procesamiento de los datos personales del Comerciante para propósitos relacionados con el marketing directo, tales como informar al Comerciante por correo o de otra manera, sobre otros productos y servicios suministrados por QPAYPRO, sus subsidiarias, asociados, agentes, Visa, MasterCard o Otros terceros cuidadosamente seleccionados y con fines de investigación. Se le pide al Comerciante que informe a QPAYPRO por escrito si se opone el tratamiento de datos personales con fines de marketing directo.
El Comerciante y (en el caso de un Comerciante corporativo) cada uno de los socios / directores del Comerciante acuerdan que QPAYPRO y cualquier persona a quien QPAYPRO haya revelado cualquier información relacionada con el Comerciante ("Datos del Comerciante") o cualquiera de sus datos personales (El "Destinatario") podrá conservar y transferir todos o cualquiera de los Datos del Comerciante y / o datos personales a cualquier país que QPAYPRO considere oportuno. La transferencia de datos personales a un tercer país que no asegure un nivel adecuado de protección sólo se realizará para los siguientes fines: (i) es necesaria para el cumplimiento de los Derechos y Obligaciones de QPAYPRO derivados del Acuerdo; Ii) sea necesario o legalmente exigido por razones de interés público, o para el establecimiento, ejercicio o defensa de demandas legales; Y (iii) es necesario para proteger los intereses vitales del Comerciante, o cualquier persona respecto de la cual los datos personales sean procesados por QPAYPRO en relación con los mismos.

GENERAL
El Comerciante puede obtener información sobre QPAYPRO, incluyendo las actuales instrucciones de operación de QPAYPRO del sitio web de QPAYPRO y obtener información sobre las reglas y regulaciones de MasterCard y Visa en sus respectivos sitios web.
El Comerciante acepta: (i) si se le solicita, proporcionar a QPAYPRO los últimos estados financieros y cualquier otra información que QPAYPRO pueda requerir para evaluar la posición financiera del Comerciante; (Ii) notificar a QPAYPRO por escrito de cualquier cambio en circunstancias que puedan afectar la condición o el estado del Comerciante o su capacidad para cumplir con sus obligaciones bajo el Acuerdo incluyendo, pero no limitado a, cualquier cambio de dirección, cuenta bancaria y naturaleza del negocio; (Iii) proporcionar la asistencia razonable que QPAYPRO pueda requerir para la prevención y detección de lavado de dinero o cualquier otra actividad fraudulenta o criminal y para el cumplimiento del Acuerdo en general. QPAYPRO no se responsabilizará de los honorarios o cargos incurridos como resultado de que el Comerciante no notifique a QPAYPRO dichos cambios. En el caso de que dichas tarifas o cargos sean incurridos por QPAYPRO, serán cobrados al Comerciante.
Si alguna disposición del Acuerdo es o se convierte en ilegal o inválida, dicha disposición se considerará suprimida del Acuerdo y las disposiciones restantes seguirán vigentes.

															</textarea>
                            </div>
                          </div>
                        </div>
                        <div class="panel">
                          <div class="panel-heading" id="exampleHeadingDefaultTwo" role="tab">
                            <a class="panel-title collapsed" data-toggle="collapse" href="#exampleCollapseDefaultTwo" data-parent="#exampleAccordionDefault" aria-expanded="false" aria-controls="exampleCollapseDefaultTwo">
                            Términos y condiciones VisaNet
                          </a>
                          </div>
                          <div class="panel-collapse collapse" id="exampleCollapseDefaultTwo" aria-labelledby="exampleHeadingDefaultTwo" role="tabpanel">
                            <div class="panel-body">
                              <textarea rows="8" cols="55">ESTE CONTRATO ES PARTE DE UN ACUERDO QUE TIENE CLÁUSULA ARBITRAL.
CONTRATO DE AFILIACIÓN DE TRANSACCIONES DE COMERCIO ELECTRÓNICO
NOSOTROS Mario Castrillo representación de la entidad COMPAÑÍA DE PROCESAMIENTO DE MEDIOS DE PAGO DE GUATEMALA, SOCIEDAD ANONIMA, (en adelante referida simplemente como VisaNet o LA COMPAÑÍA, indistintamente); y Cliente, en representación del comercio a afiliarse, (en adelante referido simplemente como EL AFILIADO O EL COMERCIO, indistintamente), por el presente documento celebramos CONTRATO DE AFILIACIÓN, que ambas partes suscribimos con fecha 21 de abril de 2017; de conformidad con lo contenido en las cláusulas siguientes:
PRIMERA: DEL OBJETO DEL CONTRATO DE AFILIACIÓN.
El presente contrato de afiliación tiene por objeto desarrollar e incentivar la implementación de transacciones de comercio electrónico, para lo cual, ambas partes manifiestan que el contrato de afiliación contiene los términos generales de la relación contractual, y se refiere a las transacciones que se realicen vía Internet en el sitio web de EL AFILIADO o el sitio web operado bajo el control de éstos.
Para el efecto VisaNet, manifiesta que dispone de la infraestructura tecnológica y la capacidad necesaria para posibilitar la utilización de los productos de la marca Visa como medio de pago de las transacciones efectuadas por medios electrónicos.
SEGUNDA: DE LAS DEFINICIONES.
Para los efectos del presente contrato de afiliación (en adelante, “Contrato”), se establecen las definiciones que se indican a continuación, en el entendido de que el uso singular implica el plural y la utilización del género masculino implica el femenino, y vice versa:
1) EL AFILIADO: Es la persona individual o jurídica que, como parte de sus actividades, ofrece y realiza, para el público en general, operaciones de venta de bienes o prestación de servicios, las cuales pueden ser pagadas por el Tarjetahabiente vía internet en el Sitio Web.
2) TRANSACCIONES DE COMERCIO ELECTRÓNICO: Son todas las transacciones realizadas en un sitio web propio de EL AFILIADO o de LA COMPAÑIA u operado bajo el control de éstos, y procesadas a través de la infraestructura que para el efecto posee y opera LA COMPAÑÍA, que por su naturaleza, no implica la presentación física de la tarjeta y el deslizamiento a través de un POS, sino que EL TARJETAHABIENTE digita los datos de la tarjeta en el Sitio Web a través de la aplicación correspondiente y en donde el consumo se realiza por EL TARJETAHABIENTE utilizando los medios electrónicos disponibles en el Sitio Web.
3) AUTORIZACIÓN: Es la respuesta de aprobación por parte del EMISOR de tarjetas Visa, a través de LA COMPAÑÍA, el cual autoriza y aprueba el consumo realizado por EL TARJETAHABIENTE en el sitio web de EL AFILIADO, la cual se materializa a través de la emisión y provisión de un código numérico o alfanumérico.
ESTE CONTRATO ES PARTE DE UN ACUERDO QUE TIENE CLÁUSULA ARBITRAL.
4) SERVIDOR DE EL AFILIADO: Es el hardware y software necesarios para
permitir el funcionamiento del sitio de EL AFILIADO, en lo que a la posibilidad de
recibir pagos electrónicos en la modalidad que en este Contrato se estipulan.
5) DIRECCIÓN IP: Se refiere a los datos de referencia de EL TARJETAHABIENTE
que permite ubicar el servidor desde el cual tiene acceso a Internet y que consiste
en una etiqueta numérica asignada de conformidad con el protocolo de
comunicación en Internet. La dirección IP puede cambiar con cada acceso o por la
ubicación que EL TARJETAHABIENTE utilice.
6) CONTRACARGOS: Es la reversión del valor de una transacción que realiza el
Emisor de la tarjeta contra LA COMPAÑÍA.
7) SITIO WEB: Es el conjunto de páginas electrónicas típicamente comunes a un
dominio o subdominio de Internet, podrá denominársele simplemente como sitio
8) CYBERSOURCE: Empresa que provee el servicio de medios de pago y
seguridad transaccional para comercio electrónico, mediante una plataforma
virtual.
9) CUESTIONARIO MANAGED RISK SERVICE: Cuestionario para identificar el
perfil del comercio respecto a su manejo y administración de riesgos.
10) PAYMENT GATEWAY: Plataforma de pagos online de CyberSource.
11) DECISION MANAGER: El detector de fraudes de CyberSource.
12) VERIFIED BY VISA (VbV): Herramienta para validar la transacción por parte
del emisor.
13) TOKENIZACIÓN: Herramienta que agiliza las compras (one-click) de forma
segura en el Internet.
14) SET UP FEE: Pago único para afiliarse a CyberSource vía VisaNet.
15) FEE POR TRANSACCIÓN: Cobro por cada autorización solicitada.
16) LIQUIDACIÓN: Es el cierre electrónico o manual que realiza EL AFILIADO y
que presenta el reporte de las TRANSACCIONES DE COMERCIO ELECTRÓNICO
procesadas y realizadas a través de la infraestructura que para el efecto posee y
opera LA COMPAÑÍA.
TERCERA: DE LAS OBLIGACIONES DE EL AFILIADO.
Para los efectos del presente Contrato, EL AFILIADO se obliga a cumplir con lo
siguiente:
1) SEGURIDAD DE LA INFORMACIÓN Y OTRAS OBLIGACIONES:
a) EL AFILIADO se compromete a mantener en absoluta reserva, frente a terceros,
los datos de EL TARJETAHABIENTE correspondientes a las transacciones
efectuadas. El AFILIADO se compromete expresamente a proteger los datos de EL
TARJETAHABIENTE mediante aislantes y a mantener los mismos en servidores
inaccesibles a través de Internet e implementar cualesquiera medidas de seguridad
que LA COMPAÑÍA le exija. De igual manera, en el evento de que EL AFILIADO
optare o decidiere disponer de sus sistemas informáticos como deshechos
electrónicos, deberá asegurar y garantizar, bajo su responsabilidad, que la
información de cuentas que contenga, esté destruida de manera que no puede ser
legible ni recuperada bajo ninguna manera.
b) Permitir a LA COMPAÑÍA que inspeccione las instalaciones, aplicaciones, sitio
web y/o equipo de EL AFILIADO, con el objeto de verificar que la información de
tarjetas y transacciones son procesadas de forma segura.
ESTE CONTRATO ES PARTE DE UN ACUERDO QUE TIENE CLÁUSULA ARBITRAL.
c) EL AFILIADO no podrá solicitar a EL TARJETAHABIENTE información de la tarjeta
con ocasión del registro del mismo en base de datos de EL AFILIADO, salvo al
momento de la celebración de la transacción, la cual, en todo caso, deberá
mantenerse segregada de la base de datos en donde se mantenga información de
EL TARJETAHABIENTE como cliente o usuario de EL AFILIADO. LA COMPAÑÍA podrá
evaluar la autorización a EL AFILIADO, con previa solicitud por escrito, el registro
de la información de EL TARJETAHABIENTE en su base de datos cuando se trate de
operaciones de transacciones recurrentes realizadas en Internet y siempre que EL
TARJETHABIENTE acepte la política de uso de la información que mantenga EL
AFILIADO. De la misma manera, EL AFILIADO se abstendrá de fraccionar las ventas
con el objeto de evitar u obviar los límites de autorización. Asimismo, se prohíbe
expresamente a EL AFILIADO imponer recargos a las transacciones por el solo hecho
de efectuarse con tarjeta de crédito o débito.
d) La guarda y protección de las claves, códigos u otra información sensible que
identifique a EL AFILIADO frente a LA COMPAÑÍA o a terceros para operar en
ambiente de comercio electrónico es de entera responsabilidad de EL AFILIADO,
siendo éste responsable por cualquier daño o perjuicio que se origine a sí mismo o
a terceros por su divulgación o conocimiento por parte de terceros, o por el uso
inadecuado que se realice de los mismos.
e) EL AFILIADO suministrará a LA COMPAÑÍA, la información relativa a la actividad
que en su sitio Web se lleve a cabo, a efectos de los controles de seguridad que se
estimen pertinentes por parte de LA COMPAÑÍA para implementación por EL
AFILIADO.
f) EL AFILIADO se obliga a implementar inmediatamente las normas de mayor
seguridad que LA COMPAÑÍA le requiera, las cuales están basadas en las mejores
prácticas y recomendaciones existentes, así como aquellas que LA COMPAÑÍA
estime en atención al negocio de EL AFILIADO.
g) LA COMPAÑÍA podrá, a su discreción, incorporar nuevas normas técnicas o
parámetros de control que juzgue necesarios o convenientes para el mejor
cumplimiento del servicio. EL AFILIADO deberá adecuar sus equipos e
infraestructura a estas normas dentro de los plazos que establezca LA COMPAÑÍA.
h) El sistema de procesamiento de datos de EL AFILIADO deberá capturar y guardar
en forma segura las direcciones IP de los TARJETAHABIENTES que pretendan
utilizar su sitio.
i) EL AFILIADO efectuará en forma permanente, eficiente y segura todos los
controles que la tecnología permita para evitar adulteraciones o falsificaciones de
su sitio y de todas las actividades conexas al mismo.
j) EL AFILIADO asume expresamente desde ya la responsabilidad por los daños y
perjuicios que cause en caso que falte a sus obligaciones contenidas en la literal a)
que antecede, así como en cualesquiera otra que LA COMPAÑÍA le imponga en
función de la seguridad de la información y de las transacciones.
k) EL AFILIADO es el exclusivo responsable de la entrega y/o prestación, en tiempo
y forma, de los bienes y/o de los servicios ofrecidos, para lo cual deberá
implementar y operar un procedimiento de entrega de los productos o servicios que
comercialice a través de su Sitio Web.
l) EL AFILIADO será responsable por cualquier transacción, aún autorizada y aún
después de haber sido liquidada, que sea considerada irregular por el EMISOR de la
Tarjeta o por LA COMPAÑÍA. Así, EL AFILIADO deberá responder y asumir en su
patrimonio los daños y perjuicios derivados de:
ESTE CONTRATO ES PARTE DE UN ACUERDO QUE TIENE CLÁUSULA ARBITRAL.
l.1) Las transacciones en las que EL AFILIADO no haya requerido la pertinente
autorización y/o no haya requerido los datos previstos para cada medio;
l.2) Por las transacciones que EL AFILIADO no se encuentre autorizado a
realizar o que no se ajusten a las normas legales, reglamentarias o contractuales
vigentes, o las que se comuniquen en el futuro.
l.3) Por las transacciones que correspondan a consumos desconocidos o
rechazados por los Tarjetahabientes.
l.4) Por transacciones objetadas por los Tarjetahabientes y cuya objeción
sea acogida por EL EMISOR.
m) EL AFILIADO acepta y reconoce que en caso un emisor realice un CONTRACARGO
en contra de LA COMPAÑÍA, EL AFILIADO asumirá las responsabilidades del mismo y
desde ya autoriza a LA COMPAÑÍA para que, de las LIQUIDACIONES, le sea
descontado el o los montos que correspondan, hasta cubrir el valor del
CONTRACARGO o bien del monto de garantía que se cree al amparo de este
Contrato, de ser el caso.
n) EL AFILIADO se obliga a implementar las políticas, procedimientos y directrices
que de tiempo en tiempo le comunique LA COMPAÑÍA en materia de seguridad de
la información de acuerdo a los estándares aplicables a la industria PCI (Payment
Card Industry, por sus siglas en inglés).
o) EL AFILIADO deberá cumplir con todas las condiciones que sea apropiadas y
aprobadas por CyberSource en cuanto a la implementación y operatoria del Sitio
Web de EL AFILIADO.
2) OTRAS OBLIGACIONES:
p) EL AFILIADO se obliga a cumplir con todas las disposiciones legales aplicables en
materia de Prevención de Lavado de Dinero u otros Activos; Ley para Prevenir y
Reprimir el Financiamiento del Terrorismo, para lo cual desde ya acepta firmar
cualquier formulario que para el efecto se le provea y asimismo, EL AFILIADO se
manifiesta sabedor y conocedor de las disposiciones contenidas en la Ley contra el
Lavado de Activos, su Reglamento y desde ya acepta cumplir con las disposiciones
en ellas contenidas y adherirse a sus disposiciones.
q) EL AFILIADO se obliga a llenar los formularios pertinentes y que correspondan en
virtud de la ley previo a y para efectos de entablar una relación comercial con LA
COMPAÑÍA, incluyendo, pero no limitado a los formularios preparados y requeridos
por la Intendencia de Verificación Especial de la Superintendencia de Bancos de
Guatemala. Asimismo, desde ya declara EL AFILIADO que ninguno de sus
representantes, funcionarios, accionistas o cualquier persona con la que tenga un
nexo de similar naturaleza, es una persona políticamente expuesta, lo cual,
igualmente, deberá ser indicado en el formulario respectivo.
r) EL AFILIADO se obliga a realizar los pagos en concepto de “Set-Up Fee” y “Fee por
Transacción” que establezca LA COMPAÑÍA, los que estarán expresados en Dólares
de los Estados Unidos de América, debiendo EL AFILIADO efectuar el pago al tipo
de cambio que publique el Banco de Guatemala. De igual manera, EL AFILIADO
reconoce que será condición previa para que la afiliación contemplada en este
Contrato, el pago del “Set-Up Fee” por parte de EL AFILIADO.
s) EL AFILIADO no podrá utilizar el logo o marca Visa salvo en la forma y términos que
expresamente le autorice LA COMPAÑÍA. De autorizarse el uso por parte LA
COMPAÑÍA, EL AFILIADO se obliga a no utilizar el logo o la marca Visa de forma tal
que pueda llegar a presumirse que los productos o servicios que ofrece EL AFILIADO
son patrocinados, producidos o vendidos por LA COMPAÑÍA o por Visa.
ESTE CONTRATO ES PARTE DE UN ACUERDO QUE TIENE CLÁUSULA ARBITRAL.
2) PROCEDIMIENTO PARA LA ACEPTACIÓN DE LA TARJETA
a) EL AFILIADO se obliga a aceptar todas las tarjetas de marca Visa sin importar
el EMISOR de la misma y que EL TARJETAHABIENTE utilice como medio de pago.
Asimismo, LA COMPAÑÍA podrá comunicar a EL AFILIADO otra u otras marcas de
tarjeta que puedan ser procesadas en el sistema de LA COMPAÑÍA.
b) EL AFILIADO pondrá a disposición de EL TARJETAHABIENTE en su Sitio
Web, la infraestructura tecnológica para que EL TARJETAHABIENTE pueda solicitar
a EL EMISOR a través de la plataforma de LA COMPAÑÍA, la autorización para
adquirir bienes y/o servicios en el Sitio Web de EL AFILIADO.
c) En virtud de que las transacciones se realizan por comercio electrónico,
EL AFILIADO no deberá obtener la firma de EL TARJETAHABIENTE. No obstante,
EL AFILIADO expresamente acepta ser el responsable ante cualquier inconformidad
y/o reclamo realizado por EL TARJETAHABIENTE por cualquier daño o perjuicio
causado a éste en virtud de esta característica.
d) EL AFILIADO deberá informar a EL TARJETAHABIENTE del cargo
efectuado a su cuenta, de forma inmediata y hacerle llegar el comprobante de pago
correspondiente, así como atender sus consultas en relación al monto cargado. EL
AFILIADO deberá resolver a la mayor brevedad las inconformidades y/o reclamos
de EL TARJETAHABIENTE por el monto cargado, ya establecido en el literal
anterior.
e) En el caso que el EMISOR deniegue una autorización, EL AFILIADO dará
instrucciones a EL TARJETAHABIENTE para que se comunique con el EMISOR, y EL
AFILIADO se abstendrá de hacer múltiples intentos o fraccionarlos con la misma
tarjeta para el pago del bien y/o servicio a adquirir por EL TARJETHABIENTE.
f) EL AFILIADO no deberá hacer entrega del bien y/o servicio si algo
despierta sospecha o a sabiendas que la transacción es de carácter fraudulento.
g) EL AFILIADO declara tener cabal y perfecto conocimiento de los riesgos
que implican las Transacciones de Comercio Electrónico, aceptando expresamente
las que le son impuestas por la ley y por el presente Contrato.
3) OTRAS OBLIGACIONES DE EL AFILIADO
a) EL AFILIADO se obliga a cumplir en forma rigurosa, exacta y de buena fe con
todas las condiciones y obligaciones que este contrato estipula a su cargo, así como
con todas las innovaciones tecnológicas, operativas y/o requisitos que le exija
VisaNet o que en el futuro fueran necesarios e imprescindibles para el
cumplimiento del objeto del presente Contrato, y a prestar los servicios que
requiera EL TARJETAHABIENTE en forma exacta.
b) Para todas aquellas transacciones que impliquen la entrega de un bien fuera
del territorio de la República de Guatemala, es deber de EL AFILIADO conocer las
prohibiciones, restricciones, licencias, permisos y/o requerimientos necesarios en
el país de destino. EL AFILIADO deberá estar en todo momento en cumplimiento
de las leyes correspondientes y se compromete por este acto a asumir cualquier
multa o penalidad impuesta a LA COMPAÑÍA al realizar alguna de las actividades
antes descritas.
CUARTA: PROHIBICIONES A EL AFILIADO.
ESTE CONTRATO ES PARTE DE UN ACUERDO QUE TIENE CLÁUSULA ARBITRAL.
1) EL AFILIADO no podrá por ningún motivo ni circunstancia procesar a través
de la infraestructura de pago de LA COMPAÑÍA, transacciones que provengan de las
siguientes actividades:
a) Transacciones de Fichas de Casino o apuestas de cualquier índole.
b) Venta de medicinas cuya comercialización requiera autorización previa; que
requiera receta médica, o que la misma esté prohibida por ley.
c) Tabaco o productos derivados de éste, en cualquiera de sus posibles
presentaciones.
d) Lotería o juegos de azar.
e) Productos o servicios que atenten contra la propiedad intelectual.
f) Pornografía.
g) Cualquier venta o servicio que LA COMPAÑÍA a su discreción considere
inaceptable o que atente contra el buen nombre de ésta y que de tiempo en tiempo
comunique LA COMPAÑÍA a EL AFILIADO.
h) Cualquier venta que requiera licencia o autorización previo a su
comercialización.
EL AFILIADO, por este medio, declara: (i) Que ninguna de las actividades arriba
descritas forma parte de su objeto social o comercial; y, (ii) Que no tiene intención
de ningún tipo en hacerlas partes de su objeto social o comercial, sea o no por
modificación del mismo.
QUINTA: DE LAS OBLIGACIONES DE LA COMPAÑÍA.
1) LA COMPAÑÍA se obliga a habilitar y permitir todos los procesos de
comunicación, pedido de autorización, procesamiento de transacciones y pagos,
que fueren necesarios para que EL AFILIADO acepte Tarjetas Visa como medio de
pago de transacciones en ambiente de comercio electrónico a través del Sitio Web
propiedad de EL AFILIADO u operado bajo el control de éste.
2) LA COMPAÑIA se obliga a cancelar a EL AFILIADO, el importe de las
liquidaciones de transacciones electrónicas con tarjetas Visa, aceptadas por éste
como medio de pago de bienes y/o servicios que EL TARJETAHABIENTE adquiera,
salvo por aquellas que puedan considerarse fraudulentas bajo este Contrato o se
hubieren hecho en contravención de lo estipulado en este Contrato.
3) LA COMPAÑÍA cobrará a EL AFILIADO por los servicios prestados, la comisión
ya establecida en el contrato de afiliación con LA COMPAÑÍA, más el Impuesto al
Valor Agregado –IVA–, la cual será calculada sobre el monto de los consumos. Como
parte de la liquidación, a finales de cada mes, LA COMPAÑÍA emitirá la factura
correspondiente a la comisión de servicios prestados y deducirá el monto
correspondiente del pago que debe efectuar a EL AFILIADO según el numeral 2)
que antecede, lo cual es expresamente autorizado desde ya por EL AFILIADO.
Asimismo EL AFILIADO reconoce y acepta, en forma irrevocable, que los montos
resultantes de los Contracargos, serán deducidos por LA COMPAÑÍA de la
liquidación periódica a que se hace referencia en este numeral y el 2) que antecede.
4) Ambas partes aceptan que la COMISIÓN podrá ser modificada, para lo cual
LA COMPAÑÍA comunicará a EL AFILIADO la nueva COMISIÓN, surtiendo ésta sus
efectos en forma inmediata y para todas las transacciones que a partir de ese día
se verifiquen.
5) LA COMPAÑÍA retendrá los pagos que correspondan a transacciones
fraudulentas, que presenten indicios de fraude o que carezcan de legitimidad. En
ESTE CONTRATO ES PARTE DE UN ACUERDO QUE TIENE CLÁUSULA ARBITRAL.
tales casos, se presumirá que EL AFILIADO no obró conforme a las mejores prácticas
y recomendaciones existentes de aceptación de transacciones en comercio
electrónico con tarjetas Visa, quedando a su cargo probar lo contrario, en el
entendido de que, de no proceder en ese sentido LA COMPAÑÍA retendrá en
definitiva los montos que correspondan por el tipo de transacciones aquí referidas.
6) Salvo lo que pueda estipularse de forma distinta en este Contrato, LA
COMPAÑÍA hará efectivo a EL AFILIADO los montos que correspondan a este por las
LIQUIDACIONES, siempre que provengan de transacciones que se hubieren
efectuado el día anterior hasta antes de las siete de la noche. Las transacciones
que se efectúen después de las siete de la noche de un día, se liquidarán un día
hábil después.
SEXTA: PLAZO DEL CONTRATO.
El plazo de este contrato es por tiempo indefinido. De cualquier manera, LA
COMPAÑÍA podrá poner fin al plazo del presente Contrato sin expresión de causa,
en cualquier tiempo, si a su juicio EL AFILIADO incumple con sus obligaciones bajo
este Contrato. LA COMPAÑÍA procederá a interrumpir en forma definitiva todas las
vías de comunicación entre el sistema de EL AFILIADO y la infraestructura para el
procesamiento de pagos de LA COMPAÑÍA.
SÉPTIMA: LIBERACIÓN DE RESPONSABILIDAD:
EL AFILIADO libera a LA COMPAÑÍA de cualquier responsabilidad civil o penal por
los perjuicios que a terceros pudieren causársele con ocasión de este Contrato.
Así mismo, EL AFILIADO libera a LA COMPAÑÍA de toda responsabilidad por
cualquier reclamación que se efectúe en relación a los derechos sobre software,
hardware, en general derechos de autor y de propiedad intelectual.
OCTAVA: COBRO COLATERAL Y GARANTÍA:
En el caso que LA COMPAÑÍA requiera realizar a EL AFILIADO la constitución de
un monto en concepto de colateral o garantía que será fijado por LA COMPAÑÍA, EL
AFILIADO desde ya acepta que LA COMPAÑÍA deduzca el monto de las liquidaciones
que tiene derecho a recibir EL AFILIADO. En tal caso, el colateral servirá para
efectos de garantizar el cumplimiento de las obligaciones que por el presente
contrato asume EL AFILIADO. El mismo podrá ser reembolsable en un plazo no
mayor a 60 días después de la terminación del Contrato, o después de que LA
COMPAÑÍA comunique a EL AFILIADO que le dispensa de la obligación de mantener
el colateral.
En el caso que EL AFILIADO no cumpliere con dicho requerimiento, LA COMPAÑÍA
podrá desafiliarlo inmediatamente, bastando para el efecto indicar como causa
justificada el incumplimiento de la presente cláusula.
Asimismo, LA COMPAÑÍA podrá solicitar de EL AFILIADO, la constitución de una
garantía distinta, tal como una carta de crédito o una fianza, a satisfacción de LA
COMPAÑÍA, que tenga por objeto asegurar el cumplimiento de las obligaciones que
para EL AFILIADO surgen de este acuerdo. En el caso que EL AFILIADO incumpla
ESTE CONTRATO ES PARTE DE UN ACUERDO QUE TIENE CLÁUSULA ARBITRAL.
con atender dicha solicitud a satisfacción de LA COMPAÑÍA, ésta podrá dar por
terminada sin ninguna responsabilidad de su parte y en forma inmediata, el
presente Contrato de Afiliación.
NOVENA: DE LA RESPONSABILIDAD DE LOS CONTRACARGOS:
EL AFILIADO acepta y reconoce que en caso un emisor realice un CONTRACARGO en
contra de LA COMPAÑÍA, EL AFILIADO asumirá la responsabilidad del mismo y desde
ya autoriza a LA COMPAÑÍA para que, de las LIQUIDACIONES le sea descontado el o
los montos que correspondan, hasta cubrir el valor del CONTRACARGO.
</textarea>
                            </div>
                          </div>
                        </div>
                        <div class="panel">
                          <div class="panel-heading" id="exampleHeadingDefaultThree" role="tab">
                            <a class="panel-title collapsed" data-toggle="collapse" href="#exampleCollapseDefaultThree" data-parent="#exampleAccordionDefault" aria-expanded="false" aria-controls="exampleCollapseDefaultThree">
                            Términos y condiciones Acepta
                          </a>
                          </div>
                          <div class="panel-collapse collapse" id="exampleCollapseDefaultThree" aria-labelledby="exampleHeadingDefaultThree" role="tabpanel">
                            <div class="panel-body">
                              <textarea rows="8" cols="55">ESTE CONTRATO ES PARTE DE UN ACUERDO QUE TIENE CLÁUSULA ARBITRAL.
CONTRATO DE AFILIACIÓN DE TRANSACCIONES DE COMERCIO ELECTRÓNICO
NOSOTROS Mario Castrillo representación de la entidad COMPAÑÍA DE PROCESAMIENTO DE MEDIOS DE PAGO DE GUATEMALA, SOCIEDAD ANONIMA, (en adelante referida simplemente como VisaNet o LA COMPAÑÍA, indistintamente); y Cliente, en representación del comercio a afiliarse, (en adelante referido simplemente como EL AFILIADO O EL COMERCIO, indistintamente), por el presente documento celebramos CONTRATO DE AFILIACIÓN, que ambas partes suscribimos con fecha 21 de abril de 2017; de conformidad con lo contenido en las cláusulas siguientes:
PRIMERA: DEL OBJETO DEL CONTRATO DE AFILIACIÓN.
El presente contrato de afiliación tiene por objeto desarrollar e incentivar la implementación de transacciones de comercio electrónico, para lo cual, ambas partes manifiestan que el contrato de afiliación contiene los términos generales de la relación contractual, y se refiere a las transacciones que se realicen vía Internet en el sitio web de EL AFILIADO o el sitio web operado bajo el control de éstos.
Para el efecto VisaNet, manifiesta que dispone de la infraestructura tecnológica y la capacidad necesaria para posibilitar la utilización de los productos de la marca Visa como medio de pago de las transacciones efectuadas por medios electrónicos.
SEGUNDA: DE LAS DEFINICIONES.
Para los efectos del presente contrato de afiliación (en adelante, “Contrato”), se establecen las definiciones que se indican a continuación, en el entendido de que el uso singular implica el plural y la utilización del género masculino implica el femenino, y vice versa:
1) EL AFILIADO: Es la persona individual o jurídica que, como parte de sus actividades, ofrece y realiza, para el público en general, operaciones de venta de bienes o prestación de servicios, las cuales pueden ser pagadas por el Tarjetahabiente vía internet en el Sitio Web.
2) TRANSACCIONES DE COMERCIO ELECTRÓNICO: Son todas las transacciones realizadas en un sitio web propio de EL AFILIADO o de LA COMPAÑIA u operado bajo el control de éstos, y procesadas a través de la infraestructura que para el efecto posee y opera LA COMPAÑÍA, que por su naturaleza, no implica la presentación física de la tarjeta y el deslizamiento a través de un POS, sino que EL TARJETAHABIENTE digita los datos de la tarjeta en el Sitio Web a través de la aplicación correspondiente y en donde el consumo se realiza por EL TARJETAHABIENTE utilizando los medios electrónicos disponibles en el Sitio Web.
3) AUTORIZACIÓN: Es la respuesta de aprobación por parte del EMISOR de tarjetas Visa, a través de LA COMPAÑÍA, el cual autoriza y aprueba el consumo realizado por EL TARJETAHABIENTE en el sitio web de EL AFILIADO, la cual se materializa a través de la emisión y provisión de un código numérico o alfanumérico.
ESTE CONTRATO ES PARTE DE UN ACUERDO QUE TIENE CLÁUSULA ARBITRAL.
4) SERVIDOR DE EL AFILIADO: Es el hardware y software necesarios para
permitir el funcionamiento del sitio de EL AFILIADO, en lo que a la posibilidad de
recibir pagos electrónicos en la modalidad que en este Contrato se estipulan.
5) DIRECCIÓN IP: Se refiere a los datos de referencia de EL TARJETAHABIENTE
que permite ubicar el servidor desde el cual tiene acceso a Internet y que consiste
en una etiqueta numérica asignada de conformidad con el protocolo de
comunicación en Internet. La dirección IP puede cambiar con cada acceso o por la
ubicación que EL TARJETAHABIENTE utilice.
6) CONTRACARGOS: Es la reversión del valor de una transacción que realiza el
Emisor de la tarjeta contra LA COMPAÑÍA.
7) SITIO WEB: Es el conjunto de páginas electrónicas típicamente comunes a un
dominio o subdominio de Internet, podrá denominársele simplemente como sitio
8) CYBERSOURCE: Empresa que provee el servicio de medios de pago y
seguridad transaccional para comercio electrónico, mediante una plataforma
virtual.
9) CUESTIONARIO MANAGED RISK SERVICE: Cuestionario para identificar el
perfil del comercio respecto a su manejo y administración de riesgos.
10) PAYMENT GATEWAY: Plataforma de pagos online de CyberSource.
11) DECISION MANAGER: El detector de fraudes de CyberSource.
12) VERIFIED BY VISA (VbV): Herramienta para validar la transacción por parte
del emisor.
13) TOKENIZACIÓN: Herramienta que agiliza las compras (one-click) de forma
segura en el Internet.
14) SET UP FEE: Pago único para afiliarse a CyberSource vía VisaNet.
15) FEE POR TRANSACCIÓN: Cobro por cada autorización solicitada.
16) LIQUIDACIÓN: Es el cierre electrónico o manual que realiza EL AFILIADO y
que presenta el reporte de las TRANSACCIONES DE COMERCIO ELECTRÓNICO
procesadas y realizadas a través de la infraestructura que para el efecto posee y
opera LA COMPAÑÍA.
TERCERA: DE LAS OBLIGACIONES DE EL AFILIADO.
Para los efectos del presente Contrato, EL AFILIADO se obliga a cumplir con lo
siguiente:
1) SEGURIDAD DE LA INFORMACIÓN Y OTRAS OBLIGACIONES:
a) EL AFILIADO se compromete a mantener en absoluta reserva, frente a terceros,
los datos de EL TARJETAHABIENTE correspondientes a las transacciones
efectuadas. El AFILIADO se compromete expresamente a proteger los datos de EL
TARJETAHABIENTE mediante aislantes y a mantener los mismos en servidores
inaccesibles a través de Internet e implementar cualesquiera medidas de seguridad
que LA COMPAÑÍA le exija. De igual manera, en el evento de que EL AFILIADO
optare o decidiere disponer de sus sistemas informáticos como deshechos
electrónicos, deberá asegurar y garantizar, bajo su responsabilidad, que la
información de cuentas que contenga, esté destruida de manera que no puede ser
legible ni recuperada bajo ninguna manera.
b) Permitir a LA COMPAÑÍA que inspeccione las instalaciones, aplicaciones, sitio
web y/o equipo de EL AFILIADO, con el objeto de verificar que la información de
tarjetas y transacciones son procesadas de forma segura.
ESTE CONTRATO ES PARTE DE UN ACUERDO QUE TIENE CLÁUSULA ARBITRAL.
c) EL AFILIADO no podrá solicitar a EL TARJETAHABIENTE información de la tarjeta
con ocasión del registro del mismo en base de datos de EL AFILIADO, salvo al
momento de la celebración de la transacción, la cual, en todo caso, deberá
mantenerse segregada de la base de datos en donde se mantenga información de
EL TARJETAHABIENTE como cliente o usuario de EL AFILIADO. LA COMPAÑÍA podrá
evaluar la autorización a EL AFILIADO, con previa solicitud por escrito, el registro
de la información de EL TARJETAHABIENTE en su base de datos cuando se trate de
operaciones de transacciones recurrentes realizadas en Internet y siempre que EL
TARJETHABIENTE acepte la política de uso de la información que mantenga EL
AFILIADO. De la misma manera, EL AFILIADO se abstendrá de fraccionar las ventas
con el objeto de evitar u obviar los límites de autorización. Asimismo, se prohíbe
expresamente a EL AFILIADO imponer recargos a las transacciones por el solo hecho
de efectuarse con tarjeta de crédito o débito.
d) La guarda y protección de las claves, códigos u otra información sensible que
identifique a EL AFILIADO frente a LA COMPAÑÍA o a terceros para operar en
ambiente de comercio electrónico es de entera responsabilidad de EL AFILIADO,
siendo éste responsable por cualquier daño o perjuicio que se origine a sí mismo o
a terceros por su divulgación o conocimiento por parte de terceros, o por el uso
inadecuado que se realice de los mismos.
e) EL AFILIADO suministrará a LA COMPAÑÍA, la información relativa a la actividad
que en su sitio Web se lleve a cabo, a efectos de los controles de seguridad que se
estimen pertinentes por parte de LA COMPAÑÍA para implementación por EL
AFILIADO.
f) EL AFILIADO se obliga a implementar inmediatamente las normas de mayor
seguridad que LA COMPAÑÍA le requiera, las cuales están basadas en las mejores
prácticas y recomendaciones existentes, así como aquellas que LA COMPAÑÍA
estime en atención al negocio de EL AFILIADO.
g) LA COMPAÑÍA podrá, a su discreción, incorporar nuevas normas técnicas o
parámetros de control que juzgue necesarios o convenientes para el mejor
cumplimiento del servicio. EL AFILIADO deberá adecuar sus equipos e
infraestructura a estas normas dentro de los plazos que establezca LA COMPAÑÍA.
h) El sistema de procesamiento de datos de EL AFILIADO deberá capturar y guardar
en forma segura las direcciones IP de los TARJETAHABIENTES que pretendan
utilizar su sitio.
i) EL AFILIADO efectuará en forma permanente, eficiente y segura todos los
controles que la tecnología permita para evitar adulteraciones o falsificaciones de
su sitio y de todas las actividades conexas al mismo.
j) EL AFILIADO asume expresamente desde ya la responsabilidad por los daños y
perjuicios que cause en caso que falte a sus obligaciones contenidas en la literal a)
que antecede, así como en cualesquiera otra que LA COMPAÑÍA le imponga en
función de la seguridad de la información y de las transacciones.
k) EL AFILIADO es el exclusivo responsable de la entrega y/o prestación, en tiempo
y forma, de los bienes y/o de los servicios ofrecidos, para lo cual deberá
implementar y operar un procedimiento de entrega de los productos o servicios que
comercialice a través de su Sitio Web.
l) EL AFILIADO será responsable por cualquier transacción, aún autorizada y aún
después de haber sido liquidada, que sea considerada irregular por el EMISOR de la
Tarjeta o por LA COMPAÑÍA. Así, EL AFILIADO deberá responder y asumir en su
patrimonio los daños y perjuicios derivados de:
ESTE CONTRATO ES PARTE DE UN ACUERDO QUE TIENE CLÁUSULA ARBITRAL.
l.1) Las transacciones en las que EL AFILIADO no haya requerido la pertinente
autorización y/o no haya requerido los datos previstos para cada medio;
l.2) Por las transacciones que EL AFILIADO no se encuentre autorizado a
realizar o que no se ajusten a las normas legales, reglamentarias o contractuales
vigentes, o las que se comuniquen en el futuro.
l.3) Por las transacciones que correspondan a consumos desconocidos o
rechazados por los Tarjetahabientes.
l.4) Por transacciones objetadas por los Tarjetahabientes y cuya objeción
sea acogida por EL EMISOR.
m) EL AFILIADO acepta y reconoce que en caso un emisor realice un CONTRACARGO
en contra de LA COMPAÑÍA, EL AFILIADO asumirá las responsabilidades del mismo y
desde ya autoriza a LA COMPAÑÍA para que, de las LIQUIDACIONES, le sea
descontado el o los montos que correspondan, hasta cubrir el valor del
CONTRACARGO o bien del monto de garantía que se cree al amparo de este
Contrato, de ser el caso.
n) EL AFILIADO se obliga a implementar las políticas, procedimientos y directrices
que de tiempo en tiempo le comunique LA COMPAÑÍA en materia de seguridad de
la información de acuerdo a los estándares aplicables a la industria PCI (Payment
Card Industry, por sus siglas en inglés).
o) EL AFILIADO deberá cumplir con todas las condiciones que sea apropiadas y
aprobadas por CyberSource en cuanto a la implementación y operatoria del Sitio
Web de EL AFILIADO.
2) OTRAS OBLIGACIONES:
p) EL AFILIADO se obliga a cumplir con todas las disposiciones legales aplicables en
materia de Prevención de Lavado de Dinero u otros Activos; Ley para Prevenir y
Reprimir el Financiamiento del Terrorismo, para lo cual desde ya acepta firmar
cualquier formulario que para el efecto se le provea y asimismo, EL AFILIADO se
manifiesta sabedor y conocedor de las disposiciones contenidas en la Ley contra el
Lavado de Activos, su Reglamento y desde ya acepta cumplir con las disposiciones
en ellas contenidas y adherirse a sus disposiciones.
q) EL AFILIADO se obliga a llenar los formularios pertinentes y que correspondan en
virtud de la ley previo a y para efectos de entablar una relación comercial con LA
COMPAÑÍA, incluyendo, pero no limitado a los formularios preparados y requeridos
por la Intendencia de Verificación Especial de la Superintendencia de Bancos de
Guatemala. Asimismo, desde ya declara EL AFILIADO que ninguno de sus
representantes, funcionarios, accionistas o cualquier persona con la que tenga un
nexo de similar naturaleza, es una persona políticamente expuesta, lo cual,
igualmente, deberá ser indicado en el formulario respectivo.
r) EL AFILIADO se obliga a realizar los pagos en concepto de “Set-Up Fee” y “Fee por
Transacción” que establezca LA COMPAÑÍA, los que estarán expresados en Dólares
de los Estados Unidos de América, debiendo EL AFILIADO efectuar el pago al tipo
de cambio que publique el Banco de Guatemala. De igual manera, EL AFILIADO
reconoce que será condición previa para que la afiliación contemplada en este
Contrato, el pago del “Set-Up Fee” por parte de EL AFILIADO.
s) EL AFILIADO no podrá utilizar el logo o marca Visa salvo en la forma y términos que
expresamente le autorice LA COMPAÑÍA. De autorizarse el uso por parte LA
COMPAÑÍA, EL AFILIADO se obliga a no utilizar el logo o la marca Visa de forma tal
que pueda llegar a presumirse que los productos o servicios que ofrece EL AFILIADO
son patrocinados, producidos o vendidos por LA COMPAÑÍA o por Visa.
ESTE CONTRATO ES PARTE DE UN ACUERDO QUE TIENE CLÁUSULA ARBITRAL.
2) PROCEDIMIENTO PARA LA ACEPTACIÓN DE LA TARJETA
a) EL AFILIADO se obliga a aceptar todas las tarjetas de marca Visa sin importar
el EMISOR de la misma y que EL TARJETAHABIENTE utilice como medio de pago.
Asimismo, LA COMPAÑÍA podrá comunicar a EL AFILIADO otra u otras marcas de
tarjeta que puedan ser procesadas en el sistema de LA COMPAÑÍA.
b) EL AFILIADO pondrá a disposición de EL TARJETAHABIENTE en su Sitio
Web, la infraestructura tecnológica para que EL TARJETAHABIENTE pueda solicitar
a EL EMISOR a través de la plataforma de LA COMPAÑÍA, la autorización para
adquirir bienes y/o servicios en el Sitio Web de EL AFILIADO.
c) En virtud de que las transacciones se realizan por comercio electrónico,
EL AFILIADO no deberá obtener la firma de EL TARJETAHABIENTE. No obstante,
EL AFILIADO expresamente acepta ser el responsable ante cualquier inconformidad
y/o reclamo realizado por EL TARJETAHABIENTE por cualquier daño o perjuicio
causado a éste en virtud de esta característica.
d) EL AFILIADO deberá informar a EL TARJETAHABIENTE del cargo
efectuado a su cuenta, de forma inmediata y hacerle llegar el comprobante de pago
correspondiente, así como atender sus consultas en relación al monto cargado. EL
AFILIADO deberá resolver a la mayor brevedad las inconformidades y/o reclamos
de EL TARJETAHABIENTE por el monto cargado, ya establecido en el literal
anterior.
e) En el caso que el EMISOR deniegue una autorización, EL AFILIADO dará
instrucciones a EL TARJETAHABIENTE para que se comunique con el EMISOR, y EL
AFILIADO se abstendrá de hacer múltiples intentos o fraccionarlos con la misma
tarjeta para el pago del bien y/o servicio a adquirir por EL TARJETHABIENTE.
f) EL AFILIADO no deberá hacer entrega del bien y/o servicio si algo
despierta sospecha o a sabiendas que la transacción es de carácter fraudulento.
g) EL AFILIADO declara tener cabal y perfecto conocimiento de los riesgos
que implican las Transacciones de Comercio Electrónico, aceptando expresamente
las que le son impuestas por la ley y por el presente Contrato.
3) OTRAS OBLIGACIONES DE EL AFILIADO
a) EL AFILIADO se obliga a cumplir en forma rigurosa, exacta y de buena fe con
todas las condiciones y obligaciones que este contrato estipula a su cargo, así como
con todas las innovaciones tecnológicas, operativas y/o requisitos que le exija
VisaNet o que en el futuro fueran necesarios e imprescindibles para el
cumplimiento del objeto del presente Contrato, y a prestar los servicios que
requiera EL TARJETAHABIENTE en forma exacta.
b) Para todas aquellas transacciones que impliquen la entrega de un bien fuera
del territorio de la República de Guatemala, es deber de EL AFILIADO conocer las
prohibiciones, restricciones, licencias, permisos y/o requerimientos necesarios en
el país de destino. EL AFILIADO deberá estar en todo momento en cumplimiento
de las leyes correspondientes y se compromete por este acto a asumir cualquier
multa o penalidad impuesta a LA COMPAÑÍA al realizar alguna de las actividades
antes descritas.
CUARTA: PROHIBICIONES A EL AFILIADO.
ESTE CONTRATO ES PARTE DE UN ACUERDO QUE TIENE CLÁUSULA ARBITRAL.
1) EL AFILIADO no podrá por ningún motivo ni circunstancia procesar a través
de la infraestructura de pago de LA COMPAÑÍA, transacciones que provengan de las
siguientes actividades:
a) Transacciones de Fichas de Casino o apuestas de cualquier índole.
b) Venta de medicinas cuya comercialización requiera autorización previa; que
requiera receta médica, o que la misma esté prohibida por ley.
c) Tabaco o productos derivados de éste, en cualquiera de sus posibles
presentaciones.
d) Lotería o juegos de azar.
e) Productos o servicios que atenten contra la propiedad intelectual.
f) Pornografía.
g) Cualquier venta o servicio que LA COMPAÑÍA a su discreción considere
inaceptable o que atente contra el buen nombre de ésta y que de tiempo en tiempo
comunique LA COMPAÑÍA a EL AFILIADO.
h) Cualquier venta que requiera licencia o autorización previo a su
comercialización.
EL AFILIADO, por este medio, declara: (i) Que ninguna de las actividades arriba
descritas forma parte de su objeto social o comercial; y, (ii) Que no tiene intención
de ningún tipo en hacerlas partes de su objeto social o comercial, sea o no por
modificación del mismo.
QUINTA: DE LAS OBLIGACIONES DE LA COMPAÑÍA.
1) LA COMPAÑÍA se obliga a habilitar y permitir todos los procesos de
comunicación, pedido de autorización, procesamiento de transacciones y pagos,
que fueren necesarios para que EL AFILIADO acepte Tarjetas Visa como medio de
pago de transacciones en ambiente de comercio electrónico a través del Sitio Web
propiedad de EL AFILIADO u operado bajo el control de éste.
2) LA COMPAÑIA se obliga a cancelar a EL AFILIADO, el importe de las
liquidaciones de transacciones electrónicas con tarjetas Visa, aceptadas por éste
como medio de pago de bienes y/o servicios que EL TARJETAHABIENTE adquiera,
salvo por aquellas que puedan considerarse fraudulentas bajo este Contrato o se
hubieren hecho en contravención de lo estipulado en este Contrato.
3) LA COMPAÑÍA cobrará a EL AFILIADO por los servicios prestados, la comisión
ya establecida en el contrato de afiliación con LA COMPAÑÍA, más el Impuesto al
Valor Agregado –IVA–, la cual será calculada sobre el monto de los consumos. Como
parte de la liquidación, a finales de cada mes, LA COMPAÑÍA emitirá la factura
correspondiente a la comisión de servicios prestados y deducirá el monto
correspondiente del pago que debe efectuar a EL AFILIADO según el numeral 2)
que antecede, lo cual es expresamente autorizado desde ya por EL AFILIADO.
Asimismo EL AFILIADO reconoce y acepta, en forma irrevocable, que los montos
resultantes de los Contracargos, serán deducidos por LA COMPAÑÍA de la
liquidación periódica a que se hace referencia en este numeral y el 2) que antecede.
4) Ambas partes aceptan que la COMISIÓN podrá ser modificada, para lo cual
LA COMPAÑÍA comunicará a EL AFILIADO la nueva COMISIÓN, surtiendo ésta sus
efectos en forma inmediata y para todas las transacciones que a partir de ese día
se verifiquen.
5) LA COMPAÑÍA retendrá los pagos que correspondan a transacciones
fraudulentas, que presenten indicios de fraude o que carezcan de legitimidad. En
ESTE CONTRATO ES PARTE DE UN ACUERDO QUE TIENE CLÁUSULA ARBITRAL.
tales casos, se presumirá que EL AFILIADO no obró conforme a las mejores prácticas
y recomendaciones existentes de aceptación de transacciones en comercio
electrónico con tarjetas Visa, quedando a su cargo probar lo contrario, en el
entendido de que, de no proceder en ese sentido LA COMPAÑÍA retendrá en
definitiva los montos que correspondan por el tipo de transacciones aquí referidas.
6) Salvo lo que pueda estipularse de forma distinta en este Contrato, LA
COMPAÑÍA hará efectivo a EL AFILIADO los montos que correspondan a este por las
LIQUIDACIONES, siempre que provengan de transacciones que se hubieren
efectuado el día anterior hasta antes de las siete de la noche. Las transacciones
que se efectúen después de las siete de la noche de un día, se liquidarán un día
hábil después.
SEXTA: PLAZO DEL CONTRATO.
El plazo de este contrato es por tiempo indefinido. De cualquier manera, LA
COMPAÑÍA podrá poner fin al plazo del presente Contrato sin expresión de causa,
en cualquier tiempo, si a su juicio EL AFILIADO incumple con sus obligaciones bajo
este Contrato. LA COMPAÑÍA procederá a interrumpir en forma definitiva todas las
vías de comunicación entre el sistema de EL AFILIADO y la infraestructura para el
procesamiento de pagos de LA COMPAÑÍA.
SÉPTIMA: LIBERACIÓN DE RESPONSABILIDAD:
EL AFILIADO libera a LA COMPAÑÍA de cualquier responsabilidad civil o penal por
los perjuicios que a terceros pudieren causársele con ocasión de este Contrato.
Así mismo, EL AFILIADO libera a LA COMPAÑÍA de toda responsabilidad por
cualquier reclamación que se efectúe en relación a los derechos sobre software,
hardware, en general derechos de autor y de propiedad intelectual.
OCTAVA: COBRO COLATERAL Y GARANTÍA:
En el caso que LA COMPAÑÍA requiera realizar a EL AFILIADO la constitución de
un monto en concepto de colateral o garantía que será fijado por LA COMPAÑÍA, EL
AFILIADO desde ya acepta que LA COMPAÑÍA deduzca el monto de las liquidaciones
que tiene derecho a recibir EL AFILIADO. En tal caso, el colateral servirá para
efectos de garantizar el cumplimiento de las obligaciones que por el presente
contrato asume EL AFILIADO. El mismo podrá ser reembolsable en un plazo no
mayor a 60 días después de la terminación del Contrato, o después de que LA
COMPAÑÍA comunique a EL AFILIADO que le dispensa de la obligación de mantener
el colateral.
En el caso que EL AFILIADO no cumpliere con dicho requerimiento, LA COMPAÑÍA
podrá desafiliarlo inmediatamente, bastando para el efecto indicar como causa
justificada el incumplimiento de la presente cláusula.
Asimismo, LA COMPAÑÍA podrá solicitar de EL AFILIADO, la constitución de una
garantía distinta, tal como una carta de crédito o una fianza, a satisfacción de LA
COMPAÑÍA, que tenga por objeto asegurar el cumplimiento de las obligaciones que
para EL AFILIADO surgen de este acuerdo. En el caso que EL AFILIADO incumpla
ESTE CONTRATO ES PARTE DE UN ACUERDO QUE TIENE CLÁUSULA ARBITRAL.
con atender dicha solicitud a satisfacción de LA COMPAÑÍA, ésta podrá dar por
terminada sin ninguna responsabilidad de su parte y en forma inmediata, el
presente Contrato de Afiliación.
NOVENA: DE LA RESPONSABILIDAD DE LOS CONTRACARGOS:
EL AFILIADO acepta y reconoce que en caso un emisor realice un CONTRACARGO en
contra de LA COMPAÑÍA, EL AFILIADO asumirá la responsabilidad del mismo y desde
ya autoriza a LA COMPAÑÍA para que, de las LIQUIDACIONES le sea descontado el o
los montos que correspondan, hasta cubrir el valor del CONTRACARGO.
</textarea>
                            </div>
                          </div>
                        </div>
                      </div>
                      <div class="check-custom check-primary">
                        <input onchange="javascript:showContent()" id="afiliacion" name="afiliacion" type="checkbox">
                        <label for="afiliacion">Acepto términos y condiciones anteriormente descritos</label>
                      </div>
                    </div>
                    <div class="form-group col-sm-6">
                      <div id="testDiv">
                        <p>Para completar el registro por favor firme en el siguiente recuadro como se muestra en su documento de identificacion.</p>
                      	<div id="signatureSet">
                      		<div id="dd_signaturePadWrapper"></div>
                      	</div>

                      </div>
                    </div>
                    <div class="form-group col-sm-12"></div>
                      <div class="col-md-3">
                        <a data-original-title="Regresar" class="btn btn-default" href="{{URL::to('step5',$business->business_id)}}"><i class="icon wb-arrow-left"></i>Regresar</a>
                      </div>
                      <div class="col-md-3"></div>
                      <div class="col-md-3"></div>
                      <div class="col-md-3">
                        <div id="next" style="display:none;">
                          <button id="siguiente" name="siguiente" type="submit" class="btn btn-block btn-primary" style="float: center;">Siguiente</button>
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
