<!-- DEVUELVO LOS LIBROS BUSCADOS MEDIANTE AJAX -->

@if(count($librosAJAX))

<table id="Libros" bgcolor=#007bff style="width:500px;">
							@foreach($librosAJAX as $l)

								<tr class="odd"> <!-- FILA -->

									<td style="font-size:11px; text-align:center" class="informacion">{{$l->ISBN}} </td>
									<td style="visibility: hidden" class="informacion">{{$l->precio_general}}</td>

									<td style="visibility: hidden" class="informacion">{{$l->precio_docente}}</td>

									<td style=" text-align:center" class="informacion">{{$l->titulo}} </td>
									<td style="visibility: hidden" class="informacion">{{$l->cant_venta}}</td>


									<td style="visibility: hidden" class="informacion">{{$l->precio_estudiante}}</td>
									<td style="visibility: hidden" class="informacion">{{$l->cant_deposito}}</td>

								
									<td style=" text-align:center">
										<button value="comprarLibro" title="comprarLibro" class="btn btn-primary btn-cargar" id="btn-cargar" aling="right">
											<i class="fa fa-check-square-o" aria-hidden="true"></i>
										</button>
									</td>
						
									
								</tr>
					
							@endforeach
	</table>


@endif

