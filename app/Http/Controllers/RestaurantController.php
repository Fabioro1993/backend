<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Restaurant;
use App\User;

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
        //Registro del dueno
        $usuario = new User();
        $usuario->nombre = $request->get('nombre');
        $usuario->telefono = $request->get('telefono');
        $usuario->direccion = $request->get('direccion');
        $usuario->cedula = $request->get('cedula');
        $usuario->email = $request->get('email');
        $usuario->password =bcrypt(12345); 
        $usuario->id_nivel = 2;
        $usuario->save();

        //MANIPULACION DE IMAGENES
        if ($request->file('logo_rest')) { //nombre del input (boton)
            $file = $request->file('logo_rest');
            $logo_rest =  time() . $request->get('nombre_rest') .'-'. $file->getClientOriginalName();   //generar nombre unico a la imagen
            $path = public_path(). '/img/restautante/'; // ruta donde guardamos la imagen
            $file->move($path, $logo_rest); // Movemos la imagen a la carpeta
        }

        $restaurante = new Restaurant();
        $restaurante->nombre_rest = $request->get('nombre_rest');
        $restaurante->direccion_rest = $request->get('direccion_rest');
        $restaurante->telefono_rest = $request->get('telefono_rest');
        $restaurante->social = $request->get('social');
        $restaurante->id_dueno = $usuario->id_users;
        $restaurante->id_nivel = 4;
        $restaurante->logo_rest = $logo_rest;
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
