@include('layout')

        <div class="titulo">
            <h1>Borrar libro</h1>
            <img src="{{asset('storage/book-remove.png')}}" alt="logo">
        </div>
        <div class="container" style="margin-top: 5px">
	        	<div class="input-group mb-3">
				  <input type="text" class="form-control" onkeypress="keyEventget()" placeholder="Ingrese código del libro.."  id="inputBuscar">
				  <div class="input-group-append">
				    <button class="btn btn-success" type="submit" onclick="buscarLibro()">Buscar</button>
				  </div>
				</div>
        </div>

        <div id="ele-1" name="ele-1" style="display: none;">

	        <div class="container">
			    <div class="row">
			        <div class="col-25">
			            <label for="id">ISBN - ISSN</label>
			        </div>
			        <div class="col-75">
			            <input type="text" id="id" value="none" readonly>
			        </div>
			    </div>
			    <div class="row">
			        <div class="col-25">
			            <label for="titulo">Titulo</label>
			        </div>
			        <div class="col-75">
			            <input type="text" id="titulo" name="titulo"  readonly>
			        </div>
			    </div>
			    <div class="row">
			        <div class="col-25">
			            <label for="editorial">Editorial</label>
			        </div>
			    	<div class="col-75">
			        	<input type="text" id="editorial"  readonly>
			    	</div>
				</div>
			    <div class="row">
			        <div class="col-25">
			            <label for="deposito">Depósito</label>
			        </div>
			        <div class="col-75">
			            <input type="text" id="deposito"  readonly>
			        </div>
			    </div>
			    <div align="right" style="margin-top: 10px;">
		    		<button type="button" class="btn btn-danger" onclick="borrar()">Borrar</button>	
		    	</div>
		    </div>
        </div>

        <div id="ele-0" name="ele-0" style="display: none;">
        	<div class="container">
        		<div align="center">
        			<div class="alert alert-danger">
					  <strong> El libro que intenta buscar no se encuentra en la Base de Datos</strong>
					</div>
        		</div>
        	</div>
        </div>

		<script>
			function showDiv(data) {
				$("#ele-" + data).addClass('visibleClass');
				hideElement(1, data);
			}

			function hideElement(total, active) {
				for (i = 0; i <= total; i++) {
				if (i != active)
					$("#ele-" + i).removeClass('visibleClass');
				}
			}

			function keyEventget(){
				if (event.keyCode === 13){
					buscarLibro();
				}
			}


			function buscarLibro(){
				
				idLib=document.getElementById("inputBuscar").value;

				$.ajax({url: "{{url('/BuscarLib')}}",data:{"idLib":idLib}, success: function(result){
					var len = result.length;
					
					if(len>0){	
						showDiv(1);

						$('#id').val(result[0].ISBN);
					
						$("#titulo").val(result[0].titulo);

						$("#editorial").val(result[0].editorial);

						$("#deposito").val(result[0].cant_deposito);
					}
					else{
						showDiv(0);
					}
				}});
			}

			function borrar(){

				Swal.fire({
						title: '¿Está seguro de eliminar el libro?',
						text: "",
						icon: 'warning',
						showCancelButton: true,
						confirmButtonColor: '#c82333',
						cancelButtonColor: '#28a745',
						confirmButtonText: 'Eliminar',
						cancelButtonText: 'Cancelar'
						
						}).then((result) => {
						if (result.value) {

							idLib=document.getElementById("id").value;
							$.ajax({url: "{{url('/eliminarLib')}}",data:{"idLib":idLib}, success: function(resultado){
								$("#ele-1").removeClass('visibleClass');
								
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

    </body>
</html>