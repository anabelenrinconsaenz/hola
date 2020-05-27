@include('layout')

<!-- ACA SELECCIONO TODOS LOS DATOS PARA UNA NUEVA VENTA -->

<div class="titulo">
	<h1>Nueva venta</h1>
	<img src="{{ asset ('storage/book-account.png') }}" alt="logo">
</div>
	
<div class="container" style="text-align: center;">
<div class="row">
	<div id="tabla1" class="col-6">	

		<!--LIBROS-->
		<!-- BUSCADOR -->
		<form class="form-inline">
			<input class="form-control w-100" type="text" id="texto" placeholder="Nombre del libro" aria-label="Search" name="texto">
			
		</form>
		
		<!-- RESULTADOS DE LA BUSQUEDA -->	

		<div id="resultados" class="my-3"></div>
					
		<!-- LISTADO DE TODOS LOS LIBROS  -->
			<div style="height: 300px; overflow: auto;">

				<table id="Libros" style="border-collapse: separate; border-spacing: 0 10px; width: 100%;">
					@foreach($libros as $libro)

					
					<tr> <!-- FILA -->

<td class="bg-light border-bottom border-gray rounded text-center px-2" style="font-size:13px" id="ISBNlibro">{{$libro->ISBN}} </td>
<td style="visibility: hidden">{{$libro->precio_general}}</td>
<td style="visibility: hidden">{{$libro->precio_docente}}</td>

<td style="text-align:center">{{$libro->titulo}} </td>
<td style="visibility: hidden">{{$libro->cant_venta}}</td>
<td style="visibility: hidden">{{$libro->precio_estudiante}}</td>
<td style="visibility: hidden">{{$libro->cant_deposito}}</td>
<td style="text-align:center">
	<button value="comprarLibro" title="Agregar a la lista" class="btn btn-primary btn-cargar" id="{{$libro->ISBN}}" aling="right">
		<i class="fa fa-check-square-o" aria-hidden="true"></i>
	</button>
</td>

</tr>
			
					@endforeach
				</table>
			</div>

	<!-- clientes-->

	</div>

	<div id="tabla2" class="col-6"> 

		<div class="form-inline">

			<input class="form-control w-100" type="text" placeholder="Nombre o apellido del cliente" aria-label="Search" id="textoCliente" name="textoCliente">

		</div>

		<!-- RESULTADOS DE LA BUSQUEDA -->	

		<div id="resultadosCliente" class="my-3"></div>

		<div style="height:300px; overflow:auto;">

			<table style="border-collapse: separate; border-spacing: 0 10px; width: 100%;">
				@foreach($datos as $cliente)

				<tr>
						<td id="dni_cuit" class="bg-light border-bottom border-gray rounded text-center px-2" style="font-size:13px">{{$cliente->dni_cuit}}</td>
						<td name="nombre" style="text-align:center">{{$cliente->nombre_apellido}}</td>
						<td name="domicilio" style="text-align:center">{{$cliente->domicilio}}</td>
						<td name="telefono" style="text-align:center">{{$cliente->telefono}}</td>
						<td name="telefono" style="text-align:center" hidden>{{$cliente->id_tipo_cliente}}</td>
						@if($cliente->id_tipo_cliente==1)
						<td name="descripcion" style="text-align:center">General</td>
						@endif
						@if($cliente->id_tipo_cliente==2)
						<td name="descripcion" style="text-align:center">Estudiante</td>
						@endif
						@if($cliente->id_tipo_cliente==3)
						<td name="descripcion" style="text-align:center">Docente</td>
						@endif

						<td style=" text-align:center">
							<button value="elegirCliente" title="elegirCliente" class="btn btn-primary elegirCliente" aling="right">
								<i class="fa fa-check-square-o" aria-hidden="true"></i>
							</button>
						</td>                   	
					</tr>

				@endforeach

			</table>
		</div>
	</div>
</div>
</div>

<!-- LIBROS SELECCIONADOS EN UNA VENTA -->
<div class="container">


