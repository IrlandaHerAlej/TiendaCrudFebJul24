


@if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
            <li>{{$error}}</li>
            @endforeach
        </ul>
    </div>
  @endif

<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content bg-body-secondary border border-0 shadow rounded bg-dark">
      <div class="modal-header">
        <h5 class="modal-title text-black">Crear perfiles</h5>
        </div>
        {!! Form::open (['route'=> 'perfiles.store']) !!}
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