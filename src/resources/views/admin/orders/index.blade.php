<x-app-layout>

    <div class="py-8">
        <div class="mx-auto px-6" style="max-width: 1000px;">

            <h1 class="text-xl font-bold mb-6">注文一覧</h1>

            <div class="overflow-x-auto bg-white rounded shadow">

                <table class="min-w-full text-sm text-left">
                    <thead style="background-color:#80B5B9;" class="text-white">
                        <tr>
                            <th class="px-4 py-2">注文ID</th>
                            <th class="px-4 py-2">ユーザーID</th>
                            <th class="px-4 py-2">合計金額</th>
                            <th class="px-4 py-2">ステータス</th>
                            <th class="px-4 py-2">詳細</th>
                        </tr>
                    </thead>

                    <tbody>
                        @foreach ($orders as $order)
                            <tr class="border-b">
                                <td class="px-4 py-2">{{ $order->id }}</td>
                                <td class="px-4 py-2">{{ $order->user_id }}</td>
                                <td class="px-4 py-2">¥{{ number_format($order->total_price) }}</td>
                                <td class="px-4 py-2">{{ $order->status }}</td>
                                <td class="px-4 py-2">
                                <a href="{{ route('admin.orders.show', $order->id) }}"
                                    class="inline-block ml-2 px-4 py-1.5 text-white text-sm rounded shadow-sm hover:opacity-80"
                                    style="background-color:#6FA8DC;">
                                    詳細
                                    </a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>

            </div>

            <!-- ページネーション -->
            <div class="mt-6">
                {{ $orders->links() }}
            </div>

        </div>
    </div>

</x-app-layout>
