
<!-- DEVUELVO LOS CLIENTES BUSCADOS MEDIANTE AJAX -->
@if(count($clientesAJAX))


    <table bgcolor=#007bff class="table table-striped" style="width:500px;">
    @foreach($clientesAJAX as $item)
        <tr class="odd"> 
                                            <td  style="font-size:12px; text-align:center" scope="col" class="informacion" id="dni_cuit">{{$item->dni_cuit}}</td>
                                            <td  style=" text-align:center" class="informacion">{{$item->nombre_apellido}} </td>
                                            <td  style=" text-align:center" class="informacion">{{$item->domicilio}}</td>
                                            <td  style=" text-align:center" class="informacion">{{$item->telefono}}</td>
                                            <td  style=" text-align:center" class="informacion">{{$item->id_tipo_cliente}}</td>

                                            <td style=" text-align:center">
                                                <button value="elegirCliente" title="elegirCliente" class="btn btn-primary elegirCliente" name="elegirCliente" aling="right">
                                                    <i class="fa fa-check-square-o" aria-hidden="true"></i>
                                                </button>
                                            </td>
        </tr>
    @endforeach
    </table>
@endif



 
