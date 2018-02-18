@extends('layouts.template')
@section('content')
<script type="text/javascript">
var i = {{$id}};
function add_type_text(){
    //obtenemos los valores de nuestra caja de texto
    //var codigo=document.getElementById("txtCodigo").value;
    //var nombre=document.getElementById("txtNombre").value;
    //var precio=document.getElementById("txtPrecio").value;
    //creamos un objeto tr que anexaremos a nuestra tabla llamada tableProductos
    var TR= document.createElement("tr");

    //creamos 4 elementos td en donde iran los datos y uno cuarto donde ira un boton para eliminar
    var TD1=document.createElement("td");
    var TD2=document.createElement("td");
    var TD3=document.createElement("td");
    var TD4=document.createElement("td");
    var TD5=document.createElement("td");
    var TD6=document.createElement("td");
    var TD7=document.createElement("td");

    //asignamos los valores a nuestros td por medio del atributo innerHTML, el cual tiene el contenido HTML de un Nodo
    //alert(codigo);
    //if(codigo==0){
        //TD1.innerHTML= "Opcion 0 <input type='text' name='codigo[]' id='path_signature' value=\""+codigo+"\"requiere>";
    //}
    //if(codigo==1) {
        //TD1.innerHTML= "Opcion 1 <input type='text' name='codigo[]' id='path_signature' value=\""+codigo+"\"requiere>";
    //}
    TD1.innerHTML= "<td class='tablesaw-priority-5'><input type='text' name='name[]' id='name' requiere><input type='hidden' name='type[]' id='type' value='varchar' requiere><input type='hidden' name='id[]' id='id' value='' requiere></td>";
    //TD2.innerHTML="";
    TD3.innerHTML="<td class='tablesaw-priority-5'><input type='text' name='description[]' id='description' requiere></td>";
    TD4.innerHTML="<td class='tablesaw-priority-5' style='display:none;'><textarea name='options[]' style='display:none;'></textarea></td>";
    var act_req = 'onclick=document.getElementById("requiere'+i+'").value=1';
    var des_req = 'onclick=document.getElementById("requiere'+i+'").value=0';
    TD5.innerHTML='<td class="tablesaw-priority-5"><label class="control-label" for="price"></span><br><div class="btn-group" data-toggle="buttons" role="group"><label '+act_req+' class="btn btn-outline btn-primary "active"><input type="radio" autocomplete="off" value="1" "checked"><i class="icon wb-check text-active" aria-hidden="true"></i>  Si</label><label '+des_req+' class="btn btn-outline btn-primary"><input type="radio" autocomplete="off" value="0"><i class="icon wb-check text-active" aria-hidden="true"></i> No</label></div></label><input type="hidden" name="requiered[]" id="requiere'+i+'" value="1"></td>';
    var act_req = 'onclick=document.getElementById("status'+i+'").value=1';
    var des_req = 'onclick=document.getElementById("status'+i+'").value=0';
    TD6.innerHTML='<td class="tablesaw-priority-5"><label class="control-label" for="price"></span><br><div class="btn-group" data-toggle="buttons" role="group"><label '+act_req+' class="btn btn-outline btn-primary  "active"><input type="radio" autocomplete="off" value="1" "checked"><i class="icon wb-check text-active" aria-hidden="true"></i>  {{ trans("app.active")}}</label><label '+des_req+' class="btn btn-outline btn-primary"><input type="radio" autocomplete="off" value="0"><i class="icon wb-check text-active" aria-hidden="true"></i> {{ trans("app.inactive")}}</label></div></label><input type="hidden" name="status[]" id="status'+i+'" value="1"></td>';
    //A continuación asignamos contenido html a nuestro cuarto td
    //esta es una forma de crear elementos tambien, dando el codigo html a un Nodo
    TD7.innerHTML="<td class='tablesaw-priority-5'><label onclick=document.getElementById('delete"+i+"').value=1 class='btn btn-outline btn-danger'><input type='radio' autocomplete='off' value='1'><i class='icon wb-check text-active' aria-hidden='true'></i> Remover Campo</label><input type='hidden' name='delete[]' id='delete"+i+"' value='0'></td>";

    //Ahora proseguimos a agregar los hijos TD al Padre TR
    //Esta es otra manera de crear elementos HTML, por medio de el metodo appendChild
    TR.appendChild(TD1);
    //TR.appendChild(TD2);
    TR.appendChild(TD3);
    //TR.appendChild(TD4);
    TR.appendChild(TD5);
    TR.appendChild(TD6);
    TR.appendChild(TD7);

    //Por ultimo asignamos nuestro TR a la tabla con id tablaProductos
    document.getElementById("prueba").appendChild(TR);

    //limpiamos nuestros inputs para agregar ma datos, y ponemos el foco nuevamente en el input de codigo
    //document.getElementById("txtCodigo").value=""
    //document.getElementById("txtNombre").value="";
    //document.getElementById("txtPrecio").value="";
    //document.getElementById("txtCodigo").focus();
    i++;
}
function add_type_option(){
    //obtenemos los valores de nuestra caja de texto
    //var codigo=document.getElementById("txtCodigo").value;
    //var nombre=document.getElementById("txtNombre").value;
    //var precio=document.getElementById("txtPrecio").value;
    //creamos un objeto tr que anexaremos a nuestra tabla llamada tableProductos
    var TR= document.createElement("tr");

    //creamos 4 elementos td en donde iran los datos y uno cuarto donde ira un boton para eliminar
    var TD1=document.createElement("td");
    var TD2=document.createElement("td");
    var TD3=document.createElement("td");
    //var TD4=document.createElement("td");
    var TD5=document.createElement("td");
    var TD6=document.createElement("td");
    var TD7=document.createElement("td");

    //asignamos los valores a nuestros td por medio del atributo innerHTML, el cual tiene el contenido HTML de un Nodo
    //alert(codigo);
    //if(codigo==0){
        //TD1.innerHTML= "Opcion 0 <input type='text' name='codigo[]' id='path_signature' value=\""+codigo+"\"requiere>";
    //}
    //if(codigo==1) {
        //TD1.innerHTML= "Opcion 1 <input type='text' name='codigo[]' id='path_signature' value=\""+codigo+"\"requiere>";
    //}
    TD1.innerHTML= "<td class='tablesaw-priority-5'><input type='text' name='name[]' id='name' requiere><input type='text' name='type[]' id='type' value='select' requiere><input type='text' name='id[]' id='id' value='' requiere></td>";
    //TD2.innerHTML="";
    TD3.innerHTML="<td class='tablesaw-priority-5'><input type='text' name='description[]' id='description' requiere></td>";
    TD4.innerHTML="<td class='tablesaw-priority-5' style='display:none;'><textarea name='options[]'></textarea></td>";
    var act_req = 'onclick=document.getElementById("requiere'+i+'").value=1';
    var des_req = 'onclick=document.getElementById("requiere'+i+'").value=0';
    TD5.innerHTML='<td class="tablesaw-priority-5"><label class="control-label" for="price"></span><br><div class="btn-group" data-toggle="buttons" role="group"><label '+act_req+' class="btn btn-outline btn-primary "active"><input type="radio" autocomplete="off" value="1" "checked"><i class="icon wb-check text-active" aria-hidden="true"></i>  Si</label><label '+des_req+' class="btn btn-outline btn-primary"><input type="radio" autocomplete="off" value="0"><i class="icon wb-check text-active" aria-hidden="true"></i> No</label></div></label><input type="hidden" name="requiered[]" id="requiere'+i+'"></td>';
    var act_req = 'onclick=document.getElementById("status'+i+'").value=1';
    var des_req = 'onclick=document.getElementById("status'+i+'").value=0';
    TD6.innerHTML='<td class="tablesaw-priority-5"><label class="control-label" for="price"></span><br><div class="btn-group" data-toggle="buttons" role="group"><label '+act_req+' class="btn btn-outline btn-primary  "active"><input type="radio" autocomplete="off" value="1" "checked"><i class="icon wb-check text-active" aria-hidden="true"></i>  {{ trans("app.active")}}</label><label '+des_req+' class="btn btn-outline btn-primary"><input type="radio" autocomplete="off" value="0"><i class="icon wb-check text-active" aria-hidden="true"></i> {{ trans("app.inactive")}}</label></div></label><input type="hidden" name="status[]" id="status'+i+'"></td>';
    //A continuación asignamos contenido html a nuestro cuarto td
    //esta es una forma de crear elementos tambien, dando el codigo html a un Nodo
    TD7.innerHTML="<td class='tablesaw-priority-5'><label onclick=document.getElementById('delete"+i+"').value=1 class='btn btn-outline btn-danger'><input type='radio' autocomplete='off' value='1'><i class='icon wb-check text-active' aria-hidden='true'></i> Remover Campo</label><input type='hidden' name='delete[]' id='delete"+i+"' value='0'></td>";

    //Ahora proseguimos a agregar los hijos TD al Padre TR
    //Esta es otra manera de crear elementos HTML, por medio de el metodo appendChild
    TR.appendChild(TD1);
    //TR.appendChild(TD2);
    TR.appendChild(TD3);
    TR.appendChild(TD4);
    TR.appendChild(TD5);
    TR.appendChild(TD6);
    TR.appendChild(TD7);

    //Por ultimo asignamos nuestro TR a la tabla con id tablaProductos
    document.getElementById("prueba").appendChild(TR);

    //limpiamos nuestros inputs para agregar ma datos, y ponemos el foco nuevamente en el input de codigo
    //document.getElementById("txtCodigo").value=""
    //document.getElementById("txtNombre").value="";
    //document.getElementById("txtPrecio").value="";
    //document.getElementById("txtCodigo").focus();
    i++;
}
function Elimina(NodoBoton){

    //recibimos el boton como parametro, obtendremos el tr que lo contiene de la siguiente manera
    //Como nuestro boton es hijo de un td, y este td de el tr, debemos invocar dos veces parentNode
    //Esto para llegar a tener el TR
    var TR= NodoBoton.parentNode.parentNode;
    //ahora que ya tenemos el padre TR, podemos eliminarlo de la siguiente manera
    //junto a todos sus hijos

    document.getElementById("prueba").removeChild(TR);
  }
