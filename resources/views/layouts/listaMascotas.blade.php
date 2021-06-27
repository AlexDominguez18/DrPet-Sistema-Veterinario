@extends('layouts.sbadmin')
@section('content')

<div class="container">
    <div class="table-responsive">
        <table id="example" class="table table-bordered" style="width:100%">
            <thead>
                <tr>
                    <th>Foto</th>
                    <th>Nombre</th>
                    <th>Raza</th>
                    <th>Color</th>
                    <th>Especie</th>
                    <th>Sexo</th>
                    <th>Dueño</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($pets as $pet)
                <tr>
                    <td>
                        @if ($pet->foto === "img/PetAvatarDefault.png")
                            <img src="{{ asset('img/PetAvatarDefault.png') }}" class="img-thumbail img-fluid" style="width: 100px; height: auto;">
                        @else
                            <img src="{{ asset('storage').'/'.$pet->foto }}" class="img-thumbail img-fluid" style="width: 100px; height: auto;" alt="Foto de la mascota">
                        @endif
                    </td>
                    <td>{{ $pet->nombre }}</td>
                    <td>{{ $pet->raza }}</td>
                    <td>{{ $pet->color }}</td>
                    <td>{{ $pet->especie }}</td>
                    <td>{{ $pet->sexo }}</td>
                    <td>{{ $pet->owner->nombre }}</td>
                </tr>
                @endforeach
            </tbody>
            <tfoot>
                <tr>
                    <th>Foto</th>
                    <th>Nombre</th>
                    <th>Raza</th>
                    <th>Color</th>
                    <th>Especie</th>
                    <th>Sexo</th>
                    <th>Dueño</th>
                </tr>
            </tfoot>
        </table>
    </div>
</div>

@endsection