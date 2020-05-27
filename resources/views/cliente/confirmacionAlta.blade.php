@extends('welcome')
@section('content')
<script>
    Swal.fire({
		position: 'center',
		type: 'success',
		title: resultado,
		showConfirmButton: false,
		timer: 1000
	});
</script>
@endsection