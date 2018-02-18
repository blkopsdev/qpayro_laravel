<div style="max-height: 500px;overflow-y: scroll;">
<table class="table table-striped">
    <thead>
      <tr>
        <th width="30%">Campo</th>
        <th>Valor</th>
      </tr>
    </thead>
    <tbody>
    <tr>
        <td>{{ _('Pasarela') }}:</td>
        <td>{{ $row->payment_method_name }}</td>
      </tr>
    <tr>
        <td>{{ _('Estado') }}:</td>
        <td>
        @if($row->status == 1)
            <span class="label label-success">Aprobada</span>
        @else
            <span class="label label-danger">Denegada</span>
        @endif
        </td>
      </tr>
        
    <tr>
        <td>{{ _('Fecha') }}:</td>
        <td>{{ $row->created_at }}</td>
      </tr>  
      <tr>
        <td>{{ _('ID Transacción') }}:</td>
        <td><span class="label label-dark">{{ $row->transaction_id }}</span></td>
      </tr>
      
      <tr>
        <td>{{ _('Correlativo de transacción') }}:</td>
        <td>{{ $row->audit_number }}</td>
      </tr>
      @if($row->product_id)
      <tr>
        <td>{{ _('Producto') }}:</td>
        <td><label class="label label-default">{{ $row->business_product_id }}</label>
            {{ $row->business_product_name }}
        </td>
      </tr>
      @endif
     
      <tr>
        <td>{{ _('Monto') }}:</td>
        <td>{{ $row->currency }} {{ sprintf('%.2f',$row->amount) }}</td>
      </tr>
        @if(@$row->additional_data->visaencuotas>0)
        <tr>
        <td>{{ _('Visa en Cuotas') }}:</td>
        <td>{{ $row->additional_data->visaencuotas }}</td>
      </tr>
    @endif
        <tr>
        <td>{{ _('Envío') }}:</td>
        <td> {{ $row->currency }} {{ sprintf('%.2f',$row->freight) }}</td>
      </tr>
        <tr>
        <td>{{ _('Descuento') }}:</td>
        <td> (-) {{ sprintf('%.2f',$row->discount) }}</td>
      </tr>
        <tr>
        <td>{{ _('Email') }}:</td>
        <td> {{ $row->email }}</td>
      </tr>
        <tr>
        <td>{{ _('Datos de tarjeta de crédito') }}:</td>
        <td>
            {{ _('Nombre:') }} {{ $row->cc_name }}<br/>
            {{ _('Tarjeta:') }} ****-{{ $row->cc_last4digits }}<br/>
            {{ _('Expiración:') }} {{ str_pad( $row->cc_expire_month, 2, '0', STR_PAD_LEFT) }}/{{ $row->cc_expire_year }}<br/>
        </td>
      </tr>
        <tr>
        <td>{{ _('Datos de facturación') }}:</td>
        <td>
            {{ _('Nombre:') }} {{ $row->bill_to_name }}<br/>
            {{ _('NIT:') }} {{ $row->bill_to_tax_id }}<br/>
            {{ _('Dirección:') }} {{ $row->bill_to_address }}<br/>
            {{ _('Ciudad:') }} {{ $row->bill_to_city }}<br/>
            {{ _('Estado:') }} {{ $row->bill_to_state }}<br/>
            {{ _('País:') }} {{ $row->bill_to_country }}<br/>
            {{ _('Código postal:') }} {{ $row->bill_to_zip }}<br/>
        </td>
      </tr>
        
        <tr>
        <td>{{ _('Código de repuesta') }}:</td>
        <td> <label class="label label-default">{{ $row->response_code }}</label>
            <label class="label label-default">{{ $row->response_reason_code }}</label><br />
            {{ $row->response_text }}
        </td>
      </tr>
         
        <tr>
        <td colspan=2>
        {{ _('Petición') }}<br />
        
        
        @if(count(json_decode($row->request))>0)
        @foreach(json_decode($row->request, true) as $i => $v)
            <label class="label label-default">{{ $i }}:</label>
                @if(is_array($v))
                <pre class="code well label-dark pre-scrollable" style="display:block;"><small>{{ print_r($v) }}</small></pre>
                @else
                <label class="label label-dark">{{ $v }}</label>
                @endif
            <br />
        @endforeach
        @endif
        
        </td>
            
      </tr>
        
        <tr>
        <td colspan=2>
        {{ _('Objeto de respuesta') }}<br />
        
        @if(count(json_decode($row->response_object))>0)
        @foreach(json_decode($row->response_object, true) as $i => $v)
            <label class="label label-default">{{ $i }}:</label>
                @if(is_array($v))
                <pre class="code well label-dark pre-scrollable" style="display:block;"><small>{{ print_r($v) }}</small></pre>
                @else
                <label class="label label-dark">{{ $v }}</label>
                @endif
            <br />
        @endforeach
        @endif
        
        </td>
            
      </tr>
        
        
    </tbody>
</table>
</div>
    