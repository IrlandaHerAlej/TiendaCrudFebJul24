@extends('master')

@section('titulo', 'Listado de Facturas')

@section('contenido')
<br>
<br>
<br>
<br>

<div class="container">
    <h1 class="text-center text-secondary-emphasis">Listado de Usuarios</h1>
   
    <div class="container">
    {!!Form::open(['route'=>'usuarios.index','method'=>'GET','class'=>'navbar-from'])!!}
    <div class="row">
    <div class="col-6">
    @can('borrar-usuarios')
    <a class="btn btn-primary" href="{{Route('usuarios.create')}}">Crear Nuevo Usuario</a>
    @endcan
    </div>
    <div class="col-4">
    {!!Form::text('nombre',null,['class'=>'form-control','id'=>'nombre','placeholder'=>'Buscar Usuario'])!!}
    </div>
    <div class="col-1">
    {!!Form::submit ('Buscar Usuario',array('class'=>'btn btn-secondary'))!!}
    </div>
    </div>
    {!!Form::close()!!}
    </div>
    <br>
  
    <table class="table table-dark table-striped" @cannot('ver-usuarios') disabled @endcannot>
        <thead>
            <tr>
                <th>Actualizar</th>
                <th>Eliminar</th>
                <th>ID</th>
                <th>Nombre</th>
                <th>E-mail</th>
                <th>Rol</th>
            </tr>
        </thead>
        <tbody>
            @foreach($usuarios as $usuario)
            <tr>
                <td>
                @can('editar-usuarios')
                    <a class="btn btn-warning" href="{{ route('usuarios.edit', $usuario->id) }}">
                        <i class="bi bi-pencil-square"></i>
                    </a>
                @endcan
                </td>
                <td>
                @can('borrar-usuarios')
                    {!! Form::open(['route' => ['usuarios.destroy', $usuario->id],'id' => 'delete-form-'.$usuario->id, ]) !!}
                    <input type="hidden" name="_method" value="DELETE">
                        <button  type="button" class="btn btn-danger delete-button"  data-id="{{ $usuario->id }}">
                            <i class="bi bi-trash"></i>
                        </button>
                    {!! Form::close() !!}
                @endcan
                </td>
                <td>{{ $usuario->id }}</td>
                <td>{{ $usuario->name}}</td>
                <td>{{ $usuario->email}}</td>
                <td>
                    @if(!empty($usuario->getRoleNames()))
                        @foreach($usuario->getRoleNames() as $rolNombre)                                       
                            <h5><span class="badge badge-dark">{{ $rolNombre }}</span></h5>
                        @endforeach
                    @endif
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
   
    {{ $usuarios->links() }}
    <br>
</div>
@include('mensajes.validaciones')
@endsection