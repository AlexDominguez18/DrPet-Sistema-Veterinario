@extends('layouts.sbadmin')
@include('users.userForm', $user)
@section('content')

<script>document.title = "Editando usuario | Dr. Pet";</script>
<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">Editando el registro de {{ $user->name}}</h1>
</div>
<hr>
@yield('user-form')
@endsection