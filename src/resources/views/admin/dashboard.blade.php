<x-app-layout>

    <div class="max-w-2xl mx-auto mt-10 space-y-6">

        <!-- タイトル -->
        <p class="text-gray-600 text-2xl font-semibold">
            管理者モード
        </p>

        <!-- ボタン群 -->
        <div class="space-y-4">

            <a href="{{ route('admin.materials.index') }}"
               class="block w-full text-center text-white text-xl font-bold py-6 rounded-2xl shadow-md hover:opacity-90 transition"
               style="background-color: #8097B9;">
                商品管理
            </a>

            <a href="{{ route('admin.orders.index') }}"
               class="block w-full text-center text-white text-xl font-bold py-6 rounded-2xl shadow-md hover:opacity-90 transition"
               style="background-color: #8980B9;">
                注文管理
            </a>

            <a href="{{ route('admin.users.index') }}"
               class="block w-full text-center text-white text-xl font-bold py-6 rounded-2xl shadow-md hover:opacity-90 transition"
               style="background-color: #A080B9;">
                ユーザー管理
            </a>

        </div>

    </div>

</x-app-layout>
