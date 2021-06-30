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
<button type="submit" class="btn btn-info" id="buttonForm" onclick="hideForm()">
    <i class="fas fa-info"></i>
    Omitir registro
</button>
<!--Formulario del duenio-->
<div id="ownerForm">
    <hr>
    @if (isset($owner))
    <form class="was-validated" method="POST" action="{{ url('/owner/{owner}',$owner) }}">
        @method('PATCH')
    @else
    <form class="was-validated" method="POST" action="{{ url('/owner') }}">    
    @endif
        <h3>Datos del dueño</h3>
        <hr>
        @csrf
        <div class="form-group row">
            <div class="col-md-8">
                <input 
                    type="text" 
                    class="form-control is-invalid"
                    id="nombre" 
                    name="nombre" 
                    placeholder="Nombre..."
                    value="{{$owner->nombre}}" 
                required>
            </div>
            <div class="col-md-4">
                <input 
                    type="text" 
                    class="form-control is-invalid"
                    id="telefono" 
                    name="telefono" 
                    placeholder="Teléfono..." 
                    value="{{$owner->telefono}}"
                required>
            </div>
        </div>
        <div class="form-group row">
            <div class="col-md-6">
                <input 
                    type="text" 
                    class="form-control is-invalid" 
                    id="correo" 
                    name="correo" 
                    placeholder="correo@ejemplo.com..." 
                    value="{{$owner->correo}}"
                required>
            </div>
            <div class="col-md-6">
                <input 
                    type="text" 
                    class="form-control is-invalid" 
                    id="direccion" 
                    name="direccion" 
                    placeholder="Dirección..." 
                    value="{{$owner->direccion}}"
                required>
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