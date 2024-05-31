@extends('master')

@section('titulo', 'Editar Rol')

@section('contenido')
<br>
<br>
<br>
<br>
<div class="container">
<h1>Editar Roles</h1>
@if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
            <li>{{$error}}</li>
            @endforeach
        </ul>
    </div>
@endif

<div>
  <div class="modal-dialog">
    <div class="modal-content bg-body-secondary border border-0 shadow rounded bg-dark">
      <div class="modal-header">
        <h5 class="modal-title text-black">Crear roles</h5>
        </div>
        {!! Form::model($role, ['method' => 'PATCH','route' => ['roles.update', $role->id]]) !!}
        <div class="modal-body">
        <div class="form-group">
        {!!form::text('name',null, array(
            'class'=>'form-control',
            'required' => 'required',
            'placeholder' => 'Nombre del Rol..' 
        ))
        !!}
        </div>
        <div class="form-group text-black">
        {!! Form::label('permisos', 'Permisos del Rol:') !!}
        @foreach($permission as $value)
        <label class="text-black">
          {{ Form::checkbox('permission[]', $value->id, in_array($value->id, $rolePermissions)  ? true : false, array('class' => 'name')) }}
            {{ $value->name}}
        </label>
        @endforeach
        </div>
        </div>
        <div class="modal-footer">
        {!! Form::submit('Guardar Rol', array('class'=>'btn btn-primary'))!!}
        {!! Form::close()!!}
        <hr>    
        </div>
    </div>
  </div>
</div>
</div>
@endsection
