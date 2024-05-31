
<div class="container text-center">
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
        <h5 class="modal-title text-black">Crear cliente</h5>
        </div>
            {!! Form::open (['route'=> 'clientes.store']) !!}
                <div class="modal-body">
                     <div class="form-group ">
                        {!!form::text('nombre',null, array('class'=>'form-control','required' => 'required','placeholder' => 'Nombre del perfil..'))!!}
                     </div>
                     <div class="form-group ">
                        {!!form::text('rfc',null, array('class'=>'form-control','required' => 'required','placeholder' => 'rfc...'))!!}
                     </div>
                     <div class="form-group ">
                        {!!form::text('direccion',null, array('class'=>'form-control','required' => 'required','placeholder' => 'direccion..' ))!!}
                     </div>
                     <div class="form-group ">
                        {!!form::text('telefono',null, array('class'=>'form-control','required' => 'required','placeholder' => 'telefono..'))!!}
                     </div>
                     <div class="form-group">
                        {!!form::text('email',null, array('class'=>'form-control','required' => 'required','placeholder' => 'correp electronico..'))!!}
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
</div>

</div>

