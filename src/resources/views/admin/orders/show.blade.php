<x-admin-layout>
    <p class="text-2xl">Order #{{ $order->id }}</p>
    <div>
        <p>Customer</p>
        <p>Name:{{ $order->user->name }}</p>
        <p>Email:{{ $order->user->email }}</p>
    </div>
    <div>

        <table class="min-w-full divide-y divide-gray-200">
            <thead class="bg-gray-50">
                <tr>
                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                        Name
                    </th>
                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                        Quantity
                    </th>
                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                        Unit Price
                    </th>
                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                        Total
                    </th>
                </tr>
            </thead>
            <tbody class="bg-white divide-y divide-gray-200">
                @foreach ($order->orderProduct as $detail)
                <tr>
                    <td class="px-6 py-4 whitespace-nowrap">
                        <div class="text-sm text-left text-gray-900">{{ $detail->product->name }}</div>
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap">
                        <div class="text-sm text-left text-gray-900">{{ $detail->quantity }}</div>
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap">
                        <div class="text-sm text-left text-gray-900">{{ $detail->unit_price }} €</div>
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap">
                        <div class="text-sm text-left text-gray-900">{{ $detail->unit_price * $detail->quantity}} €</div>
                    </td>
                </tr>
                @endforeach
                <tr class="font-bold">
                    <td colspan="2"></td>
                    <td class="px-6 py-4 whitespace-nowrap text-right">TOTAL</td>
                    <td class="px-6 py-4 whitespace-nowrap">{{ $order->total }}€</td>
                </tr>
            </tbody>
        </table>
    </div>
</x-admin-layout>