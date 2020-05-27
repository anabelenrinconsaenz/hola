@include('layout')

<div class="titulo">
  <h1>Talonarios</h1>
  <i class='fas fa-file-invoice-dollar' style='font-size:48px;color:#e86a04;margin-left: 10px;'></i>
</div>
  
<div class="titulo" style="height: 45px">
  <!--color:#white;-->
  <button type="button" onclick="window.location.href='agregarTalonario'" class="btn btn-success" ><i class='fas fa-user-plus' style="margin-right: 1px"></i>Nuevo talonario</button>
    <!-- Search form -->
</div>
<div style="margin-left: 50px;margin-right: 50px;margin-top: 10px;background-color: white">
    
  <table class="table table-bordered" >

    <thead class="thead-white">
      <tr align="center">
        <th scope="col" >Numero de talonario</th>
        <th scope="col">Numero Inicio de Recibos</th>
        <th scope="col">Numero Fin de Recibos</th>
    


      </tr>
    </thead>
    <tbody>
     @foreach($talonario as $tal)
        <tr align="center">
          <td>{{$tal->id_talonario}}</td>
         <td>{{$tal->nro_inicio}}</td>
         <td>{{$tal->nro_fin}}</td>          
        </tr>
    @endforeach
    </tbody>
  </table>  
 
</div