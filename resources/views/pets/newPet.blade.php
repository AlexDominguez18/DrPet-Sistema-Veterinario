@extends('layouts.sbadmin')
@include('pets.ownerForm')
@include('pets.petForm', ['owners'=> $owners])
@section('content')
<script>document.title = "Agregar mascota | Dr. Pet";</script>
<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">Agregar mascota</h1>
</div>
<hr>
@if(session()->has('message'))
    <div class="alert alert-success">
        {{ session()->get('message') }}
    </div>
@endif
@yield('owner-form')
<hr>
@yield('pet-form', $owners)
@endsection
