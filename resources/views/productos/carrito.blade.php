@extends('master')
@section('titulo', 'Listado de perfiles')
@section('contenido')
<br>
<br>
<br>
<br>
<br>
<div class="container">
    <h1 class="text-center">Productos Compra</h1>
    <br>
    <p>
        <a href="{{ route('carrito-vaciar')}}" class="btn btn-warning">Vaciar Carrito
        <i class="bi bi-trash3-fill"></i>
        </a>
    </p>
    <table class="table table-dark" >
        <thead>
            <tr>
                <th scope="col">Nombre</th>
                <th scope="col">Precio</th>
                <th scope="col">Cantidad</th>
                <th scope="col">Total</th>
                <th scope="col">Borrar</th>
            </tr>
        </thead>

        <tbody>
            @foreach($carrito as $item)
            <tr>
                <td>{{$item->nombre}}</td>
                <td>${{number_format($item->precio,0)}}</td>
                <td>
                    <input type="number" min="1" max="50" value="{{$item->cantidad}}" id="producto_{{$item->id}}">
                      <a href="#" class="btn btn-info btn-update-item" data-href="{{ route('carrito-actualizar', $item->id)}}" data-id="{{$item->id}}">
                      <i class="bi bi-arrow-counterclockwise"></i>
                      </a>
                </td>
                <td>{{$item->precio*$item->cantidad}}</td>
                <td>    
                <a class="btn btn-danger delete-button"  href="{{route('carrito-borrar', $item->id)}}">
                     <i class="bi bi-trash"></i>
                </a>
                </td>          
            </tr>
            @endforeach
        </tbody>
    </table>
    <h5><span class="btn btn-outline-success">${{ number_format($total)}}</span></h5>
    <hr>
    <p>
    <a class="btn btn-primary" href="{{ route('productos.index')}}">
    <i class="fa fa-chevron-circle-left"> </i> Seguir Agregando</a>
    @if(count($carrito))
    <a class="btn btn-light" href="{{ route('ordenar')}}"> Ordenar 
        <i class="fa fa-chevron-circle-right"></i>
    </a>
    @endif
    </p>
</div>
@endsection