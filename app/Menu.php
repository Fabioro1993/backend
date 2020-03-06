<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Menu extends Model
{
    use SoftDeletes;
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'menu';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['nombre_menu', 'descr_menu', 'precio', 'imag_menu', 'id_restaurant', 'id_tipo', 'id_nivel'];

    protected $dates = ['deleted_at'];

    protected $hidden = ['created_at', 'updated_at'];

    /**
     * The primary key associated with the table.
     *
     * @var string
     */
    protected $primaryKey = 'id_menu';

    public function restaurante()
    {
        return $this->belongsTo(Restaurant::class, 'id_restaurant' );
    }

    public function tipo_comida()
    {
        return $this->belongsTo(Tipo::class, 'id_tipo' );
    }

    public function nivel_estado()
    {
        return $this->belongsTo(Nivel::class, 'id_nivel' );
    }
}