<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Restaurant;

class RestaurantController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $restaurante = Restaurant::with('users', 'nivel_estado')->get();
        return response()->json($restaurante);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        dd($request->all());
        //MANIPULACION DE IMAGENES
        if ($request->file('item_ruta')) { //nombre del input (boton)
            $file = $request->file('item_ruta');
            $item_ruta = time() . $file->getClientOriginalName();   //generar nombre unico a la imagen
            $path = public_path(). '/inv_img/'; // ruta donde guardamos la imagen
            $file->move($path, $item_ruta); // Movemos la imagen a la carpeta
        }

        $restaurante = new Restaurant();
        $restaurante->nombre_rest = $request->get('nombre_rest');
        $restaurante->direccion_rest = $request->get('direccion_rest');
        $restaurante->telefono_rest = $request->get('telefono_rest');
        $restaurante->social = $request->get('social');
        $restaurante->id_dueno = $request->get('id_dueno'); 
        $restaurante->id_nivel = $request->get('id_nivel');
        $restaurante->logo_rest = $item_ruta;
        $restaurante->save();

        return response()->json($restaurante);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $restaurante = Restaurant::with('users', 'nivel_estado')->find($id);
        return response()->json($restaurante);
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
        //VALIDACION
        $this->validate($request, [
            'item_ruta' => 'image',
        ]);
        
        //MANIPULACION DE IMAGENES
        if ($request->file('item_ruta')) { //nombre del input (boton)
            $file = $request->file('item_ruta');
            $item_ruta = time() . $file->getClientOriginalName();   //generar nombre unico a la imagen
            $path = public_path(). '/inv_img/'; // ruta donde guardamos la imagen
            $file->move($path, $item_ruta); // Movemos la imagen a la carpeta
        }

        $restaurante = Restaurant::findOrFail($id);
        $restaurante->nombre_rest = $request->get('nombre_rest');
        $restaurante->direccion_rest = $request->get('direccion_rest');
        $restaurante->telefono_rest = $request->get('telefono_rest');
        $restaurante->social = $request->get('social');
        $restaurante->id_dueno = $request->get('id_dueno'); 
        $restaurante->id_nivel = $request->get('id_nivel');
        //Si la imagen existe
        if ($request->file('item_ruta')) { 
            $restaurante->logo_rest = $item_ruta;
        }

        $restaurante->save();

        return response()->json($restaurante);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $restaurante = Restaurant::findOrFail($id);
        $restaurante->delete();

        return response()->json(['success'=>true]);
    }
}
