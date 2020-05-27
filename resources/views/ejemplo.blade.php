<!DOCTYPE html>
<html lang="es">
    <head>
        
        <title>Document</title>
         <meta charset="utf-8">
         <!-- CON ESTA LINEA LE DOY FORMATO A LA TABLA PERO LOS OTROS DATOS NO SE VEN, SIN LA 
         LINEA LOS DATOS SE VEN PERO LA TABLA QUEDA FEA-->
         <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
        
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
         .titulo {
                margin-top: 10px;
                background-color:#dfdcdd;
                margin-left: 50px;
                margin-right: 50px;
                display: flex;
            }
            
            * {
                box-sizing: border-box;
              }
              input[type=text], select, textarea {
                width: 100%;
                padding: 12px;
                border: 1px solid #ccc;
                border-radius: 4px;
                resize: vertical;
              }
              label {
                padding: 12px 12px 12px 0;
                display: inline-block;
              }
              .visibleClass {
                display: block !important;
              } 
              input[type=submit] {
                background-color: #4CAF50;
                color: white;
                padding: 12px 20px;
                border: none;
                border-radius: 4px;
                cursor: pointer;
                float: right;
              }
              input[type=submit]:hover {
                background-color: #45a049;
              }
              .container {
                padding: 20px;
              }
              .col-25 {
                float: left;
                width: 25%;
                margin-top: 6px;
              }
              .col-75 {
                float: left;
                width: 75%;
                margin-top: 6px;
              }
              /* Clear floats after the columns */
              .row:after {
                content: "";
                display: table;
                clear: both;
              }
              /* Responsive layout - when the screen is less than 600px wide, make the two columns stack on top of each other instead of next to each other */
              @media screen and (max-width: 600px) {
                .col-25, .col-75, input[type=submit] {
                  width: 100%;
                  margin-top: 0;
                }
              }
    </style>
    </head>
    <body>
      <BR>
<center>

<h1 align="center"> Recibo </h1>

    <form  action="{{ url ('/imprimir') }}" method="GET" style=" max-width: 60em; height: 40em; background-color:#FDFEA4; ">
         <table style="border-collapse: separate; border-spacing: 0 10px; width: 100%;">
         <TR  >
        <TD colspan="3" aling="right" ><b>  NRº </b></TD>
        <TD> {{$data['id_talonario']}} -{{$data['id_recibo']}}</TD>
        </TR>
        <TR >
        <TD colspan="3"> <b> Fecha: </b>  </TD>
        <TD>  {{$data['fecha']}}</TD>
        </TR>
        <TR >
        <TD colspan="3"> <b> Nom y Ap/Razon Social: </b> </TD>
        <TD>  {{$data['nombre']}}</TD>
        </TR>
        <TR >
        <TD > <b> Domicilio:   </b></TD>
        <TD colspan="2" >  {{$data['domicilio']}}</TD>
        <TD ><b> DNI o CUIT:</b> </TD>
        <TD colspan="2"> {{$data['dni_cuit']}} </TD>
        </TR>
        <TR >
        <TD > <b> Telefono:  </b> </TD>
        <TD>  {{$data['telefono']}}</TD>
        <TD> <b>Email: </b></TD>
        <TD> {{$data['email']}} </TD>
        </TR>
        </table>
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