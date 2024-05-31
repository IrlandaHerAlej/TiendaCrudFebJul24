<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Perfil;

class PerfilesController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {   
        function __construct(){
            $this->middleware('permission: ver-perfiles | crear-perfiles | editar-perfiles | borrar-perfiles',['only'=>['index']]);
            $this->middleware('permission: crear-perfiles', ['only'=>['create','store']]);
            $this->middleware('permission: editar-perfiles', ['only'=>['edit','update']]);
            $this->middleware('permission: borrar-perfiles', ['only'=>['destroy']]);
        } 
        // consultas personalizas accediendo directamente a las tablas
        //$perfiles = DB::table('perfiles')->get();
        //return view('perfiles.index',['perfiles' => $perfiles]);
        //$perfiles = Perfil::all();
        $perfiles = Perfil::Buscador($request->nombre)->orderByDesc('id',$request->id)->simplepaginate(3);
        return view('perfiles.index',['perfiles' => $perfiles]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('perfiles.crear');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $this->validate($request,['nombre' => 'required|unique:perfiles']);
        //
        $perfil = Perfil::create(['nombre' => $request->get('nombre')]);
        return redirect()->route('perfiles.index')
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
        $perfil = Perfil::find($id);
        return view('perfiles.editar',compact('perfil'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $this->validate($request, ['nombre' => 'required|unique:perfiles']);
            //mas validaciones si se require
            //'nombre', mas campos
        

        $perfil = Perfil::find($id);
        $perfil -> nombre = $request->get("nombre");
        $perfil -> save();

        return redirect()->route('perfiles.index')
        ->with('mensaje','Se actualizo correctamente');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $perfil = Perfil::find($id);
        $perfil->delete();

        return redirect()->route('perfiles.index');
    }
}
