<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Checkout extends Model
{
    use HasFactory;

    protected $fillable = [
        'order_id',
        'material_id',
        'quantity',
        'price',
        'subtotal',
    ];

    protected $casts = [
    'price' => 'integer',
    'quantity' => 'integer',
    'subtotal' => 'integer',
    ];


    //リレーション
    public function order()
    {
        return $this->belongsTo(Order::class);
    }
    
    public function material()
    {
        return $this->belongsTo(Material::class);
    }

}
