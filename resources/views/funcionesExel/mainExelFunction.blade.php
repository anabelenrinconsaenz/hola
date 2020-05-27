@include('layout')

<div class="titulo">
    <h1>Administrar Excel</h1>
    <img src="{{asset('imagen/excel.svg')}}" width="52" height="52" style="margin-left: 10px;">
</div>

<div class="container">
    <div class="titulo">
        <!--<img src="{{asset('imagen/microsoft-excel.jpg')}}" width="64" height="64" >
        <img src="{{asset('imagen/f-abajo.png')}}" width="64" height="64" >-->
        <i class='fas fa-file-download' style='font-size:48px;color:#28a745;margin-right: 5px;'></i>
        <h1>Exportar libros</h1>
    </div>
    <div class="titulo" style="height: "> 
        <!--color:#white;-->
        <button type="button" class="btn btn-dark" onclick="window.location.href='{{ url ('exelExportar') }}'" style="margin-top: -5px;">Descargar Excel</button>
    </div>
</div>

<br>
<div class="container">
    <div class="titulo">
        <!--<img src="{{asset('imagen/microsoft-excel.jpg')}}" width="64" height="64" >
        <img src="{{asset('imagen/f-arriba.png')}}" width="64" height="64" >-->
        <i class='fas fa-file-upload' style='font-size:48px;color:#e86a04;margin-right: 5px;'></i>
        <h1>Importar libros</h1>
    </div> 
    <div class="titulo" style="height: 45px">
        <!--color:#white;-->
        <form action="{{ url ('exelImportar') }}" method="post" enctype="multipart/form-data">
            @csrf
            @if (Session::has('mensaje'))
                <script>
                    Swal.fire({
                    position: 'center',
                    icon: 'success',
                    title: '{{ Session::get('mensaje') }}',
                    showConfirmButton: false,
                    timer: 1500
                    })
                </script>
            @endif
            <input type="file" id="exelLibro" name="exelLibro" accept=".xlsx"><br>
            <button class="btn btn-dark" id="btnFile" onclick="loadgif()" style="margin-top: 10px;">Importar Excel</button>
        </form>
    </div>

    <div style="width: 490px">
        <a href=" {{ url ('exelPreparacion') }} " style="text-decoration: none;color: black"> 
        <div class="titulo" style="margin-top: 100px;">
                
            <!--<img src="{{asset('imagen/prepare-exel.jpg')}}" width="64" height="64" >-->
            <i class='fas fa-file-excel' style='font-size:48px;color:#337ab7;margin-right: 5px;'></i>
            
            <h1>Guía preparar Excel</h1>  
        </div>
    </a>
    </div>
    
</div>


<script>
    window.addEventListener("load",verificarFile());

    function verificarFile(){
        if( document.getElementById("exelLibro").files.length == 0 ){
            document.getElementById("btnFile").disabled = true;
        }else{
            document.getElementById("btnFile").disabled = false;
        }
        var refrescar= setTimeout(function(){verificarFile()},100);
    }


    function loadgif(){
        Swal.fire('Cargando datos...')
        Swal.showLoading()
    }

    function test(){
        Swal.fire({
        position: 'center',
        icon: 'success',
        title: 'Your work has been saved',
        showConfirmButton: false,
        timer: 1500
        })
    }
</script>