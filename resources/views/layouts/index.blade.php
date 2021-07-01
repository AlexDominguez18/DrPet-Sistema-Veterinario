@extends('layouts.sbadmin')
@section('content')
<div class="d-sm-flex align-items-center justify-content-between mb-4">
    @auth
        <h1 class="h3 mb-0 text-gray-800">Bienvenido, {{ Auth::user()->name }}</h1>
    @endauth
    <a href="#" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i
            class="fas fa-download fa-sm text-white-50"></i> Generar reporte
    </a>
</div>
<hr>
<div class="text-center">
    <img src="{{asset('img/DrPetLogo.png')}}" alt="Logo de Dr. Pet" width="500" height="auto">
</div>
@endsection
