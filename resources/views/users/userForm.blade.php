@section('user-form')

<form method="POST" action="{{ route('user.store') }}">
    @csrf

    <!--Input de texto para el nombre-->
    <div class="form-group">
        <label for="name" class="form" value="Nombre">Nombre</label>
        <input 
            class="form-control"
            type="text" 
            id="name" 
            name="name" 
        required>
    </div>
    <!--Input de texto para el correo-->
    <div class="form-group">
        <label for="email" class="form" value="Email">Correo</label>
        <input 
            class="form-control"
            type="text" 
            id="email" 
            name="email" 
        required>
    </div>
    <!--Input de la contrasenia-->
    <div class="form-group">
        <label for="password" class="form" value="Contraseña">Contraseña</label>
        <input 
            class="form-control"
            type="password" 
            id="password" 
            name="password" 
        required>
    </div>
    <!--Input de la contrasenia-->
    <div class="form-group">
        <label for="confirm_password" class="form" value="Confirmar contraseña">Confirmar contraseña</label>
        <input 
            class="form-control"
            type="password" 
            id="confirm_password" 
            name="confirm_password" 
        required>
    </div>
    <!--Checkbox para el tipo de usuario-->
    <div class="form-group row">
        <legend class="col-form-label col-sm-2"><strong>Tipo:</strong></legend>
        <div class="col-md-2 border-bottom-primary">
            <div class="form-check">
                <input class="form-check-input" type="radio" name="admin" id="admin" value="1" checked>
                <label class="form-check-label" for="admin">
                Administrador
                </label>
            </div>
            <div class="form-check">
                <input class="form-check-input" type="radio" name="admin" id="empleado" value="0">
                <label class="form-check-label" for="empleado">
                Empleado
                </label>
            </div>
        </div>
    </div>
    <button type="submit" class="btn btn-success">
        <i class="fas fa-save"></i>
        <span>Guardar</span>
    </button>
</form>
@endsection