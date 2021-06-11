<?php

namespace App\Models\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ModelClientes extends Model
{
    protected $table='model_clientes';
    use HasFactory;

    protected $fillable = [
        'id',
        'name',
        'email',
    ];
}