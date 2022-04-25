<x-admin-layout>
    <p class="text-2xl">Order #{{ $order->id }}</p>
    <div class="flex my-10  justify-around flex-wrap">
        <div>
            <p class="text-xl font-bold">Customer</p>
            <p><span class="font-bold">Name:</span> {{ $order->user->name }}</p>
            <p><span class="font-bold">Email:</span> {{ $order->user->email }}</p>
        </div>
        <div>
            <p class="text-xl font-bold">Shipment</p>
            <p>info</p>
        </div>
        <div>
            <form action="{{route('admin.orders.update)}}" method="post">
                @PATCH
                <p class="text-xl font-bold">Order status</p>
                <select name="status">
                    <option value="Preparing">Preparing</option>
                    <option value="Sent">Sent</option>
                    <option value="In delivery">In delivery</option>
                    <option value="Delivered">Delivered</option>
                </select>
                <input type="submit" value="Save" class="px-6 py-2 leading-5 text-white transition-colors duration-200 transform bg-gray-700 rounded-md hover:bg-gray-600 focus:outline-none focus:bg-gray-600 ml-3">
            </form>
        </div>

    </div>
    <div>

        <table class="min-w-full divide-y divide-gray-200">
            <thead class="bg-gray-50">
                <tr>
                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                        Product
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