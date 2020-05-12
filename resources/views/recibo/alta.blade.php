
@include('layout')
<table class="table table-bordered">
                     <thead class="thead-dark">
                       <tr>
                         <th scope="col">DNI o CUIT</th>
                         <th scope="col">Nombre y Apellido o Razón social</th>
                         <th scope="col">Domicilio</th>
                         <th scope="col">Teléfono</th>
                         <th scope="col">Email</th>
                       </tr>
                     </thead>
                     <tbody>
                     @foreach($cliente as $cli)
                       <tr>
                        
                         <td>{{$cli->dni_cuit}}</td>
                         <td>{{$cli->nombre_apellido}}</td>
                         <td>{{$cli->domicilio}}</td>
                         <td>{{$cli->telefono}}</td>
                         <td>{{$cli->email}}</td>
                     
                         
                       </tr>
                      @endforeach
                     </tbody>
                   </table>

      fecha:        {{$nuevaVenta->fecha}}  
        
        @foreach ($info as $fila)
            <tr>
            <td><h4>{{$fila["ISBN"]}}</h4><br></td>
            
            <td><h4>{{$fila["cantidad"]}}</h4><br></td>
            @foreach($fila["titulo"] as $ti)

            <td><h4>{{$ti->titulo}}</h4><br></td>
            @endforeach
            
            </tr>
        @endforeach             