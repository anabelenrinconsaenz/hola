@include('layout')

<div class="titulo">
	<h1>Paso 1</h1>
</div>
<div class="container">
    <p><i> 
        Se deben eliminar las primeras filas del Excel, de forma tal que solo queden las filas de los 
        datos a almacenar, como se aprecia en la siguiente imagen:
    </i></p>
</div>

<div class="container">
    <img src="{{asset('imagen/pasoI.png')}}" style="display: block;margin-left: auto;margin-right: auto;">
</div>

<div class="titulo">
	<h1>Paso 2</h1>
</div>
<div class="container">
    <p><i> 
        Se deben eliminar las ultimas filas del Excel de forma tal que la última fila que quede sea 
        el último dato a guardar, como se aprecia en la siguiente imagen:
    </i></p>
</div>

<div class="container">
    <img src="{{asset('imagen/pasoII.png')}}" style="display: block;margin-left: auto;margin-right: auto;">
</div>

<div class="titulo">
	<h1>Paso 3</h1>
</div>
<div class="container">
    <p><i> 
        Último paso, se debe guardar los cambios realizados a dicho Excel, y éste debería apreciarse tal como se aprecia el ejemplo en la siguiente
        imagen:
    </i></p>
</div>

<div class="container">
    <img src="{{asset('imagen/pasoIII.png')}}" style="display: block;margin-left: auto;margin-right: auto;">
</div>

<center><a href=" {{ url ('exelFunciones') }} ">
    <button type="submit" class="btn btn-dark" style="margin-bottom: 10px">Volver</button>
</a></center>
