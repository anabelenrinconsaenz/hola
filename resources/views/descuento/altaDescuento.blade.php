@include('layout')

<div class="titulo">
    <i class='fas fa-tag' style="font-size:48px;color:#28a745"></i>
    <h1>Nuevo descuento</h1>
</div>
        <div class=" container ">

            <form action="{{url('descuento/crear/alta')}}" method="get">
            

                

                <div class="row">
                    <div class="col-25">
                        <label for="tipoDescuento"> Tipo de descuento </label>
                    </div>
                    <div class="col-75">
                    <select id="idtipo_descuento" name="idtipo_descuento">
                        @foreach ($data['tipoDescuento'] as $item)
                            <option value="{{$item->idtipo_descuento}}">{{$item->descripcion}} </option>
                        @endforeach
                    </select>
                    </div>
                </div>
                
                <div class="row">
                    <div class="col-25">
                        <label for="fecha_ini"> Fecha de Inicio</label>
                    </div>
                    
                    <div class="col-75">
                        <input type="date" id="fecha_inicio" name="fecha_inicio" min=''>
                    </div>
                </div>
                <div class="row">
                    <div class="col-25">
                        <label for="fecha_fin"> Fecha de Finalización </label>
                    </div>
                    <div class="col-75">
                    <input  type="date" id="fecha_final" name="fecha_final" min=''>
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
                            <input type="number" id="porcentaje" name="porcentaje" placeholder="Ingrese porcentaje de descuento.." min="1" style="width: 100%;padding: 12px;border: 1px solid #ccc;border-radius: 4px;resize: vertical;">
                    </div>
                </div>

                <div class="row">
                    <div class="col-25">
                        <label for="descripcion"> Descripción </label>
                    </div>
                    <div class="col-75">
                        <input type="text"  id="descripcion" name="descripcion" placeholder="Ingrese descripción del descuento..">
                    </div>
                </div>
                
                <br>
                <div align="right" style="margin-top: -20px;">
                <button type="submit" class="btn btn-success" id="btnAgregar">Agregar</button>
                </div>
            </form>
        </div>

        <script>
            window.addEventListener("load",validateForm());

            function validateForm(){
                var a = document.getElementById("fecha_inicio").value;
                var b = document.getElementById("fecha_final").value;
                var c = document.getElementById("porcentaje").value;
                var d = document.getElementById("descripcion").value;
                if (!a || !b || c == null || c == "" || d == null || d == "") {
                    document.getElementById("btnAgregar").disabled = true;
                }else{
                    document.getElementById("btnAgregar").disabled = false;
                }
                var refrescar= setTimeout(function(){validateForm()},100);
            }
        </script>
    