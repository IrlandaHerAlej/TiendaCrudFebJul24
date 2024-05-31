@extends('master')
@section('titulo','Crear un Perfil')

@section('contenido')

<div class="container text-center"></div>
<h2 class="text-center">Editar Perfil</h2>
@if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
            <li>{{$error}}</li>
            @endforeach
        </ul>
    </div>
@endif
    {!! Form::model ($perfil, ['route'=> ['perfiles.update',$perfil->id],'method'=>'PUT']) !!}
<div tabindex="-1">
  <div class="modal-dialog">
    <div class="modal-content bg-body-secondary border border-0 shadow rounded bg-dark">
      <div class="modal-header">
        <h5 class="modal-title text-black">Crear Perfiles</h5>
        </div>
      {!! Form::model ($perfil, ['route'=> ['perfiles.update',$perfil->id],'method'=>'PUT']) !!}
      <div class="modal-body">
      <div class="form-group">
        {!!form::text('nombre',null, array(
            'class'=>'form-control',
            'required' => 'required',
            'placeholder' => 'Nombre del perfil..' 
        ))
    !!}
    </div>
    </div>
      <div class="modal-footer">
      {!! Form::submit('Guardar Perfil', array('class'=>'btn btn-primary'))!!}
      {!! Form::close()!!}
      <hr>
      </div>
    </div>
  </div>
</div>
</div>
@endsection