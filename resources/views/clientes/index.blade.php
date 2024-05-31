@extends('master')
@section('titulo', 'Listado de clientes')
@section('contenido')
<br>
<br>
<br>
<br>

@if(($message = Session::get('mensaje')))
<script>
    Swal.fire({
         title: "Mensaje",
         text: "{{$message}}",
         icon: "success"
         });
</script>
@endif

<script>
    document.addEventListener('DOMContentLoaded', function () {
        document.querySelectorAll('.delete-button').forEach(button => {
            button.addEventListener('click', function () {
                let clientId = this.getAttribute('data-id');
                Swal.fire({
                    title: "¿Estás seguro?",
                    text: "¡No podrás revertir esto!",
                    icon: "warning",
                    showCancelButton: true,
                    confirmButtonColor: "#3085d6",
                    cancelButtonColor: "#d33",
                    confirmButtonText: "¡Sí, elimínalo!"
                }).then((result) => {
                    if (result.isConfirmed) {
                        document.getElementById('delete-form-' + clientId).submit();
                        Swal.fire({
                        title: "Eliminado!",
                        text: "El registro a sido eliminado.",
                        icon: "success"
                        });
                    }
                });
            });
        });
    });
</script>

<div class="container">
    <h1 class="text-center text-secondary-emphasis">Listado de Clientes</h1>
    <div class="container">
        {!!Form::open(['route'=>'clientes.index','method'=>'GET','class'=>'navbar-from'])!!}
        <div class="row">
            <div class="col-6">
                <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal"  @cannot('crear-clientes') disabled @endcannot>
                    Crear Nuevo Cliente
                </button>
            </div>
            <div class="col-4">
                {!!Form::text('nombre',null,['class'=>'form-control','id'=>'nombre','placeholder'=>'Buscar Cliente'])!!}
            </div>
            <div class="col-1">
                {!!Form::submit ('Buscar Cliente',array('class'=>'btn btn-secondary'))!!}
            </div>
        </div>
        {!!Form::close()!!}
    </div>
    @can('ver-clientes')
    <table class="table table-dark">
        <thead>
            <tr>
                <th scope="col">Actualizar</th>
                <th scope="col">Eliminar</th>
                <th scope="col">Id</th>
                <th scope="col">Nombre</th>
                <th scope="col">Rfc</th>
                <th scope="col">Direccion</th>
                <th scope="col">Telefono</th>
                <th scope="col">Email</th>
            </tr>
        </thead>

        <tbody>

            @foreach($clientes as $cliente)
            <tr>
                <td>
                    <a class="btn btn-warning @cannot('editar-clientes') disabled @endcannot" 
                        href="@can('editar-clientes') {{ route('clientes.edit', $cliente->id) }} @else # @endcan">
                        <i class="bi bi-pencil-square"></i>
                    </a>
                </td>
                <td>
                    {!! Form::open(['route' => ['clientes.destroy', $cliente->id],'id' => 'delete-form-'.$cliente->id]) !!}
                    <input type="hidden" name="_method" value="DELETE">
                    <button type="button" class="btn btn-danger delete-button"  data-id="{{ $cliente->id }}"  @cannot('borrar-clientes') disabled @endcannot>
                        <i class="bi bi-trash"></i>
                    </button>
                    {!! Form::close() !!}
                </td>
                <td>{{$cliente->id}}</td>
                <td>{{$cliente->nombre}}</td>
                <td>{{$cliente->rfc}}</td>
                <td>{{$cliente->direccion}}</td>
                <td>{{$cliente->telefono}}</td>
                <td>{{$cliente->email}}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
    {{ $clientes->links() }}
    @endcan
    <br>
</div>
@endsection
@include('clientes.crear')