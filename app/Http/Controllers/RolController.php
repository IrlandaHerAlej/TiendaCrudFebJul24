<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

//nuevo
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Illuminate\Support\Facades\DB;

class RolController extends Controller
{
    //nuevo
    function __construct(){
        $this->middleware('permission: ver-rol | crear-rol | editar-rol | borrar-rol',['only'=>['index']]);
        $this->middleware('permission: crear-rol', ['only'=>['create','store']]);
        $this->middleware('permission: editar-rol', ['only'=>['edit','update']]);
        $this->middleware('permission: borrar-rol', ['only'=>['destroy']]);

    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
       $roles = Role::simplepaginate(5);
       return view('roles.index',compact('roles'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        $permission=Permission::get();
        return view('roles.crear', compact('permission'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
        $this->validate($request, ['name' => 'required|unique:roles,name', 'permission' => 'required']);
        $role = Role::create(['name'=>$request->input('name')]);
        $role -> syncPermissions(array_map('intval',$request->input('permission')));

        return redirect()->route('roles.index')
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
        //
        $role = Role::find($id);
        $permission = Permission::get();
        $rolePermissions = DB::table('role_has_permissions')->where('role_has_permissions.role_id',$id) 
        ->pluck('role_has_permissions.permission_id','role_has_permissions.permission_id')->all();
        return view('roles.editar',compact('role','permission','rolePermissions'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
        $this->validate($request, ['name' => 'required', 'permission' => 'required']);
        $role = Role::find($id);
        $role -> name = $request->input('name');
        $role -> save();
        $role -> syncPermissions(array_map('intval',$request->input('permission')));
        return redirect()->route('roles.index')
        ->with('mensaje','Se actualizo correctamente');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
        DB::table('roles')->where('id', $id)->delete();
        return redirect()->route('roles.index');
    }

}