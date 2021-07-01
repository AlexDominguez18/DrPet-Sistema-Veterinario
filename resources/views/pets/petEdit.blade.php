@extends('layouts.sbadmin')
@include('pets.ownerForm',['owner' => $owner])
@include('pets.petForm',['owners' => $owners])
@section('content')

<script>document.title = "Editando mascota | Dr. Pet";</script>
<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">Editando el registro de {{ $pet->nombre}}</h1>
</div>
<hr>
@yield('owner-form', $owner)
<hr>
@yield('pet-form', $owners)

@endsection
