@include('layout')

<h1> Agregar Descuento </h1>

    <div class="container" style="margin-top: 5px">

	    <div class="input-group mb-3">
            <input type="text" class="form-control" onkeypress="keyEventget()" placeholder="Ingrese titulo del libro.."  id="inputBuscarTitulo" style="margin-right: 5px">
            <input type="text" class="form-control" onkeypress="keyEventget()" placeholder="Ingrese autor del libro.."  id="inputBuscarAutor" style="margin-right: 5px">
			<input type="text" class="form-control" onkeypress="keyEventget()" placeholder="Ingrese editorial del libro.."  id="inputBuscarEditorial" style="margin-right: 5px">
			<div class="input-group-append">
				<button class="btn btn-success" type="submit" onclick="buscarLibro()">Buscar</button>
			</div>
		</div>

    </div>

    <div id="ele-1" name="ele-1" style="display: none;">
        <div class="container" style="margin-top: 5px">
           
                <table class="table table-bordered" id="tabla">
                    <thead class="thead-dark">
                        <tr>
                            <th scope="col">ISBN</th>
                            <th scope="col">Titulo</th>
                            <th scope="col">Autor</th>
                            <th scope="col">Editorial</th>
                            <th scope="col">+</th>
                        </tr>
                    </thead>
                    <tbody>
                        
                    </tbody>
                </table>
            
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
				hideElement(2, data);
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
				
				ed=document.getElementById("inputBuscarEditorial").value;
                titulo=document.getElementById("inputBuscarTitulo").value;
                autor=document.getElementById("inputBuscarAutor").value;

				$.ajax({url: "{{url('descuento/buscarLibros')}}",data:{"editorial":ed,"titulo":titulo,"autor":autor}
				, success: function(result){

					var len = result.length;
                    var resultado="";
					if(len>0){	
                        $("#tabla").find("tbody").empty();
                        for (i = 0; i < len; i++) {
                            resultado=resultado+"<tr>";
                            resultado=resultado+"<td>"+result[i].ISBN+"</td>";
                            resultado=resultado+"<td>"+result[i].titulo+"</td>";
                            resultado=resultado+"<td>"+result[i].autor+"</td>";
                            resultado=resultado+"<td>"+result[i].editorial+"</td>";
                            resultado=resultado+"<td> <a href=crear/confirmar/"+result[i].ISBN+" )>Registrar Descuento</a> </td>";
                            resultado=resultado+"</tr>";
                        }
                        $("#tabla").find("tbody").append(resultado); 	
                        showDiv(1);
					}
					else{
						showDiv(0);
					}

				}});
			}

            function altaDescuento(data){
               document.write("el ISBN es:"+data);
            }
            
    </script>


    

