<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Producto extends Model
{
    protected $table = 'productos';
    protected $guarded = ['id','codigo','nombre','valor','imagen','id_categoria'];
    protected $hidden = ['created_at','updated_at'];

}