<!-- CON ESTA TABLA ENVIO TODOS LOS DATOS DE LA VENTA (FORM)-->

	<form id="form-compra" action="/InsertVenta" type="GET"> 

		<!-- LIBROS -->
		<table class="table table-striped tablaVenta mb-5" id="tablaVenta">
			<thead>
				<tr>
				<th scope="col">ISBN</th>
					<th scope="col">Titulo</th>
					<th scope="col">Precio estudiante</th>
					<th scope="col">Precio general</th>
					<th scope="col">Precio docente</th>
					<th scope="col">Cantidad</th>
					<th scope="col">Descuento</th>



					
				</tr>
			</thead>
			
			<tbody>

			</tbody>
			
		</table>

		<table class="table table-striped tablaCliente mb-5" id="tablaCliente">
			<thead>
				<tr>
				<th scope="col">DNI o CUIT</th>
					<th scope="col">Nombre</th>
					<th scope="col">Domicilio</th>
					<th scope="col">Telefono</th>
					<th scope="col">Fecha</th>
					<th scope="col">Condicion</th>
					<th scope="col">Lugar</th>


				</tr>
			</thead>
			<tbody>

			</tbody>
			
		</table>


		
		<div id="alerta"></div>

		<div class="form-group" style="width: 100%;">
			<button class="btn btn-danger btn-lg btn-block"  id="btnConfirmarVenta" type="submit"> Confirmar venta</button>
		</div>

	</form>
</div>

	<script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
	<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
</body>
</html>


<script>






//BUSCADOR EN TIEMPO REAL LIBROS

window.addEventListener("load",function(){
	document.getElementById("texto").addEventListener("keyup",function(){

		if(document.getElementById("texto").value.length>0){
			fetch(`/nombres/buscador?texto=${document.getElementById("texto").value}`,{
				method:'get'
			})
			.then(response => response.text())
			.then(html => {
				document.getElementById("resultados").innerHTML = html
			})
		}else{
			document.getElementById("resultados").innerHTML= " "
		}
	});
});




$(document).on('click','.btn-cargar', function(e){
	e.preventDefault(); //evita que se recargue la pagina

	$(this).attr("disabled",true);

	ISBN=$(this).parent().parent().children("td:eq(0)").text(); //estoy posicionada en el boton, el padre es el TD y luego el TR, luego para obtener solo el ISBN pongo el resto
	precio_general=$(this).parent().parent().children("td:eq(1)").text(); 

	precio_docente=$(this).parent().parent().children("td:eq(2)").text(); 


	titulo=$(this).parent().parent().children("td:eq(3)").text(); 
	cant_venta=$(this).parent().parent().children("td:eq(4)").text(); 
	precio_estudiante=$(this).parent().parent().children("td:eq(5)").text(); 
	cant_deposito=$(this).parent().parent().children("td:eq(6)").text(); 

	cant_libros=parseInt(cant_deposito);

	agregarFila(ISBN,titulo,precio_estudiante,precio_general,cant_libros,precio_docente);
});


function agregarFila(ISBN, titulo,precio_estudiante,precio_general,cant_libros,precio_docente) {
   
	var htmlTags = '<tr>'+
  		'<td><input class="form-control" style="width :110px; font-size:13px" type="text" name="ISBNtabla[]" value="'+ISBN+'" readonly></td>'+ 
  		'<td><input class="form-control" style="width :250px; font-size:13px" type="text" name="TITULOtabla[]" value="'+titulo+'" readonly></td>'+ 
  		'<td><input class="form-control subtotal" style="width :100px; font-size:13px" type="number" name="PRECIO_ESTUDIANTEtabla[]" value="'+precio_estudiante+'" readonly></td>'+ 
  		'<td><input class="form-control subtotal" style="width :100px; font-size:13px" type="number" name="PRECIO_GENERALtabla[]" value="'+precio_general+'" readonly></td>'+ 
		'<td><input class="form-control subtotal" style="width :100px; font-size:13px" type="number" name="PRECIO_DOCENTEtabla[]" value="'+precio_docente+'" readonly></td>'+ 
		'<td><input type="number" name="CANTIDADtabla[]" style="width :100px; font-size:13px" class="form-control" min="0" max="'+cant_libros+'" required></td>'+
		'<td><select id="idDescuento" name="idDescuento[]" class="form-control" style="width :200px; font-size:13px" required>'+
		@foreach($descuentos as $descuento)
			@if($descuento->fecha_inicio<= now()->toDateString() && ($descuento->fecha_final>=now()->toDateString() || $descuento->idtipo_descuento==2 || $descuento->idtipo_descuento==3))
     		'<option value={{$descuento->idDescuento}}>{{ $descuento->porcentaje}}%  {{ $descuento->descripcion }} - {{ $descuento->idtipo_descuento }}</option>'+
			@endif
	 	@endforeach
 '</select></td>'+
		'<td><button type="button" class="btn btn-danger btn-quitarLibro"><i class="fa fa-times"></i></button></td>'+
		'</tr>';
      
   $('#tablaVenta tbody').append(htmlTags);
}

//Quitar un libro de la tabla de libros a comprar

$(document).on('click','.btn-quitarLibro', function(e){

	e.preventDefault(); //evita que se recargue la pagina
	
	var ISBN = $(this).closest('tr').find('td:eq(0)').find('input').attr('value');

	$(this).parent().parent().remove();

	$('#'+ISBN).attr("disabled",false); //el boton para cargar ese libro vuelve a estar activado
});

