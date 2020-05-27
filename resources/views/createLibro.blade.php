@include('layout')

<div class="titulo">
    <i class='fas fa-plus' style="font-size:48px;color:#28a745"></i>
    <h1>Nuevo libro</h1>
</div>
        
            <div class="container">
                
                    <div class="row">
                        <div class="col-25">
                            <label for="id">ISBN - ISSN</label>
                        </div>
                        <div class="col-75">
                            <input type="number" name="ISBN" id="ISBN" placeholder="ISBN del libro.. " min="1" style="width: 100%;padding: 12px;border: 1px solid #ccc;border-radius: 4px;resize: vertical;">
                        </div>
                    </div>

                    <div id="ele-0"  style="display: none;">
                        <div class="container">
                            <div align="center">
                                <div class="alert alert-danger">
                                <strong> El ISBN ingresado ya existe, por favor ingrese uno nuevo</strong>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-25">
                            <label for="titulo">Título</label>
                        </div>
                        <div class="col-75">
                            <input type="text"  id="titulo"  placeholder="Título del libro..">
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-25">
                            <label for="autor">Autor</label>
                        </div>
                        <div class="col-75">
                            <input type="text"  id="autor"  placeholder="Autor del libro..">
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-25">
                            <label for="editorial">Editorial</label>
                        </div>
                        <div class="col-75">
                            <input type="text"  id="editorial"  placeholder="Editorial del libro..">
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-25">
                            <label for="cant_venta">Ventas</label>
                        </div>
                        <div class="col-75">
                            <input type="number"  id="cant_venta"  value="0" min="0" style="width: 100%;padding: 12px;border: 1px solid #ccc;border-radius: 4px;resize: vertical;">
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-25">
                            <label for="cant_deposito">Depósito</label>
                        </div>
                        <div class="col-75">
                            <input type="number"  id="cant_deposito" min="0"  placeholder="En depósito.." style="width: 100%;padding: 12px;border: 1px solid #ccc;border-radius: 4px;resize: vertical;">
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-25">
                            <label for="stock_min">Stock Minimo</label>
                        </div>
                        <div class="col-75" style="display: flex;">
                            <input type="number"  id="stock_min" value="10" min="10" style="width: 100%;padding: 12px;border: 1px solid #ccc;border-radius: 4px;resize: vertical;">
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-25">
                            <label for="precio_general">Precio general</label>
                        </div>
                        <div class="col-75" style="display: flex;">
                            <h1>$</h1><input type="number"  id="precio_general" min="0" style="width: 100%;padding: 12px;border: 1px solid #ccc;border-radius: 4px;resize: vertical;">
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-25">
                            <label for="precio_estudiante">Precio estudiante</label>
                        </div>
                        <div class="col-75" style="display: flex;">
                            <h1>$</h1><input type="number" id="precio_estudiante" min="0" style="width: 100%;padding: 12px;border: 1px solid #ccc;border-radius: 4px;resize: vertical;">
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-25">
                            <label for="precio_docente">Precio Docente</label>
                        </div>
                        <div class="col-75" style="display: flex;">
                            <h1>$</h1><input type="number" id="precio_docente" min="0" style="width: 100%;padding: 12px;border: 1px solid #ccc;border-radius: 4px;resize: vertical;">
                        </div>
                    </div>
                    <div align="right" style="margin-top: 10px;">
                        <button type="button" class="btn btn-success"  onclick="guardar()" id="btnAgregar" >Agregar</button>
                    </div>
            </div>

        <script>

            window.addEventListener("load",function validateForm(){
                var a = document.getElementById("ISBN").value;
                var b = document.getElementById("titulo").value;
                var c = document.getElementById("editorial").value;
                var d = document.getElementById("cant_venta").value;
                var e = document.getElementById("cant_deposito").value; 
                var f = document.getElementById("precio_general").value;
                var g = document.getElementById("precio_estudiante").value;
                var h = document.getElementById("stock_min").value;
                var i = document.getElementById("precio_docente").value;
                if (a == null || a == "" || b == null || b == "" || c == null || c == "" || d == null || d == "" || e == null || e == "" || f == null || f == "" || g == null || g == "" || h == null || h == "" || i == null || i == "") {
                    document.getElementById("btnAgregar").disabled = true;
                }else{
                    document.getElementById("btnAgregar").disabled = false;
                }
                var refrescar= setTimeout(function(){validateForm()},100);
            });

			function guardar(){

                id=document.getElementById("ISBN").value;
                titulo=document.getElementById("titulo").value;
                autor=document.getElementById("autor").value;
                edi=document.getElementById("editorial").value;
                dep=document.getElementById("cant_deposito").value;
                sm=document.getElementById("stock_min").value;
                vta=document.getElementById("cant_venta").value;
                gra=document.getElementById("precio_general").value;
                est=document.getElementById("precio_estudiante").value;
                doce=document.getElementById("precio_docente").value;

                $.ajax({url: "{{url('/consultarLib')}}",data:{"ISBN":id}, success: function(resultado){

                    var len = resultado.length;
                     
                    if(len!=0){ 
                        showDiv(0);
                    }
                    else{
                        $.ajax({url: "{{url('/crearLib')}}",data:{"ISBN":id,"titulo":titulo,"autor":autor,
                        "editorial":edi,"cant_deposito":dep,"stock_min":sm,"cant_venta":vta,
                        "precio_general":gra,"precio_estudiante":est,"precio_docente":doce}, 
                        success: function(resultado){

                            Swal.fire({
                                position: 'center',
                                type: 'success',
                                title: resultado,
                                showConfirmButton: false,
                                timer: 1000
                            });

                        }});
                        $("#ele-0").removeClass('visibleClass');
                        $('#ISBN').val("");
                        $('#titulo').val("");
                        $('#autor').val("");
                        $('#editorial').val("");
                        $('#cant_deposito').val(0);
                        $('#stock_min').val(10);
                        $('#cant_venta').val(0);
                        $('#precio_general').val(0);
                        $('#precio_estudiante').val(0);
                        $('#precio_docente').val(0);
                    }
                    
                }});

            }

		</script>

    </body>
</html>