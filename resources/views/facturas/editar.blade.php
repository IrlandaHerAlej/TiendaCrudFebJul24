@extends('master')
@section('titulo','Listado de Facturas')

@section('contenido')
<h2 class="text-center">Crear Perfil</h2>
@if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
            <li>{{$error}}</li>
            @endforeach
        </ul>
    </div>
@endif
{!! Form::model($factura, ['route' => ['facturas.update', $factura->id], 'method' => 'PUT', 'files' => true]) !!}
<div tabindex="-1">
  <div class="modal-dialog">
    <div class="modal-content bg-body-secondary border border-0 shadow rounded bg-dark">
      <div class="modal-header">
        <h5 class="modal-title text-black">Editar facturas</h5>
        
      </div>
      <div class="modal-body">
      <div class="form-group">
      {!! Form::label('numero', 'Número de la factura:') !!}
      {!! Form::text('numero', null, array(
                        'class' => 'form-control',
                        'required' => 'required',
                        'placeholder' => 'Número de Factura...'
                    ))
       !!}
        </div>
        <div class="form-group">
        {!! Form::label('detalles', 'Detalles de la factura:') !!}
        {!! Form::textarea('detalles', null, 
            ['id' => 'editor', 
            'class' => 'form-control ckeditor', 
            'placeholder' => 'Detalles de la factura...']) !!}      
        </div>
        <div class="form-group">
        {!! Form::label('valor', 'Valor de la factura:') !!}
        {!! Form::text('valor', null, array(
                        'class' => 'form-control',
                        'required' => 'required',
                        'placeholder' => 'Valor...'
                    ))
        !!}
        </div>
        <div class="form-group">
        {!! Form::label('archivo', 'Archivo:') !!}
        {!! Form::file('archivo', array(
                        'class' => 'form-control',
                        'placeholder' => 'Archivo...'
                    ))
        !!}
        </div>
        <div class="form-group">
        {!! Form::label('idcliente', 'Clientes:') !!}
        {!! Form::select('idcliente', $clientes->pluck('nombre', 'id'), $factura->idcliente, array(
                        'class' => 'form-control',
                        'required' => 'required',
                        'placeholder' => 'Seleccionar Cliente...'
                    ))
        !!}
        </div>
        <div class="form-group">
        {!! Form::label('idforma', 'Formas de Pago:') !!}
        {!! Form::select('idforma', $formas->pluck('nombre', 'id'), $factura->idforma, array(
                        'class' => 'form-control',
                        'required' => 'required',
                        'placeholder' => 'Seleccionar Forma...'
                    ))
        !!}
        </div>
        <div class="form-group">
        {!! Form::label('idestado', 'Estados:') !!}
        {!! Form::select('idestado', $estados->pluck('nombre', 'id'), $factura->idestado, array(
                        'class' => 'form-control',
                        'required' => 'required',
                        'placeholder' => 'Seleccionar Estado...'
                    ))
        !!}
        </div>
      </div>
      <div class="modal-footer">
       {!! Form::submit('Guardar Factura', ['class' => 'btn btn-primary']) !!}
       {!! Form::close() !!}
      <hr>
      </div>
    </div>
  </div>
</div>
@endsection
@section('scripts')
<script>
    ClassicEditor
        .create( document.querySelector( '#editor' ) )
        .catch( error => {
            console.error( error );
        } );
</script>
@endsection