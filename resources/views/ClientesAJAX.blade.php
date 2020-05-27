@if(count($clientes))

	<div class="titulo">
        <h1>Seleccionar Cliente </h1>
    </div>
    <div class="container">
        <form class="my-2 my-lg-0">
            <input class="form-control mr-sm-2 w-80" type="text" placeholder="Nombre o apellido del cliente" aria-label="Search" id="textoCliente" name="textoCliente">
        </form>
    </div>

	<!-- RESULTADOS DE LA BUSQUEDA -->	

    <div id="resultadosCliente" class="list-group mt-3"></div>
	<br>

    <div class="container">

        <table class="table table-striped" class="tablaCliente" id="tablaCliente">
            <thead>
               
                <tr>
                    <th scope="col">DNI - CUIT</th>
                    <th scope="col">Nombre y Apellido</th>
                    <th scope="col">Domicilio</th>
                    <th scope="col">Telefono</th>
                    <th scope="col">Email</th>
                    <th scope="col">Tipo</th>

                </tr>
            </thead>
            <tbody >
          
            @foreach($clientes as $cliente)

            <tr>
                    <th>{{$cliente->dni_cuit}}</th>
                    <td>{{$cliente->nombre_apellido}}</td>
                    <td>{{$cliente->domicilio}}</td>
                    <td>{{$cliente->telefono}}</td>
                    <td>{{$cliente->email}}</td>
                    <td>{{$cliente->id_tipo_cliente}}</td>
                    <td><input type="checkbox" id="cbox2" value="{{$cliente->dni_cuit}}"> <label for="cbox2"></label>


            </tr>

            @endforeach

            </tbody>
        </table>
    </div>
    <div class="container">
        <input type="submit" class="mx-3 confirmar" id="confirmar" value="confirmar" style="background: #e86a04;" >
       <input type="submit" class="mx-3" value="Nuevo cliente" style="background: #e86a04;" >
    </div>
    <script>


window.addEventListener("load",function(){
	document.getElementById("textoCliente").addEventListener("keyup",function(){

		if(document.getElementById("textoCliente").value.length>=0){
			fetch(`/nombresClientes/buscador?texto=${document.getElementById("textoCliente").value}`,{
				method:'get'
			})
			.then(response => response.text())
			.then(html => {
				document.getElementById("resultadosCliente").innerHTML = html
			})
		}else{
			document.getElementById("resultadosCliente").innerHTML= " "
		}
	})
})


</script>

    @endif

 