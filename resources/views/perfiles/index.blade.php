@extends('master')
@section('titulo', 'Listado de perfiles')
@section('contenido')
<br>
<br>
<br>
<br>
@if(($message = Session::get('mensaje')))
<script>
    Swal.fire({
         title: "Mensaje",
         text: "{{$message}}",
         icon: "success"
         });
</script>
@endif

<script>
    document.addEventListener('DOMContentLoaded', function () {
        document.querySelectorAll('.delete-button').forEach(button => {
            button.addEventListener('click', function () {
                let clientId = this.getAttribute('data-id');
                Swal.fire({
                    title: "¿Estás seguro?",
                    text: "¡No podrás revertir esto!",
                    icon: "warning",
                    showCancelButton: true,{}
                    confirmButtonColor: "#3085d6",
                    cancelButtonColor: "#d33",
                    confirmButtonText: "¡Sí, estoy segure"
                }).then((result) => {
                    if (result.isConfirmed) {
                        document.getElementById('delete-form-' + clientId).submit();
                        Swal.fire({
                        title: "Eliminado!",
                        text: "El registro a sido eliminado.",
                        icon: "success"
                        });
                    }
                });
            });
        });
    });
</script>
<div class="container">

    <h1 class="text-center text-black">Listado de Perfiles</h1>
    <div class="container">
        {!!Form::open(['route'=>'perfiles.index','method'=>'GET','class'=>'navbar-from'])!!}
        <div class="row">
            <div class="col-6">
                
                <!-- <a class="btn btn-primary" href="{{Route('perfiles.create')}}">Crear Nuevo Perfil</a>-->
                <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal" @cannot('crear-perfiles') disabled @endcannot>
                    Crear Nuevo perfil
                </button>
               
            </div>
            <div class="col-4">
                {!!Form::text('nombre',null,['class'=>'form-control','id'=>'nombre','placeholder'=>'Buscar Perfil'])!!}
            </div>
            <div class="col-1">
                {!!Form::submit ('Buscar Perfil',array('class'=>'btn btn-secondary'))!!}
            </div>
        </div>
        {!!Form::close()!!}
    </div>

    <br>
   @can('ver-perfiles')
    <table class="table table-dark table-striped" >
        <thead>
            <tr>
                <th scope="col">Actualizar</th>
                <th scope="col">Eliminar</th>
                <th scope="col">Id</th>
                <th scope="col">Nombre</th>
            </tr>
        </thead>

        <tbody>

            @foreach($perfiles as $perfil)
            <tr>
                <td>
                    <a class="btn btn-warning @cannot('editar-perfiles') disabled @endcannot" 
                        href=" @can('editar-perfiles') {{route('perfiles.edit',$perfil->id)}} @else # @endcan">
                        <i class="bi bi-pencil-square edit-btn"></i>
                    </a>
                </td>
                <td>
                    {!! Form::open(['route' => ['perfiles.destroy', $perfil->id],'id' => 'delete-form-'.$perfil->id]) !!}
                    <input type="hidden" name="_method" value="DELETE">
                    <button type="button" class="btn btn-danger delete-button"  data-id="{{ $perfil->id }}"  @cannot('borrar-perfiles') disabled @endcannot>
                        <i class="bi bi-trash"></i>
                    </button>
                    {!! Form::close() !!}
                </td>
                <td>{{$perfil->id}}</td>
                <td>{{$perfil->nombre}}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
    {{ $perfiles->links() }}
    @endcan
    <br>
</div>
@include('perfiles.crear')
@endsection