</script>
<link rel="stylesheet" href="{{URL::to('/')}}/global/vendor/filament-tablesaw/tablesaw.css">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
<div class="page-header">
  <h1 class="page-title font_lato">Campos Personalizados</h1>
  <div class="page-header-actions">
	<ol class="breadcrumb">
		<li><a href="{{URL::to('/dashboard')}}">{{ trans('app.home')}}</a></li>
    <li><a href="{{URL::to('business_products_detail', $business->business_id)}}">Regresar a listado de botones</a></li>
		<li class="active">Campos Personalizados</li>
	</ol>
  </div>
</div>
<div class="page-content">
<div class="panel">
<div class="panel-body container-fluid">
<!------------------------start insert, update, delete message ---------------->
<div class="row">
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
<h3 class="page-title font_lato">Link en edición: {{$product->title}}</h3>
<div class="bs-example" data-example-id="single-button-dropdown" style="float:right; ">
<div class="btn-group">
<input value="Agregar campo personalizado" type="button" onclick="add_type_text()" class="btn btn-outline btn-default" data-toggle="tooltip" data-placement="top" data-original-title="{{ trans('app.add_user')}}" />
</div>
<!--<div class="btn-group">
<input value="Agregar tipo option" type="button" onclick="add_type_option()" class="btn btn-outline btn-default" data-toggle="tooltip" data-placement="top" data-original-title="{{ trans('app.add_user')}}" />
</div>-->
</div>
</div>
<div style="clear:both;"></div><br/>
<form class="form-inline ng-pristine ng-valid" action="{{URL::to('custom_fields_register',$id)}}" method="post">
  {{ csrf_field() }}
