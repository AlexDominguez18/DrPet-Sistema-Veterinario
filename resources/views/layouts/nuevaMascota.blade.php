@extends('layouts.sbadmin')
@include('layouts.duenioForm')
@include('layouts.mascotaForm', ['owners'=> $owners])
@section('content')
<script>
    document.title = "Agregar mascota | Dr. Pet";
</script>
<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">Agregar mascota</h1>
</div>
<hr>
@yield('duenio-form')
<hr>
@yield('mascota-form', $owners)
@endsection