@extends('layouts.sbadmin')
@section('content')
<script>
    document.title = "Acceso denegado"
</script>
<div class="container-fluid">
    <!-- 404 Error Text -->
    <div class="text-center">
        <div class="error mx-auto" data-text="404">404</div>
        <p class="lead text-gray-800 mb-5">Acceso denegado o página no encontrada</p>
        <p class="text-gray-500 mb-0">No es administrador o la ruta no existe...</p>
        <a href="{{ route('index') }}">&larr; Volver al inicio</a>
    </div>

</div>
@endsection