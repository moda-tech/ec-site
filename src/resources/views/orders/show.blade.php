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

            <div class="mb-10 text-center max-w-2xl mx-auto">

            <h2 class="text-2xl font-bold mb-4">
                {{ $checkout->material->material_name }}
            </h2>

            <p class="text-gray-700 leading-relaxed mb-4">
                {{ $checkout->material->material_overview }}
            </p>

            <p class="text-gray-400 text-sm">
                ※ ポートフォリオ用デモのため本文は省略しています。
            </p>

            </div>

            @endforeach

            


        </div>

    </div>

</x-app-layout>