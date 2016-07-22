


<form name="form" id="form" method="post" action="javascript:enviarValeConsumo();" >
<!--Campo nombre solicitud -->
   <div class="row col-md-offset-1">
       <div id="diverror_namevale" class="col-md-4">
           <div class="row">
           <label>Nombre solicitud</label>
           </div>
           <div class="row">
            <input class="form-control"  placeholder="Nombre de la solicitud" id="namevale" name="name_vale" required >
               <span id="error_namevale"class="help-block" style="display: none;"></span>
               </div>
       </div>


       <div id="diverror_departamentos" class="col-md-4">
           <div class="row">
                <label>Departamento</label>
           </div>
           <div class="row">
               <select  class="selectpicker" id="select_departamento" name="departamentos" data-width="auto">
                   <option value="">Seleccion Departamento</option>
                   @foreach($users->user_departamentos as $departamento)
                       <option value="{{$departamento->id}}"> {{$departamento->name_departamento}}</option>
                   @endforeach
               </select>
               <span id="error_departamentos"class="help-block" style="display: none;"></span>

           </div>
       </div>

   </div>

    </br>
    <div class="row col-md-offset-1">
          <div class="col-md-9">
              <div class="row">
              <select  class="selectpicker" id="iterador" data-width="100px">
                    @for ($i = 1; $i < 10; $i++)
                      <option value ={{$i}}> {{$i }}</option>
                    @endfor
            </select>

              <button class="btn btn-primary" type="button" onclick="generarTablas($('#iterador').val())">Generar tabla </button>
           </div>
          </div>
   </div>
<br>

    <div class="table-responsive">
<table id="tabla" class="table table-condensed">
    <thead>
    <tr>
        <th>Codigo Producto</th>
        <th>Nombre producto</th>
        <th>Cantidad stock</th>
        <th>Precio</th>
        <th>Cantidad a pedir</th>
    </tr>
    </thead>
    <tbody id="tbody">
    <tr>
       <!-- <td><input class="form-control"  placeholder="EJ: 04008006" id="codproducto[]" name="codproducto[]" type="search" onkeyup="buscarproductos(document.getElementsByName('codproducto[]')[0].value)"  autofocus></td>-->

    </tr>
    </tbody>
</table>
</div>

<input type="hidden" name="_token" id="_token" value="{{ csrf_token() }}">
    <input type="hidden" name="totalproduct" id="totalproduct" >
    @if (!Auth::guest())
        <input type="hidden" name="iduser" id="iduser" value="  {{ Auth::user()->id }}">

            @endif

    </form>
<input type="hidden" id="url" value="{{URL::route('user.vales.buscarproducto')}}" >
<input type="hidden" id="urlingreso" value="{{URL::route('user.vales.ingresarvale')}}" >