//Verifica si hay al menos un libro y un cliente en el formulario de compra

$('#form-compra').submit(function(){

	if($('#tablaVenta tr').length>1 && $('#tablaCliente tr').length>1){
		
		return true;
		
	}else{
		$('#alerta').attr('class','alert alert-danger');
		$('#alerta').attr('role','alert');
		$('#alerta').text('Faltan agregar datos!');
		return false;
	}
	
});

//CLIENTE

$(document).on('click','.elegirCliente', function(e){
	e.preventDefault(); //evita que se recargue la pagina

	$('.elegirCliente').attr("disabled",true); //SI ELIGO LA CLASE, PUEDO ELEGIR UN UNICO CLIENTE

	dni=$(this).parent().parent().children("td:eq(0)").text(); //estoy posicionada en el boton, el padre es el TD y luego el TR, luego para obtener solo el ISBN pongo el resto
	nombre=$(this).parent().parent().children("td:eq(1)").text(); 

	domicilio=$(this).parent().parent().children("td:eq(2)").text(); 

	telefono=$(this).parent().parent().children("td:eq(3)").text(); 
	id_tipo_cliente=$(this).parent().parent().children("td:eq(4)").text(); 
	descripcion=$(this).parent().parent().children("td:eq(5)").text(); 









agregarFilaCliente(dni,nombre,domicilio,telefono,id_tipo_cliente,descripcion);

});


function agregarFilaCliente(dni,nombre,domicilio,telefono,id_tipo_cliente,descripcion){
   
   var fecha = new Date(); //Fecha actual
   var mes = fecha.getMonth()+1;
   var dia = fecha.getDate(); 
   var anio = fecha.getFullYear();
   if(dia<10){
	   dia='0'+dia; //agrega cero si el menor de 10
   }	
   if(mes<10){
		 mes='0'+mes; //agrega cero si el menor de 10
   }

  var htmlcliente = '<tr>'+
		 '<td><input class="form-control" style="width :105px; font-size:13px" type="number" name="dni" value="'+dni+'" readonly></td>'+ 
		 '<td><input class="form-control" style="width :150px; font-size:13px" type="text" name="nombre" value="'+nombre+'" readonly></td>'+ 
		 '<td><input class="form-control" style="width :110px; font-size:13px" type="text" name="domicilio" value="'+domicilio+'" readonly></td>'+ 
		 '<td><input class="form-control" style="width :120px; font-size:13px" type="text" name="telefono" value="'+telefono+'" readonly></td>'+ 
	   '<td><input class="form-control" style="width :125px; font-size:13px" type="date" name="fecha" value="'+anio+'-'+mes+'-'+dia+'" required></td>'+ 
	   '<td><select id="condicion" name="condicion" class="form-control" style="width :95px; font-size:13px" required>'+
			'<option value="Efectivo">Efectivo</option>'+
		   '<option value="Tarjeta">Tarjeta</option>'+
			'<option value="Cheque">Cheque</option>'+
		   '<option value="Debito">Debito</option>'+
'</select></td>'+
'<td><select id="lugar" name="lugar" class="form-control" style="width :130px; font-size:13px" required>'+
			'<option value="General Pico">General Pico</option>'+
		   '<option value="Santa Rosa">Santa Rosa</option>'+
		   '<option value="Trenel">Trenel</option>'+
		   '<option value="Parera">Parera</option>'+
		   '<option value="Victorica">Victorica</option>'+
		   '<option value="Eduardo Castex">Eduardo Castex</option>'+
		   '<option value="Otro">Otro</option>'+
'</select></td>'+
'<td><input class="form-control" style="width :90px; font-size:13px" name="descripcion" value="'+descripcion+'" readonly></td>'+ 
'<td><input class="form-control" style="width :5px; font-size:13px" type="hidden" name="id_tipo_cliente" value="'+id_tipo_cliente+'" readonly></td>'+ 

	   '<td><button type="button" class="btn btn-danger btn-quitarCliente"><i class="fa fa-times"></i></button></td>'+
	 '</tr>';
	 
  $('#tablaCliente tbody').append(htmlcliente);
}

//Quitar cliente de la tabla

$(document).on('click','.btn-quitarCliente', function(e){
	
	e.preventDefault(); //evita que se recargue la pagina

	$(this).parent().parent().remove();
	$('.elegirCliente').attr("disabled",false);
});


//BUSCADOR DE CLIENTES

window.addEventListener("load",function(){
	document.getElementById("textoCliente").addEventListener("keyup",function(){

		if(document.getElementById("textoCliente").value.length>0){
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


