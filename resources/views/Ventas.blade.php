@include('layout')


<!-- TODAS LAS VENTAS - VISTA DE /TODASVENTAS-->

<div class="titulo">
    <h1>Detalle de Venta</h1>
</div>
<hr>
<div class="container" >


    <div class="row">
        <div class="col-12" style="text-align: center;">	
            <!-- BUSCADOR -->
            <form class="form-inline">
                    <input type="text" id="texto" placeholder="Nombre del cliente" aria-label="Search" name="texto" style="width:1150px; heigth:10px">        
            </form>
        </div>
    </div>
</div>
        <!-- RESULTADOS DE LA BUSQUEDA -->	

<div id="resultados" class="my-3">



    @foreach($totalVentas as $p)
    <div class="container bg-light border border-dark mt-3">

            <div class="form-group col-md-6">
                <form action="/formulario" type="GET">

                        <label class="label-detalleVenta">ID VENTA

                                <input type="text" readonly class="form-control-plaintext input-detalleVenta" name="idVenta" value="{{ $p->idVenta }}">
                                <BR>
                                <input name="evento" type="submit" class="mx-3" value="MODIFICAR_VENTA" style="background: #68F741;" >
                                <button type="button" class="btn btn-warning btn-lg" data-dismiss="modal" onclick="eliminar({{$p->idVenta}})">ELIMINAR VENTA</button>




                </form>
                </label>

            </div>   
        <h3 class="subtitulo-detalleVenta">Datos del cliente</h3>


        <div class="form-group row">

            <div class="form-group col-md-2">
                <label class="label-detalleVenta">DNI-CUIL</label>
                <input type="text" readonly class="form-control-plaintext input-detalleVenta" style="width :150px;" value="{{ $p->Cliente_dni_cuit}}">
            </div>

            @foreach($clientes as $cliente)<!-- SACO EL NOMBRE DEL CLIENTE-->
            
                @if($cliente->dni_cuit==$p->Cliente_dni_cuit)
                <div class="form-group col-md-3">
                <label class="label-detalleVenta">Nombre</label>
                <input type="text" readonly class="form-control-plaintext input-detalleVenta" style="width :220px;" value="{{$cliente->nombre_apellido}}">
                </div>

                @endif

            @endforeach

            <div class="form-group col-md-2">
                <label class="label-detalleVenta">Domicilio</label>
                <input type="text" readonly class="form-control-plaintext input-detalleVenta" style="width :180px;" value="{{$p->lugar}}">
            </div>
            <div class="form-group col-md-2">
                <label class="label-detalleVenta">Condicion de pago</label>
                <input type="text" readonly class="form-control-plaintext input-detalleVenta" style="width :170px;" value="{{$p->condicion}}">
            </div>
            <div class="form-group col-md-2">
                <label class="label-detalleVenta">Fecha venta</label>
                <input type="text" readonly class="form-control-plaintext input-detalleVenta" style="width :190px;" value="{{$p->fecha}}">
            </div>
        </div>


        <h3 class="subtitulo-detalleVenta">Lista de libros</h3>
        <table class="table table-striped">
            <thead>
                <tr>
                    <th scope="col">ISBN</th>
                    <th scope="col">titulo</th>

                    <th scope="col">Cantidad</th>
                    <th scope="col">Descuento</th>
                    <th scope="col">Descripcion descuento</th>
                    <th scope="col">precio unitario</th>


                </tr>
            </thead>
            <tbody>
                
            @foreach($totalLibroxVenta as $i)<!-- VOY COMPARANDO Y SACO LOS LIBROS DE ESTA VENTA-->
            
                @if($i->idVenta==$p->idVenta)

                    <tr>
                        <td>{{ $i->ISBN }}</td>
                        <td>{{ $i->titulo}}</td><!-- AHORA LO TENGO EN LIBRO X VENTA -->


                        

                        <td>{{ $i->cant }}</td>
                        @foreach($descuentos as $descuento)<!-- INFORMACION DEL DESCUENTO -->
            
                            @if($i->IdDescuento==$descuento->idDescuento)
                                <td>{{ $descuento->porcentaje}} %</td>
                                <td>{{ $descuento->descripcion}}</td>

                            @endif

                        @endforeach
                
                        <td>{{ $i->precio_unitario }}</td>
                </tr>
                @endif
                    
                
            @endforeach

            </tbody>
      </table>

        <div class="form-group row">
            <div class="form-group col-md-6">
                <label class="label-detalleVenta">Total venta </label>
                <input type="text" readonly class="form-control-plaintext input-detalleVenta" value="{{$p->total}}">


            </div>
        </div>
    </div>
    <br>
      @endforeach
      <div class="col-12 d-flex justify-content-center pt-4">
    </div>


</div>

<div class="col-12 d-flex justify-content-center pt-4">
{{ $totalVentas->links() }}

<!--{{ $totalVentas->appends(request()->query())->links() }}-->

</div>
      <script>



//ELIMINO UNA VENTA
          function eliminar(idVenta){

            Swal.fire({
            title: '¿Está seguro de eliminar esta venta?',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#c82333',
            confirmButtonText: 'Eliminar',
            cancelButtonText: 'Cancelar'
            
            }).then((result) => {
            if (result.value) {

              $.ajax({url: "{{url('/eliminarVenta')}}",data:{"idVenta":idVenta}, success: function(resultado){
                
                /*Swal.fire({
                  position: 'center',
                  type: 'success',
                  title: resultado,
                  showConfirmButton: false,
                  timer: 1500
                });*/

                if(document.getElementById("texto").value.length>0){
                fetch(`/clientes/buscadorVentas?texto=${document.getElementById("texto").value}`,{
                  method:'get'
                })
                .then(response => response.text())
                .then(html => {
                  document.getElementById("resultados").innerHTML = html
                })
                }else{
                  fetch(`/todasVentas/buscadorAJAX?page={{$totalVentas->currentPage()}}`,{
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


          //BUSCADOR EN TIEMPO REAL CLIENTES

window.addEventListener("load",function(){
	document.getElementById("texto").addEventListener("keyup",function(){

		if(document.getElementById("texto").value.length>0){
			fetch(`/clientes/buscadorVentas?texto=${document.getElementById("texto").value}`,{//MUESTRO TODAS LAS OCURRENCIAS
				method:'get'
			})
			.then(response => response.text())
			.then(html => {
				document.getElementById("resultados").innerHTML = html
			})
		}else{
            fetch(`/todasVentas/buscadorAJAX?page={{$totalVentas->currentPage()}}`,{//VUELVO A LA PAGINA EN LA QUE ESTABA POSICIONADA CUANDO REALICE LA BUSQUEDA
				method:'get'
			})
			.then(response => response.text())
			.then(html => {
				document.getElementById("resultados").innerHTML = html
			})

           
		}
	});
});
/*
function eliminar(idVenta){
  
		

            fetch(`/todasVentas/buscadorAJAX?page={{$totalVentas->currentPage()}}`,{//VUELVO A LA PAGINA EN LA QUE ESTABA POSICIONADA CUANDO REALICE LA BUSQUEDA
				method:'get'
			})
			.then(response => response.text())
			.then(html => {
				document.getElementById("resultados").innerHTML = html
			})

}*/
      </script>