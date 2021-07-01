@extends('layouts.sbadmin')
@include('products.productForm')
@section('content')
<script>document.title = "Agregar producto | Dr. Pet";</script>
<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">Registrar Producto</h1>
</div>
<hr>
@yield('product-form')
@endsection
