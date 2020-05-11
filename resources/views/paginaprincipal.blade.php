
@if(count($totalLibros))

  @foreach($totalLibros as $i)
      <tr>
        <td data-toggle="modal" data-target="#myModalLibro{{$i->ISBN}}">{{ $i->precio_general }}</td>
        <td data-toggle="modal" data-target="#myModalLibro{{$i->ISBN}}"> {{ $i->precio_estudiante }} </td>
        <td data-toggle="modal" data-target="#myModalLibro{{$i->ISBN}}"> {{ $i->precio_docente }} </td>
        <td data-toggle="modal" data-target="#myModalLibro{{$i->ISBN}}"> {{ $i->titulo }} </td>
        <td data-toggle="modal" data-target="#myModalLibro{{$i->ISBN}}">{{ $i->autor }}</td>
        <td  data-toggle="modal" data-target="#myModalLibro{{$i->ISBN}}">{{ $i->editorial }}</td>
        @if($i->stock_min<$i->cant_deposito)
        <td  data-toggle="modal" data-target="#myModalLibro{{$i->ISBN}}">{{$i->cant_deposito }}</td>
        @endif
        @if($i->stock_min>=$i->cant_deposito)
          <td class="table-danger" data-toggle="modal" data-target="#myModalLibro{{$i->ISBN}}">{{$i->cant_deposito }}</td>
        @endif
        <td >
                <a data-toggle="modal" href="#myModalStock{{$i->ISBN}}" style="text-decoration:none;color:black;">
                    <i class='fas fa-plus' style='color:#4caf50;'>
                        <font face="Arial,MS Sans Serif" size="2">
                            Stock
                        </font>
                    </i>
                </a>
                |
                <a href="/editar?ISBN={{$i->ISBN}}" style="text-decoration:none;color:black;">
                    <i class='fas fa-edit' style='color:#337ab7;'>
                        <font face="Arial,MS Sans Serif" size="2">
                            Editar
                        </font>
                    </i>
                </a>
                |
                <a data-toggle="modal" href="#" onclick="borrar({{$i->ISBN}})" style="text-decoration:none;color:black;">
                    <i class='fas fa-trash-alt' style='color:#d9534f;'>
                        <font face="Arial,MS Sans Serif" size="2">
                            Eliminar
                        </font>
                    </i>
                </a>
            </td>
      </tr>

      <!-- The Modal Libro-->
      <div class="modal fade" id="myModalLibro{{$i->ISBN}}">
        <div class="modal-dialog modal-dialog-centered">
          <div class="modal-content">

          <!-- Modal Header -->
          <div class="modal-header">
            <h4 class="modal-title">
              <i class='fas fa-plus' style='color:#337ab7;font-size:24px;'>
                <font face="Arial,MS Sans Serif" size="5">
                  Info
                </font>
              </i>
            </h4>
            <button type="button" class="close" data-dismiss="modal">&times;</button>
          </div>

          <!-- Modal body -->
          <div class="modal-body">
            <div class="row">
              <div class="col-25">
                <label for="id" style="padding-left: 10px">ISBN - ISSN</label>
              </div>
              <div class="col-75">
                <input type="text" name="ISBN" value="{{ $i->ISBN }}" style="width: 100%;padding: 12px;border: 1px solid #ccc;border-radius: 4px;resize: vertical;" readonly>
              </div>
            </div>
            <div class="row">
              <div class="col-25">
                <label for="id" style="padding-left: 10px">Venta</label>
              </div>
              <div class="col-75">
                <input type="text" name="cant_venta" value="{{ $i->cant_venta }}" style="width: 100%;padding: 12px;border: 1px solid #ccc;border-radius: 4px;resize: vertical;" readonly>
              </div>
            </div>
            <div class="row">
              <div class="col-25">
                <label for="id" style="padding-left: 10px">Stock minimo</label>
              </div>
              <div class="col-75">
                <input type="text" name="stock_min" value="{{ $i->stock_min }}" style="width: 100%;padding: 12px;border: 1px solid #ccc;border-radius: 4px;resize: vertical;" readonly>
              </div>
            </div>
          </div>

            </div>
          </div>
      </div>


      <!-- The Modal Agregar-->
      <div class="modal fade" id="myModalStock{{$i->ISBN}}">
        <div class="modal-dialog modal-dialog-centered modal-sm">
          <div class="modal-content">

            <!-- Modal Header -->
            <div class="modal-header">
              <h4 class="modal-title">Agregar stock</h4>
              <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>

            <!-- Modal body -->
            <div class="modal-body">
              <input type="number" name="stock" id="stock{{$i->ISBN}}"  value="0" min="0">
            </div>

            <!-- Modal footer -->
            <div class="modal-footer">
              <button type="button" class="btn btn-danger" data-dismiss="modal" onclick="modificarStock({{$i->ISBN}},{{$i->cant_deposito}})">Guardar</button>
            </div>

          </div>
        </div>
      </div>
    @endforeach

@endif