<table class="tablesaw table-striped table-bordered tablesaw-columntoggle" data-tablesaw-mode="columntoggle" data-tablesaw-minimap="" id="table-3973">
  <thead>
    <tr>
      <th data-tablesaw-priority="5" class="tablesaw-priority-5 tablesaw-cell-visible">Nombre</th>
      <th data-tablesaw-priority="3">Descripción</th>
      <th data-tablesaw-priority="2" style="display:none;">Opciones</th>
      <th data-tablesaw-priority="2">Requerido</th>
      <th data-tablesaw-priority="2">Estado</th>
      <th id='myColumnId' data-tablesaw-priority="1">{{ trans('app.actions')}}</th>
    </tr>
  </thead>
  <tbody id="prueba">
    <p style="display:none;">{{ $key=0 }}</p>
  @foreach($custom_fields as $view)
    <tr>
      <td class="tablesaw-priority-6 tablesaw-cell-visible">
          <input type="text" name="name[]" id="name" value="{{$view->name}}" requiere>
          <input type="hidden" name="type[]" id="type" value="{{$view->type}}" requiere>
          <input type='hidden' name='id[]' id='id' value='{{$view->custom_field_id}}' requiere>
      </td>
      <td class="tablesaw-priority-4"><input type='text' name="description[]" id="description" value="{{$view->description}}" requiere></td>
      <td class="tablesaw-priority-3" style="display:none;"><textarea name='options[]'>{{$view->options}}</textarea></td>
      <td class="tablesaw-priority-3">
          <label class="control-label" for="price">
          </span>
          <br>
          <div class="btn-group" data-toggle="buttons" role="group">
            <label onclick="document.getElementById('requiere{{$key}}').value=1" class="btn btn-outline btn-primary  {{ (($view->required == "1")?"active": "")}}">
              <input type="radio" autocomplete="off" value="1" {{ $view->required == "1" ?  "checked" : "" }}>
              <i class="icon wb-check text-active" aria-hidden="true"></i>  Si</label>
            <label onclick="document.getElementById('requiere{{$key}}').value=0" class="btn btn-outline btn-primary {{ (($view->required == "0")?"active": "")}}">
              <input type="radio" autocomplete="off" value="0" {{ $view->required == "0" ?  "checked" : "" }}>
              <i class="icon wb-check text-active" aria-hidden="true"></i> No
            </label>
          </div>
        </label>
        <input type="hidden" name="requiered[]" id="requiere{{$key}}" value="{{$view->required}}">
      </td>
      <td class="tablesaw-priority-2">
        <label class="control-label" for="price">
        </span>
        <br>
        <div class="btn-group" data-toggle="buttons" role="group">
          <label onclick="document.getElementById('status{{$key}}').value=1" class="btn btn-outline btn-primary  {{(($view->status == "1")?"active": "")}}">
            <input type="radio" autocomplete="off" value="1" {{$view->status == "1" ?  "checked" : "" }} >
            <i class="icon wb-check text-active" aria-hidden="true"></i>  {{ trans("app.active")}}</label>
          <label onclick="document.getElementById('status{{$key}}').value=0" class="btn btn-outline btn-primary {{(($view->status == "0")?"active": "")}}">
            <input type="radio" autocomplete="off" value="0" {{$view->status == "0" ?  "checked" : "" }} >
            <i class="icon wb-check text-active" aria-hidden="true"></i> {{ trans("app.inactive")}}
          </label>
        </div>
      </label>
      <input type="hidden" name="status[]" id="status{{$key}}" value="{{$view->status}}">
      </td>
      <td class="tablesaw-priority-1">
        <label onclick="document.getElementById('delete{{$key}}').value=1" class="btn btn-outline btn-danger">
          <input type="radio" autocomplete="off" value="1">
          <i class="icon wb-check text-active" aria-hidden="true"></i> Remover Campo
        </label>
        <input type="hidden" name="delete[]" id="delete{{$key}}" value="0">
      </td>
    </tr>
    <p style="display:none;">{{ ++$key }}</p>
  @endforeach

  </tbody>
  </table>
  <br/>
  <div class="form-group col-sm-6">
  <button type="submit" ng-disabled="userForm.$invalid" class="btn btn-primary ladda-button" data-plugin="ladda" data-style="expand-left">
      <i class="fa fa-save"></i>  Actualizar
    <span class="ladda-spinner"></span><div class="ladda-progress" style="width: 0px;"></div>
    </button>
    <a class="btn btn-default" href="{{URL::to('business_products_detail', $business->business_id)}}"><i class="icon wb-arrow-left"></i>Regresar</a>
  </div>
</form>
  <div style="clear:both;"></div><br/>

  <!-- /.panel -->
  </div>
  <!-- /.col-lg-12 -->
  </div>
  <!-- /.row -->
  </div><br/>
@stop
