@section('treatment-form')

<div>
    <h3>Información del tratamiento</h3>
    <hr>
    @if (isset($treatment))
    <form class="form" method="POST" action="{{ route('treatment.update',$treatment) }}">     
        @method('PATCH')
    @else
    <form class="form" method="POST" action="{{ route('treatment.store') }}">
    @endif
        @csrf
        <!--Input para el nombre del tratamiento -->
        <div class="form-group">
            <div>
                <input
                    type="textarea"
                    class="form-control @error('nombre') is-invalid @enderror"
                    name="nombre"
                    id="nombre"
                    placeholder="Nombre..."
                    @if (isset($treatment))
                    value="{{ $treatment->nombre }}"
                    @else
                    value="{{old('nombre')}}"
                    @endif
                required>
                @error('nombre')
                <div class="invalid-feedback">{{$message}}</div>
                @enderror
            </div>
        </div>
        <div class="form-group row">
            <!--Number para la dosis del tratamiento-->
            <div class="col">
                <div class="input-group mb-2">
                    <div>
                        <input
                            type="number"
                            step=".01"
                            class="form-control @error('dosis') is-invalid @enderror"
                            name="dosis"
                            id="dosis"
                            placeholder="Dosis..."
                            @if (isset($treatment))
                            value="{{ $treatment->dosis}}"
                            @else
                            value="{{old('dosis')}}"
                            @endif
                        required>
                    </div>
                    <div class="input-group-prepend">
                        <div class="input-group-text">ml/mg</div>
                    </div>
                    @error('dosis')
                    <div class="invalid-feedback">{{$message}}</div>
                    @enderror
                </div>
            </div>
            <!--Date para la fecha de caducidad del tratamiento-->
            <div class="form-group row col-md-8">
                <div class="col-sm-w">
                    <label for="fecha_caducidad">Caducidad:</label>
                </div>
                <div class="col auto">
                    <input
                        type="date"
                        class="form-control @error('fecha_caducidad') is-invalid @enderror"
                        name="fecha_caducidad"
                        id="fecha_caducidad"
                        @if (isset($treatment))
                        value="{{ $treatment->fecha_caducidad}}"
                        @else
                        value="{{old('fecha_caducidad')}}"
                        @endif
                    required>
                    @error('fecha_caducidad')
                    <div class="invalid-feedback">{{$message}}</div>
                    @enderror
                </div>
            </div>
        </div>
        <!--Select para checar el tipo de tratamiento-->
        <div class="form-group">
            <select id="tipo" name="tipo" class="form-control" required>
                <option value="ninguno" selected>Ninguno...</option>
                @if (isset($treatment))
                    @if ($treatment->tipo === "medicina")
                    <option value="medicina" selected>Medicina</option>
                    <option value="vacuna">Vacuna</option>
                    @else
                    <option value="vacuna" selected>Vacuna</option>
                    <option value="medicina">Medicina</option>
                    @endif
                @else
                <option value="medicina">Medicina</option>
                <option value="vacuna">Vacuna</option>
                @endif  
            </select>
            @error('tipo')
            <div class="alert alert-danger">{{$message}}</div>
            @enderror
        </div>
        <button type="submit" class="btn btn-success btn-icon-split">
            <span class="icon"><i class="fas fa-save"></i></span>
            <span class="text">Guardar</span>
        </button>
    </form>
</div>

@endsection