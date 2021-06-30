@extends('layouts.sbadmin')
@section('content')

<div class="container">
    <div class="table-responsive">
        <table id="table" class="table table-bordered" style="width:100%">
            <thead>
                <tr>
                    <th>Foto</th>
                    <th>Nombre</th>
                    <th>Raza</th>
                    <th>Color</th>
                    <th>Especie</th>
                    <th>Sexo</th>
                    <th>Dueño</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($pets as $pet)
                <tr>
                    <td>
                        @if ($pet->foto === "img/PetAvatarDefault.png")
                            <img src="{{ asset('img/PetAvatarDefault.png') }}" class="img-thumbnail img-fluid" width="100">
                        @else
                            <img src="{{ asset('storage').'/'.$pet->foto }}" class="img-thumbnail img-fluid" width="100" alt="Foto de la mascota">
                        @endif
                    </td>
                    <td>
                        <a class="btn btn-light" href="{{ route('pet.show',$pet) }}">
                            {{ $pet->nombre }}
                        </a>
                    </td>
                    <td>{{ $pet->raza }}</td>
                    <td>{{ $pet->color }}</td>
                    <td>{{ $pet->especie }}</td>
                    <td>{{ $pet->sexo }}</td>
                    <td>{{ $pet->owner->nombre }}</td>
                    <td>
                        <a class="btn btn-circle btn-warning" href="{{ route('pet.edit', $pet) }}">
                            <i class="fas fa-edit"></i>
                        </a>
                    </td>
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
                    <th>Acciones</th>
                </tr>
            </tfoot>
        </table>
    </div>
</div>

@endsection