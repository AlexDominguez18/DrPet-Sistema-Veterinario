@extends('layouts.sbadmin')
@section('content')

<script>document.title = "{{ $pet->nombre }} | Dr. Pet"</script>
<link rel="icon" href="{{asset('img/DrPetLogo.png')}}" type="image">

<div>
    <h3>Mostrando información de {{ $pet->nombre }}</h3>
    <hr>
    <div class="row">
        <div class="col col-md-6 mb-4">
            <div class="card border-left-info shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-sm font-weight-bold text-primary text-uppercase mb-1">
                                {{ $pet->nombre }}
                            </div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">
                                {{ $pet->raza }}
                            </div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">
                                {{ $pet->color }}
                            </div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">
                                {{ $pet->especie }}
                            </div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">
                                <div>
                                    <strong>Observaciones:</strong>
                                    {{ $pet->observaciones }}
                                </div>
                            </div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">
                                <div>
                                    <strong>Última fecha consulta:</strong>
                                    {{ $pet->fecha_consulta }}
                                </div>
                            </div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">
                                <div>
                                    <strong>Dueño:</strong>
                                    {{ $pet->owner->nombre }}
                                </div>
                            </div>
                        </div>
                        <div class="col-auto">
                            @if ($pet->foto === "img/PetAvatarDefault.png")
                                <img src="{{ asset('img/PetAvatarDefault.png') }}" class="img-thumbnail img-fluid" width="100">
                            @else
                                <img src="{{ asset('storage').'/'.$pet->foto }}" class="img-thumbnail img-fluid" width="100" alt="Foto de la mascota">
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <hr>
    <a class="btn btn-success btn-icon-split" href="{{ route('pet.index') }}">
        <span class="icon text-white-50">
            <i class="fas fa-chevron-circle-left"></i>
        </span>
        <span class="text">
            Regresar
        </span>
    </a>
</div>

@endsection