@extends('master')

@section('titulo', 'Listado de Facturas')

@section('contenido')
<br>
<br>
<br>
<br>

<div class="container">
    <h1 class="text-center text-secondary-emphasis">Listado de Roles</h1>
   
    <div class="container">
    {!!Form::open(['route'=>'roles.index','method'=>'GET','class'=>'navbar-from'])!!}
    <div class="row">
    <div class="col-6">
    @can('crear-rol')
    <a class="btn btn-primary" href="{{Route('roles.create')}}">Crear Nuevo Rol</a>
    @endcan
    </div>
    <div class="col-4">
    {!!Form::text('nombre',null,['class'=>'form-control','id'=>'nombre','placeholder'=>'Buscar Rol'])!!}
    </div>
    <div class="col-1">
    {!!Form::submit ('Buscar Rol',array('class'=>'btn btn-secondary'))!!}
    </div>
    </div>
    {!!Form::close()!!}
    </div>
    <br>

    <table class="table table-sucess table-striped">
        <thead>
            <tr>
                <th>Rol</th>
                <th>Acciones</th>
                <th>Nombre</th>
            </tr>
        </thead>
        <tbody>
            @foreach($roles as $role)
            <tr>
                <td>
                    @can('editar-rol')
                    <a class="btn btn-warning" href="{{ route('roles.edit', $role->id) }}">
                        <i class="bi bi-pencil-square"></i>
                    </a>
                    @endcan
                </td>
                <td>
                    
                    {!! Form::open(['route' => ['roles.destroy', $role->id],'id' => 'delete-form-'.$role->id, ]) !!}
                    <input type="hidden" name="_method" value="DELETE">
                        <button  type="button" class="btn btn-danger delete-button"  data-id="{{ $role->id }}" @cannot('borrar-rol') disabled @endcannot>
                            <i class="bi bi-trash"></i>
                        </button>
                    {!! Form::close() !!}
                    
                </td>
                <td>{{ $role->name }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
    {{$roles->links()}}
    <br>
</div>
@include('mensajes.validaciones')
@endsection
