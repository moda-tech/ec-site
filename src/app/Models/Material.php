<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Material extends Model
{
    //テストデータ一括作成用
    use HasFactory;

    protected $fillable = [
        'material_name',
        'material_image',
        'material_price',
        'material_overview',
        'slug',
    ];

    //DBからデータ取得する際にstringになってしまうのを防止
    protected $casts = [
        'material_price' => 'integer',
    ];

    //リレーション
    public function checkouts()
    {
        return $this->hasMany(Checkout::class);
    }
}
