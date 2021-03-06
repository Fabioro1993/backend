<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Nivel extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'nivel';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['nombre_nivel'];

    protected $hidden = ['created_at', 'updated_at'];

    /**
     * The primary key associated with the table.
     *
     * @var string
     */
    protected $primaryKey = 'id_nivel';
}