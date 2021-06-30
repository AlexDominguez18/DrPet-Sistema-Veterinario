@section('mascota-form')
<div>
    <h3>Datos de la mascota</h3>
    <hr>    
    @if (isset($pet))
    <form class="was-validated" method="POST" action="{{ route('pet.update',$pet) }}" enctype="multipart/form-data">    
        @method('PATCH')
    @else
    <form class="was-validated" method="POST" action="{{ route('pet.store') }}" enctype="multipart/form-data">
    @endif
        @csrf
        <!--Imagen de la mascota-->
        <div class="form-group align-self-start">
            <div class="d-flex justify-content-start">
                @if (isset($pet))
                <img src="{{asset('storage').'/'.$pet->foto}}" class="img-thumbnail img-fluid" id="fotoPreview" style="height: 10rem;"/>
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
        </div>
        <!--Input para el nombre de la mascota -->
        <div class="form-group row">
            <div class="col-md-4">
                <input 
                    type="textarea"
                    class="form-control is-invalid"
                    name="nombre"
                    id="nombre"
                    placeholder="Nombre..."
                    value="{{$pet->nombre}}" 
                required>
            </div>
            <!--Text para la raza de la mascota-->
            <div class="col-md-4">
                <input 
                    type="text"
                    class="form-control is-invalid"
                    name="raza" 
                    id="raza" 
                    placeholder="Raza..."
                    value="{{$pet->raza}}" 
                required>
            </div>
            <!--Text para el color de la mascota-->
            <div class="col-md-4">
                <input 
                    type="text" 
                    class="form-control is-invalid" 
                    name="color" 
                    id="color" 
                    placeholder="Color..."
                    value="{{$pet->color}}" 
                required>
            </div>
        </div>
        <div class="form-group row">
            <div class="col-md-4">
                <input 
                    type="text" 
                    class="form-control is-invalid" 
                    name="especie" 
                    id="especie" 
                    placeholder="Especie..."
                    value="{{$pet->especie}}" 
                required>
            </div>
            <div class="col-sm-1 text-center">
                <label for="fecha_consulta">Consulta:</label>
            </div>
            <div class="col-md-7">
                <input 
                    type="date" 
                    class="form-control is-invalid" 
                    name="fecha_consulta" 
                    id="fecha_consulta" 
                    value="{{$pet->fecha_consulta}}"
                required>
            </div>
        </div>
        <div>
            <label for="observaciones"><strong>Observaciones:</strong></label>
            <textarea 
                class="form-control is-invalid" 
                name="observaciones" 
                id="observaciones" 
            required>{{$pet->observaciones}}</textarea>
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
                <select id="owner_id" name="owner_id" class="form-select form-select-lg mb-3 align-self-cente" aria-label=".form-select-lg example">
                    @foreach ($owners as $owner)
                        @if (isset($pet))
                            @if ($owner->id === $pet->owner->id)
                                <option value="{{ $owner->id }}" selected>{{ $pet->owner->nombre }}</option>
                                @continue
                            @endif
                        @else
                        <option selected>Seleccione al dueño de la mascota...</option>
                        @endif    
                        <option value="{{ $owner->id }}">{{ $owner->nombre }}</option>
                    @endforeach
                </select>
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