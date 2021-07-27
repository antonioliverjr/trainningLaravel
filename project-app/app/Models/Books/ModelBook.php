<?php

namespace App\Models\Books;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ModelBook extends Model
{
    protected $table = 'book';
    use HasFactory;
    use SoftDeletes;

    protected $fillable = [
        'title',
        'description',
        'pages',
        'price',
        'image',
        'id_cliente',
    ];

    public function RelCliente()
    {
        return $this->hasOne('App\Models\Clientes\ModelClientes', 'id', 'id_cliente');
    }

    public function deletedAtNull($id)
    {
        $book_del = ModelBook::where(['deleted_at' => null, 'id' => $id])->forceDelete();
    }

    protected $dates = ['deleted_at'];
}
