<x-app-layout>

      {{-- ページ全体ラッパー（文字色保証） --}}
    <div class="text-black">

        <div class="max-w-5xl mx-auto mt-16 px-6 py-8 bg-white shadow rounded-2xl">


            {{-- 成功メッセージ --}}
            @if (session('success'))
                <p class="mb-4 text-green-600 font-medium">
                    {{ session('success') }}
                </p>
            @endif

            <form action="{{ route('admin.materials.update', $materials->slug) }}" method="POST">
                @csrf
                @method('PUT')

                {{-- 商品名 --}}
                <div class="mb-4">
                    <label class="block font-semibold mb-1">商品名</label>
                    <input
                        type="text"
                        name="material_name"
                        value="{{ old('material_name', $materials->material_name) }}"
                        class="w-full border rounded px-3 py-2"
                    >
                </div>

                {{-- スラッグ --}}
                <div class="mb-4">
                    <label class="block font-semibold mb-1">スラッグ</label>
                    <input
                        type="text"
                        name="slug"
                        value="{{ old('slug', $materials->slug) }}"
                        class="w-full border rounded px-3 py-2"
                    >
                </div>

                {{-- 商品画像 --}}
                <div class="mb-4">
                    <label class="block font-semibold mb-1">現在の画像</label>

                    @if($materials->material_image)
                        <img src="{{ asset('storage/' . $materials->material_image) }}" class="w-32 mb-2">
                    @endif

                    <input type="file" name="material_image" class="w-full">
                </div>

                {{-- 商品説明 --}}
                <div class="mb-6">
                    <label class="block font-semibold mb-2">概要</label>
                    <textarea
                        name="material_overview"
                        rows="8"
                        class="w-full border rounded px-4 py-3"
                    >{{ old('material_overview', $materials->material_overview) }}</textarea>
                </div>

                {{-- 価格 --}}
                <div class="mb-4">
                    <label class="block font-semibold mb-1">価格</label>
                    <input
                        type="number"
                        name="material_price"
                        value="{{ old('material_price', $materials->material_price) }}"
                        class="w-full border rounded px-3 py-2"
                    >
                </div>

                {{-- 更新ボタン --}}
                <button
                    type="submit"
                    class="bg-[#80B5B9] text-white px-6 py-2 rounded hover:opacity-80"
                >
                    更新する
                </button>
            </form>



            </div>



        </div>

    </div>          
</x-app-layout>