<?php

namespace App\Models\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ModelBook extends Model
{
    protected $table='book';
    use HasFactory;

    protected $fillable = [
        'id',
        'title',
        'pages',
        'price',
        'id_cliente',
    ];

    public function RelCliente(){
        return $this->hasOne('App\Models\Models\ModelClientes', 'id', 'id_cliente');
    }
}
