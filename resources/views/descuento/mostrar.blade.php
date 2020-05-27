@extends('welcome')
@section('content')

<div class="titulo">
  <h1>Lista de descuentos</h1>
  <i class='fas fa-tags' style='font-size:48px;color:#e86a04;margin-left: 10px;'></i>
</div>

<div>
  
</div>

<div class="titulo" style="margin-top: 0px">
  <div class="table-responsive">
    <table class="table table-borderless ">
    <tr>
      <td colspan="6">
        <div style="justify-content: flex-start;display: flex;margin-left: -10px">
          <button type="button" onclick="window.location.href='descuento/crear'" class="btn btn-success" style="height: 45px"><i class='fas fa-tag' style="margin-right: 2px;"></i>Nuevo descuento</button>
        </div>
      </td>
      <td colspan="6">
        <div style="justify-content: flex-end;display: flex;margin-right: -10px">
          <form class="form-inline md-form form-sm active-purple active-purple-2 mt-2" action="{{url('descuento/buscar')}}" method="get" >
          <div>
              Fecha de Inicio
              <input type="date" id="fecha_inicio" name="fecha_inicio">
          </div>
          <div style="margin-left: 10px;">
              Fecha de Finalización
              <input  type="date" id="fecha_final" name="fecha_final">
          </div>
          <button id="btnBuscar" type="submit" class="btn btn-dark" style="margin-left: 10px;"><i class='fas fa-search' style="margin-right: 5px"></i>Buscar</button>
          </form>  
        </div>
      </td>  
    </tr>
    </table>
  </div>
</div>

 
<div style="margin-left: 50px;margin-right: 50px;margin-top: -20px;background-color: white">

  <table class="table table-hover table-bordered" style="font-size: 0.9rem">
    <thead>
      <tr>
        
        <th scope="col">Tipo de descuento</th>
        <th scope="col">Fecha de inicio</th>
        <th scope="col">Fecha de finalizacion</th>
        <th scope="col">Porcentaje</th>
        <th scope="col">Descripcion</th>
        <th scope="col" width="180px">Acción</th>
      </tr>
    </thead>
    <tbody>
      @foreach($descuento as $des)
        <tr>
          @if($des->idtipo_descuento==1)           
            <td>Promocion</td>
          @endif
          @if($des->idtipo_descuento==2)           
            <td>Barata</td>
          @endif
          <td>{{$des->fecha_inicio}}</td>
          <td>{{$des->fecha_final}}</td>
          <td>{{$des->porcentaje}}</td>
          <td>{{$des->descripcion}}</td>
          <td>
                <a href="descuento/modificar/{{$des->idDescuento}}" style="text-decoration:none;color:black;">
                    <i class='fas fa-edit' style='color:#337ab7;'>
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
  <!--<p id="demo"></p>-->
</div>


  <div class="col-12 d-flex justify-content-center pt-4">
    {{ $descuento->links()}}
  </div>

  

  <script>

    window.addEventListener("load",verificarFecha());

    function verificarFecha(){
      var fi = document.getElementById("fecha_inicio").value;
      var ff = document.getElementById("fecha_final").value;
      //document.getElementById("demo").innerHTML = fi;
      if (!fi || !ff){
        document.getElementById("btnBuscar").disabled = true;
      }else{
        document.getElementById("btnBuscar").disabled = false;
      }
      var refrescar= setTimeout(function(){verificarFecha()},100);
    }
  </script>

@endsection