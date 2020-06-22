@include('layout')

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

<form action="{{ url('/backup') }}" method="get">
    <button style="submit" class="btn btn-primary" onclick="loadgif()"> Crear Copia de Seguridad</button>
</form>

<script>
    function loadgif(){
        Swal.fire('Generando Copia de Seguridad, esto podria tardar... Por favor espere!')
        Swal.showLoading()
    }
</script>