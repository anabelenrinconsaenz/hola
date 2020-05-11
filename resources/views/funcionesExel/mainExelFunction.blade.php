@include('layout')

<div class="container">
    <div class="titulo">
        <img src="{{asset('imagen/microsoft-excel.jpg')}}" width="64" height="64" >
        <img src="{{asset('imagen/f-abajo.png')}}" width="64" height="64" >
        <h1>Exportar libros</h1>
    </div>
    <div class="titulo" style="height: 45px">
        <!--color:#white;-->
        <p>
            Clic <a href=" {{ url ('exelExportar') }} ">aqui </a> para descargar el Exel de Libros
        </p>
    </div>
</div>

<br>
<div class="container">
    <div class="titulo">
        <img src="{{asset('imagen/microsoft-excel.jpg')}}" width="64" height="64" >
        <img src="{{asset('imagen/f-arriba.png')}}" width="64" height="64" >
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
            <input type="file" name="exelLibro">
            <button onclick="loadgif()"> Importar Libros</button>
        </form>
    </div>

    <br>

    <div style="text-align:right;">
        <div class="titulo">
            <a href=" {{ url ('exelPreparacion') }} "> 
                <img src="{{asset('imagen/prepare-exel.jpg')}}" width="64" height="64" >
            </a>
            <h1>Como Preparar Exel</h1>
        </div>
    </div>
</div>


<script>
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