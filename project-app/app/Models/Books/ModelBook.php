<?php

namespace App\Models\Books;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ModelBook extends Model
{
    protected $table='book';
    use HasFactory;

    protected $fillable = [
        'title',
        'description',
        'pages',
        'price',
        'image',
        'id_cliente',
    ];

    public function RelCliente(){
        return $this->hasOne('App\Models\Clientes\ModelClientes', 'id', 'id_cliente');
    }
}
