@include('layout')

<h1> Registrar Descuento </h1>
        <div class=" container ">

            <form action="{{url('descuento/crear/alta')}}" method="get">
            

                <div class="row">
                    <div class="col-25">
                            <label for="ISBN"> ISBN</label>
                    </div>
                    <div class="col-75">
                        <input type="text" id="ISBN" name="ISBN"  value="{{$data['ID']}}" readonly>
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
                            <input type="number" id="porcentaje" name="porcentaje" min="0">
                    </div>
                </div>

                <div class="row">
                    <div class="col-25">
                        <label for="descripcion"> Descripción </label>
                    </div>
                    <div class="col-75">
                        <input type="text"  id="descripcion" name="descripcion">
                    </div>
                </div>
                
                <br>
                <div style=" margin-top: 10px; ">
                <button type="submit" class="btn btn-primary btn-lg btn-block">Guardar</button>
                </div>
            </form>
        </div>
    