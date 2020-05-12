@include('layout')
<div align="right" style="margin-left: 50px;margin-right: 50px;margin-top: 10px;">
<a href="agregarTalonario">
   <img src="{{asset('imagen/add-file (1).png')}}" width="64" height="64" >
  </a>
  </div>
<div style="margin-left: 50px;margin-right: 50px;margin-top: 10px;background-color: white">
    
  <table class="table table-bordered" >

    <thead class="thead-dark">
      <tr align="center">
        <th scope="col" >Numero de talonario</th>
        <th scope="col">Numero Inicio de Recibos</th>
        <th scope="col">Numero Fin de Recibos</th>
        <th scope="col"></th>


      </tr>
    </thead>
    <tbody>
     @foreach($talonario as $tal)
        <tr align="center">
          <td>{{$tal->id_talonario}}</td>
         <td>{{$tal->nro_inicio}}</td>
         <td>{{$tal->nro_fin}}</td>
          <td>  <a  href="talonario/mailFacturacion/{{$tal->id_talonario}}" style="text-decoration:none;color:black;">
                    <i class='fas fa-envelope-open-text' style='color:#337ab7;'>
                        <font face="Arial" size="2">
                            Enviar Mail
                        </font>
                    </i>
                </a>
            </td>           
          </tr>
    @endforeach
    </tbody>
  </table>  
 
</div