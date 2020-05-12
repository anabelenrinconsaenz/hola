<!DOCTYPE html>
<html lang="es">
   <head>
      <meta charset="utf-8">
   </head>
   <body>
        
         <table>
            <caption>Lista de  recibosw</caption>
             <thead>
              <tr>
                <th scope="col" style="background-color:#D3D3D3;"><h4>ISBN</h4></th>
                <
               </tr>
              </thead>
              <tbody>
        @foreach ($info as $fila)
            <tr>
            <td><h4>{{$fila["ISBN"]}}</h4><br></td>
            </tr>
        @endforeach
        </tbody>
   </body>
</html>