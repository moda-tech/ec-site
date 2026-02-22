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

            <p class="font-semibold text-black">
                ご利用ありがとうございました。
            </p>

        </div>

    </div>

</x-app-layout>
</body>
</html>
