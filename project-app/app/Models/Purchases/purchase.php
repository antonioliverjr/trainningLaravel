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
        return $this->hasMany('App\Models\Clientes\ModelClientes', 'id');
    }

    public function RelUser()
    {
        return $this->hasMany('App\Models\User', 'id',);
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

    public function RelPurchaseBookItem()
    {
        return $this->hasMany('App\Models\Purchases\purchase_book', 'id_purchase');
    }
}
