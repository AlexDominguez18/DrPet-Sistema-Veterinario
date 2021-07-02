@extends('layouts.sbadmin')
@include('treatments.treatmentForm', ['treatment' => $treatment])
@section('content')
<script>document.title = "Editando mascota | Dr. Pet";</script>
<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">Editando el registro de {{ $treatment->nombre}}</h1>
</div>
<hr>
@yield('treatment-form', $treatment)
@endsection