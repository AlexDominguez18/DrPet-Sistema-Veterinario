@section('user-form')

<script src="{{asset('libs/jquery/jquery.min.js')}}"></script>
<script>
    function hideForm(){
        if (document.getElementById('passwordFields').style.display === "none"){
            document.getElementById('passwordFields').style.display="block";
            document.getElementById('buttonUserForm').textContent="No cambiar contraseña";
        }else{
            document.getElementById('passwordFields').style.display="none";
            document.getElementById('buttonUserForm').textContent="Cambiar contraseña";
        }
    }
    function showPasswordFields(){
        document.getElementById('passwordFields').style.display = "block"; 
        document.getElementById('buttonUserForm').textContent = "No cambiar contraseña";
    }
</script>

<div>
    <h3>Datos del usuario</h3>
    <hr>
    @if (isset($user))
    <form  method="POST" action="{{ route('user.update',$user) }}">
        @method('PATCH')
    @else    
    <form  method="POST" action="{{ route('user.store') }}">
    @endif

        @csrf
        <!--Input de texto para el nombre-->
        <div class="form-group">
            <label for="name" class="form" value="Nombre">Nombre</label>
            <input 
                class="form-control"
                type="text" 
                id="name" 
                name="name" 
                @if (isset($user))
                value="{{ $user->name }}"
                @else
                value="{{ old('name') }}"
                @endif
            required>
            @error('name')
            <div class="alert alert-danger">{{ $message }}</div>
            @enderror
        </div>
        <!--Input de texto para el correo-->
        <div class="form-group">
            <label for="email" class="form" value="Email">Correo</label>
            <input 
                class="form-control"
                type="text" 
                id="email" 
                name="email" 
                @if (isset($user))
                value="{{ $user->email }}"
                @else
                value="{{ old('email') }}"
                @endif
            required>
            @error('email')
            <div class="alert alert-danger">{{ $message }}</div>
            @enderror
        </div>
        <!--Checkbox para el tipo de usuario-->
        <div class="form-group row">
            <legend class="col-form-label col-sm-2"><strong>Tipo:</strong></legend>
            <div class="col-md-2 border-bottom-primary">
                <div class="form-check">
                    @if (isset($user))
                        @if ($user->admin === 1)
                        <input class="form-check-input" type="radio" name="admin" id="admin" value="1" chekced>   
                        @else
                        <input class="form-check-input" type="radio" name="admin" id="admin" value="1">
                        @endif    
                    @else
                    <input class="form-check-input" type="radio" name="admin" id="admin" value="1" checked>
                    @endif
                    <label class="form-check-label" for="admin">
                    Administrador
                    </label>
                </div>
                <div class="form-check">
                    @if (isset($user))
                        @if ($user->admin === 0)
                        <input class="form-check-input" type="radio" name="admin" id="empleado" value="0" checked>
                        @else
                        <input class="form-check-input" type="radio" name="admin" id="empleado" value="0">
                        @endif
                    @else
                    <input class="form-check-input" type="radio" name="admin" id="empleado" value="0">
                    @endif
                    <label class="form-check-label" for="empleado">
                    Empleado
                    </label>
                </div>
            </div>
        </div>
         <!--Boton para cambiar contrasenia-->
        @if (isset($user))
        <hr>
        <button
            type="button"
            class="btn btn-info"
            data-toggle="tooltip"
            data-placement="bottom"
            title="Actualice la contraseña del usuario"
            id="buttonUserForm" onclick="hideForm()">
            Cambiar contraseña
        </button>
        @error('password')
        <script>
            $(document).ready(function(){
                showPasswordFields();
            });
        </script>
        @enderror
        <hr>
        @endif
        <div id="passwordFields" @if(isset($user)) style="display:none;" @endif>
            <!--Input de la contrasenia-->
            <div class="form-group">
                <label for="password" class="form" value="Contraseña">Contraseña</label>
                <input 
                    class="form-control"
                    type="password" 
                    id="password" 
                    name="password" 
                @if(isset($user)) @else required @endif>
            </div>
            <!--Input de la contrasenia-->
            <div class="form-group">
                <label for="confirm_password" class="form" value="Confirmar contraseña">Confirmar contraseña</label>
                <input 
                    class="form-control"
                    type="password" 
                    id="confirm_password" 
                    name="confirm_password" 
                @if(isset($user)) @else required @endif>
                @error('password')
                <div class="alert alert-danger">{{ $message }}</div>
                @enderror
            </div>
        </div>
        <button type="submit" class="btn btn-success">
            <i class="fas fa-save"></i>
            <span>Guardar</span>
        </button>
    </form>
</div>
@endsection