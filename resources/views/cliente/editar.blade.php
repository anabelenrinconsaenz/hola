@extends('welcome')
@section('content')
<h1> Seleccione el cliente a modificar </h1>
<div class=" container ">
<div class="row d-flex justify-content-center">
<form>
                   <table class="table table-bordered">
                     <thead class="thead-dark">
                       <tr>
                         <th scope="col">DNI o CUIT</th>
                         <th scope="col">Nombre y Apellido o Razón social</th>
                         <th scope="col">Domicilio</th>
                         <th scope="col">Teléfono</th>
                         <th scope="col">Email</th>
                         <th scope="col">Acción</th>
     
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
                         
                            <td>
                                <div style=" margin-top: 10px; ">
                                    <button><a href="{{ url ('cliente/edit/editar/modificar',[$cli->nombre_apellido]) }}">Modificar</a></button>
                                </div>  
                            </td>
                        
                       </tr>
                      @endforeach
                     </tbody>
                   </table>
                   </form>
                 </div>
              
        
    
@endsection