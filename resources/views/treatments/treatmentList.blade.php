@extends('layouts.sbadmin')
@section('content')

<script>document.title = "Tratamientos | Dr. treatment";</script>

<script src="{{asset('libs/jquery/jquery.min.js')}}"></script>
<link rel="stylesheet" type="text/css" href="{{ asset('libs/datatables/dataTables.bootstrap4.min.css') }}">

<div class="card-shadow mb-4">
    <div class="card-header py-3">
        <h3 class="m-0 font-weight-bold text-primary">Lista de tratamientos</h3>
    </div>
    @foreach ($errors->all() as $error)
        <div class="alert alert-danger">{{ $error }}</div>
    @endforeach
<div class="card-body">
    <div class="table-responsive">
        <table id="table" class="table table-striped table-bordered" style="width:100%">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nombre</th>
                    <th>Dósis</th>
                    <th>Fecha caducidad</th>
                    <th>Tipo</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($treatments as $treatment)
                <tr>
                    <td>{{ $treatment->id }}</td>
                    <td>
                        <a class="btn btn-light" href="{{ route('treatment.show',$treatment) }}">
                            {{ $treatment->nombre }}
                        </a>
                    </td>
                    <td>{{ $treatment->dosis }} ml/mg</td>
                    <td>{{ $treatment->fecha_caducidad }}</td>
                    <td>{{ $treatment->tipo }}</td>
                    <td class="text-center">
                        <!--Boton de editar-->
                        <a class="btn btn-circle btn-warning" href="{{ route('treatment.edit', $treatment) }}">
                            <i class="fas fa-edit"></i>
                        </a>
                        <!--Boton de eliminar-->
                        <a class="btn btn-circle btn-danger" href="#" data-toggle="modal" data-target="#deleteTreatmentModal{{$treatment->id}}">
                            <i class="fas fa-trash"></i>
                        </a>
                        <!--Modal para borrar registro-->
                        <div class="modal fade" id="deleteTreatmentModal{{$treatment->id}}" tabindex="-1" role="dialog"  aria-hidden="true">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLabel">¿Seguro que quiere eliminar el {{$treatment->nombre}}?</h5>
                                        <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">×</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">Ingrese la contraseña de su usuario para eliminarlo.
                                        @if(isset($treatment))
                                            <form method="POST" action="{{ route('treatment.destroy',$treatment) }}">
                                                @csrf
                                                @method('DELETE')
                                                <input id="password" class="form-control" type="password" name="password" required autofocus />
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
            <tfoot>
                <tr>
                    <th>ID</th>
                    <th>Nombre</th>
                    <th>Dósis</th>
                    <th>Fecha caducidad</th>
                    <th>Tipo</th>
                    <th>Acciones</th>
                </tr>
            </tfoot>
        </table>
    </div>
</div>
</div>

@endsection