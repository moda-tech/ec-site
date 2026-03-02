<x-app-layout>

    <div class="max-w-5xl mx-auto mt-10 px-6">

        @forelse ($orders as $order)

            @foreach ($order->checkouts as $checkout)

                <a href="{{ route('orders.show', $order->id) }}"
                   class="block mb-6">

                    <div class="bg-white shadow rounded-2xl overflow-hidden hover:shadow-md transition">

                        <img
                            src="{{ asset('images/' . $checkout->material->material_image) }}"
                            alt="{{ $checkout->material->material_name }}"
                            class="w-full h-48 object-cover bg-[#F7F9FA]"
                        >

                        <div class="p-4">
                            <p class="font-semibold text-lg">
                                {{ $checkout->material->material_name }}
                            </p>
                        </div>

                    </div>

                </a>

            @endforeach

        @empty

            <p class="text-center text-gray-500 mt-10">
                購入済みの商品がありません
            </p>

        @endforelse

    </div>

</x-app-layout>
