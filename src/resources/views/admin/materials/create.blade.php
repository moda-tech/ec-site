<x-app-layout>

    <div class="text-black">
        <div class="max-w-5xl mx-auto mt-16 px-6 py-8 bg-white shadow rounded-2xl">

            {{-- 成功メッセージ --}}
            @if (session('success'))
                <div class="mb-6 px-4 py-3 bg-green-100 text-green-700 border border-green-300 rounded">
                    {{ session('success') }}
                </div>
            @endif

            <form action="{{ route('admin.materials.store') }}" method="POST" enctype="multipart/form-data">
                @csrf

                {{-- 商品名 --}}
                <div class="mb-4">
                    <label class="block font-semibold mb-1">商品名</label>
                    <input
                        type="text"
                        name="material_name"
                        value="{{ old('material_name') }}"
                        class="w-full border rounded px-3 py-2"
                    >
                </div>

                {{-- スラッグ --}}
                <div class="mb-4">
                    <label class="block font-semibold mb-1">スラッグ</label>
                    <input
                        type="text"
                        name="slug"
                        value="{{ old('slug') }}"
                        class="w-full border rounded px-3 py-2"
                    >
                </div>

                {{-- 商品画像 --}}
                <div class="mb-4">
                    <label class="block font-semibold mb-1">商品画像</label>
                    <input type="file" name="material_image" class="w-full">
                </div>

                {{-- 商品説明 --}}
                <div class="mb-6">
                    <label class="block font-semibold mb-2">概要</label>
                    <textarea
                        name="material_overview"
                        rows="8"
                        class="w-full border rounded px-4 py-3"
                    >{{ old('material_overview') }}</textarea>
                </div>

                {{-- 価格 --}}
                <div class="mb-4">
                    <label class="block font-semibold mb-1">価格</label>
                    <input
                        type="number"
                        name="material_price"
                        value="{{ old('material_price') }}"
                        class="w-full border rounded px-3 py-2"
                    >
                </div>

                {{-- 作成ボタン --}}
                <button
                    type="submit"
                    class="bg-[#80B5B9] text-white px-6 py-2 rounded hover:opacity-80"
                >
                    作成する
                </button>
            </form>

        </div>
    </div>

</x-app-layout>
