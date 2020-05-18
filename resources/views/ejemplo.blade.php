<!DOCTYPE html>
<html lang="es">
    <head>
        <meta charset="UTF-8">
        <title>Document</title>
        <style>
        h1{
        text-align: center;
        text-transform: uppercase;
        }
        .contenido{
        font-size: 20px;
        }
        #primero{
        background-color: #ccc;
        }
        #segundo{
        color:#44a359;
        }
        #tercero{
        text-decoration:line-through;
        }
    </style>
    </head>
    <body>
      <BR>
<center>

<h1 align="center"> Recibo </h1>

<!-- ACA ARRANCA EL FORM PUSE EL ESTILO ACA PORQUE SINO NO ME LO TOMABA-->

    <form  action="{{ url ('/imprimir') }}" method="GET" style=" max-width: 60em; height: 40em; background-color:#FDFEA4; ">
    
     <div class="row col-xs-12">
      <b><label for="id_recibo" class="col-xs-6" style="margin: 10px  0px   0px   600px;"> RNº </label> </b>

      <!-- ACA IRIA EL NUMERO DE RECIBO-->

       <input type="text" id="id_recibo" name="id_recibo" class="form-control" class="col-xs-6" style= "width:30%; background-color:#FDFEA4;margin: 10px   0px   0px   0px;" value="634567" />
       </div>
      <div class="row col-xs-12">
       <b> <label for="fecha" class="col-xs-6" style="margin: 10px  0px   0px   600px;"> Fecha </label></b>
      <input type="text" id="fecha" name="fecha" class="form-control" class="col-xs-6" style= "width:30%; background-color:#FDFEA4;margin: 10px   0px   0px   0px;"  value="{{$data['fecha']}}" />
     </div>

       
          <div align="left">
          <div class="row col-xs-12">
            <b><label  for="nombre" style= "margin: 0px   0px   0px   40px; font-size:15px; " class="col-xs-6">Nom y Ap/Razon Social: </label></b>
            <input type="text"  id="nombre" name="nombre" align="left" class="form-control" style= "width:40%; background-color:#FDFEA4; margin: 0px   50px   0px   0px;" class="col-xs-6" value="{{$data['nombre']}}">
            </div>
          <div class="row col-xs-12">
            <b><label for="domicilio" style= "margin: 0px   0px   0px   40px; " class="col-xs-3"> Domicilio: </label></b>
            <input type="text" id= "domicilio" name="domicilio" class="form-control" class="col-xs-3" style= "width:30%; background-color:#FDFEA4;" value="{{$data['domicilio']}}">
            <b><label for="dni"  style= "margin: 0px   10px   0px   10px;" class="col-xs-3"> DNI o CUIT: </label></b>
            <input type="text" id="dni"  name="dni" class="form-control" class="col-xs-3"style= " width:30%;background-color:#FDFEA4;" value="{{$data['dni_cuit']}}">
          </div>
          <div class="row col-xs-12">
            <b><label for="telefono" style= "margin: 0px   10px   0px   40px;"  class="col-xs-3"> Telefono : </label></b> 
            <input type="text" id="telefono" name="telefono" class="form-control"  class="col-xs-3" style= "  width:30%;background-color:#FDFEA4;" value="{{$data['telefono']}}">  
            <b><label for="email"  style= "margin: 0px   10px   0px   40px;"  class="col-xs-3"> Email: </label></b>   
            <input type="text" id="email" name="email" class="form-control"  class="col-xs-3" style= " width:30%; background-color:#FDFEA4;" value="{{$data['email']}}">
          </div>
        
         
        <TABLE class="table table-bordered" >
        <thead class="thead-dark">
        <TR align="center" style="border: solid 1px #000000; ">
        <TH>  Cantidad  </TH>
        <TH>  Detalle </TH>
        <TH>  Precio Unitario  </TH>
        <TH>  Subtotal  </TH></TR>
        </thead>
        <tbody>
        
            <tr style="border: solid 1px #000000; ">
            <td style="border: solid 1px #000000; ">{{$data["cantidad"]}}</td>
              <input type="hidden" id="cantidad" name="cantidad" value="{{$data["cantidad"]}}">
           
            <td style="border: solid 1px #000000; ">{{$data["titulo"]}}</td>
               <input type="hidden" id="titulo" name="titulo" value="{{$data["titulo"]}}">
        
            <TD style="border: solid 1px #000000; ">{{$data["precio_unitario"]}}</TD>
            <input type="hidden" id="precio_unitario" name="precio_unitario" value="{{$data["precio_unitario"]}}">
            <TD style="border: solid 1px #000000; ">{{$data["subtotal"]}}</TD>
            <input type="hidden" id="sub_total" name="sub_total" value="{{$data["subtotal"]}}">
            </tr>
        

        <!--ESTO ES SOLO PARA AGREGAR FILAS DECORATIVAS SE PUEDEN SACAR-->

        <TR > <TD style="border: solid 1px #000000; "> </TD> <TD style="border: solid 1px #000000; "> </TD> <TD style="border: solid 1px #000000; "> </TD>  <TD style="border: solid 1px #000000; "> </TD> </TR>
        <TR > <TD style="border: solid 1px #000000; "> </TD> <TD style="border: solid 1px #000000; "> </TD> <TD style="border: solid 1px #000000; "> </TD>  <TD style="border: solid 1px #000000; "> </TD> </TR>
        <TR >
        <TD colspan="3" style="border: solid 1px #000000; "> Total </TD> 
        <TD aling="right" style="border: solid 1px #000000; ">  {{$data["total"]}}</TD>
        <input type="hidden" id="total" name="total" value="{$data["total"]}}">
        </TR>
        </tbody>s
        </TABLE>
        
         <br>
      
    </form>
 </center>
    </body>
</html>