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

            <p class="text-xl font-bold text-black mt-8 mb-6">
                購入内容の確認
            </p>

        <div class="font-semibold text-black space-y-1 bg-gray-200 p-4 mt-4 rounded-lg">

            <p>
                教材名 : {{ $materials->material_name }}
            </p>

            <p>
                教材価格 : ¥{{ number_format($materials->material_price) }}
            </p>

        </div>



            <p class="font-semibold text-black my-6">
                ・購入後はマイページから閲覧できます<br>
                ・いつでも再閲覧可能です<br>
                ※本サイトはポートフォリオ用のデモです。実際の決済は行われません。
            </p>

            <form 
                action="{{ route('checkout.confirm', $materials->slug) }}" 
                method="POST">

                @csrf

                <button
                    type="submit"
                    class="bg-[#C4E3E5] text-[#3C3C3C] px-6 py-2 rounded-lg font-semibold hover:bg-[#A9D6D9]">
                    購入する
                </button>

            </form>



        </div>

    </div>

</x-app-layout>
</body>
</html>
