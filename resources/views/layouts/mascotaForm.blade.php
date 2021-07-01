@section('mascota-form')

<div>
    <h3>Datos de la mascota</h3>
    <hr>
    @if (isset($pet))
    <form class="form" method="POST" action="{{ route('pet.update',$pet) }}" enctype="multipart/form-data">
        @method('PATCH')
    @else
    <form class="form" method="POST" action="{{ route('pet.store') }}" enctype="multipart/form-data">
    @endif
        @csrf
        <!--Imagen de la mascota-->
        <div class="form-group align-self-start">
            <div class="d-flex justify-content-start">
                @if (isset($pet))
                    @if ($pet->foto !== "img/PetAvatarDefault.png")
                    <img src="{{asset('storage').'/'.$pet->foto}}" class="img-thumbnail img-fluid" id="fotoPreview" style="height: 10rem;"/>
                    @else
                    <img src="{{asset('img/PetAvatarDefault.png')}}" class="img-thumbnail img-fluid" id="fotoPreview" style="height: 10rem;"/>                        
                    @endif
                @else
                <img src="{{asset('img/PetAvatarDefault.png')}}" class="img-thumbnail img-fluid" id="fotoPreview" style="height: 10rem;"/>
                @endif
                <div class="align-self-end">
                    <input class="custom-file-input form-control" type="file" name="foto" id="foto"
                            onchange="document.getElementById('fotoPreview').src = window.URL.createObjectURL(this.files[0])">
                    <label for="foto" class="btn btn-light btn-icon-split">
                        <span class="icon text-gray-600">
                            <i class="fas fa-arrow-right"></i>
                        </span>
                        <span class="text">Subir imagen</span>
                    </label>
                </div>
            </div>
            @error('foto')
            <div class="alert alert-danger">{{$message}}</div>
            @enderror
        </div>
        <!--Input para el nombre de la mascota -->
        <div class="form-group row">
            <div class="col-md-4">
                <input
                    type="textarea"
                    class="form-control @error('nombre') is-invalid @enderror"
                    name="nombre"
                    id="nombre"
                    placeholder="Nombre..."
                    @if (isset($pet))
                    value="{{ $pet->nombre }}"
                    @else
                    value="{{old('nombre')}}"
                    @endif
                required>
                @error('nombre')
                <div class="invalid-feedback">{{$message}}</div>
                @enderror
            </div>
            <!--Text para la raza de la mascota-->
            <div class="col-md-4">
                <input
                    type="text"
                    class="form-control @error('raza') is-invalid @enderror"
                    name="raza"
                    id="raza"
                    placeholder="Raza..."
                    @if (isset($pet))
                    value="{{ $pet->raza}}"
                    @else
                    value="{{old('raza')}}"
                    @endif
                required>
                @error('raza')
                <div class="invalid-feedback">{{$message}}</div>
                @enderror
            </div>
            <!--Text para el color de la mascota-->
            <div class="col-md-4">
                <input
                    type="text"
                    class="form-control @error('color') is-invalid @enderror"
                    name="color"
                    id="color"
                    placeholder="Color..."
                    @if (isset($pet))
                    value="{{ $pet->color}}"
                    @else
                    value="{{old('color')}}"
                    @endif
                required>
                @error('color')
                <div class="invalid-feedback">{{$message}}</div>
                @enderror
            </div>
        </div>
        <div class="form-group row">
            <div class="col-sm-1 text-center">
                <label for="specie_id">Especie:</label>
            </div>
            <div class="col-md-4">
                <select id="specie_id" name="specie_id" class="form-control" required>
                    <option value="0" selected>Seleccione la especie...</option>
                    @foreach ($species as $specie)
                        @if (isset($pet))   
                            @if ($errors->any())
                                @if ($specie->id == old('specie_id'))
                                    <option value="{{ $specie->id }}" selected>{{ $specie->nombre }}</option>
                                    @continue
                                @endif
                            @else 
                                @if ($specie->id === $pet->specie_id) 
                                    <option value="{{ $specie->id }}" selected>{{ $specie->nombre }}</option>
                                    @continue
                                @endif
                            @endif
                        @else
                            @if ($specie->id === old('specie_id'))
                                <option value="{{ $specie->id }}" selected>{{ $specie->nombre }}</option>
                            @endif
                        @endif
                        <option value="{{ $specie->id }}">{{ $specie->nombre }}</option>
                    @endforeach
                </select>
                @error('specie_id')
                <div class="alert alert-danger">{{$message}}</div>
                @enderror
            </div>
            <div class="col-sm-1 text-center">
                <label for="fecha_consulta">Consulta:</label>
            </div>
            <div class="col-md-6">
                <input
                    type="date"
                    class="form-control @error('fecha_consulta') is-invalid @enderror"
                    name="fecha_consulta"
                    id="fecha_consulta"
                    @if (isset($pet))
                    value="{{ $pet->fecha_consulta}}"
                    @else
                    value="{{old('fecha_consulta')}}"
                    @endif
                required>
                @error('fecha_consulta')
                <div class="invalid-feedback">{{$message}}</div>
                @enderror
            </div>
        </div>
        <div>
            <label for="observaciones"><strong>Observaciones:</strong></label>
            <textarea
                class="form-control @error('observaciones') is-invalid @enderror"
                name="observaciones"
                id="observaciones"required>@if (isset($pet)){{ $pet->observaciones }}@else{{ old('observaciones') }}@endif</textarea>
                @error('observaciones')
                <div class="invalid-feedback">{{$message}}</div>
                @enderror
        </div><br>
        <div class="form-group row">
            <!--Radio para el sexo de la mascota-->
            <legend class="col-form-label col-sm-2 pt-0"><strong>Sexo:</strong></legend>
            <div class="col-md-2 border-bottom-primary">
                <div class="form-check">
                    @if (isset($pet))
                        @if ($pet->sexo === 'M')
                        <input class="form-check-input" type="radio" name="sexo" id="sexo" value="M" checked>
                        @else
                        <input class="form-check-input" type="radio" name="sexo" id="sexo" value="M">
                        @endif
                    @else
                    <input class="form-check-input" type="radio" name="sexo" id="sexo" value="M" checked>
                    @endif
                    <label class="form-check-label" for="sexo">
                        Macho
                    </label>
                </div>
                <div class="form-check">
                    @if (isset($pet))
                        @if ($pet->sexo === 'H')
                        <input class="form-check-input" type="radio" name="sexo" id="sexo" value="H" checked>
                        @else
                        <input class="form-check-input" type="radio" name="sexo" id="sexo" value="H">
                        @endif
                    @else
                    <input class="form-check-input" type="radio" name="sexo" id="sexo" value="H">
                    @endif
                    <label class="form-check-label" for="sexo">
                        Hembra
                    </label>
                </div>
            </div>
            <legend class="col-form-label col-sm-1 pt-0"><strong>Dueño:</strong></legend>
            <div class="col-md-4">
                <select id="owner_id" name="owner_id" class="form-control" required>
                    <option value="0" selected>Seleccione al dueño de la mascota...</option>
                    @foreach ($owners as $owner)
                        @if (isset($pet))
                            @if ($errors->any())
                                @if ($owner->id == old('owner_id'))
                                    <option value="{{ $owner->id }}" selected>{{ $owner->nombre }}</option>
                                    @continue

                                @endif
                            @else 
                                @if ($owner->id === $pet->owner_id) 
                                    <option value="{{ $owner->id }}" selected>{{ $owner->nombre }}</option>
                                    @continue
                                @endif
                            @endif
                        @else
                            @if ($owner->id == old('owner_id'))
                                <option value="{{ $owner->id }}" selected>{{ $owner->nombre }}</option>
                                @continue
                            @endif
                        @endif
                        <option value="{{ $owner->id }}">{{ $owner->nombre }}</option>
                    @endforeach
                </select>
                @error('owner_id')
                <div class="alert alert-danger">{{$message}}</div>
                @enderror
            </div>
        </div>
        <!--Adoptable falso porque es mascota con duenio-->
        <input type="hidden" value="0" name="adoptable" id="adoptable" default>
        <button type="submit" class="btn btn-success">
            <i class="fas fa-save"></i>
            Guardar
        </button>
    </form>
</div>
@endsection
