@include('layout')

<!-- MODIFICAR UNA VENTA -->


<div class="titulo">
    <h1>Modificar venta</h1>
</div>
<hr>
<form action="/ConfirmarModificacion" type="GET">
<div class="container bg-light border border-dark mt-3">

@foreach($venta as $p)

    <div class="form-group col-md-6">
            <label class="label-detalleVenta">ID VENTA
                    <input type="text" readonly class="form-control-plaintext input-detalleVenta" name="idVenta" value="{{ $p->idVenta }}">
            </label>
    </div>
    <h3 class="subtitulo-detalleVenta">Datos del cliente</h3>
    <div class="form-group row">
        <div class="form-group col-md-3">
            <label class="label-detalleVenta">DNI-CUIT</label>
            <input type="text" readonly class="form-control-plaintext input-detalleVenta" name="dni_cuit" value="{{ $p->Cliente_dni_cuit}}">
        </div>
        <div class="form-group col-md-3">
            <label class="label-detalleVenta">Domicilio</label>
            <input type="text" class="form-control-plaintext input-detalleVenta" name="domicilio" value="{{$p->lugar}}" style=" background-color: #A4D0FF;">
        </div>
        <div class="form-group col-md-3">
            <label class="label-detalleVenta">Condicion de pago</label>
            <input type="text" class="form-control-plaintext input-detalleVenta" name="condicion" value="{{$p->condicion}}" style=" background-color: #A4D0FF;">
        </div>
        <div class="form-group col-md-3">
            <label class="label-detalleVenta">Fecha venta</label>
            <input type="text" readonly class="form-control-plaintext input-detalleVenta" name="fecha" value="{{$p->fecha}}">
        </div>
    </div>
 
<h3 class="subtitulo-detalleVenta">Datos de la venta</h3>

        @foreach($libroxventa as $i)<!-- VOY COMPARANDO -->
        
        @if($i->idVenta==$p->idVenta)

            <div class="form-group row">
                <div class="form-group col-md-2">
                    <label class="label-detalleVenta">ISBN</label>
                    <input type="text" readonly class="form-control-plaintext input-detalleVenta" name=ISBN[] value="{{$i->ISBN}}">
                </div>
                <div class="form-group col-md-3">
                    <label class="label-detalleVenta">TITULO</label>
                    <input type="text" readonly class="form-control-plaintext input-detalleVenta" name=titulo[] value="{{$i->titulo}}">
                </div>
                <div class="form-group col-md-2">
                    <label class="label-detalleVenta">Cantidad vendida</label>
                    <?php $cant_deposito=0; ?>
<?php
                    foreach($libros as $libro){
                        if($i->ISBN==$libro->ISBN){
                            $cant_deposito=$libro->cant_deposito;
                        }//SI JAMAS SE MODIFICA CANT DEPOSITO ES PORQUE EL LIBRO NO EXISTE
                    }
?>

            <?php if($cant_deposito!=0){ ?> <!-- SI EL LIBRO EXISTE ENTONCES PUEDO MODIFICAR SU CANTIDAD -->
                    <input type="number" min=1 max="{{$i->cant+$cant_deposito}}" class="form-control-plaintext input-detalleVenta" name=cantidad[] value="{{$i->cant}}" style=" background-color: #A4D0FF;">
             <?php   } ?>

             <?php if($cant_deposito==0){ ?> <!-- SI EL LIBRO NO EXISTE ENTONCES NO PUEDO MODIFICAR SU CANTIDAD, O QUIZAS NO HAY MAS EN DEPOSITO-->
                    <input type="number" min=1 max="{{$i->cant+$cant_deposito}}" readonly class="form-control-plaintext input-detalleVenta" name=cantidad[] value="{{$i->cant}}">
             <?php   } ?>

                    </div>
                <div class="form-group col-md-3">
                <label class="label-detalleVenta">Descuento</label>

                <select id="IdDescuento" name="IdDescuento[]" class="form-control" style="width :200px; font-size:13px; background-color: #A4D0FF;" required>
                @foreach($descuentos as $descuento)
                        @if($descuento->idDescuento==$i->IdDescuento)
                        <option selected value="{{$descuento->idDescuento}}">{{ $descuento->porcentaje}}% {{$descuento->descripcion}} - {{$descuento->idtipo_descuento }} </option>
                        @endif
                @endforeach
                        @foreach($descuentos as $descuento)
                            @if($descuento->fecha_inicio<= now()->toDateString() && ($descuento->fecha_final>=now()->toDateString() || $descuento->idtipo_descuento==2 || $descuento->idtipo_descuento==3))
                            '<option value="{{$descuento->idDescuento}}">{{ $descuento->porcentaje}}%  {{ $descuento->descripcion }} - {{ $descuento->idtipo_descuento }}</option>'+
                            @endif
                        @endforeach
                </select>
                </div>
                <div class="form-group col-md-2">
                    <label class="label-detalleVenta">Precio unitario</label>
                    <input type="number" readonly class="form-control-plaintext input-detalleVenta" name=precio_unitario[] value="{{$i->precio_unitario}}">
                </div>
            </div>


        @endif
                

        @endforeach
        <div class="form-group row">
                <div class="form-group col-md-6">
                    <label class="label-detalleVenta">TOTAL</label>
                    <input type="text" readonly class="form-control-plaintext input-detalleVenta" name=total value="{{$p->total}}">
                </div>
        </div>
        <div class="form-group">
			<button  class="btn btn-danger btn-lg btn-block" name="confirmarModificacion" type="submit"> Confirmar modificacion</button></a>
	    </div>


      @endforeach
      </div>
</form>
