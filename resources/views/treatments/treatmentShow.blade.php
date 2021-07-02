@extends('layouts.sbadmin')
@section('content')
<script>document.title = "{{ $treatment->nombre }} | Dr. treatment"</script>
<link rel="icon" href="{{asset('img/DrtreatmentLogo.png')}}" type="image">

<div>
    <h3>Información del tratamiento: {{ $treatment->nombre }}</h3>
    <hr>
    <div class="row">
        <div class="col col-md-6 mb-4">
            <div class="card border-left-info shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-sm font-weight-bold text-primary text-uppercase mb-1">
                                {{ $treatment->nombre }}
                            </div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">
                                {{ $treatment->dosis }} ml/mg
                            </div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">
                                {{ $treatment->tipo }}
                            </div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">
                                <div>
                                    <strong>Caduca el:</strong><br>
                                    {{ $treatment->fecha_caducidad }}
                                </div>
                            </div>
                        </div>
                        <div class="col-auto">
                            @if ($treatment->tipo === "vacuna")
                            <i class="fas fa-syringe fa-2x"></i>
                            @else
                            <i class="fas fa-pills fa-2x"></i>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <hr>
    <a class="btn btn-success btn-icon-split" href="{{ route('treatment.index') }}">
        <span class="icon text-white-50">
            <i class="fas fa-chevron-circle-left"></i>
        </span>
        <span class="text">
            Regresar
        </span>
    </a>
</div>
@endsection