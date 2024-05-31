@extends('master')

@section('titulo','Listado de Facturas')

@section('contenido')

<div class="container text-center"></div>
<h2 class="text-center">Editar User</h2>
@if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
            <li>{{$error}}</li>
            @endforeach
        </ul>
    </div>
@endif

{!! Form::model($user, ['route' => ['usuarios.update', $user->id], 'method' => 'PUT', 'files' => true]) !!}
<div class="">
  <div class="modal-dialog">
    <div class="modal-content bg-body-secondary border border-0 shadow rounded bg-dark">
      <div class="modal-header">
        <h5 class="modal-title text-black">Editar usuarios</h5>
        </div>
      <div class="modal-body">
         <div class="form-group">
            {!! Form::label('nombre', 'Nombre del Usuario:') !!}
            {!! Form::text('name', null, ['class' => 'form-control', 'required' => 'required', 'placeholder' => 'Nombre del Usuario...']) !!}
        </div>
        <div class="form-group">
            {!! Form::label('email', 'correo electronico:') !!}
            {!! Form::text('email', null, ['class' => 'form-control', 'required' => 'required', 'placeholder' => 'Correo e-mail...']) !!}
        </div>
        <div class="form-group">
            {!! Form::label('password', 'password:') !!}
            {!! Form::password('password', array('class' => 'form-control')) !!}
        </div>
        <div class="form-group">
            {!! Form::label('confirmar password', 'confirmar password:') !!}
            {!! Form::password('confirm-password', array('class' => 'form-control')) !!}
        </div>
        <div class="form-group">
            {!! Form::label('Roles', 'Roles:') !!}
            {!! Form::select('roles[]', $roles,[], array('class' => 'form-control')) !!}
        </div>
      </div>
      <div class="modal-footer">
       {!! Form::submit('Guardar Usuario', ['class' => 'btn btn-primary']) !!}
       {!! Form::close() !!}
      <hr>
      </div>
    </div>
  </div>
</div>
</div>
@endsection