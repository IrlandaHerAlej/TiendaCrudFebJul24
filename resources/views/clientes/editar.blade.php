@extends('master')
@section('titulo','Editar un Cliente')

@section('contenido')

<div class="container text-center"></div>
<h2 class="text-center">Editar Cliente</h2>
@if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
            <li>{{$error}}</li>
            @endforeach
        </ul>
    </div>
@endif
<div tabindex="-1">
  <div class="modal-dialog">
    <div class="modal-content bg-body-secondary border border-0 shadow rounded bg-dark">
      <div class="modal-header">
        <h5 class="modal-title text-black">Editar cliente</h5>
      </div>
      {!! Form::model ($cliente, ['route'=> ['clientes.update',$cliente->id],'method'=>'PUT']) !!}
      <div class="modal-body">
      <div class="form-group ">
      {!! Form::label('nombre', 'nombre del cliente:') !!}
        {!!form::text('nombre',null, array(
            'class'=>'form-control',
            'required' => 'required',
            'placeholder' => 'Nombre del perfil..' 
        ))
    !!}
    </div>
    <div class="form-group ">
    {!! Form::label('rfc', 'rfc:') !!}
        {!!form::text('rfc',null, array(
            'class'=>'form-control',
            'required' => 'required',
            'placeholder' => 'rfc...' 
        ))
    !!}
    </div>
    <div class="form-group ">
    {!! Form::label('direccion', 'direccion:') !!}
        {!!form::text('direccion',null, array(
            'class'=>'form-control',
            'required' => 'required',
            'placeholder' => 'direccion..' 
        ))
    !!}
    </div>
    <div class="form-group ">
    {!! Form::label('telefono', 'telefono:') !!}
        {!!form::text('telefono',null, array(
            'class'=>'form-control',
            'required' => 'required',
            'placeholder' => 'telefono..' 
        ))
    !!}
    </div>
    <div class="form-group">
    {!! Form::label('email', 'correo electronico:') !!}
        {!!form::text('email',null, array(
            'class'=>'form-control',
            'required' => 'required',
            'placeholder' => 'Nombre del perfil..' 
        ))
    !!}
    </div>
    </div>
      <div class="modal-footer">
      {!! Form::submit('Guardar Cliente', array('class'=>'btn btn-primary'))!!}
      {!! Form::close()!!}
     <hr>
      </div>
    </div>
  </div>
</div>

</div>
@endsection