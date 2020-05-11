@extends('welcome')
@section('content')

<nav class="navbar">
  
  <h1>Lista de Clientes</h1>
  <a href="cliente/create">
   <img src="{{asset('imagen/add-file (1).png')}}" width="64" height="64" >
  </a>
 
</nav>
 
                 <div class="row d-flex justify-content-center">
                   <table class="table table-bordered">
                     <thead class="thead-dark">
                       <tr>
                         <th scope="col">DNI o CUIT</th>
                         <th scope="col">Nombre y Apellido o Razón social</th>
                         <th scope="col">Domicilio</th>
                         <th scope="col">Teléfono</th>
                         <th scope="col">Email</th>
                         <th scope="col">Tipo Cliente</th>
                         <th scope="col">Facultad</th>
                         <th scope="col">Acciones</th>
                       </tr>
                     </thead>
                     <tbody>
                     @foreach($clientes as $cli)
                       <tr>
                        
                         <td>{{$cli->dni_cuit}}</td>
                         <td>{{$cli->nombre_apellido}}</td>
                         <td>{{$cli->domicilio}}</td>
                         <td>{{$cli->telefono}}</td>
                         <td>{{$cli->email}}</td>
                         <td>{{$cli->descripcion_cliente}}</td>
                         <td>{{$cli->descripcion_facultad}}</td>
                         <td> <a  href="{{url('editarCliente',[$cli->dni_cuit])}}">Editar</a></td>
                       </tr>
                      @endforeach
                     </tbody>
                   </table>
                   <div class="row" >
                    <div class="col-12 d-flex justify-content-center pt-4">
                        {{$clientes->links()}}
                    </div>
                   
                   </div>
                 </div>
@endsection