@include('layout')

<!-- PUSE EL ACTION Y PUSE EL HREF EN EL BUTTON USA EL QUE QUIERAS, TENES QUE 
PONERLE LA URL Y LO QUE LE QUIERAS PASAR-->

<!-- FALTA EL PRECIO UNITARIO, UNA VEZ QUE LO TENGA HAGO LA MULTIPLICACION PARA EL 
SUBTOTAL Y EL TOTAL VIENE EN 0 NO SE PORQUE-->

<BR>
<center>

<h1 align="center"> Recibo </h1>

<!-- ACA ARRANCA EL FORM PUSE EL ESTILO ACA PORQUE SINO NO ME LO TOMABA-->

    <form  action="{{ url ('/imprimir') }}" method="GET" style=" max-width: 60em; height: 40em; background-color:#FDFEA4; ">
    
     <div class="row col-xs-12">
      <b><label for="numero" class="col-xs-6" style="margin: 10px  0px   0px   600px;"> RNº </label> </b>

      <!-- ACA IRIA EL NUMERO DE RECIBO-->
        @foreach($numero as $num)
        
       <input type="number" id="numero" name="numero" class="form-control" class="col-xs-6" style= "width:30%; background-color:#FDFEA4;margin: 10px   0px   0px   0px;" value="{{$num->id_talonario}}{{$num->nro_actual}}" />
        <input type="hidden" id="id_recibo" name="id_recibo" value="{{$num->nro_actual}}">
        <input type="hidden" id="id_talonario" name="id_talonario" value=" {{$num->id_talonario}}">
        @endforeach
      </div>
    
      <div class="row col-xs-12">
       <b> <label for="fecha" class="col-xs-6" style="margin: 10px  0px   0px   600px;"> Fecha </label></b>
      <input type="date" id="fecha" name="fecha" class="form-control" class="col-xs-6" style= "width:30%; background-color:#FDFEA4;margin: 10px   0px   0px   0px;"  value="{{$nuevaVenta->fecha}}" />
     </div>

        @foreach($cliente as $cli)
          <div align="left">
          <div class="row col-xs-12">
            <b><label  for="nombre" style= "margin: 0px   0px   0px   40px; font-size:15px; " class="col-xs-6">Nom y Ap/Razon Social: </label></b>
            <input type="text"  id="nombre" name="nombre" align="left" class="form-control" style= "width:40%; background-color:#FDFEA4; margin: 0px   50px   0px   0px;" class="col-xs-6" value="{{$cli->nombre_apellido}}">
            </div>
          <div class="row col-xs-12">
            <b><label for="domicilio" style= "margin: 0px   0px   0px   40px; " class="col-xs-3"> Domicilio: </label></b>
            <input type="text" id= "domicilio" name="domicilio" class="form-control" class="col-xs-3" style= "width:30%; background-color:#FDFEA4;" value="{{$cli->domicilio}}">
            <b><label for="dni"  style= "margin: 0px   10px   0px   10px;" class="col-xs-3"> DNI o CUIT: </label></b>
            <input type="number" id="dni"  name="dni" class="form-control" class="col-xs-3"style= " width:30%;background-color:#FDFEA4;" value="{{$cli->dni_cuit}}">
          </div>
          <div class="row col-xs-12">
            <b><label for="telefono" style= "margin: 0px   10px   0px   40px;"  class="col-xs-3"> Telefono : </label></b> 
            <input type="number" id="telefono" name="telefono" class="form-control"  class="col-xs-3" style= "  width:30%;background-color:#FDFEA4;" value="{{$cli->telefono}}">  
            <b><label for="email"  style= "margin: 0px   10px   0px   40px;"  class="col-xs-3"> Email: </label></b>   
            <input type="text" id="email" name="email" class="form-control"  class="col-xs-3" style= " width:30%; background-color:#FDFEA4;" value="{{$cli->email}}">
          </div>
         @endforeach
         
        <TABLE class="table table-bordered" >
        <thead class="thead-dark">
        <TR align="center" style="border: solid 1px #000000; ">
        <TH>  Cantidad  </TH>
        <TH>  Detalle </TH>
        <TH>  Precio Unitario  </TH>
        <TH>  Subtotal  </TH></TR>
        </thead>
        <tbody>
        @foreach ($info as $fila)
            <tr style="border: solid 1px #000000; ">
            <td style="border: solid 1px #000000; ">{{$fila["cantidad"]}}</td>
              <input type="hidden" id="cantidad" name="cantidad" value="{{$fila["cantidad"]}}">
            @foreach($fila["titulo"] as $ti)
            <td style="border: solid 1px #000000; ">{{$ti->titulo}}</td>
               <input type="hidden" id="titulo" name="titulo" value="{{$ti->titulo}}">
            @endforeach
            <TD style="border: solid 1px #000000; ">{{$fila["precio_unitario"]}}</TD>
            <input type="hidden" id="precio_unitario" name="precio_unitario" value="{{$fila["precio_unitario"]}}">
            <TD style="border: solid 1px #000000; ">{{$sub_total}}</TD>
            <input type="hidden" id="sub_total" name="sub_total" value="{{$sub_total}}">
            </tr>
        @endforeach

        <!--ESTO ES SOLO PARA AGREGAR FILAS DECORATIVAS SE PUEDEN SACAR-->

        <TR > <TD style="border: solid 1px #000000; "> </TD> <TD style="border: solid 1px #000000; "> </TD> <TD style="border: solid 1px #000000; "> </TD>  <TD style="border: solid 1px #000000; "> </TD> </TR>
        <TR > <TD style="border: solid 1px #000000; "> </TD> <TD style="border: solid 1px #000000; "> </TD> <TD style="border: solid 1px #000000; "> </TD>  <TD style="border: solid 1px #000000; "> </TD> </TR>
        <TR >
        <TD colspan="3" style="border: solid 1px #000000; "> Total </TD> 
        <TD aling="right" style="border: solid 1px #000000; ">  {{$total}}</TD>
        <input type="hidden" id="total" name="total" value="{{$total}}">
        </TR>
        </tbody>
        </TABLE>
        @foreach ($idVenta as $venta) <!-- PONER ESTO EN UN HIDDEN-->
         
          <input type="hidden" id="idVenta" name="idVenta" value=" {{$venta}}">
        @endforeach 
        <div align="right" style="margin-top: 10px;">
             <button type="submit" class="btn btn-primary btn-lg btn-block">Agregar</button>
         </div>
         <br>
      
    </form>
 </center>

        
                     