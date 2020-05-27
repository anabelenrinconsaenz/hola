@include('layout')
<BR>
<center>
<div class="col-11">

<form action="" >


<div class="row row-cols-1 row-cols-md-4">
@foreach($notificaciones as $li)

  <div class="col mb-4">
  <div class="card h-100 bg-light">
    <div class="card-header" style="background-color:#848484; color: white;" >{{$li->ISBN}} </div>
      <div class="card-body">
        <h5> Titulo: {{$li->titulo}} </h5>
        <h5> Cantidad disponible: {{$li->cant_deposito}} </h5>
      </div>
      <div class="card-footer">
   
    <button type="submit" class="btn btn-danger btn-block" > <a style="color: white;  padding: 1.5px;text-decoration: none" href="{{ url ('bajaNotificacion',[$li->ISBN]) }}">Eliminar notificación</a></button>
  
   @if($li->leido==0)
  
    <button type="submit" class="btn btn-success btn-block" > <a style="color: white;  padding: 1.5px;text-decoration: none" href="{{ url ('modificarNotificacion',[$li->ISBN]) }}">Marcar como leído</a></button>
    @endif
   
   @if($li->leido==1)
   
       <button type="submit" class="btn btn-success btn-block" disabled> Leído</button>
   @endif

    </div>  
    </div>
  </div>
  @endforeach

</form> 
</div>

</center>
</body>

</html>