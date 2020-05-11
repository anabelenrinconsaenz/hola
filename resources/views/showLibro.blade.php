@extends('welcome')
@section('content')

<nav class="navbar">
  
  <h1>Lista de Libros</h1>  
</nav>
<form action=" {{ url('notificacion') }}">
                 <div class="row d-flex justify-content-center">
                   <table class="table table-bordered">
                     <thead class="thead-dark">
                       <tr>
                         <th scope="col">ISBN</th>
                         <th scope="col">titulo</th>
                         <th scope="col">cant total</th>
                        
                        
                       </tr>
                     </thead>
                     <tbody>
                     @foreach($libros as $li)
                       <tr>
                        
                         <td>{{$li->ISBN}}</td>
                         <td>{{$li->titulo}}</td>
                         <td>{{$li->cant_deposito}}</td>
                         

                       </tr>
                      @endforeach
                     </tbody>
                   </table>
                   
                  
                  <div style=" margin-top: 10px; ">
                     <button type="submit" class="btn btn-primary btn-lg btn-block">notificacion</button>
                  </div>
                 </div>
</form>
@endsection