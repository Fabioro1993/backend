<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Pedido;

class PedidoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $pedido = Pedido::with('users', 'restaurante','menu_cliente', 'nivel_estado')->get();
        return response()->json($pedido);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $pedido_cliente = Pedido::where('id_cliente', $request->get('id_cliente'))->count();
        $numero_cliente = $pedido_cliente++;
            
        $pedido = new Pedido();
        $pedido->numero_pedido = $numero_cliente;
        $pedido->id_cliente = $request->get('id_cliente');
        $pedido->id_restaurant = $request->get('id_restaurant');
        $pedido->id_menu = $request->get('id_menu');
        $pedido->id_nivel = $request->get('id_nivel');
        $pedido->comentario_pedido = $request->get('comentario_pedido'); 
        $pedido->forma_pago_pedido = $request->get('forma_pago_pedido');
        $pedido->monto_pedido = $request->get('monto_pedido');
        $pedido->fecha_compra_pedido = $request->get('fecha_compra_pedido');
        $pedido->save();

        return response()->json($pedido);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $pedido = Pedido::with('users', 'restaurante','menu_cliente', 'nivel_estado')->findOrFail($id);
        return response()->json($pedido);
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
        $pedido = Pedido::findOrFail($id);
        $pedido->id_cliente = $request->get('id_cliente');
        $pedido->id_restaurant = $request->get('id_restaurant');
        $pedido->id_menu = $request->get('id_menu');
        $pedido->id_nivel = $request->get('id_nivel');
        $pedido->comentario_pedido = $request->get('comentario_pedido'); 
        $pedido->forma_pago_pedido = $request->get('forma_pago_pedido');
        $pedido->monto_pedido = $request->get('monto_pedido');
        $pedido->fecha_compra_pedido = $request->get('fecha_compra_pedido');
        $pedido->save();

        return response()->json($pedido);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $pedido = Pedido::findOrFail($id);
        $pedido->delete();

        return response()->json(['success'=>true]);
    }
}
