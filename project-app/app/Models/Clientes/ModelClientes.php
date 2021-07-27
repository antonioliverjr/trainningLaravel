<?php

namespace App\Models\Clientes;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ModelClientes extends Model
{
    protected $table = 'clientes';
    use HasFactory;
    use SoftDeletes;

    protected $fillable = [
        'name',
        'email',
    ];

    public function relBooks()
    {
        return $this->hasMany('App\Models\Books\ModelBook', 'id_cliente');
    }

    /**
     * @return void
     */
    public function deletedAtNull($id)
    {
        $cliente_del = ModelClientes::where(['deleted_at' => null, 'id' => $id])->forceDelete();
    }

    protected $dates = ['deleted_at'];
}
