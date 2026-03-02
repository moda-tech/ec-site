<x-app-layout>

@if (session('success'))
    <div class="mb-6 px-4 py-3 bg-green-100 text-green-700 border border-green-300 rounded">
        {{ session('success') }}
    </div>
@endif

<div class="max-w-7xl mx-auto p-6">
    <table class="min-w-full border border-gray-300 rounded-lg overflow-hidden">
        <thead class="bg-gray-100">
            <tr>
                <th class="px-4 py-2 text-left">ID</th>
                <th class="px-4 py-2 text-left">名前</th>
                <th class="px-4 py-2 text-left">メール</th>
                <th class="px-4 py-2 text-left">作成日</th>
                <th class="px-4 py-2 text-left">操作</th>
            </tr>
        </thead>

        <tbody>
            @foreach ($users as $user)
                <tr class="border-t hover:bg-gray-50">
                    <td class="px-4 py-2">{{ $user->id }}</td>

                    <td class="px-4 py-2 font-semibold">
                        {{ $user->name }}
                    </td>

                    <td class="px-4 py-2 text-gray-600">
                        {{ $user->email }}
                    </td>

                    <td class="px-4 py-2 text-sm">
                        {{ $user->created_at->format('Y-m-d') }}
                    </td>

                    <td class="px-4 py-2 flex items-center space-x-2">
                        <!-- 編集 -->
                        <a href="{{ route('admin.users.edit', $user->id) }}"
                           class="px-3 py-1 text-white rounded hover:opacity-80"
                           style="background-color:#80B5B9;">
                            編集
                        </a>

                        <!-- 削除 -->
                        <form action="{{ route('admin.users.destroy', $user->id) }}"
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
        {{ $users->links() }}
    </div>
</div>

</x-app-layout>
