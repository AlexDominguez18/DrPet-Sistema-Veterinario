@section('mascota-form')
<div>
    <form class="was-validated" method="POST" action="{{ route('pet.store') }}" enctype="multipart/form-data">
        <h3>Datos de la mascota</h3>
        <hr>
        @csrf
        <!--Imagen de la mascota-->
        <div class="form-group align-self-start">
            <div class="d-flex justify-content-start"> 
                <img src="{{asset('img/PetAvatarDefault.png')}}" class="img-thumbnail img-fluid" id="fotoPreview" style="height: 10rem;"/>
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
                <input type="textarea" class="form-control is-invalid" name="nombre" id="nombre" placeholder="Nombre..." required>
            </div>
            <!--Text para la raza de la mascota-->
            <div class="col-md-4">
                <input type="text" class="form-control is-invalid" name="raza" id="raza" placeholder="Raza..." required>
            </div>
            <!--Text para el color de la mascota-->
            <div class="col-md-4">
                <input type="text" class="form-control is-invalid" name="color" id="color" placeholder="Color..." required>
            </div>
        </div>
        <div class="form-group row">
            <div class="col-md-4">
                <input type="text" class="form-control is-invalid" name="especie" id="especie" placeholder="Especie..." required>
            </div>
            <div class="col-sm-1 text-center">
                <label for="fecha_consulta">Consulta:</label>
            </div>
            <div class="col-md-7">
                <input type="date" class="form-control is-invalid" name="fecha_consulta" id="fecha_consulta" required>
            </div>
        </div>
        <div>
            <label for="observaciones"><strong>Observaciones:</strong></label>
            <textarea class="form-control is-invalid" name="observaciones" id="observaciones" required></textarea>
        </div><br>
        <div class="form-group row">
            <!--Radio para el sexo de la mascota-->
            <legend class="col-form-label col-sm-2 pt-0"><strong>Sexo:</strong></legend>
            <div class="col-md-2 border-bottom-primary">
                <div class="form-check">
                    <input class="form-check-input" type="radio" name="sexo" id="sexo" value="M" checked>
                    <label class="form-check-label" for="sexo">
                        Macho
                    </label>
                    </div>
                <div class="form-check">
                    <input class="form-check-input" type="radio" name="sexo" id="sexo" value="H">
                    <label class="form-check-label" for="sexo">
                        Hembra
                    </label>
                </div>
            </div>
            <legend class="col-form-label col-sm-1 pt-0"><strong>Dueño:</strong></legend>
            <div class="col-md-4">
                <select id="owner_id" name="owner_id" class="form-select form-select-lg mb-3 align-self-cente" aria-label=".form-select-lg example">
                    <option selected>Seleccione al dueño de la mascota...</option>
                    @foreach ($owners as $owner)
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