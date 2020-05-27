@include('layout')

        <div class="titulo">
            <i class='fas fa-edit' style='font-size:48px;color:#337ab7;'></i>
            <h1>Editar libro</h1>
        </div>
<form action="{{url('/modificarLib')}}" method="post" enctype="multipart/form-data">
    {{ csrf_field() }}
    @foreach($libro as $l)
    
                <div class="container">
                    <div class="row">
                        <div class="col-25">
                            <label for="id">ISBN - ISSN</label>
                        </div>
                        <div class="col-75">
                            <input type="text" id="id" name="id" value="{{ $l->ISBN }}" readonly>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-25">
                            <label for="titulo">Titulo</label>
                        </div>
                        <div class="col-75">
                            <input type="text" id="titulo" name="titulo" value="{{ $l->titulo }}">
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-25">
                            <label for="autor">Autor </label>
                        </div>
                        <div class="col-75">
                            <input type="text" id="autor" name="autor" value="{{ $l->autor }}">
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-25">
                            <label for="editorial">Editorial</label>
                        </div>
                        <div class="col-75">
                            <input type="text" id="editorial" name="editorial" value="{{ $l->editorial }}">
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-25">
                            <label for="venta">Ventas</label>
                        </div>
                        <div class="col-75">
                            <input type="number" id="venta" name="venta" min="0" style="width: 100%;padding: 12px;border: 1px solid #ccc;border-radius: 4px;resize: vertical;" value="{{ $l->cant_venta }}">
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-25">
                            <label for="deposito">Depósito</label>
                        </div>
                        <div class="col-75">
                            <input type="number" id="deposito" name="deposito" min="0" style="width: 100%;padding: 12px;border: 1px solid #ccc;border-radius: 4px;resize: vertical;" value="{{ $l->cant_deposito }}">
                        </div>
                    </div>
                    
                    <div class="row">
                        <div class="col-25">
                            <label for="stock_min">Stock minimo</label>
                        </div>
                        <div class="col-75">
                            <input type="number" id="stock_min" name="stock_min" min="0" style="width: 100%;padding: 12px;border: 1px solid #ccc;border-radius: 4px;resize: vertical;" value="{{ $l->stock_min }}">
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-25">
                            <label for="general">Precio general</label>
                        </div>
                        <div class="col-75" style="display: flex;">
                            <h1>$</h1><input type="number" id="general" name="general" min="0" style="width: 100%;padding: 12px;border: 1px solid #ccc;border-radius: 4px;resize: vertical;" value="{{ $l->precio_general }}">
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-25">
                            <label for="estudiante">Precio estudiante</label>
                        </div>
                        <div class="col-75" style="display: flex;">
                            <h1>$</h1><input type="number" id="estudiante" name="estudiante"  min="0" style="width: 100%;padding: 12px;border: 1px solid #ccc;border-radius: 4px;resize: vertical;" value="{{ $l->precio_estudiante }}">
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-25">
                            <label for="docente">Precio docente</label>
                        </div>
                        <div class="col-75" style="display: flex;">
                            <h1>$</h1><input type="number" id="docente" name="docente"  min="0" style="width: 100%;padding: 12px;border: 1px solid #ccc;border-radius: 4px;resize: vertical;" value="{{ $l->precio_docente }}">
                        </div>
                    </div>
                    <div align="right" style="margin-top: 10px;margin-bottom: 20px;">
                        <button type="submit" class="btn btn-primary"  id="btnGuardar">Guardar</button>	
                    </div>
                </div>
                
    @endforeach
</form>
		<script>

            window.addEventListener("load",function validateForm(){
                var a = document.getElementById("titulo").value;
                var b = document.getElementById("editorial").value;
                var c = document.getElementById("venta").value;
                var d = document.getElementById("deposito").value;
                var e = document.getElementById("general").value; 
                var f = document.getElementById("estudiante").value;
                var g = document.getElementById("docente").value;
                var h = document.getElementById("stock_min").value;
                if (a == null || a == "" || b == null || b == "" || c == null || c == "" || d == null || d == "" || e == null || e == "" || f == null || f == "" || g == null || g == "" || h == null || h == "") {
                    document.getElementById("btnGuardar").disabled = true;
                }else{
                    document.getElementById("btnGuardar").disabled = false;
                }
                var refrescar= setTimeout(function(){validateForm()},100);
            });

			/*function guardar(){

                id=document.getElementById("id").value;
                titulo=document.getElementById("titulo").value;
                autor=document.getElementById("autor").value;
                edi=document.getElementById("editorial").value;
                dep=document.getElementById("deposito").value;
                sm=document.getElementById("stock_min").value;
                vta=document.getElementById("venta").value;
                gra=document.getElementById("general").value;
                est=document.getElementById("estudiante").value;
                doce=document.getElementById("docente").value;

				$.ajax({url: "{{url('/modificarLib')}}",data:{"id":id,"titulo":titulo,"autor":autor,
                "edi":edi,"dep":dep,"sm":sm,"vta":vta,"gra":gra,"est":est,"doce":doce}, 
                success: function(resultado){
                			
					Swal.fire({
						position: 'center',
						type: 'success',
						title: resultado,
						showConfirmButton: false,
						timer: 1000
					});

				}});
			}*/

		</script>

    </body>
</html>