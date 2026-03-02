<x-app-layout>

@if (session('success'))
    <div class="mb-6 px-4 py-3 bg-green-100 text-green-700 border border-green-300 rounded">
        {{ session('success') }}
    </div>
@endif

<div class="mt-6 ml-6">
    <a href="{{ route('admin.materials.create') }}"
       class="inline-flex items-center gap-2 bg-[#80B5B9] text-white px-6 py-3 rounded-lg text-sm font-semibold shadow-md hover:opacity-80 hover:shadow-lg transition">
        ＋ 商品を追加
    </a>
</div>


<div class="max-w-7xl mx-auto p-6">
    <table class="min-w-full border border-gray-300 rounded-lg overflow-hidden">
        <thead class="bg-gray-100">
            <tr>
                <th class="px-4 py-2 text-left">ID</th>
                <th class="px-4 py-2 text-left">商品名</th>
                <th class="px-4 py-2 text-left">画像</th>
                <th class="px-4 py-2 text-left">概要</th>
                <th class="px-4 py-2 text-left">価格</th>
                <th class="px-4 py-2 text-left">スラッグ</th>
                <th class="px-4 py-2 text-left">作成日</th>
                <th class="px-4 py-2 text-left">操作</th>
            </tr>
        </thead>

        <tbody>
            @foreach ($materials as $material)
                <tr class="border-t hover:bg-gray-50">
                    <td class="px-4 py-2">{{ $material->id }}</td>

                    <td class="px-4 py-2 font-semibold">
                        {{ $material->material_name }}
                    </td>

                    <td class="px-4 py-2">
                        <img src="{{ asset($material->material_image) }}" class="w-16 h-16 object-cover rounded">
                    </td>

                    <td class="px-4 py-2 text-sm text-gray-600">
                        {{ \Illuminate\Support\Str::limit($material->material_overview, 25) }}
                    </td>

                    <td class="px-4 py-2">
                        ¥{{ number_format($material->material_price) }}
                    </td>

                    <td class="px-4 py-2 text-gray-500">
                        {{ $material->slug }}
                    </td>

                    <td class="px-4 py-2 text-sm">
                        {{ $material->created_at->format('Y-m-d') }}
                    </td>

                   <td class="px-4 py-2 flex items-center space-x-2">
                        <!-- 編集 -->
                        <a href="{{ route('admin.materials.edit', $material->slug) }}"
                        class="px-3 py-1 text-white rounded hover:opacity-80"
                        style="background-color:#80B5B9;">
                            編集
                        </a>

                        <!-- 削除 -->
                        <form action="{{ route('admin.materials.destroy', $material->id) }}"
                            method="POST">
                            @csrf
                            @method('DELETE')
                            <button type="submit"
                                onclick="return confirm('本当に削除しますか？')"
                                class="px-3 py-1 text-white rounded"
                                style="background-color:#B9808D;">
                                削除
                            </button>
                        </form>
                    </td>

                </tr>
            @endforeach
        </tbody>
    </table>

    <div class="mt-4">
        {{ $materials->links() }}
    </div>
</div>

</x-app-layout>
