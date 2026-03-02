<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>ログイン</title>

    <!-- フォント -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

    <!-- CSS -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="font-sans bg-gray-100 text-black">

    <div class="min-h-screen flex items-center justify-center">

        <div class="w-full max-w-md px-6 py-8 bg-white shadow rounded-2xl">

            <div class="text-center mt-20">
                <a href="{{ route('orders.index') }}">
                    <img 
                        src="{{ asset('images/Hello_Code.png') }}" 
                        class="h-8 mx-auto"
                        alt="ロゴ"
                    >
                </a>
            </div>

            {{-- 中身 --}}
            {{ $slot }}

        </div>

    </div>

</body>
</html>
