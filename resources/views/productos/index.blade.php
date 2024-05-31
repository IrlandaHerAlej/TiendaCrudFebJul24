@extends('master')
@section('titulo', 'Listado de perfiles')
@section('contenido')
<br>
<br>
<br>
<br>
<br>
<div class="container">

    <h1 class="text-center text-black">Productos</h1>
    <br>
    <table class="table table-dark" >
        <thead>
            <tr>
                <th scope="col">Nombre</th>
                <th scope="col">Precio</th>
                <th scope="col">Cantidad</th>
                <th scope="col">Agregar</th>
            </tr>
        </thead>

        <tbody>
            @foreach($productos as $producto)
            <tr>
                <td>{{$producto->nombre}}</td>
                <td>{{$producto->precio}}</td>
                <td>{{$producto->cantidad}}</td>
                <td>    
                <a class="btn btn-success" href="{{ route('carrito-agregar', $producto->id) }}">
                <i class="bi bi-cart-fill"></i>
                </a>
                </td>          
            </tr>
            @endforeach
        </tbody>
    </table>
    <br>
</div>

@include('mensajes.validaciones')
@endsection