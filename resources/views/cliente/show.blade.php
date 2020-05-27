@extends('welcome')
@section('content')

<div class="titulo">
  <h1>Lista de clientes</h1>
  <i class='fas fa-users' style='font-size:48px;color:#e86a04;margin-left: 10px;'></i>
</div>
  
<div class="titulo" style="height: 45px">
  <!--color:#white;-->
  <button type="button" onclick="window.location.href='cliente/create'" class="btn btn-success" ><i class='fas fa-user-plus' style="margin-right: 1px"></i>Nuevo cliente</button>
    <!-- Search form -->
</div>

<div style="margin-left: 50px;margin-right: 50px;margin-top: 10px;background-color: white"> 
                 
                   <table class="table table-hover table-bordered" style="font-size: 0.9rem">
                     <thead>
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
                         <td>
                              <a href="{{url('editarCliente',[$cli->dni_cuit])}}" style="text-decoration:none;color:black;">
                                  <i class='fas fa-user-edit' style='color:#337ab7;'>
                                      <font face="Arial,MS Sans Serif" size="2">
                                          Editar
                                      </font>
                                  </i>
                              </a>
                         </td>
                       </tr>
                      @endforeach
                     </tbody>
                   </table>
                   </div>
                   
                    <div class="col-12 d-flex justify-content-center pt-4">
                        {{$clientes->links()}}
                    </div>

@endsection