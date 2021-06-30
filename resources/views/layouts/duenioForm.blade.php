@section('duenio-form')

<script>
    function hideForm(){
        if (document.getElementById('ownerForm').style.display === "none"){
            document.getElementById('ownerForm').style.display="block";
            document.getElementById('buttonForm').textContent="Omitir registro";
        }else{
            document.getElementById('ownerForm').style.display="none";
            document.getElementById('buttonForm').textContent="Mostrar registro";
        }
    }
</script>

<!--Informacion del duenio-->
<button 
    type="button" 
    class="btn btn-info" 
    data-toggle="tooltip" 
    data-placement="bottom" 
    title="Si usted ya ha registrado previamente al dueño, omita el registro" 
    id="buttonForm" onclick="hideForm()">
    Omitir registro del dueño
</button>

<!--Formulario del duenio-->
<div id="ownerForm">
    <hr>
    @if (isset($owner))
    <form class="form" method="POST" action="{{ url('/owner/'.$owner->id.'/'.$pet->id) }}">
        @method('PATCH')
    @else
    <form class="form" method="POST" action="{{ url('/owner') }}">
    @endif
        <h3>Datos del dueño</h3>
        <hr>
        @csrf
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
        <button type="submit" class="btn btn-success">
            <i class="fas fa-save"></i>
            Guardar
        </button>
    </form>
</div>
@endsection
