<html>
<head><meta http-equiv=Content-Type content="text/html; charset=UTF-8">
<style type="text/css">
<!--
span.cls_002{font-size:7.0px;color:rgb(31,72,124);font-weight:normal;font-style:normal;text-decoration: none}
div.cls_002{font-size:7.0px;color:rgb(31,72,124);font-weight:normal;font-style:normal;text-decoration: none}
span.cls_003{font-size:12.1px;color:rgb(31,72,124);font-weight:bold;font-style:normal;text-decoration: none}
div.cls_003{font-size:12.1px;color:rgb(31,72,124);font-weight:bold;font-style:normal;text-decoration: none}
span.cls_005{font-size:8.1px;color:rgb(0,0,0);font-weight:bold;font-style:normal;text-decoration: none}
div.cls_005{font-size:8.1px;color:rgb(0,0,0);font-weight:bold;font-style:normal;text-decoration: none}
span.cls_006{font-size:8.1px;color:rgb(0,0,0);font-weight:normal;font-style:normal;text-decoration: none}
div.cls_006{font-size:8.1px;color:rgb(0,0,0);font-weight:normal;font-style:normal;text-decoration: none}
span.cls_004{font-size:8.1px;color:rgb(31,72,124);font-weight:bold;font-style:normal;text-decoration: none}
div.cls_004{font-size:8.1px;color:rgb(31,72,124);font-weight:bold;font-style:normal;text-decoration: none}
span.cls_007{font-size:6.0px;color:rgb(0,0,0);font-weight:normal;font-style:normal;text-decoration: none}
div.cls_007{font-size:6.0px;color:rgb(0,0,0);font-weight:normal;font-style:normal;text-decoration: none}
span.cls_008{font-size:7.0px;color:rgb(0,0,0);font-weight:normal;font-style:normal;text-decoration: none}
div.cls_008{font-size:7.0px;color:rgb(0,0,0);font-weight:normal;font-style:normal;text-decoration: none}
span.cls_011{font-size:8.1px;color:rgb(0,0,0);font-weight:bold;font-style:normal;text-decoration: none}
div.cls_011{font-size:8.1px;color:rgb(0,0,0);font-weight:bold;font-style:normal;text-decoration: none}
span.cls_012{font-size:8.1px;color:rgb(0,0,0);font-weight:normal;font-style:normal;text-decoration: none}
div.cls_012{font-size:8.1px;color:rgb(0,0,0);font-weight:normal;font-style:normal;text-decoration: none}
span.cls_013{font-size:11.1px;color:rgb(31,72,124);font-weight:bold;font-style:normal;text-decoration: none}
div.cls_013{font-size:11.1px;color:rgb(31,72,124);font-weight:bold;font-style:normal;text-decoration: none}
-->
</style>
<script type="text/javascript" src="909283cc-35d2-11e7-922a-002590d31986_id_solicitud_de_Payment_Gateway_files/wz_jsgraphics.js"></script>
</head>
<body>
<div style="position:absolute;left:50%;margin-left:-297px;top:0px;width:595px;height:841px;border-style:outset;overflow:hidden">
<div style="position:absolute;left:0px;top:0px">
<img src="https://app.qpaypro.com/uploads/background1.jpg" width=595 height=841></div>
<div style="position:absolute;left:469.42px;top:19.96px" class="cls_002"><span class="cls_002">Anexo</span></div>
<div style="position:absolute;left:467.50px;top:28.00px" class="cls_002"><span class="cls_002">Versión 1.0</span></div>
<div style="position:absolute;left:467.50px;top:36.04px" class="cls_002"><span class="cls_002">Mayo 2017</span></div>
<div style="position:absolute;left:467.50px;top:44.08px" class="cls_002"><span class="cls_002">Paymet Gateway</span></div>
<div style="position:absolute;left:224.93px;top:69.06px" class="cls_003"><span class="cls_003">Solicitud de Payment Gateway</span></div>
<div style="position:absolute;left:42.60px;top:92.22px" class="cls_005"><span class="cls_005">1.</span></div>
<div style="position:absolute;left:62.88px;top:92.22px" class="cls_005"><span class="cls_005">Datos del comercio (El afiliado)</span></div>
<div style="position:absolute;left:62.76px;top:112.86px" class="cls_006"><span class="cls_006">Nombre  comercial:</span></div>
<div style="position:absolute;left:179.18px;top:112.86px" class="cls_004"><span class="cls_004">{{$business->business_name}}</span></div>
<div style="position:absolute;left:62.76px;top:126.66px" class="cls_006"><span class="cls_006">Razón Social:</span></div>
<div style="position:absolute;left:177.74px;top:126.66px" class="cls_004"><span class="cls_004">{{$business->legal_name}}</span></div>
<div style="position:absolute;left:62.76px;top:140.46px" class="cls_006"><span class="cls_006">NIT:</span></div>
<div style="position:absolute;left:177.74px;top:140.46px" class="cls_004"><span class="cls_004">{{$business->tax_id}}</span></div>
<div style="position:absolute;left:62.76px;top:154.26px" class="cls_006"><span class="cls_006">Representante Legal:</span></div>
<div style="position:absolute;left:179.18px;top:154.26px" class="cls_004"><span class="cls_004">{{$business->name_representative}}</span></div>
<div style="position:absolute;left:62.76px;top:168.06px" class="cls_006"><span class="cls_006">DPI / Pasaporte (extranjeros):     </span><span class="cls_004">{{$business->id_representative}}</span></div>
<div style="position:absolute;left:42.60px;top:202.38px" class="cls_005"><span class="cls_005">2.</span></div>
<div style="position:absolute;left:60.60px;top:202.38px" class="cls_005"><span class="cls_005">Datos de la afiliación</span></div>
<div style="position:absolute;left:60.60px;top:229.98px" class="cls_006"><span class="cls_006">Afiliación Matriz</span></div>
<div style="position:absolute;left:217.85px;top:229.98px" class="cls_004"><span class="cls_004">{{$business->number_afiliation}}</span></div>
<div style="position:absolute;left:60.60px;top:243.81px" class="cls_006"><span class="cls_006">Tipo de moneda de la afiliación</span></div>
<div style="position:absolute;left:200.45px;top:243.81px" class="cls_005"><span class="cls_005">Dólares (USD $)  @if($business->currency_afiliation == 'USD') X @endif</span></div>
<div style="position:absolute;left:290.21px;top:243.81px" class="cls_005"><span class="cls_005">Quetzales (Q) @if($business->currency_afiliation == 'GTQ') X @endif</span></div>
<div style="position:absolute;left:60.60px;top:271.53px" class="cls_006"><span class="cls_006">Procesar transacciones a través de Payment Gateway en moneda distinta  a la de la matriz: @if($business->diferent_number_account != null) &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;X @endif @if($business->diferent_number_account === null) &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;X @endif</span></div>
<div style="position:absolute;left:420.07px;top:271.53px" class="cls_006"><span class="cls_006">Si</span></div>
<div style="position:absolute;left:494.38px;top:271.53px" class="cls_006"><span class="cls_006">No</span></div>
<div style="position:absolute;left:60.60px;top:285.45px" class="cls_007"><span class="cls_007">(</span><span class="cls_008">Si la respuesta es positiva, completar los datos siguientes):</span></div>
<div style="position:absolute;left:60.48px;top:307.65px" class="cls_006"><span class="cls_006">No. de cuenta*:</span></div>
<div style="position:absolute;left:149.06px;top:307.65px" class="cls_004"><span class="cls_004">{{$business->diferent_number_account}}</span></div>
<div style="position:absolute;left:268.13px;top:307.65px" class="cls_006"><span class="cls_006">Banco:    </span><span class="cls_004">{{$business->diferent_bank}}</span></div>
<div style="position:absolute;left:397.51px;top:304.65px" class="cls_006"><span class="cls_006">Moneda:   </span><span class="cls_004">{{$business->diferent_currency}}</span></div>
<div style="position:absolute;left:42.60px;top:335.49px" class="cls_004"><span class="cls_004">*</span><span class="cls_011">Adjuntar copia de cheque de la cuenta bancaria a la que se acredita.</span></div>
<div style="position:absolute;left:42.60px;top:364.17px" class="cls_005"><span class="cls_005">3.</span></div>
<div style="position:absolute;left:60.60px;top:364.17px" class="cls_005"><span class="cls_005">condiciones:</span></div>
<div style="position:absolute;left:60.60px;top:386.13px" class="cls_012"><span class="cls_012">•</span></div>
<div style="position:absolute;left:78.62px;top:386.13px" class="cls_006"><span class="cls_006">El presente anexo forma parte integral del contrato de afiliación suscrito con anterioridad entre VisaNet Guatemala y el afiliado</span></div>
<div style="position:absolute;left:60.60px;top:397.19px" class="cls_012"><span class="cls_012">•</span></div>
<div style="position:absolute;left:78.62px;top:397.19px" class="cls_006"><span class="cls_006">En caso de cambio o vencimiento de la representación legal, adjuntar a la presente solicitud copia del acta notarial de</span></div>
<div style="position:absolute;left:78.62px;top:407.75px" class="cls_006"><span class="cls_006">nombramiento.</span></div>
<div style="position:absolute;left:60.60px;top:418.91px" class="cls_012"><span class="cls_012">•</span></div>
<div style="position:absolute;left:78.62px;top:418.91px" class="cls_006"><span class="cls_006">Se creará  una afiliación como sucursal para la página de comercio electrónico, la cual tendrá como propósito la realización de</span></div>
<div style="position:absolute;left:78.62px;top:429.47px" class="cls_006"><span class="cls_006">ventas en línea utilizando como medio de pago tarjetas de crédito y débito.</span></div>
<div style="position:absolute;left:60.60px;top:440.63px" class="cls_012"><span class="cls_012">•</span></div>
<div style="position:absolute;left:78.62px;top:440.63px" class="cls_006"><span class="cls_006">El afiliado es responsable de las transacciones,  autorizadas y liquidadas, que puedan  considerarse como  irregulares por el Banco</span></div>
<div style="position:absolute;left:78.62px;top:451.19px" class="cls_006"><span class="cls_006">Emisor de la tarjeta  o por VisaNet Guatemala</span></div>
<div style="position:absolute;left:60.60px;top:462.35px" class="cls_012"><span class="cls_012">•</span></div>
<div style="position:absolute;left:78.62px;top:462.35px" class="cls_006"><span class="cls_006">El afiliado asumirá los daños y perjuicios derivados de las transacciones que corresponden a consumos desconocidos o</span></div>
<div style="position:absolute;left:78.62px;top:472.79px" class="cls_006"><span class="cls_006">rechazados por los tarjetahabientes o por transacciones objetadas por los tarjetahabientes y cuya controversia es acogida por el</span></div>
<div style="position:absolute;left:78.62px;top:483.35px" class="cls_006"><span class="cls_006">Banco Emisor de la tarjeta.</span></div>
<div style="position:absolute;left:60.60px;top:494.63px" class="cls_012"><span class="cls_012">•</span></div>
<div style="position:absolute;left:78.62px;top:494.63px" class="cls_006"><span class="cls_006">El afiliado acepta y reconoce expresamente las responsabilidades derivadas de los contracargos realizados por los emisores,</span></div>
<div style="position:absolute;left:78.62px;top:505.07px" class="cls_006"><span class="cls_006">autorizando a VisaNet Guatemala para descontar de nuestra liquidación el monto que corresponda  hasta cubrir el valor del</span></div>
<div style="position:absolute;left:78.62px;top:515.63px" class="cls_006"><span class="cls_006">contracargo.</span></div>
<div style="position:absolute;left:42.60px;top:558.02px" class="cls_006"><span class="cls_006">Por este medio se deja constancia de la aceptación  de los términos y condiciones que anteceden.</span></div>
<div style="position:absolute;left:42.60px;top:578.78px" class="cls_006"><span class="cls_006">Guatemala, </span><span class="cls_013">{{Session::get('fecha_docto')}}</span></div>
<div style="position:absolute;left:248.81px;top:578.90px" class="cls_006"><span class="cls_006"></span></div>
<div style="position:absolute;left:248.81px;top:614.90px" class="cls_006"><span class="cls_006">f. ___________________________</span></div>
<div style="position:absolute;left:250.73px;top:633.14px" class="cls_004"><span class="cls_004">{{$business->name_representative}}</span></div>
<div style="position:absolute;left:264.05px;top:660.74px" class="cls_005"><span class="cls_005">USO INTERNO VISANET</span></div>
<div style="position:absolute;left:42.60px;top:688.10px" class="cls_006"><span class="cls_006">Nombre del Integrador</span></div>
<div style="position:absolute;left:208.13px;top:687.02px" class="cls_004"><span class="cls_004">Nombre del integrador</span></div>
<div style="position:absolute;left:42.60px;top:702.62px" class="cls_006"><span class="cls_006">Facturación promedio mensual</span></div>
<div style="position:absolute;left:208.13px;top:701.54px" class="cls_004"><span class="cls_004">Facturación promedio mensual</span></div>
<div style="position:absolute;left:42.60px;top:717.28px" class="cls_006"><span class="cls_006">Transacciones diarias</span></div>
<div style="position:absolute;left:208.13px;top:716.20px" class="cls_004"><span class="cls_004">Cantidad de transacciones diarias</span></div>
<div style="position:absolute;left:42.60px;top:734.08px" class="cls_006"><span class="cls_006">Ticket promedio (por transacción)</span></div>
<div style="position:absolute;left:208.13px;top:733.00px" class="cls_004"><span class="cls_004">Ticket promedio</span></div>
<div style="position:absolute;left:42.60px;top:749.68px" class="cls_006"><span class="cls_006">Terminal Virtual:</span></div>
<div style="position:absolute;left:208.13px;top:748.60px" class="cls_004"><span class="cls_004">No. terminal virtual</span></div>
<div style="position:absolute;left:42.60px;top:765.16px" class="cls_006"><span class="cls_006">No. de gestión:</span></div>
<div style="position:absolute;left:208.13px;top:764.08px" class="cls_004"><span class="cls_004">No. de gestión</span></div>
</div>

</body>
</html>
