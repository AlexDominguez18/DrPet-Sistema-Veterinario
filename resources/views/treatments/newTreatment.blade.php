@extends('layouts.sbadmin')
@include('treatments.treatmentForm')
@section('content')
<script>document.title = "Registrar tratamiento | Dr. Pet";</script>
<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">Registrar tratamiento</h1>
</div>
<hr>
@yield('treatment-form')
@endsection