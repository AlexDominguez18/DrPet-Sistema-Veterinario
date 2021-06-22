@extends('layouts.admin')
@section('content')
<script>
    document.title = "Agregar mascota | Dr. Pet";
</script>
<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">Agregar mascota</h1>
</div>
<hr>
<div>
    <form class="was-validated" action="{{ route('pet.store') }}" enctype="multipart/form-data">
        <h3>Datos de la mascota</h3>
        <hr>
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
                <input type="textarea" class="form-control is-invalid"
                    id="nombre" placeholder="Nombre..." required>
            </div>
            <!--Text para la raza de la mascota-->
            <div class="col-md-4">
                <input type="text" class="form-control is-invalid"
                    id="raza" placeholder="Raza..." required>
            </div>
            <!--Text para el color de la mascota-->
            <div class="col-md-4">
                <input type="text" class="form-control is-invalid"
                    id="color" placeholder="Color..." required>
            </div>
        </div>
        <div class="form-group row">
            <div class="col-md-4">
                <input type="text" class="form-control is-invalid"
                    id="especie" placeholder="Especie..." required>
            </div>
            <div class="col-sm-1 text-center">
                <label for="fecha_consulta">Consulta:</label>
            </div>
            <div class="col-md-7">
                <input type="date" class="form-control is-invalid" id="fecha_consulta" required>
            </div>
        </div>
        <div>
            <label for="observaciones"><strong>Observaciones:</strong></label>
            <textarea class="form-control is-invalid" id="observaciones" required></textarea>
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
            <!--Adoptable falso porque es mascota con duenio-->
            <input type="hidden" value="false" id="adoptable">
            <!--CheckBox para las vacunas de la mascota-->
            <legend class="col-form-label col-sm-2 pt-0"><strong>Vacunas:</strong></legend>
            <div class="col-md-2 border-bottom-primary">
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" name="vacunas" id="vacunas">
                    <label class="form-check-label" for="vacunas">Ninguna</label>
                </div>
            </div>
            <!--CheckBox para las medicinas de la mascota-->
            <legend class="col-form-label col-sm-2 pt-0"><strong>Medicinas:</strong></legend>
            <div class="col-md-2 border-bottom-primary">
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" name="medicinas" id="medicinas">
                    <label class="form-check-label" for="medicinas">Ninguna</label>
                </div>
            </div>
        </div>
        <!--Informacion del duenio-->
        <hr>
        <h3>Datos del dueño</h3>
        <hr>
        <div class="form-group row">
            <div class="col-md-8">
                <input type="text" class="form-control is-invalid"
                    id="nombre_duenio"  placeholder="Nombre..." required>
            </div>
            <div class="col-md-4">
                <input type="text" class="form-control is-invalid"
                    id="telefono" placeholder="Teléfono..." required>
            </div>
        </div>
        <div class="form-group row">
            <div class="col-md-6">
                <input type="text" class="form-control is-invalid" 
                    id="correo" placeholder="correo@ejemplo.com..." required>
            </div>
            <div class="col-md-6">
                <input type="text" class="form-control is-invalid" 
                    id="direccion" placeholder="Dirección..." required>
            </div>
        </div>
        <hr>
        <button type="submit" class="btn btn-success">
            <i class="fas fa-save"></i>
            Guardar
        </button>
    </form>
</div>
@endsection