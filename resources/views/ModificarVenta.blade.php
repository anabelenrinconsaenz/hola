@include('layout')

<!-- MODIFICAR UNA VENTA -->


<div class="titulo">
    <h1>Modificar venta</h1>
</div>
<hr>
<form action="/ConfirmarModificacion" type="POST">
<div class="container bg-light border border-dark mt-3">

@foreach($venta as $p)

    <div class="form-group col-md-6">
            <label class="label-detalleVenta">ID VENTA
                    <input type="text" readonly class="form-control-plaintext input-detalleVenta" name="idVenta" value="{{ $p->idVenta }}">
            </label>
    </div>
    <h3 class="subtitulo-detalleVenta">Datos del cliente</h3>
    <div class="form-group row">
        <div class="form-group col-md-6">
            <label class="label-detalleVenta">DNI-CUIT</label>
            <input type="text" readonly class="form-control-plaintext input-detalleVenta" name="dni_cuit" value="{{ $p->Cliente_dni_cuit}}">
        </div>
        <div class="form-group col-md-6">
            <label class="label-detalleVenta">Domicilio</label>
            <input type="text" class="form-control-plaintext input-detalleVenta" name="domicilio" value="{{$p->lugar}}">
        </div>
    </div>
    <div class="form-group row">
        <div class="form-group col-md-6">
            <label class="label-detalleVenta">Condicion de pago</label>
            <input type="text" class="form-control-plaintext input-detalleVenta" name="condicion" value="{{$p->condicion}}">
        </div>
        <div class="form-group col-md-6">
            <label class="label-detalleVenta">Fecha venta</label>
            <input type="text" class="form-control-plaintext input-detalleVenta" name="fecha" value="{{$p->fecha}}">
        </div>
    </div>

<h3 class="subtitulo-detalleVenta">Datos de la venta</h3>

        @foreach($libroxventa as $i)<!-- VOY COMPARANDO -->
        
        @if($i->idVenta==$p->idVenta)

            <div class="form-group row">
                <div class="form-group col-md-6">
                    <label class="label-detalleVenta">ISBN</label>
                    <input type="text" readonly class="form-control-plaintext input-detalleVenta" name=ISBN[] value="{{$i->ISBN}}">
                </div>
                <div class="form-group col-md-6">
                    <label class="label-detalleVenta">Cantidad vendida</label>
                    <input type="number" min=0 class="form-control-plaintext input-detalleVenta" name=cantidad[] value="{{$i->cant}}">
                </div>
        
            </div>


        @endif
                

        @endforeach
        <div class="form-group">
			<button  class="btn btn-danger btn-lg btn-block" name="confirmarModificacion" type="submit"> Confirmar modificacion</button></a>
	    </div>


      @endforeach
      </div>
</form>
