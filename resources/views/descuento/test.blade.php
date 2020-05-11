@include('layout')

    <form action="{{url('descuento/modificar/alta')}}" method="get">    
        <div style="display: none;">
                    <input type="text" id="idDescuento" name="idDescuento"  value="{{$data['descuento'][0]->idDescuento}}" readonly>
                </div>
                
                <div class="row">
                    <div class="col-25">
                            <label for="ISBN"> ISBN</label>
                    </div>
                    <div class="col-75">
                        <input type="text" id="ISBN" name="ISBN"  value="{{$data['descuento'][0]->ISBN}}" readonly>
                    </div>
                </div>

                <div class="row">
                    <div class="col-25">
                        <label for="tipoDescuento"> Tipo de descuento </label>
                    </div>
                    <div class="col-75">
                    <select id="idtipo_descuento" name="idtipo_descuento"
                        @foreach ($data['tipoDescuento'] as $item)>
                            <option value="{{$item->idtipo_descuento}}">{{$item->descripcion}} </option>
                        @endforeach
                        
                    </select>
                    </div>
                </div>

                <div class="row">
                    <div class="col-25">
                        <label for="fecha_inicio"> Fecha de Inicio</label>
                    </div>
                    <div class="col-75">
                        <input type="date" id="fecha_inicio" name="fecha_inicio" value="{{$data['descuento'][0]->fecha_inicio}}" min=''>
                    </div>
                </div>

                <div class="row">
                    <div class="col-25">
                        <label for="fecha_final"> Fecha de Finalización </label>
                    </div>
                    <div class="col-75">
                    <input  type="date" id="fecha_final" name="fecha_final" value="{{$data['descuento'][0]->fecha_final}}" min=''>
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
                            <input type="number" id="porcentaje" name="porcentaje" value="{{$data['descuento'][0]->porcentaje}}" min='0'>
                    </div>
                </div>

                <div class="row">
                    <div class="col-25">
                        <label for="descripcion"> Descripción </label>
                    </div>
                    <div class="col-75">
                        <input type="text"  id="descripcion" name="descripcion" value="{{$data['descuento'][0]->descripcion}}">
                    </div>
                </div>

                <div align="center" style="margin-top: 10px;">
                    <button  type="submit" class="btn btn-danger"  id="btnGuardar">Guardar Cambios</button>   
                </div>   
    </form>

    </body>
</html>