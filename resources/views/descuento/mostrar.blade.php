@extends('welcome')
@section('content')

<nav class="navbar">
  
  <h1>Mostrar descuentos vigentes</h1>
  <a href="descuento/crear">
   <img src="{{asset('imagen/add-file (1).png')}}" width="64" height="64" >
  </a>

  <form class="form-inline d-flex justify-content-center md-form form-sm active-purple active-purple-2 mt-2" 
  action =  " {{ url ('descuento/buscar') }}" method="get">
    <div class="row">
        <div>
          <label for="fecha_inicio"> Fecha de Inicio </label>
        </div>
        <div class="col-75">
          <input type="date" id="fecha_inicio" name="fecha_inicio" min=''>
        </div>
    </div>
    <div class="row">
      <div >
        <label for="fecha_final"> Fecha de Finalización </label>
      </div>
      <div class="col-75">
        <input  type="date" id="fecha_final" name="fecha_final" min=''>
      </div>
      <script>
                    var todaysDate = new Date(); // Gets today's date<font></font>
                    var year = todaysDate.getFullYear();    
                    var month = ("0" + (todaysDate.getMonth() + 1)).slice(-2);  // MM<font></font>
                    var day = ("0" + todaysDate.getDate()).slice(-2);           // DD<font></font>
                    var minDate = (year +"-"+ month +"-"+ day);
                    document.getElementById("fecha_inicio").setAttribute("min", minDate);
                    document.getElementById("fecha_final").setAttribute("min", minDate);
      </script>
      <button type="submit" class="btn btn-dark">buscar</button>
    </div>
  </form>
  
</nav>
 
<div class="row d-flex justify-content-center">

  <table class="table table-bordered">
    <thead class="thead-dark">
      <tr>
        <th scope="col">Titulo</th>
        <th scope="col">Editorial</th>
        <th scope="col">Tipo de descuento</th>
        <th scope="col">Fecha de inicio</th>
        <th scope="col">Fecha de finalizacion</th>
        <th scope="col">Porcentaje</th>
        <th scope="col">Descripcion</th>
        <th scope="col">Acción</th>
      </tr>
    </thead>
    <tbody>
      @foreach($descuento as $des)
        <tr>
          <td>{{$des->titulo}}</td>
          <td>{{$des->editorial}}</td>             
          <td>{{$des->idtipo_descuento}}</td>
          <td>{{$des->fecha_inicio}}</td>
          <td>{{$des->fecha_final}}</td>
          <td>{{$des->porcentaje}}</td>
          <td>{{$des->descripcion}}</td>
          <td>  
            <a href="descuento/eliminar/{{$des->idDescuento}}">
              <img src="{{asset('imagen/eliminar.png')}}" width="38" height="30" >
            </a>
            <a href="descuento/modificar/{{$des->idDescuento}}">
              <img src="{{asset('imagen/Edit.svg')}}" width="38" height="30" >
            </a>
          </td>
        </tr>
      @endforeach
    </tbody>
  </table>  
</div>

<div class="row">
  <div class="col-12 d-flex justify-content-center pt-4">
    {{ $descuento->links()}}
  </div>
</div>

  <script>
    function borrar(idDes){

      Swal.fire({
        title: '¿Está seguro de eliminar el descuento?',
        text: "",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#c82333',
        cancelButtonColor: '#28a745',
        confirmButtonText: 'Eliminar',
        cancelButtonText: 'Cancelar'
                          
        }).then((result) => {
          if (result.value) {
            $.ajax({url: "{{url('descuento/eliminar')}}",data:{"idDes":idDes}, success: function(resultado){
              Swal.fire({
                position: 'center',
                type: 'success',
                title: resultado,
                showConfirmButton: false,
                timer: 1000
              });

            }});

          }
        })                
    }
  </script>
@endsection