<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use App\Models\Material;
use App\Models\Checkout;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class MaterialController extends Controller
{
    // 商品一覧表示
    public function index()
    {
        $materials = Material::orderBy('created_at', 'desc')->paginate(18);

        //購入済み判定
        $purchasedMaterialIds = Checkout::whereHas('order', function ($query) {
        $query->where('user_id', Auth::id());
        })
        ->pluck('material_id')
        ->toArray();

        return view('materials.index', compact('materials', 'purchasedMaterialIds'));


    }

    //　商品詳細表示
    public function show($slug)
    {
        $materials = Material::where('slug', $slug)->firstOrFail();

        return view('materials.show', compact('materials'));
    }

}
