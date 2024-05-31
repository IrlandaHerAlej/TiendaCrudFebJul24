@extends('master')

@section('titulo', 'Listado de Facturas')

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
                    showCancelButton: true,
                    confirmButtonColor: "#3085d6",
                    cancelButtonColor: "#d33",
                    confirmButtonText: "¡Sí, elimínalo!"
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
    <h1 class="text-center text-secondary-emphasis">Listado de Facturas</h1>
   
    <div class="container">
    {!!Form::open(['route'=>'facturas.index','method'=>'GET','class'=>'navbar-from'])!!}
    <div class="row">
    <div class="col-6">
    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal" @cannot('crear-facturas') disabled @endcannot>Crear Nueva factura</button>
    </div>
    <div class="col-4">
    {!!Form::text('numero',null,['class'=>'form-control','id'=>'numero','placeholder'=>'Buscar Factura'])!!}
    </div>
    <div class="col-1">
    {!!Form::submit ('Buscar Factura',array('class'=>'btn btn-secondary'))!!}
    </div>
    </div>
    {!!Form::close()!!}
    </div>
    <br>
    @can('ver-facturas')
    <table class="table table-dark table-striped">
        <thead>
            <tr>
                <th>Actualizar</th>
                <th>Eliminar</th>
                <th>Número</th>
                <th >Cliente</th>
                <th>RFC</th>
                <th>Valor</th>
                <th>Archivo</th>
                <th>Detalles</th>
            </tr>
        </thead>
        <tbody>
            @foreach($facturas as $factura)
            <tr>
                <td>
                    <a class="btn btn-warning @cannot('editar-facturas') disabled @endcannot"
                     href="@can('editar-facturas') {{ route('facturas.edit', $factura->id) }}  @else # @endcan"">
                        <i class="bi bi-pencil-square"></i>
                    </a>
                </td>
                <td>
                    {!! Form::open(['route' => ['facturas.destroy', $factura->id],'id' => 'delete-form-'.$factura->id, ]) !!}
                    <input type="hidden" name="_method" value="DELETE">
                        <button type="button" class="btn btn-danger delete-button"  data-id="{{ $factura->id }}"  @cannot('borrar-facturas') disabled @endcannot>
                            <i class="bi bi-trash"></i>
                        </button>
                    {!! Form::close() !!}
                
                </td>
                <td>{{ $factura->numero }}</td>
                <td>{{ $factura->cliente->nombre}}</td>
                <td>{{ $factura->cliente->rfc}}</td>
                <td>${{number_format($factura->valor)}}</td>
                <td><img src="{{asset('archivos/'.$factura->archivo.'')}}" width="150"></td>
                <td>{!! $factura->detalles !!} </td>
            </tr>
            @endforeach
        </tbody>
    </table>
    {{ $facturas->links() }}
    @endcan
   </div> 
   <br>
   @endsection
   @include('facturas.crear')

