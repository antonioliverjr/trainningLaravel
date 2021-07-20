<?php

namespace App\Models\Purchases;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class purchase extends Model
{
    protected $table='purchases';
    use HasFactory;

    protected $fillable = [
        'id_user',
        'id_cliente',
        'status',
    ];

    public function RelCliente()
    {
        return $this->hasOne('App\Models\Clientes\ModelClientes', 'id', 'id_cliente');
    }

    public function RelUser()
    {
        return $this->hasOne('App\Models\User', 'id', 'id_user');
    }

    public function RelPurchaseBook()
    {
        return $this->hasMany('App\Models\Purchases\purchase_book', 'id_purchase')
                    ->select('id_book')
                    ->selectRaw('count(*) as quantity')
                    ->selectRaw('sum(discount) as discounts')
                    ->selectRaw('sum(price_book) as prices_books')
                    ->groupBy('id_book')
                    ->orderBy('id_book', 'desc');
    }
}
