<x-guest-layout>

    <div class="text-black">

        <div class="max-w-md mx-auto mt-20 px-6 py-8 bg-white shadow rounded-2xl">

            {{-- タイトル --}}
            <h2 class="text-xl font-bold mb-6 text-center">
                ログイン
            </h2>

            {{-- セッションメッセージ --}}
            <x-auth-session-status class="mb-4 text-green-600" :status="session('status')" />

            <form method="POST" action="{{ route('login') }}">
                @csrf

                {{-- メール --}}
                <div class="mb-4">
                    <label class="block font-semibold mb-1">メール</label>
                    <input
                        type="email"
                        name="email"
                        value="{{ old('email') }}"
                        class="w-full border rounded px-3 py-2"
                        required
                        autofocus
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

                {{-- Remember me --}}
                <div class="mb-4 flex items-center">
                    <input
                        id="remember_me"
                        type="checkbox"
                        name="remember"
                        class="mr-2"
                    >
                    <label for="remember_me" class="text-sm">
                        ログイン状態を保持する
                    </label>
                </div>

                {{-- ボタン --}}
                <button
                    type="submit"
                    class="w-full bg-[#80B5B9] text-white py-2 rounded hover:opacity-80"
                >
                    ログイン
                </button>

                {{-- パスワード忘れ --}}
                @if (Route::has('password.request'))
                    <div class="mt-4 text-center">
                        <a href="{{ route('password.request') }}"
                           class="text-sm text-gray-600 hover:text-gray-900 underline">
                            パスワードを忘れた方はこちら
                        </a>
                    </div>
                @endif

            </form>

        </div>

    </div>

</x-guest-layout>
