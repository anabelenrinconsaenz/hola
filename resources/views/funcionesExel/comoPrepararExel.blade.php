@include('layout')

<div class="titulo">
	<h1>Paso 1</h1>
</div>
<div class="container">
    <p><i> 
        Primero se deben eliminar las primeras filas del exel, de forma tal que quede como primeras filas 
        datos a almacenar, como sugiere la siguiente imagen
    </i></p>
</div>

<div class="container">
    <img src="{{asset('imagen/pasoI.png')}}">
</div>

<div class="titulo">
	<h1>Paso 2</h1>
</div>
<div class="container">
    <p><i> 
        Segundo se deben eliminar las ultimas filas del exel de forma tal que la ultima fila que quede sea 
        el ultimo dato a guardar, como sugiere la siguiente imagen.
    </i></p>
</div>

<div class="container">
    <img src="{{asset('imagen/pasoII.png')}}">
</div>

<div class="titulo">
	<h1>Paso 3</h1>
</div>
<div class="container">
    <p><i> 
        Tercer y ultimo paso, se debe guardar los cambios realizador a dicho exel, como sugiere la siguiente
        imagen.
    </i></p>
</div>

<div class="container">
    <img src="{{asset('imagen/pasoIII.png')}}">
</div>

<center><a href=" {{ url ('exelFunciones') }} ">
    <button type="submit" class="btn btn-dark">Volver</button>
</a></center>
