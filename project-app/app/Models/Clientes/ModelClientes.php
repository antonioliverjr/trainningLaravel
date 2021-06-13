<?php

namespace App\Models\Clientes;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ModelClientes extends Model
{
    protected $table='model_clientes';
    use HasFactory;

    protected $fillable = [
        'name',
        'email',
    ];

    public function relBooks(){
        return $this->hasMany('App\Models\Books\ModelBook', 'id_cliente');
    }
}
