<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Pedido extends Model
{
    use SoftDeletes;
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'pedido';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['numero_pedido', 'id_cliente', 'id_restaurant', 'id_menu', 'id_nivel', 'comentario_pedido', 'forma_pago_pedido', 'monto_pedido', 'fecha_compra_pedido'];

    protected $dates = ['deleted_at'];

    protected $hidden = ['created_at', 'updated_at'];

    /**
     * The primary key associated with the table.
     *
     * @var string
     */
    protected $primaryKey = 'id_pedido';

    public function users()
    {
        return $this->belongsTo(User::class, 'id_cliente' );
    }

    public function restaurante()
    {
        return $this->belongsTo(Restautant::class, 'id_restaurant' );
    }

    public function menu_cliente()
    {
        return $this->belongsTo(Menu::class, 'id_menu' );
    }

    public function nivel_estado()
    {
        return $this->belongsTo(Nivel::class, 'id_nivel' );
    }
}