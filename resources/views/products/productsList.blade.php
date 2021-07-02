@extends('layouts.sbadmin')
@section('content')

<script>
    document.title = "Mascotas | Dr. Pet";
</script>

<script src="{{asset('libs/jquery/jquery.min.js')}}"></script>
<link rel="stylesheet" type="text/css" href="{{ asset('libs/datatables/dataTables.bootstrap4.min.css') }}">

@if(session()->has('message'))
<div class="alert alert-success">
    {{ session()->get('message') }}
</div>
@endif

<div class="card-shadow mb-4">
    <div class="card-header py-3">
        <h3 class="m-0 font-weight-bold text-primary">Lista de productos</h3>
    </div>
<div class="card-body">
    <div class="table-responsive">
        <table id="table" class="table table-striped table-bordered" style="width:100%">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nombre</th>
                    <th>Precio Compra</th>
                    <th>Precio Venta</th>
                    <th>Existencias</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($products as $product)
                <tr>
                    <td>{{ $product->id }}</td>
                    <td>{{ $product->nombre }}</td>
                    <td>$ {{ $product->precio_compra }} mxn</td>
                    <td>$ {{ $product->precio_venta }} mxn</td>
                    <td>{{ $product->existencias }} unidades</td>
                    <td class="text-center">
                        <!--Boton de editar-->
                        <a class="btn btn-circle btn-warning" href="{{ route('product.edit', $product) }}">
                            <i class="fas fa-edit"></i>
                        </a>
                        <!--Boton de eliminar-->
                        <a class="btn btn-circle btn-danger" href="#" data-toggle="modal" data-target="#deleteProductModal{{$product->id}}">
                            <i class="fas fa-trash"></i>
                        </a>
                        <!--Modal para borrar registro-->
                        <div class="modal fade" id="deleteProductModal{{$product->id}}" tabindex="-1" role="dialog"  aria-hidden="true">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLabel">¿Seguro que quiere eliminar a {{$product->nombre}}?</h5>
                                        <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">×</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">Ingrese la contraseña de su usuario para borrarlo.
                                        @if(isset($product))
                                            <form method="POST" action="{{ route('product.destroy',$product) }}">
                                                @csrf
                                                @method('DELETE')
                                                <input id="password" class="form-control" type="password" name="password" required autofocus />
                                                @foreach ($errors->all() as $error)
                                                    <p class="text-danger">{{ $error }}</p>
                                                @endforeach
                                                <div class="modal-footer">
                                                    <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancelar</button>
                                                    <button class="btn btn-primary" type="submit">Confirmar</button>
                                                </div>
                                            </form>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
</div>



@if($errors->any())
    <script>
        $(document).ready(function(){
            $("#deleteModal").modal('show');
        });
    </script>
@endif

@endsection
