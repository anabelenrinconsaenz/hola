
<!-- DETALLE DE UNA SOLA VENTA -->


<div class="titulo">
    <h1>Detalle de Venta</h1>
</div>
<hr>
<div class="container bg-light border border-dark mt-3">
    <h3 class="subtitulo-detalleVenta">Datos del cliente</h3>

    @foreach($totalVentas as $p)


    <div class="form-group row">

        <div class="form-group col-md-6">
            <label class="label-detalleVenta">{{$p->Cliente_dni_cuit}}</label>
            <input type="text" readonly class="form-control-plaintext input-detalleVenta" value="56842175">
        </div>
        <div class="form-group col-md-6">
            <label class="label-detalleVenta">Domicilio</label>
            <input type="text" readonly class="form-control-plaintext input-detalleVenta" value="General Pico">
        </div>
    </div>
    <div class="form-group row">
        <div class="form-group col-md-6">
            <label class="label-detalleVenta">Nombre y Apellido</label>
            <input type="text" readonly class="form-control-plaintext input-detalleVenta" value="Marcos Perez">
        </div>
        <div class="form-group col-md-6">
            <label class="label-detalleVenta">Telefono</label>
            <input type="text" readonly class="form-control-plaintext input-detalleVenta" value="2302 545454">
        </div>
    </div>
    <div class="form-group row">
        <div class="form-group col-md-6">
            <label class="label-detalleVenta">Tipo de Cliente</label>
            <input type="text" readonly class="form-control-plaintext input-detalleVenta" value="Estudiante">
        </div>
        <div class="form-group col-md-6">
            <label class="label-detalleVenta">Email</label>
            <input type="text" readonly class="form-control-plaintext input-detalleVenta" value="marcosPerez@gmail.com">
        </div>
        <div class="form-group col-md-6">
            <label class="label-detalleVenta">{{$p->fecha}}</label>
            <input type="text" readonly class="form-control-plaintext input-detalleVenta" value="">
        </div>
    </div>

<br>
<br>
@endforeach

</div>


<div class="container bg-light border border-dark mt-3">
    <h3 class="subtitulo-detalleVenta">Lista de libros</h3>
    <table class="table table-striped">
        <thead>
            <tr>
                <th scope="col">ISBN</th>
                <th scope="col">Titulo</th>
                <th scope="col">Autor</th>
                <th scope="col" class="text-center">Cantidad</th>
                <th scope="col" class="text-center">Precio Unitario</th>
            </tr>
        </thead>
        <tbody>

        
            <tr>
                <td>6767</td>
                <td>10 Bajistas</td>
                <td>Alejo Carbonell</td>
                <td class="text-center">2</td>
                <td class="text-center">200</td>
            </tr>
          




            <tr>
                <th scope="row" colspan="4" class="text-right">TOTAL</th>
                <td class="text-center">550</td>
            </tr>
        </tbody>
      </table>
</div>

