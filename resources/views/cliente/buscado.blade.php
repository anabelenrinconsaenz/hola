@extends('welcome')
@section('content')

<nav class="navbar">
  <h1>Lista de Clientes</h1>
  <form class="form-inline d-flex justify-content-center md-form form-sm active-purple active-purple-2 mt-2" action =  " {{ url ('cliente/buscar') }}">
    <input value="" id="nombre_apellido" class="form-control mr-sm-2" name="nombre_apellido" type="text" placeholder="Search" >
    <button type="submit" class="btn btn-dark">buscar</button>
  </form>
  
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
                 </div>
@endsection