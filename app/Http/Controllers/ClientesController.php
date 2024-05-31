<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Cliente;
use Illuminate\Validation\Rule;

class ClientesController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {   
        function __construct(){
            $this->middleware('permission: ver-clientes | crear-clientes | editar-clientes | borrar-clientes',['only'=>['index']]);
            $this->middleware('permission: crear-clientes', ['only'=>['create','store']]);
            $this->middleware('permission: editar-clientes', ['only'=>['edit','update']]);
            $this->middleware('permission: borrar-clientes', ['only'=>['destroy']]);
    
        }
       // $clientes = Cliente::paginate(2);
      // $clientes = Cliente::simplepaginate(2);
       $clientes = Cliente::Buscador($request->nombre)->orderByDesc('id',$request->id)->simplepaginate(2);
       return view('clientes.index', compact('clientes'));
      // return view('clientes.index',['clientes' => $clientes]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('clientes.crear');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $this->validate($request,[
            'nombre' =>     ['required', Rule::unique('clientes', 'nombre')],
            'rfc' =>        ['required', Rule::unique('clientes', 'rfc')],
            'direccion' =>  ['required', Rule::unique('clientes', 'direccion')],
            'telefono' =>   ['required', Rule::unique('clientes', 'telefono')],
            'email' =>      ['required', Rule::unique('clientes', 'email')]
        ]);
        //
        $cliente = Cliente::create([
        'nombre' => $request->get('nombre'),
        'rfc' => $request->get('rfc'),
        'direccion' => $request->get('direccion'),
        'telefono' => $request->get('telefono'),
        'email' => $request->get('nombre')
        ]);

        return redirect()->route('clientes.index')
        ->with('mensaje','Se creo correctamente');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $cliente = Cliente::find($id);
        return view('clientes.editar',compact('cliente'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $cliente = Cliente::find($id);
        $this->validate($request, [
            'nombre' =>     ['required', Rule::unique('clientes')->ignore($cliente->nombre, 'nombre')],
            'rfc' =>        ['required', Rule::unique('clientes')->ignore($cliente->rfc, 'rfc')],
            'direccion' =>  ['required', Rule::unique('clientes')->ignore($cliente->direccion, 'direccion')],
            'telefono' =>   ['required', Rule::unique('clientes')->ignore($cliente->telefono, 'telefono')],
            'email' =>      ['required', Rule::unique('clientes')->ignore($cliente->email, 'email')],
            //mas validaciones si se require
            //'nombre', mas campos
        ]);

        $cliente -> nombre = $request->get("nombre");
        $cliente -> rfc = $request->get("rfc");
        $cliente -> direccion = $request->get("direccion");
        $cliente -> telefono = $request->get("telefono");
        $cliente -> email = $request->get("email");
        $cliente -> save();

        return redirect()->route('clientes.index')
        ->with('mensaje','Se actualizo correctamente');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $cliente = Cliente::find($id);
        $cliente->delete();

        return redirect()->route('clientes.index');
    }
}
