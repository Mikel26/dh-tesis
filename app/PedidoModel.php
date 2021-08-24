<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PedidoModel extends Model
{
    protected $table = 'cabecera';
	protected $guarded = ['id','numFac','fecha','ruc_dni', 'estado','total'];

}
