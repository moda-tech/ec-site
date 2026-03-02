<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Material;


class MaterialController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $materials = Material::orderBy('created_at', 'desc')->paginate(30);

        return view('admin.materials.index', compact('materials'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.materials.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // バリデーション
        $request->validate([
            'material_name' => 'required|string|max:255',
            'material_price' => 'required|numeric',
            'material_overview' => 'nullable|string',
            'slug' => 'required|string|max:255|unique:materials,slug',
            'material_image' => 'nullable|image|max:2048',
        ]);

        // 画像アップロード（あれば）
        if ($request->hasFile('material_image')) {
            $path = $request->file('material_image')->store('materials', 'public');
        } else {
            $path = null;
        }

        // 新規作成
        Material::create([
            'material_name' => $request->material_name,
            'material_price' => $request->material_price,
            'material_overview' => $request->material_overview,
            'slug' => $request->slug,
            'material_image' => $path,
        ]);

        // リダイレクト
        return redirect()->route('admin.materials.index')
            ->with('success', '商品を作成しました');
    }

    /**
     * Display the specified resource.
     */
    public function show($slug)
    {
        $materials = Material::where('slug', $slug)->firstOrFail();

        return view('admin.materials.show', compact('materials'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($slug)
    {
        $materials = Material::where('slug', $slug)->firstOrFail();

        return view('admin.materials.edit', compact('materials'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $slug)
    {
        // データ取得
        $material = Material::where('slug', $slug)->firstOrFail();

        // バリデーション
        $request->validate([
            'material_name' => 'required|string|max:255',
            'material_price' => 'required|numeric',
            'material_overview' => 'nullable|string',
            'slug' => 'required|string|max:255',
            'material_image' => 'nullable|image|max:2048',
        ]);

        // 画像アップロード（あれば）
        if ($request->hasFile('material_image')) {
            $path = $request->file('material_image')->store('materials', 'public');
        } else {
            $path = $material->material_image; // 既存画像を維持
        }

        // 更新
        $material->update([
            'material_name' => $request->material_name,
            'material_price' => $request->material_price,
            'material_overview' => $request->material_overview,
            'slug' => $request->slug,
            'material_image' => $path,
        ]);

        // リダイレクト
        return redirect()->route('admin.materials.index')
            ->with('success', '商品を更新しました');
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        // データ取得
        $material = Material::findOrFail($id);

        // 商品名を先に退避（削除後は使えないため）
        $name = $material->material_name;

        // 削除
        $material->delete();

        // リダイレクト
        return redirect()->route('admin.materials.index')
            ->with('success', $name . ' が削除されました');
    }
}
