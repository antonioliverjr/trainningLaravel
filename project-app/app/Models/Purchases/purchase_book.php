<?php

namespace App\Models\Purchases;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class purchase_book extends Model
{
    protected $table='purchase_books';
    use HasFactory;

    protected $fillable = [
        'id_purchase',
        'id_book',
        'status',
        'price_book',
        'discount',
    ];

    public function RelPurchase()
    {
        return $this->hasMany('App\Models\Purchases\purchase', 'id');
    }

    public function RelBooks()
    {
        return $this->belongsTo('App\Models\Books\ModelBook', 'id_book', 'id');
    }
}
