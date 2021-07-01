@section('product-form')

<div>
    <h3>Datos del Producto</h3>
    <hr>
    @if (isset($product))
    <form class="form" method="POST" action="{{ route('product.update',$product) }}">
        @method('PATCH')
    @else
    <form class="form" method="POST" action="{{ route('product.store') }}">
    @endif
        @csrf
        <!--Input para el nombre del producto -->
        <div class="form-group row">
            <div class="col-md-6">
                <input
                    type="textarea"
                    class="form-control @error('nombre') is-invalid @enderror"
                    name="nombre"
                    id="nombre"
                    placeholder="Nombre..."
                    @if (isset($product))
                    value="{{ $product->nombre }}"
                    @else
                    value="{{old('nombre')}}"
                    @endif
                required>
                @error('nombre')
                <div class="invalid-feedback">{{$message}}</div>
                @enderror
            </div>
            <!--Text para el precio de compra del producto-->
            <div class="col-md-6">
                <input
                    type="number"
                    class="form-control @error('precio_compra') is-invalid @enderror"
                    name="precio_compra"
                    id="precio_compra"
                    placeholder="Precio-compra..."
                    @if (isset($product))
                    value="{{ $product->precio_compra}}"
                    @else
                    value="{{old('precio_compra')}}"
                    @endif
                required>
                @error('precio_compra')
                <div class="invalid-feedback">{{$message}}</div>
                @enderror
            </div>

        </div>

        <div class="form-group row">
             <!--Text para el color de la mascota-->
             <div class="col-md-6">
                <input
                    type="number"
                    class="form-control @error('precio_venta') is-invalid @enderror"
                    name="precio_venta"
                    id="precio_venta"
                    placeholder="Precio-venta..."
                    @if (isset($product))
                    value="{{ $product->precio_venta}}"
                    @else
                    value="{{old('precio_venta')}}"
                    @endif
                required>
                @error('precio_venta')
                <div class="invalid-feedback">{{$message}}</div>
                @enderror
            </div>
            <div class="col-sm-1 text-center">
                <label for="existencias">Existencias:</label>
            </div>
            <div class="col-md-4">
                <input type="number" min="1" id="existencias" name="existencias" class="form-control" required>
                @error('existencias')
                <div class="alert alert-danger">{{$message}}</div>
                @enderror
            </div>
        </div>
        <div class="text-left">
            <button type="submit" class="btn btn-success">
                <i class="fas fa-save"></i>
                Guardar
            </button>
        </div>

    </form>
</div>
@endsection
