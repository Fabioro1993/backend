<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Nivel;

class NivelController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $nivel = Nivel::all();
        return response()->json($nivel);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $nivel = new Nivel();
        $nivel->nombre_nivel = $request->get('nombre_nivel');
        $nivel->save();

        return response()->json($nivel);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $nivel = Nivel::findOrFail($id);
        return response()->json($nivel);
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
        $nivel = Nivel::findOrFail($id);
        $nivel->nombre_nivel = $request->get('nombre_nivel');
        $nivel->save();
        return response()->json($nivel);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $nivel = Nivel::findOrFail($id);
        $nivel->delete();

        return response()->json(['success'=>true]);
    }   
}