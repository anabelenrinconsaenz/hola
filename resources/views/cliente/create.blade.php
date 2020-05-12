@extends('welcome')
@section('content')

<h1> Agregar Cliente </h1>

    <div class=" container ">

        <form action="{{url('cliente/create/alta')}}">
            <div class="row">
                <div class="col-25">
                    <label for="id"> Apellido y Nombre o Razon Social </label>
                </div>
                <div class="col-75">
                    <input type="text"s id="nombre_apellido" name="nombre_apellido">
                </div>
            </div>
            <div class="row">
                <div class="col-25">
                    <label for="domicilio"> Domicilio </label>
                </div>
                <div class="col-75">
                    <input type="text" id="domicilio" name="domicilio">
                </div>
            </div>
            <div class="row">
                <div class="col-25">
                    <label for="id"> DNI o CUIT </label>
                </div>
                <div class="col-75">
                  <input  type="text" id="dni_cuit" value="" name="dni_cuit">
                </div>
            </div>
           

            <div class="row">
			    <div class="col-25">
			            <label for="tel">Teléfono</label>
			    </div>
			    <div class="col-75">
			            <input type="text" id="telefono"  value="" name="telefono">
			    </div>
			</div>

            <div class="row">
                <div class="col-25">
                    <label for="email"> Email </label>
                </div>
                <div class="col-75">
                    <input type="text"  id="email" value="" name="email">
                </div>
            </div>
            <br> 
            <div class="row">
                <div class="col-25">
                    <label for="tipoCliente"> Tipo cliente </label>
                </div>
                <div class="col-75">
                <select name="id_tipo_cliente"
                    @foreach ($Tipo_cliente as $item)>
                        <option value="{{$item->id_tipo_cliente}}">{{$item->descripcion_cliente}} </option>
                    @endforeach
                </select>
                </div>
            </div>
            <div class="row">
                <div class="col-25">
                    <label for="tipoFacultad"> Facultad </label>
                </div>
                <div class="col-75">
                <select name="id_tipo_facultad"
                    @foreach ($Tipo_facultad as $item)>
                        <option value="{{$item->id_tipo_facultad}}">{{$item->descripcion_facultad}} </option>
                    @endforeach
                </select>
                </div>
            </div>
            
            
            <br>
            <div style=" margin-top: 10px; ">
              <button type="submit" class="btn btn-primary btn-lg btn-block">Guardar</button>
            </div>

    </div>
    </form>
    
@endsection
