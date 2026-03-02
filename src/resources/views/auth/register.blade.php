<x-guest-layout>

    <h2 class="text-xl font-bold text-center mt-10 mb-6">
        新規登録
    </h2>

    <form method="POST" action="{{ route('register') }}">
        @csrf

        {{-- 名前 --}}
        <div class="mb-4">
            <label class="block font-semibold mb-1">名前</label>
            <input
                type="text"
                name="name"
                value="{{ old('name') }}"
                class="w-full border rounded px-3 py-2"
                required
                autofocus
            >
            <x-input-error :messages="$errors->get('name')" class="mt-2" />
        </div>

        {{-- メール --}}
        <div class="mb-4">
            <label class="block font-semibold mb-1">メール</label>
            <input
                type="email"
                name="email"
                value="{{ old('email') }}"
                class="w-full border rounded px-3 py-2"
                required
            >
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        {{-- パスワード --}}
        <div class="mb-4">
            <label class="block font-semibold mb-1">パスワード</label>
            <input
                type="password"
                name="password"
                class="w-full border rounded px-3 py-2"
                required
            >
            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        {{-- 確認 --}}
        <div class="mb-6">
            <label class="block font-semibold mb-1">パスワード確認</label>
            <input
                type="password"
                name="password_confirmation"
                class="w-full border rounded px-3 py-2"
                required
            >
            <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
        </div>

        {{-- ボタン --}}
        <button
            type="submit"
            class="w-full bg-[#80B5B9] text-white py-2 rounded hover:opacity-80"
        >
            登録する
        </button>

        {{-- ログインリンク --}}
        <div class="mt-4 text-center">
            <a href="{{ route('login') }}"
               class="text-sm text-gray-600 hover:text-gray-900 underline">
                すでにアカウントをお持ちの方はこちら
            </a>
        </div>

    </form>

</x-guest-layout>
