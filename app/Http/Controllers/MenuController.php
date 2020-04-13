<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Menu;

class MenuController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $menu = Menu::with('restaurante','tipo_comida', 'nivel_estado')->get();
        return response()->json($menu);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //MANIPULACION DE IMAGENES
        if ($request->file('imag_menu')) { //nombre del input (boton)
            $file = $request->file('imag_menu');
            $imag_menu =  time() . $request->get('nombre_menu') .'-'. $file->getClientOriginalName();   //generar nombre unico a la imagen
            $path = public_path(). '/img/menu/'; // ruta donde guardamos la imagen
            //dd($path);
            $file->move($path, $imag_menu); // Movemos la imagen a la carpeta
        }

        $menu = new Menu();
        $menu->nombre_menu = $request->get('nombre_menu');
        $menu->descr_menu = $request->get('descr_menu');
        $menu->precio = $request->get('precio');
        $menu->id_restaurant = $request->get('id_restaurant');
        $menu->id_tipo = $request->get('id_tipo'); 
        $menu->id_nivel = 4;
        $menu->imag_menu = '/img/menu/'.$imag_menu;
        $menu->save();

        return response()->json($menu);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $menu = Menu::with('restaurante','tipo_comida', 'nivel_estado')->findOrFail($id);
        return response()->json($menu);
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
        //dd($request->all(), $id);
        
        //MANIPULACION DE IMAGENES
        if ($request->file('imag_menu')) { //nombre del input (boton)
            $file = $request->file('imag_menu');
            $imag_menu =  time() . $request->get('nombre_menu') .'-'. $file->getClientOriginalName();   //generar nombre unico a la imagen
            $path = public_path(). '/img/menu/'; // ruta donde guardamos la imagen
            //dd($path);
            $file->move($path, $imag_menu); // Movemos la imagen a la carpeta
        }

        $menu = Menu::findOrFail($id);
        $menu->nombre_menu = $request->get('nombre_menu');
        $menu->descr_menu = $request->get('descr_menu');
        $menu->precio = $request->get('precio');
        $menu->id_restaurant = $request->get('id_restaurant');
        $menu->id_tipo = $request->get('id_tipo'); 

        if ( $request->get('id_nivel') == 'true' || $request->get('id_nivel') == 4) {
            $menu->id_nivel = 4;
        } else {
            $menu->id_nivel = 5;
        }
                
        //Si la imagen existe
        if ($request->file('imag_menu')) { 
            $menu->imag_menu = '/img/menu/'.$imag_menu;
        }

        $menu->save();

        return response()->json($menu);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $menu = Menu::findOrFail($id);
        $menu->delete();

        return response()->json(['success'=>true]);
    }
}
