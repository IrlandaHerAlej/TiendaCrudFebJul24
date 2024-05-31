<div class="container text-center"></div>

@if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
            <li>{{$error}}</li>
            @endforeach
        </ul>
    </div>
@endif
 {!! Form::open(['route' => 'facturas.store', 'enctype' => 'multipart/form-data']) !!}
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content bg-body-secondary border border-0 shadow rounded bg-dark">
      <div class="modal-header">
        <h5 class="modal-title text-black">Crear facturas</h5>
        </div>
      <div class="modal-body">
      <div class="form-group">
            {!! Form::label('numero', 'Número de la factura:') !!}
            {!! Form::text('numero', null, ['class' => 'form-control', 'required' => 'required', 'placeholder' => 'Número de la factura...']) !!}
      </div>
        <div class="form-group">
            {!! Form::label('valor', 'Valor de la factura:') !!}
            {!! Form::text('valor', null, ['class' => 'form-control', 'required' => 'required', 'placeholder' => 'Valor de la factura...']) !!}
        </div>
        <div class="form-group">
            {!! Form::label('detalles', 'Detalles de la factura:') !!}
            {!! Form::textarea('detalles', null, 
              ['id' => 'crear',
              'class' => 'form-control  ckeditor', 'placeholder' => 'Detalles de la factura...']) !!}
        </div>
        <div class="form-group">
         {!! Form::label('idcliente', 'Clientes:') !!}
           {!! Form::select('idcliente', $clientes, null, ['class' => 'form-control']) !!}
        </div>

        <div class="form-group">
            {!! Form::label('idforma', 'Formas de Pago:') !!}
            {!! Form::select('idforma', $formas, null, ['class' => 'form-control']) !!}
        </div>
        <div class="form-group">
            {!! Form::label('idestado', 'Estados:') !!}
            {!! Form::select('idestado', $estados, null, ['class' => 'form-control']) !!}
        </div>
        <div class="form-group">
            {!! Form::label('archivo', 'Archivo:') !!}
            {!! Form::file('archivo', ['class' => 'form-control']) !!}
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