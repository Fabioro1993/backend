<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\User;

class UsersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $usuario = User::with('nivel_estado')->get();
        return response()->json($usuario);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $usuario = new User();
        $usuario->nombre = $request->get('nombre');
        $usuario->apellido = $request->get('apellido');
        $usuario->direccion = $request->get('direccion');
        $usuario->telefono = $request->get('telefono');
        $usuario->cedula = $request->get('cedula');
        $usuario->email = $request->get('email');

        $usuario->password =bcrypt($request->get('password')); 
        $usuario->id_nivel = $request->get('id_nivel');

        $usuario->save();

        return response()->json($usuario);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $usuario = User::with('nivel_estado')->find($id);
        return response()->json($usuario);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $usuario = User::findOrFail($id);
        $usuario->nombre = $request->get('nombre');
        $usuario->apellido = $request->get('apellido');
        $usuario->direccion = $request->get('direccion');
        $usuario->cedula = $request->get('cedula');
        $usuario->email = $request->get('email');

        $usuario->password =bcrypt($request->get('password')); 
        $usuario->id_nivel = $request->get('id_nivel');

        $usuario->save();

        return response()->json($usuario);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $usuario = User::findOrFail($id);
        $usuario->delete();       

        return response()->json(['success'=>true]);
    }
}
