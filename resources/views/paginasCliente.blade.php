
<!-- DEVUELVO LOS CLIENTES BUSCADOS MEDIANTE AJAX -->
@if(count($clientesAJAX))


    <table bgcolor=#007bff style="width:525px;">
    @foreach($clientesAJAX as $cliente)
    <tr>


						<td id="dni_cuit" style="font-size:11px; text-align:center" class="informacion">{{$cliente->dni_cuit}}</td>
						<td name="nombre" style="text-align:center;">{{$cliente->nombre_apellido}}</td>
						<td name="domicilio" style=" text-align:center" class="informacion">{{$cliente->domicilio}}</td>
						<td style=" text-align:center" class="informacion">{{$cliente->telefono}}</td>
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
@endif



 
