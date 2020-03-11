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
        //dd( $request->all());
        //MANIPULACION DE IMAGENES
        /*if ($request->file('menu_ruta')) { //nombre del input (boton)
            $file = $request->file('menu_ruta');
            $menu_ruta = time() . $file->getClientOriginalName();   //generar nombre unico a la imagen
            $path = public_path(). '/inv_img/menu/'; // ruta donde guardamos la imagen
            $file->move($path, $menu_ruta); // Movemos la imagen a la carpeta
        }*/

        $menu = new Menu();
        $menu->nombre_menu = $request->get('nombre_menu');
        $menu->descr_menu = $request->get('descr_menu');
        $menu->precio = $request->get('precio');
        $menu->id_restaurant = $request->get('id_restaurant');
        $menu->id_tipo = $request->get('id_tipo'); 
        $menu->id_nivel = 4;
        $menu->imag_menu = '$menu_ruta';
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
        //VALIDACION
        $this->validate($request, [
            'menu_ruta' => 'image',
        ]);
        
        //MANIPULACION DE IMAGENES
        if ($request->file('menu_ruta')) { //nombre del input (boton)
            $file = $request->file('menu_ruta');
            $menu_ruta = time() . $file->getClientOriginalName();   //generar nombre unico a la imagen
            $path = public_path(). '/inv_img/menu/'; // ruta donde guardamos la imagen
            $file->move($path, $menu_ruta); // Movemos la imagen a la carpeta
        }

        $menu = Menu::findOrFail($id);
        $menu->nombre_menu = $request->get('nombre_menu');
        $menu->descr_menu = $request->get('descr_menu');
        $menu->precio = $request->get('precio');
        $menu->id_restaurant = $request->get('id_restaurant');
        $menu->id_tipo = $request->get('id_tipo'); 
        $menu->id_nivel = $request->get('id_nivel');
        //Si la imagen existe
        if ($request->file('menu_ruta')) { 
            $menu->logo_rest = $menu_ruta;
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
