<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Restaurant extends Model
{
    use SoftDeletes;
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'restaurant';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['nombre_rest', 'direccion_rest', 'telefono_rest', 'social', 'logo_rest', 'id_dueno','id_nivel'];

    protected $dates = ['deleted_at'];

    protected $hidden = ['created_at', 'updated_at'];

    /**
     * The primary key associated with the table.
     *
     * @var string
     */
    protected $primaryKey = 'id_restaurant';

    public function users()
    {
        return $this->belongsTo(User::class, 'id_dueno' );
    }

    public function nivel_estado()
    {
        return $this->belongsTo(Nivel::class, 'id_nivel' );
    }
}