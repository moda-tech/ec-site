<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Models\Material;
use App\Models\Checkout;
use App\Models\Order;

use Illuminate\Http\Request;

class CheckoutController extends Controller
{
    //購入内容の確認
    public function show($slug)
    {
        $materials = Material::where('slug', $slug)->firstOrFail();

        return view('checkouts.show', compact('materials'));
    }

    //購入処理
    public function confirm($slug)
    {
        $material = Material::where('slug', $slug)->firstOrFail();

           try {

                DB::beginTransaction();

                $alreadyPurchased = Checkout::where('material_id', $material->id)
                    ->whereHas('order', function ($query) {
                        $query->where('user_id', Auth::id())
                            ->where('status', 'completed');
                    })
                    ->exists();

                if ($alreadyPurchased) {
                    throw new \Exception('already purchased');
                }

                // order作成
                $order = Order::create([
                    'user_id' => Auth::id(),
                    'total_price' => $material->material_price,
                    'status' => 'pending',
                ]);

                $quantity = 1;

                // checkout作成
                Checkout::create([
                    'order_id'   => $order->id,
                    'material_id'=> $material->id,
                    'quantity'   => $quantity,
                    'price'      => $material->material_price,
                    'subtotal'   => $material->material_price * $quantity,
                ]);

                //DB側でcheckoutテーブルのuser_idとmaterial_idの組み合わせにユニーク制約をかけることで
                //同時リクエストによる二重Insertを防止しています

                DB::commit();

            } catch (\Exception $e) {

                DB::rollBack();

                \Log::error($e->getMessage());

                return redirect()
                    ->back()
                    ->with('error', '購入処理に失敗しました');
            }


            return redirect()
                ->route('checkout.result')
                ->with('success', '決済が完了しました');
    }

    //購入完了
    public function result()
    {
        return view('checkouts.result');
    }


}
