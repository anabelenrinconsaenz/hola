@include('layout')
<div class="titulo">
    <i class='fas fa-edit' style='font-size:48px;color:#337ab7;'></i>
    <h1>Editar descuento</h1>
</div>

        <div class=" container ">
            <form action="{{url('descuento/modificacion/alta')}}" method="post" enctype="multipart/form-data">
                {{ csrf_field() }}
                <div style="display: none;">
                            <input type="text" id="idDescuento" name="idDescuento"  value="{{$data['idDescuento']}}" readonly>
                        </div>
                        
                        

                        <div class="row">
                            <div class="col-25">
                                <label for="tipoDescuento"> Tipo de descuento </label>
                            </div>
                            <div class="col-75">
                            <select id="idtipo_descuento" name="idtipo_descuento">
                                <option value="1">Promocion</option>
                                <option value="2">Barata</option>
                            </select>
                            <script >
                                document.getElementById('idtipo_descuento').value = "{{$data['idtipo_descuento']}}";
                            </script>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-25">
                                <label for="fecha_ini"> Fecha de Inicio</label>
                            </div>
                            <div class="col-75">
                                <input type="date" id="fecha_inicio" name="fecha_inicio" value="{{$data['fecha_inicio']}}" min=''>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-25">
                                <label for="fecha_fin"> Fecha de Finalización </label>
                            </div>
                            <div class="col-75">
                            <input  type="date" id="fecha_final" name="fecha_final" value="{{$data['fecha_final']}}" min=''>
                            </div>
                        </div>
                    
                        <script>
                            var todaysDate = new Date(); // Gets today's date<font></font>
                            var year = todaysDate.getFullYear();    
                            var month = ("0" + (todaysDate.getMonth() + 1)).slice(-2);  // MM<font></font>
                            var day = ("0" + todaysDate.getDate()).slice(-2);           // DD<font></font>
                            var minDate = (year +"-"+ month +"-"+ day);
                            document.getElementById("fecha_inicio").setAttribute("min", minDate);
                            document.getElementById("fecha_final").setAttribute("min", minDate);
                        </script>
                        <div class="row">
                            <div class="col-25">
                                    <label for="porcentaje">Porcentaje del descuento</label>
                            </div>
                            <div class="col-75">
                                <input type="number" id="porcentaje" name="porcentaje" value="{{$data['porcentaje']}}" min="1" style="width: 100%;padding: 12px;border: 1px solid #ccc;border-radius: 4px;resize: vertical;" placeholder="Ingrese porcentaje de descuento..">
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-25">
                                <label for="descripcion"> Descripción </label>
                            </div>
                            <div class="col-75">
                                <input type="text"  id="descripcion" name="descripcion" value="{{$data['descripcion']}}" placeholder="Ingrese descripción del descuento..">
                            </div>
                        </div>

                        <div align="right" style="margin-top: 10px;">
                            <button  type="submit" class="btn btn-primary"  id="btnGuardar">Guardar</button>   
                        </div>   
            </form>
        </div>

    </body>
</html>

<script>
    window.addEventListener("load",validateForm());

            function validateForm(){
                var a = document.getElementById("fecha_inicio").value;
                var b = document.getElementById("fecha_final").value;
                var c = document.getElementById("porcentaje").value;
                var d = document.getElementById("descripcion").value;
                if (!a || !b || c == null || c == "" || d == null || d == "") {
                    document.getElementById("btnGuardar").disabled = true;
                }else{
                    document.getElementById("btnGuardar").disabled = false;
                }
                var refrescar= setTimeout(function(){validateForm()},100);
            }
</script>