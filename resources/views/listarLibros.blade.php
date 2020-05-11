@include('layout')

<div class="titulo">
	<h1>Lista de libros</h1>
	<i class='fas fa-book' style='font-size:48px;color:#e86a04;margin-left: 10px;'></i>
</div>
<div class="titulo" style="height: 45px">
	<!--color:#white;-->
	<button type="button" onclick="window.location.href='nuevoLibro'" class="btn btn-success" style="width:11%;"><div style="width: 100px;height: 30px"><i class='fas fa-plus' style="margin-right: 1px"></i>Nuevo libro</div></button>
    <!-- Search form -->
    <div class="input-group md-form form-sm form-1 pl-0" style="margin-left: 10px;">
	  <div class="input-group-prepend">
	    <span class="input-group-text purple lighten-3" id="basic-text1" style="background-color: #e86a04;border: 1px solid #e86a04"><i class="fas fa-search text-white" aria-hidden="true"></i></span>
	  </div>
	  <input class="form-control my-0 py-1" type="text" id="texto" placeholder="Ingrese libro a buscar..." aria-label="Search" name="texto" style="height:45px;">
	</div>
</div>




<div style="margin-left: 50px;margin-right: 50px;margin-top: 10px;background-color: white">


  <table class="table table-hover table-bordered" style="font-size: 0.9rem">
    <thead>
      <tr>
        <th scope="col" width="80px">Precio General</th>
        <th scope="col" width="80px">Precio Estudiante</th>
        <th scope="col" width="80px">Precio Docente</th>
        <th scope="col">Título</th>
        <th scope="col">Autor</th>
        <th scope="col" width="75px">Editorial</th>
        <th scope="col" width="60px">Stock</th>
        <th scope="col" width="260px">Acciones</th>
      </tr>
    </thead>
    <tbody id="resultados">
    @foreach($totalLibros as $i)
      <tr>
        <td data-toggle="modal" data-target="#myModalLibro{{$i->ISBN}}">{{ $i->precio_general }}</td>
        <td data-toggle="modal" data-target="#myModalLibro{{$i->ISBN}}"> {{ $i->precio_estudiante }} </td>
        <td data-toggle="modal" data-target="#myModalLibro{{$i->ISBN}}"> {{ $i->precio_docente }} </td>
        <td data-toggle="modal" data-target="#myModalLibro{{$i->ISBN}}"> {{ $i->titulo }} </td>
        <td data-toggle="modal" data-target="#myModalLibro{{$i->ISBN}}">{{ $i->autor }}</td>
        <td data-toggle="modal" data-target="#myModalLibro{{$i->ISBN}}">{{ $i->editorial }}</td>
        @if($i->stock_min<$i->cant_deposito)
        <td  data-toggle="modal" data-target="#myModalLibro{{$i->ISBN}}">{{$i->cant_deposito }}</td>
        @endif
        @if($i->stock_min>=$i->cant_deposito)
          <td class="table-danger" data-toggle="modal" data-target="#myModalLibro{{$i->ISBN}}">{{$i->cant_deposito }}</td>
        @endif
        <td>
                <a data-toggle="modal" href="#myModalStock{{$i->ISBN}}" style="text-decoration:none;color:black;">
                    <i class='fas fa-plus' style='color:#4caf50;'>
                        <font face="Arial,MS Sans Serif" size="2">
                            Stock
                        </font>
                    </i>
                </a>
                |
                <a href="/editar?ISBN={{$i->ISBN}}" style="text-decoration:none;color:black;">
                    <i class='fas fa-edit' style='color:#337ab7;'>
                        <font face="Arial,MS Sans Serif" size="2">
                            Editar
                        </font>
                    </i>
                </a>
                |
                <a data-toggle="modal" href="#" onclick="borrar({{$i->ISBN}})" style="text-decoration:none;color:black;">
                    <i class='fas fa-trash-alt' style='color:#d9534f;'>
                        <font face="Arial,MS Sans Serif" size="2">
                            Eliminar
                        </font>
                    </i>
                </a>
        </td>
      </tr>

      <!-- The Modal Libro-->
      <div class="modal fade" id="myModalLibro{{$i->ISBN}}">
        <div class="modal-dialog modal-dialog-centered">
          <div class="modal-content">

          <!-- Modal Header -->
          <div class="modal-header">
            <h4 class="modal-title">
              <i class='fas fa-plus' style='color:#337ab7;font-size:24px;'>
                <font face="Arial,MS Sans Serif" size="5">
                  Info
                </font>
              </i>
            </h4>
            <button type="button" class="close" data-dismiss="modal">&times;</button>
          </div>

          <!-- Modal body -->
          <div class="modal-body">
            <div class="row">
              <div class="col-25">
                <label for="id" style="padding-left: 10px">ISBN - ISSN</label>
              </div>
              <div class="col-75">
                <input type="text" name="ISBN" value="{{ $i->ISBN }}" style="width: 100%;padding: 12px;border: 1px solid #ccc;border-radius: 4px;resize: vertical;" readonly>
              </div>
            </div>
            <div class="row">
              <div class="col-25">
                <label for="id" style="padding-left: 10px">Venta</label>
              </div>
              <div class="col-75">
                <input type="text" name="cant_venta" value="{{ $i->cant_venta }}" style="width: 100%;padding: 12px;border: 1px solid #ccc;border-radius: 4px;resize: vertical;" readonly>
              </div>
            </div>
            <div class="row">
              <div class="col-25">
                <label for="id" style="padding-left: 10px">Stock minimo</label>
              </div>
              <div class="col-75">
                <input type="text" name="stock_min" value="{{ $i->stock_min }}" style="width: 100%;padding: 12px;border: 1px solid #ccc;border-radius: 4px;resize: vertical;" readonly>
              </div>
            </div>
          </div>

            </div>
          </div>
      </div>


      <!-- The Modal Agregar-->
      <div class="modal fade" id="myModalStock{{$i->ISBN}}">
        <div class="modal-dialog modal-dialog-centered modal-sm">
          <div class="modal-content">

            <!-- Modal Header -->
            <div class="modal-header">
              <h4 class="modal-title">Agregar stock</h4>
              <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>

            <!-- Modal body -->
            <div class="modal-body">
              <input type="number" name="stock" id="stock{{$i->ISBN}}"  value="0" min="0">
            </div>

            <!-- Modal footer -->
            <div class="modal-footer">
              <button type="button" class="btn btn-danger" data-dismiss="modal" onclick="modificarStock({{$i->ISBN}},{{$i->cant_deposito}})">Guardar</button>
            </div>

          </div>
        </div>
      </div>
      @endforeach
    </tbody>
  </table>
      <!--
        <div id="ele-0" name="ele-0" style="display: none;">
        	<div class="container">
        		<div align="center">
        			<div class="alert alert-danger">
					  <strong> El libro que intenta buscar no se encuentra en la Base de Datos</strong>
					</div>
        		</div>
        	</div>
        </div>
      -->
