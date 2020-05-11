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

                        <input name="evento" type="submit" class="mx-3" value="ELIMINAR_VENTA" style="background: #e86a04;" >
                        <input name="evento" type="submit" class="mx-3" value="MODIFICAR_VENTA" style="background: #68F741;" >


                </label>
        </form>
    </div>   
    <h3 class="subtitulo-detalleVenta">Datos del cliente</h3>


    <div class="form-group row">

        <div class="form-group col-md-6">
            <label class="label-detalleVenta">DNI-CUIL</label>
            <input type="text" readonly class="form-control-plaintext input-detalleVenta" value="{{ $p->Cliente_dni_cuit}}">
        </div>
        <div class="form-group col-md-6">
            <label class="label-detalleVenta">Domicilio</label>
            <input type="text" readonly class="form-control-plaintext input-detalleVenta" value="{{$p->lugar}}">
        </div>
    </div>
    <div class="form-group row">
        <div class="form-group col-md-6">
            <label class="label-detalleVenta">Condicion de pago</label>
            <input type="text" readonly class="form-control-plaintext input-detalleVenta" value="{{$p->condicion}}">
        </div>
        <div class="form-group col-md-6">
            <label class="label-detalleVenta">Fecha venta</label>
            <input type="text" readonly class="form-control-plaintext input-detalleVenta" value="{{$p->fecha}}">
        </div>
    </div>

<br>
<br>




    <h3 class="subtitulo-detalleVenta">Lista de libros</h3>
    <table class="table table-striped">
        <thead>
            <tr>
                <th scope="col">ISBN</th>
                <th scope="col">Cantidad</th>
            </tr>
        </thead>
        <tbody>
            
        @foreach($totalLibroxVenta as $i)<!-- VOY COMPARANDO -->
        
            @if($i->idVenta==$p->idVenta)

                <tr>
                    <td>{{ $i->ISBN }}</td>
                    <td>{{ $i->cant }}</td>
                
                </tr>
            @endif
                

        @endforeach


        </tbody>


        
      </table>
      </div>
      <br>
      @endforeach

