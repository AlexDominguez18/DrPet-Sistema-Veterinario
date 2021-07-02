@extends('layouts.sbadmin')
@section('content')

<script>document.title = "{{ $pet->nombre }} | Dr. Pet"</script>
<link rel="icon" href="{{asset('img/DrPetLogo.png')}}" type="image">

@if(session()->has('message'))
    <div class="alert alert-success">
        {{ session()->get('message') }}
    </div>
@endif

<div>
    <h3>Mostrando información de {{ $pet->nombre }}</h3>
    <hr>
    <div class="row">
        <!--Tarjeta con la informaccion de la mascota-->
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
        <!--Tarjeta con la informaccion del dueño de la mascota-->
        <div class="col col-md-6 mb-4">
            <div class="card border-left-info shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-sm font-weight-bold text-primary text-uppercase mb-1">
                                Dueño: {{ $pet->owner->nombre }}
                            </div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">
                                {{ $pet->owner->telefono }}
                            </div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">
                                {{ $pet->owner->correo }}
                            </div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">
                                {{ $pet->owner->direccion }}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <hr>
    <div class="row">
        <!--Formulario para asignarle tratamientos a la mascota-->
        <div class="col-lg-6">
            <div class="card shadow mb-4 border-left-success">
                <a href="#collapseAsignTreatmentForm" class="d-block card-header py-3" data-toggle="collapse"
                    role="button" aria-expanded="true" aria-controls="collapseCardExample">
                    <h6 class="m-0 font-weight-bold text-primary">Añadir tratamiento</h6>
                </a>
                <div class="collapse" id="collapseAsignTreatmentForm">
                    <div class="card-body">
                        <form class="form" method="POST" action="{{ route('pet.add-treatment',$pet) }}">
                            @csrf
                            <div class="form-group">
                                <label for="treatment_id">Seleccione el tratamiento a aplicar...</label>
                                <select id="treatment_id" name="treatment_id" class="form-control" required>
                                    <option value="0" selected>Ninguno</option>
                                    @foreach ($treatments as $treatment)
                                        @if (array_search($treatment->id,$pet->treatments->pluck('id')->toArray()) === false)
                                        <option value="{{ $treatment->id }}">{{ $treatment->nombre}} - {{ $treatment->tipo }}</option>
                                        @endif
                                    @endforeach
                                </select>
                            </div>
                            <hr>
                            <button type="submit" class="btn btn-info btn-icon-split">
                                <span class="icon">+</i></span>
                                <span class="text">Agregar</span>
                            </button>
                        </form>
                    </div>
                </div>
            </div>
            @error('treatment_id')
            <div class="alert alert-danger">{{$message}}</div>
            @enderror
        </div>
        <!--Tarjeta colapsable para mostrar los tratamientos asignados-->
        <div class="col-lg-6">
            <div class="card shadow mb-4">
                <a href="#collapseTreatmentsCard" class="d-block card-header py-3 border-left-success" data-toggle="collapse"
                    role="button" aria-expanded="true" aria-controls="collapseTreatmentsCard">
                    <h6 class="m-0 font-weight-bold text-primary text-uppercase mb-1">Tratamientos aplicados</h6>
                </a>
                <div class="collapse" id="collapseTreatmentsCard">
                    <div class="card-body">
                        @if ($pet->treatments->count())
                        <ul class="list-group">
                        @foreach ($pet->treatments as $treatment)
                        <li class="list-group-item">
                            <div class="row">
                                <div class="col-md-8">
                                    {{ $treatment->nombre }} | {{ $treatment->dosis }} mg/ml
                                </div>
                                <div class="col-auto">
                                    <form method="POST" action="{{ route('pet.delete-treatment',[$pet,$treatment]) }}">
                                        @method('DELETE')
                                        @csrf
                                        <button type="submit" class="btn btn-circle btn-sm btn-danger">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    </form>
                                </div>
                            </div>
                        </li>
                        @endforeach
                        </ul>
                        @else
                        Sin tratamientos
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
    <hr>
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