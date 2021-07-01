@section('owner-form')

<!--Script para mostrar u ocultar el formulario del duenio-->
<script>
    function hideForm(){
        if (document.getElementById('ownerForm').style.display === "none"){
            document.getElementById('ownerForm').style.display="block";
            document.getElementById('btnTextOwner').textContent="Omitir registro del dueño";
        }else{
            document.getElementById('ownerForm').style.display="none";
            document.getElementById('btnTextOwner').textContent="Mostrar registro del dueño";
        }
    }
</script>

<!--Formulario del duenio-->
<div id="ownerForm">
    @if (isset($owner))
    <form class="form" method="POST" action="{{ url('/owner/'.$owner->id.'/'.$pet->id) }}">
        @method('PATCH')
    @else
    <form class="form" method="POST" action="{{ url('/owner') }}">
    @endif
        <h3>Datos del dueño</h3>
        <hr>
        @csrf
        @if (isset($pet))
        <input type="hidden" name="pet_id" value="{{ $pet->id }}">
        @else
        <input type="hidden" name="pet_id" value="0">
        @endif

        <div class="form-group row">
            <div class="col-md-8">
                <input
                    type="text"
                    class="form-control @error('nombre') is-invalid @enderror"
                    id="nombre"
                    name="nombre"
                    placeholder="Nombre..."
                    @if(isset($owner))
                    value="{{$owner->nombre}}"
                    @else
                    value="{{old('nombre')}}"
                    @endif
                required>
                @error('nombre')
                <div class="invalid-feedback">{{$message}}</div>
                @enderror
            </div>
            <div class="col-md-4">
                <input
                    type="text"
                    class="form-control @error('telefono') is-invalid @enderror"
                    id="telefono"
                    name="telefono"
                    placeholder="Teléfono..."
                    @if(isset($owner))
                    value="{{$owner->telefono}}"
                    @else
                    value="{{old('telefono')}}"
                    @endif
                required>
                @error('telefono')
                <div class="invalid-feedback">{{$message}}</div>
                @enderror
            </div>
        </div>
        <div class="form-group row">
            <div class="col-md-6">
                <input
                    type="text"
                    class="form-control @error('correo') is-invalid @enderror"
                    id="correo"
                    name="correo"
                    placeholder="correo@ejemplo.com..."
                    @if(isset($owner))
                    value="{{$owner->correo}}"
                    @else
                    value="{{old('correo')}}"
                    @endif
                required>
                @error('correo')
                <div class="invalid-feedback">{{$message}}</div>
                @enderror
            </div>
            <div class="col-md-6">
                <input
                    type="text"
                    class="form-control @error('direccion') is-invalid @enderror"
                    id="direccion"
                    name="direccion"
                    placeholder="Dirección..."
                    @if(isset($owner))
                    value="{{$owner->direccion}}"
                    @else
                    value="{{old('direccion')}}"
                    @endif
                required>
                @error('direccion')
                <div class="invalid-feedback">{{$message}}</div>
                @enderror
            </div>
        </div>
        <hr>
        <div class="btn-toolbar mb-3">
            <div class="btn-group mr-2">
                <button type="submit" class="btn btn-success btn-icon-split">
                    <span class="icon"><i class="fas fa-save"></i></span>
                    <span class="text">Guardar</span>
                </button>
            </div>
        </div>
    </form>
</div>

<!--Informacion del duenio-->
<div class="btn-group me-2">
    <button
        type="button"
        class="btn btn-icon-split btn-info"
        data-toggle="tooltip"
        data-placement="bottom"
        title="Si usted ya ha registrado previamente al dueño, omita el registro"
        id="buttonForm" onclick="hideForm()">
        <span class="icon"><i class="fas fa-arrow-circle-right"></i></span>
        <span id="btnTextOwner" class="text">Omitir registro del dueño</span>
    </button>
</div>
@endsection
