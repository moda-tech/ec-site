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
    public function show($slug)
    {
        $materials = Material::where('slug', $slug)->firstOrFail();

        return view('checkouts.show', compact('materials'));
    }

    public function confirm($slug)
    {
        $material = Material::where('slug', $slug)->firstOrFail();

            $alreadyPurchased = Checkout::where('material_id', $material->id)
                    ->whereHas('order', function ($query) {
                        $query->where('user_id', Auth::id())
                            ->where('status', 'completed');
                    })
                    ->exists();

            if ($alreadyPurchased) {
                return redirect()
                    ->back()
                    ->with('error', 'この商品はすでに購入済みです');
            }


            DB::transaction(function () use ($material) {
               // ① order作成
                $order = Order::create([
                    'user_id' => Auth::id(),
                    'total_price' => $material->material_price,
                    'status' => 'pending',
                ]);

                $quantity = 1;

                // ② checkout作成
                Checkout::create([
                    'order_id'   => $order->id,
                    'material_id'=> $material->id,
                    'quantity'   => $quantity,
                    'price'      => $material->material_price,
                    'subtotal'   => $material->material_price * $quantity,
                ]);
        
                sleep(1);

                $lockedOrder = Order::lockForUpdate()->find($order->id);

                if ($lockedOrder->status === 'completed') {
                    return;
                }

                $lockedOrder->status = 'completed';
                $lockedOrder->save();
            });

            return redirect()
                ->route('checkout.result')
                ->with('success', '決済が完了しました');
    }

    public function result()
    {
        return view('checkouts.result');
    }


}
