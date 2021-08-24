<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CategoriaModel extends Model
{
    protected $table = 'categoria_producto';
    protected $hidden = ['created_at','updated_at'];
}
