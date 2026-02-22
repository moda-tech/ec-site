<x-app-layout>

    {{-- ページ全体ラッパー（文字色保証） --}}
    <div class="text-black">

        <div class="max-w-xl mx-auto mt-16 px-6 py-8 bg-white shadow rounded-2xl">


            {{-- 成功メッセージ --}}
            @if (session('success'))
                <p class="mb-4 text-green-600 font-medium">
                    {{ session('success') }}
                </p>
            @endif

            <p class="font-semibold text-black">
                商品：{{ $materials->material_name }}
            </p>

            <p class="font-semibold text-black">
                概要：{{ $materials->material_overview }}
            </p>
            
            <div class="flex items-center justify-between mt-6">

                {{-- 価格 --}}
                <p class="text-2xl font-bold text-gray-900">
                    ¥{{ number_format($materials->material_price) }}
                </p>

                {{-- 購入ボタン --}}
                <a 
                    href="{{ route('checkout.show', $materials->slug) }}"
                    class="bg-[#C4E3E5] text-[#3C3C3C] px-6 py-2 rounded-lg font-semibold hover:bg-[#A9D6D9]">
                    購入する
                </a>

            </div>


            </div>



        </div>

    </div>

</x-app-layout>
</body>
</html>
