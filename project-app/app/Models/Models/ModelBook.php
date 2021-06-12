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
    ];
}
