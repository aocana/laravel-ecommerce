<x-admin-layout>
    <div class="flex justify-between items-center mb-5">
        <p class="text-2xl">Brands</p>
        <a href="{{ route('admin.brands.create') }}">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                <path stroke-linecap="round" stroke-linejoin="round" d="M12 9v3m0 0v3m0-3h3m-3 0H9m12 0a9 9 0 11-18 0 9 9 0 0118 0z" />
            </svg>
        </a>
    </div>
    <div class="flex flex-col w-6/12">
        <div class="-my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
            <div class="py-2 align-middle inline-block min-w-full sm:px-6 lg:px-8">
                <form action="{{route('admin.brands.search')}}" method="get">
                    <input type="search" class="w-full py-2 pl-10 pr-4 text-gray-700 bg-white border rounded-md focus:border-blue-400 focus:outline-none focus:ring focus:ring-opacity-40 focus:ring-blue-300" placeholder="Search brand..." maxlength="30" name="query">
                </form>
                @if(count($brands)>0)
                <div class="shadow overflow-hidden border-b border-gray-200 sm:rounded-lg">
                    <table class="min-w-full divide-y divide-gray-200">
                        <thead class="bg-gray-50">
                            <tr>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Name</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                            @foreach($brands as $brand)
                            <tr class="flex items-center justify-between">
                                <td class="px-6 whitespace-nowrap">
                                    {{ $brand->name }}
                                </td>
                                <td class="px-6 whitespace-nowrap text-right text-sm font-medium flex justify-center items-center gap-5">
                                    <a href="{{ route('admin.brands.edit', $brand) }}" class="text-indigo-600 hover:text-indigo-900">Edit</a>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                @else
                <p>No results found...</p>
                @endif
                {{ $brands->links() }}
            </div>
        </div>
    </div>
</x-admin-layout>