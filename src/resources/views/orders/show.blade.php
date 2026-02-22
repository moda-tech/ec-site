<x-app-layout>

    {{-- ページ全体ラッパー（文字色保証） --}}
    <div class="text-black">

        <div class="max-w-6xl mx-auto mt-8 px-4">

            {{-- 成功メッセージ --}}
            @if (session('success'))
                <p class="mb-4 text-green-600 font-medium">
                    {{ session('success') }}
                </p>
            @endif

            @foreach ($order->checkouts as $checkout)

            <div class="mb-6">

            <p class="font-semibold">
                {{ $checkout->material->material_name }}
            </p>

            <p>
                {{ $checkout->material->material_overview }}
            </p>

            <p class="text-gray-500 text-sm">
                ※ ポートフォリオ用デモのため本文は省略しています。
            </p>

    </div>

@endforeach
            


        </div>

    </div>

</x-app-layout>