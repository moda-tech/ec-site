<x-app-layout>
<div class="text-black">

    <div class="max-w-4xl mx-auto mt-12 px-6 py-8 bg-white shadow rounded-2xl">

        {{-- タイトル --}}
        <h2 class="text-xl font-bold mb-6">注文詳細</h2>

        {{-- 注文情報 --}}
        <div class="mb-6 space-y-2">
            <p><span class="font-semibold">注文ID：</span>{{ $order->id }}</p>
            <p><span class="font-semibold">ユーザーID：</span>{{ $order->user_id }}</p>
            <p><span class="font-semibold">ユーザー名：</span>{{ $order->user->name ?? '不明' }}</p>
            <p><span class="font-semibold">合計金額：</span>¥{{ number_format($order->total_amount) }}</p>
            <p><span class="font-semibold">ステータス：</span>{{ $order->status }}</p>
            <p><span class="font-semibold">注文日：</span>{{ $order->created_at }}</p>
        </div>

        {{-- 商品一覧 --}}
        <div class="mb-6">
            <h3 class="font-semibold mb-3">購入商品</h3>

            <table class="w-full border">
                <thead style="background-color:#f3f4f6;">
                    <tr>
                        <th class="px-4 py-2 text-left">商品名</th>
                        <th class="px-4 py-2 text-left">価格</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($order->checkouts as $checkout)
                        <tr class="border-t">
                            <td class="px-4 py-2">
                                {{ $checkout->material->material_name ?? '削除済み商品' }}
                            </td>
                            <td class="px-4 py-2">
                                ¥{{ number_format($checkout->material->material_price ?? 0) }}
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        {{-- 戻るボタン --}}
        <a href="{{ route('admin.orders.index') }}"
           class="inline-block mt-4 px-5 py-2 text-white rounded hover:opacity-80"
           style="background-color:#80B5B9;">
            ← 一覧に戻る
        </a>

    </div>

</div>
</x-app-layout>
