@extends('layouts.sbadmin')
@section('content')

<script>document.title = "Mascotas | Dr. Pet";</script>

<script src="{{asset('libs/jquery/jquery.min.js')}}"></script>
<link rel="stylesheet" type="text/css" href="{{ asset('libs/datatables/dataTables.bootstrap4.min.css') }}">

@if(session()->has('message'))
    <div class="alert alert-success">
        {{ session()->get('message') }}
    </div>
@endif

<div class="card-shadow mb-4">
    <div class="card-header py-3">
        <h3 class="m-0 font-weight-bold text-primary">Lista de mascotas</h3>
    </div>
<div class="card-body">
    <div class="table-responsive">
        <table id="table" class="table table-striped table-bordered" style="width:100%">
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
                    @foreach ($species as $specie)
                        @if ($specie->id === $pet->specie_id)
                            <td>{{ $specie->nombre }}</td>
                        @endif
                    @endforeach
                    <td>{{ $pet->sexo }}</td>
                    @if($pet->owner != null)
                        <td>{{ $pet->owner->nombre }}</td>

                    @else
                        <td>Disponible para adopción</td>
                    @endif
                    <td class="text-center">
                        <!--Boton de editar-->
                        <a class="btn btn-circle btn-warning" href="{{ route('pet.edit', $pet) }}">
                            <i class="fas fa-edit"></i>
                        </a>
                        <!--Boton de eliminar-->
                        <a class="btn btn-circle btn-danger" href="#" data-toggle="modal" data-target="#deletePetModal{{$pet->id}}">
                            <i class="fas fa-trash"></i>
                        </a>
                        <!--Modal para borrar registro-->
                        <div class="modal fade" id="deletePetModal{{$pet->id}}" tabindex="-1" role="dialog"  aria-hidden="true">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLabel">¿Seguro que quiere eliminar a {{$pet->nombre}}?</h5>
                                        <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">×</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">Ingrese la contraseña de su usuario para borrarlo.
                                        @if(isset($pet))
                                            <form method="POST" action="{{ route('pet.destroy',$pet) }}">
                                                @csrf
                                                @method('DELETE')
                                                <input id="password" class="form-control" type="password" name="password" required autofocus />
                                                @foreach ($errors->all() as $error)
                                                    <p class="text-danger">{{ $error }}</p>
                                                @endforeach
                                                <div class="modal-footer">
                                                    <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancelar</button>
                                                    <button class="btn btn-primary" type="submit">Confirmar</button>
                                                </div>
                                            </form>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
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
</div>

@if($errors->any())
    <script>
        $(document).ready(function(){
            $("#deleteModal").modal('show');
        });
    </script>
@endif

@endsection
