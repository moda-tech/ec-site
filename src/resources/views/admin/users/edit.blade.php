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

            <form action="{{ route('admin.users.update', $user->id) }}" method="POST">
                @csrf
                @method('PUT')

                {{-- 名前 --}}
                <div class="mb-4">
                    <label class="block font-semibold mb-1">名前</label>
                    <input
                        type="text"
                        name="name"
                        value="{{ old('name', $user->name) }}"
                        class="w-full border rounded px-3 py-2"
                    >
                </div>

                {{-- メール --}}
                <div class="mb-6">
                    <label class="block font-semibold mb-2">メール</label>
                    <textarea
                        name="email"
                        class="w-full border rounded px-4 py-3"
                    >{{ old('email', $user->email) }}</textarea>
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