<x-app-layout>

    {{-- ページ全体ラッパー（文字色保証） --}}
    <div class="text-black">

        {{-- ページタイトル --}}
        <div class="max-w-6xl mx-auto mt-8 px-4">
            <h1 class="text-2xl font-bold">講座一覧</h1>
        </div>

        <div class="max-w-6xl mx-auto mt-8 px-4">

            {{-- 成功メッセージ --}}
            @if (session('success'))
                <p class="mb-4 text-green-600 font-medium">
                    {{ session('success') }}
                </p>
            @endif

            @if ($materials->count() === 0)

                <p class="text-gray-500">
                    登録されているコンテンツはありません。
                </p>

            @else

            {{-- グリッド --}}
            <div class="grid gap-6
                        grid-cols-1
                        sm:grid-cols-2
                        lg:grid-cols-3
                        xl:grid-cols-4">

                @foreach ($materials as $material)
                    @php
                        $isPurchased = in_array($material->id, $purchasedMaterialIds);
                    @endphp

                @if(!$isPurchased)
                <a
                    href="{{ route('material.show', $material->slug) }}"
                    class="block"
                >
                @endif

                    <div class="
                        bg-[#D8F0F2]
                        rounded-xl
                        p-4
                        shadow-sm
                        transition
                        hover:-translate-y-1
                        hover:shadow-lg
                    ">

                        {{-- 画像 --}}
                        <img
                            src="{{ asset('images/' . $material->material_image) }}"
                            alt="{{ $material->material_image }} のレッスン画像"
                            class="
                                w-full
                                h-36
                                object-cover
                                rounded-lg
                                bg-[#F7F9FA]
                            "
                        >

                        {{-- テキスト --}}
                        <div class="mt-3 text-sm">

                            <p class="font-semibold text-black">
                                {{ $material->material_name }}
                            </p>

                            @if($isPurchased)
                            <p class="text-black">
                                購入済み
                            </p>
                            @else
                            <p class="text-black">
                             ¥{{ number_format($material->material_price) }}
                            </p>
                            @endif

                        </div>

                    </div>
                </a>

                @endforeach

            </div>

            {{-- ページネーション --}}
            <div class="mt-8 flex justify-center">
                {{ $materials->links() }}
            </div>

            @endif

        </div>

    </div>

</x-app-layout>
</body>
</html>