</div>

    <div class="col-12 d-flex justify-content-center pt-4">
      {!! $totalLibros->render() !!}
    </div>


<script>

  window.addEventListener("load",function(){
    document.getElementById("texto").addEventListener("keyup",function(){

      if(document.getElementById("texto").value.length>0){
        fetch(`/paginaprincipalBuscador?texto=${document.getElementById("texto").value}`,{
          method:'get'
        })
        .then(response => response.text())
        .then(html => {
          document.getElementById("resultados").innerHTML = html
        })
      }else{
        fetch(`/todos`,{
          method:'get'
        })
        .then(response => response.text())
        .then(html => {
          document.getElementById("resultados").innerHTML = html
        })
      }
    });
  });

  function borrar(idLib){

        Swal.fire({
            title: '¿Está seguro de eliminar el libro?',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#c82333',
            confirmButtonText: 'Eliminar',
            cancelButtonText: 'Cancelar'
            
            }).then((result) => {
            if (result.value) {

              $.ajax({url: "{{url('/eliminarLib')}}",data:{"idLib":idLib}, success: function(resultado){
                
                /*Swal.fire({
                  position: 'center',
                  type: 'success',
                  title: resultado,
                  showConfirmButton: false,
                  timer: 1500
                });*/

                if(document.getElementById("texto").value.length>0){
                fetch(`/paginaprincipalBuscador?texto=${document.getElementById("texto").value}`,{
                  method:'get'
                })
                .then(response => response.text())
                .then(html => {
                  document.getElementById("resultados").innerHTML = html
                })
                }else{
                  fetch(`/todos`,{
                    method:'get'
                  })
                  .then(response => response.text())
                  .then(html => {
                    document.getElementById("resultados").innerHTML = html
                  })
                }

              }});
                
            }});
  }

  function modificarStock(id,cant_deposito){

    stock=document.getElementById("stock"+id).value;

    $.ajax({url: "{{url('/modificarStock')}}",data:{"id":id,"cant_deposito":cant_deposito,"stock":stock}, 
                success: function(resultado){
      
          /*Swal.fire({
            position: 'center',
            type: 'success',
            title: resultado,
            showConfirmButton: false,
            timer: 1500
          });*/

          if(document.getElementById("texto").value.length>0){
          fetch(`/paginaprincipalBuscador?texto=${document.getElementById("texto").value}`,{
            method:'get'
          })
          .then(response => response.text())
          .then(html => {
            document.getElementById("resultados").innerHTML = html
          })
          }else{
            fetch(`/todos`,{
              method:'get'
            })
            .then(response => response.text())
            .then(html => {
              document.getElementById("resultados").innerHTML = html
            })
          }

        }});
  }

</script>




