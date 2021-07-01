@extends('layouts.sbadmin')
@section('content')

<script>document.title = "Animales en Adopción | Dr. Pet";</script>

<script src="{{asset('libs/jquery/jquery.min.js')}}"></script>
<link rel="stylesheet" type="text/css" href="{{ asset('libs/datatables/dataTables.bootstrap4.min.css') }}">

<div class="card-shadow mb-4">
    <div class="card-header py-3">
        <h3 class="m-0 font-weight-bold text-primary">Mascotas disponibles para adopción</h3>
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
                    <td class="text-center">
                        <!--Boton de adoptar-->
                        <a class="btn btn-success" href="#" data-toggle="modal" data-target="#adoptModal{{$pet->id}}">
                            Adoptar
                        </a>
                        <!--Modal para cambiar registro-->
                        <div class="modal fade" id="adoptModal{{$pet->id}}" tabindex="-1" role="dialog"  aria-hidden="true">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLabel">¿Seguro que quiere adoptar a {{$pet->nombre}}?</h5>
                                        <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">×</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">Presione "Adoptar" para confirmar.
                                        @if(isset($pet))
                                            <form method="POST" action="{{ route('adoption.store') }}">
                                                @csrf
                                                <input type="hidden" name="pet_id" value="{{ $pet->id }}">
                                                <div class="modal-footer">
                                                    <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancelar</button>
                                                    <button class="btn btn-primary" type="submit">Adoptar</button>
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
