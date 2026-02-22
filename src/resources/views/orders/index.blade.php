<x-app-layout>

    @foreach ($orders as $order)
        @foreach ($order->checkouts as $checkout)

            <a href="{{ route('orders.show', $order->id) }}"
                class="block"
            >

            <img
                src="{{ asset('images/' . $checkout->material->material_image) }}"
                alt="{{ $checkout->material->material_name }} の画像"
                class="w-full h-36 object-cover rounded-lg bg-[#F7F9FA]"
            >

            {{ $checkout->material->material_name }}

            </a>

        @endforeach
    @endforeach

</x-app-layout>
