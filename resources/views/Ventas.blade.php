@include('layout')


<!-- TODAS LAS VENTAS - VISTA DE /TODASVENTAS-->

<div class="titulo">
    <h1>Detalle de Venta</h1>
</div>
<hr>

@foreach($totalVentas as $p)
<div class="container bg-light border border-dark mt-3">

    <div class="form-group col-md-6">
        <form action="/formulario" type="POST">

                <label class="label-detalleVenta">ID VENTA

                        <input type="text" readonly class="form-control-plaintext input-detalleVenta" name="idVenta" value="{{ $p->idVenta }}">
                        <BR>

                        <input name="evento" type="submit" class="mx-3" value="ELIMINAR_VENTA" style="background: #e86a04; align=right;" >
                        <input name="evento" type="submit" class="mx-3" value="MODIFICAR_VENTA" style="background: #68F741;" >


                </label>
        </form>
    </div>   
    <h3 class="subtitulo-detalleVenta">Datos del cliente</h3>


    <div class="form-group row">

        <div class="form-group col-md-3">
            <label class="label-detalleVenta">DNI-CUIL</label>
            <input type="text" readonly class="form-control-plaintext input-detalleVenta" value="{{ $p->Cliente_dni_cuit}}">
        </div>
        <div class="form-group col-md-3">
            <label class="label-detalleVenta">Domicilio</label>
            <input type="text" readonly class="form-control-plaintext input-detalleVenta" value="{{$p->lugar}}">
        </div>
        <div class="form-group col-md-3">
            <label class="label-detalleVenta">Condicion de pago</label>
            <input type="text" readonly class="form-control-plaintext input-detalleVenta" value="{{$p->condicion}}">
        </div>
        <div class="form-group col-md-3">
            <label class="label-detalleVenta">Fecha venta</label>
            <input type="text" readonly class="form-control-plaintext input-detalleVenta" value="{{$p->fecha}}">
        </div>
    </div>


    <h3 class="subtitulo-detalleVenta">Lista de libros</h3>
    <table class="table table-striped">
        <thead>
            <tr>
                <th scope="col">ISBN</th>
                <th scope="col">titulo</th>

                <th scope="col">Cantidad</th>
                <th scope="col">Descuento</th>
                <th scope="col">Descripcion descuento</th>

            </tr>
        </thead>
        <tbody>
            
        @foreach($totalLibroxVenta as $i)<!-- VOY COMPARANDO Y SACO LOS LIBROS DE ESTA VENTA-->
        
            @if($i->idVenta==$p->idVenta)

                <tr>
                    <td>{{ $i->ISBN }}</td>
                    @foreach($libros as $libro)<!-- INFORMACION DEL LIBRO -->
        
                            @if($i->ISBN==$libro->ISBN)
                                <td>{{ $libro->titulo}}</td>

                            @endif  

                    @endforeach

                    <td>{{ $i->cant }}</td>
                    @foreach($descuentos as $descuento)<!-- INFORMACION DEL DESCUENTO -->
        
                         @if($i->IdDescuento==$descuento->idDescuento)
                            <td>{{ $descuento->porcentaje}} %</td>
                            <td>{{ $descuento->descripcion}}</td>

                         @endif

                    @endforeach
                </tr>
            @endif
                

        @endforeach


        </tbody>


        
      </table>
      <div class="form-group row">
        <div class="form-group col-md-6">
            <label class="label-detalleVenta">Total venta</label>
            <input type="text" readonly class="form-control-plaintext input-detalleVenta" value="{{$p->total}}">
        </div>
    </div>
      </div>
      <br>
      @endforeach

