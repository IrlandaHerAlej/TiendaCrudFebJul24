<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

use App\Models\Cliente;
use App\Models\Formapago;
use App\Models\Estadofactura;
use App\Models\Factura; 

use App\Models\User;
use App\Mail\CreateFactura;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;


class FacturasController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {   
        function __construct(){
            $this->middleware('permission: ver-facturas | crear-facturas | editar-facturas | borrar-facturas',['only'=>['index']]);
            $this->middleware('permission: crear-facturas', ['only'=>['create','store']]);
            $this->middleware('permission: editar-facturas', ['only'=>['edit','update']]);
            $this->middleware('permission: borrar-facturas', ['only'=>['destroy']]);
        }
        //
        //$facturas = Factura::all();
        
        $facturas = Factura::Buscador($request->numero)->orderByDesc('id',$request->id)->simplepaginate(2);
        $clientes = Cliente::orderBy('nombre', 'asc')->pluck('nombre', 'id');
        $formas = Formapago::orderBy('nombre', 'asc')->pluck('nombre', 'id');
        $estados = Estadofactura::orderBy('nombre', 'asc')->pluck('nombre', 'id');
        return view('facturas.index', compact('facturas', 'clientes', 'formas','estados'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //$clientes = Cliente::all();
        //$formas = Formaspago::all();
        //$estados = Estadofactura::all();

        //Con la funcion pluck solo traemos el nombre y el id y ordenamos por nombre en forma
        $clientes = Cliente::orderBy('nombre', 'asc')->pluck('nombre', 'id');
        $formas = Formapago::orderBy('nombre', 'asc')->pluck('nombre', 'id');
        $estados = Estadofactura::orderBy('nombre', 'asc')->pluck('nombre', 'id');
        
        return view ('facturas.crear',compact('clientes','formas','estados'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
    $this->validate($request, [
        'numero' => 'required|numeric',
        'valor' => 'required|numeric',
        'detalles' => 'required',
        'idcliente' => 'required',
        'idestado' => 'required',
        'idforma' => 'required',
        'archivo' => 'mimes:jpeg,png,jpg'
    ]);
    $now = new \Datetime();
    $fecha = $now->format('Ymd-His');
    $numero = $request->get('numero');
    $archivo = $request->file('archivo');
    $nombre = "";

    if($archivo){
        $extension = $archivo->getClientOriginalExtension();
        $nombre = "factura-".$numero."-".$fecha.".".$extension;
        \Storage::disk('local')->put($nombre, \File::get($archivo));
    }
    $user = Auth::user();
    //insertar la informacion a la tabla
    $factura = Factura::create([
        'numero'=>$request->get('numero'),
        'detalles'=>$request->get('detalles'),
        'valor'=>$request->get('valor'),
        'archivo'=>$nombre,
        'idcliente'=>$request->get('idcliente'),
        'idestado'=>$request->get('idestado'),
        'idforma'=>$request->get('idforma'),
    ]);
    
    Mail::to($user->email)->send(new CreateFactura($factura,$user));

    return redirect()->route('facturas.index')
    ->with('mensaje','Se creo correctamente');
    
    }
    
    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
    }
    

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
        $factura = Factura::find($id);
        $clientes = Cliente::all();
        $formas = Formapago::all();
        $estados = EstadoFactura::all();
        return view('facturas.editar', compact('factura', 'clientes', 'formas', 'estados'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
        $this->validate($request, [
            'numero' => 'required|numeric',
            'detalles' => 'required',
            'valor' => 'required|numeric',
            'archivo' => 'mimes:jpeg,png,jpg',
            'idcliente' => 'required',
            'idforma' => 'required',
            'idestado' => 'required',
        ]);

        $factura = Factura::find($id);
        $factura->numero = $request->get('numero');
        $factura->detalles = $request->get('detalles');
        $factura->valor = $request->get('valor');
        $factura->idcliente = $request->get('idcliente');
        $factura->idforma = $request->get('idforma');
        $factura->idestado = $request->get('idestado');

        if ($request->hasFile('archivo')) {
            $archivo = $request->file('archivo');
            $nombreArchivo = time() . '_' . $archivo->getClientOriginalName();
            $archivo->move(public_path('archivos'), $nombreArchivo);
            $factura->archivo = $nombreArchivo;
        }

        $factura->save();

        return redirect()->route('facturas.index')
        ->with('mensaje','Se actualizo correctamente');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    
        $factura = Factura::find($id);
        $factura->delete();

        return redirect()->route('facturas.index');
    }
}
