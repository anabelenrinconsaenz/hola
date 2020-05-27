@extends('welcome')
@section('content')

<div class="titulo">
    <i class='fas fa-user-edit' style='font-size:48px;color:#337ab7;'></i>
    <h1> Editar cliente </h1>
</div>

<div class="container">
    <form action=" {{ url('cliente/edit/editar/modificacion') }} "method="post" enctype="multipart/form-data">
        {{ csrf_field() }}
        @foreach($cliente as $cli)
        
            <div class="row">
                <div class="col-25">
                    <label for="id"> Apellido y Nombre o Razon Social </label>
                </div>
                <div class="col-75">
                    <input type="text" id="nombre_apellido" value="{{$cli->nombre_apellido}}" name="nombre_apellido">
                </div>
            </div>
            <div class="row">
                <div class="col-25">
                    <label for="domicilio"> Domicilio </label>
                </div>
                <div class="col-75">
                    <input type="text" id="domicilio" value="{{$cli->domicilio}}" name="domicilio">
                </div>
            </div>
            <div class="row">
                <div class="col-25">
                    <label for="id"> DNI o CUIT </label>
                </div>
                <div class="col-75">
                  //<input  type="text" id="dni_cuit"value="{{$cli->dni_cuit}}" name="dni_cuit">
                  <input type="number" id="dni_cuit"  value="{{$cli->dni_cuit}}" name="dni_cuit" min=0 style="width: 100%;padding: 12px;border: 1px solid #ccc;border-radius: 4px;resize: vertical;">
                </div>
            </div>
           

            <div class="row">
			    <div class="col-25">
			            <label for="tel">Teléfono</label>
			    </div>
			    <div class="col-75">
			            <input type="number" id="telefono"  value="{{$cli->telefono}}" name="telefono" min=0 style="width: 100%;padding: 12px;border: 1px solid #ccc;border-radius: 4px;resize: vertical;">
			    </div>
			</div>

            <div class="row">
                <div class="col-25">
                    <label for="email"> Email </label>
                </div>
                <div class="col-75">
                    <input type="email"  id="email" value="{{$cli->email}}" name="email" style="width: 100%;padding: 12px;border: 1px solid #ccc;border-radius: 4px;resize: vertical;">
                </div>
            </div>
            <div class="row">
                <div class="col-25">
                    <label for="tipoCliente"> Tipo cliente </label>
                </div>
                <div class="col-75">
                <select name="id_tipo_cliente" id="id_tipo_cliente">
                    @foreach ($Tipo_cliente as $item)
                        <option value="{{$item->id_tipo_cliente}}">{{$item->descripcion_cliente}}</option>
                    @endforeach
                </select>
                    <script >
                        document.getElementById('id_tipo_cliente').value = "{{$cli->id_tipo_cliente}}";
                    </script>
                </div>
            </div>
            <div class="row" id="tipo_Facultad" >
                <div class="col-25">
                    <label for="tipoFacultad"> Facultad </label>
                </div>
                <div class="col-75">
                <select name="id_tipo_facultad" id="id_tipo_facultad">
                    @foreach ($Tipo_facultad as $item)
                        <option value="{{$item->id_tipo_facultad}}">{{$item->descripcion_facultad}}</option>
                    @endforeach
                    <script >
                        //document.getElementById("demo").innerHTML = {{$cli->id_tipo_facultad}};
                        document.getElementById('id_tipo_facultad').value = "{{$cli->id_tipo_facultad}}";
                    </script>
                </select>
                </div>
            </div>
            @endforeach
            <div align="right" style="margin-top: 10px;margin-bottom: 20px;">
                <button type="submit" class="btn btn-primary" onclick="guardar()" id="btnGuardar">Guardar</button>  
            </div>
    </form>
    <!--<p id="demo"></p>-->
</div>
<script>

    window.addEventListener("load",validateForm(),verificarCliente());

    function validateForm(){
        var a = document.getElementById("nombre_apellido").value;
        var b = document.getElementById("domicilio").value;
        var c = document.getElementById("dni_cuit").value;
        var d = document.getElementById("telefono").value;
        var e = document.getElementById("email").value;
        if (a == null || a == "" || b == null || b == "" || c == null || c == "" || d == null || d == "" || e == null || e == "") {
            document.getElementById("btnGuardar").disabled = true;
        }else{
            document.getElementById("btnGuardar").disabled = false;
        }
        var refrescar= setTimeout(function(){validateForm()},100);
    }

    function verificarCliente(){
        if($('#id_tipo_cliente').val()!="1"){
            //$('#id_tipo_facultad').removeAttr('disabled');
        }else{
            document.getElementById('id_tipo_facultad').value = "7";
            //$('#id_tipo_facultad').attr('disabled',true);
        }
        var refrescar= setTimeout(function(){verificarCliente()},100);
    }

</script>
@endsection