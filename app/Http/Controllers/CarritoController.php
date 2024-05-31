<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Session;
use App\Models\Producto;
use App\Models\Pedidos;

class CarritoController extends Controller
{
    //
    public function __construct(){
        if(!Session::has('carrito'))
        Session::put('carrito',array());
    }

    public function show(){
        $carrito = Session::get('carrito');
        $total = $this->total();
        return view('productos.carrito', compact('carrito', 'total'));
    }

    public function add($id){
        $carrito = Session::get('carrito');
        $producto = Producto::find($id);
        $carrito[$producto->id] = $producto;
        Session::put('carrito',$carrito);
        return redirect()->route('carrito')
        ->with('Seagrego','Se Agrego al carrito');
    }

    public function delete($id){
        $carrito =Session::get('carrito');
        unset($carrito[$id]);
        Session::put('carrito',$carrito);
        return redirect()->route('carrito');
    }

    public function trash(){
        Session::forget('carrito');
        return redirect()->route('carrito');
    }

    public function update($id, $cantidad){
        $carrito = Session::get('carrito');
        $producto = Producto::find($id);
        $carrito[$producto->id]->cantidad=$cantidad;

        Session::put('carrito', $carrito);
        return redirect()->route('carrito');
    }

    public function total(){
        $carrito = Session::get('carrito');
        $total = 0;
        foreach ($carrito as $item){
            $total += $item->precio*$item->cantidad;
        }
        return $total;
    }

    public function guardarPedido(){
        $carrito = Session::get('carrito');
        if(count($carrito)){
            $now = new \DateTime();
            $numero = $now -> format('Ymd-His');
            foreach($carrito as $producto){
                $this->guardarItem($producto, $numero);
            }
            Session::forget('carrito');
        }
        return redirect()->route('carrito');
    }

    public function guardarItem($producto, $numero){
        $productoguardado = Pedidos::create([
            'numero' => $numero,
            'idproducto'=>$producto->id,
            'cantidad'=>$producto->cantidad,
            'precio'=>$producto->precio
        ]);
    }

}
