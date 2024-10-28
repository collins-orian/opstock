<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <h1 class="text-xl font-bold mb-4">Inventory Overview</h1>

                    <!-- Display List of Items -->
                    <div class="mb-6">
                        <h4 class="font-semibold text-md mb-2">Items Available</h4>
                        <table class="min-w-full bg-white dark:bg-gray-700 border border-gray-300 dark:border-gray-600 rounded-lg">
                            <thead class="bg-gray-100 dark:bg-gray-900">
                            <tr>
                                <th class="py-2 px-4 border-b">Item Name</th>
                                <th class="py-2 px-4 border-b">Quantity</th>
                                <th class="py-2 px-4 border-b">Created At</th>
                                <th class="py-2 px-4 border-b">Updated At</th>
                                <th class="py-2 px-4 border-b">Action</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($items as $item)
                                <tr class="border-b hover:bg-gray-50 dark:hover:bg-gray-800">
                                    <td class="py-2 px-4">{{ $item->name }}</td>
                                    <td class="py-2 px-4">{{ $item->quantity }}</td>
                                    <td class="py-2 px-4">
                                        {{ $item->created_at->format('d, F Y - H:i') }}
                                    </td>
                                    <td class="py-2 px-4">
                                        {{ $item->updated_at->format('d, F Y - H:i') }}
                                    </td>
                                    <td class="py-2 px-4 flex space-x-2">
                                        <!-- Edit Button -->
{{--                                        <a href="{{ route('item.edit', $item->id) }}" class="bg-blue-500 text-white px-3 py-1 rounded-md hover:bg-blue-600 focus:outline-none focus:ring-2 focus:ring-blue-500">Edit</a>--}}

                                        <!-- Delete Button -->
                                        <form action="{{ route('item.delete', $item->id) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this item?');">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="bg-red-500 text-black px-3 py-1 rounded-md hover:bg-red-600 focus:outline-none focus:ring-2 focus:ring-red-500">Delete</button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>

                    <!-- Add Item Form -->
                    <div class="mb-6">
                        <h4 class="font-semibold text-md mb-2">Add New Item</h4>
                        <form action="{{ route('item.add') }}" method="POST" class="flex items-center space-x-4">
                            @csrf
                            <input type="text" name="name" placeholder="Item Name" class="border border-gray-300 dark:border-gray-600 p-2 rounded-md focus:outline-none focus:ring-2 focus:ring-orange-500" required>
                            <input type="number" name="quantity" placeholder="Quantity" class="border border-gray-300 dark:border-gray-600 p-2 rounded-md focus:outline-none focus:ring-2 focus:ring-orange-500" required>
                            <button type="submit" class="bg-navy-500 text-black px-4 py-2 rounded-md hover:bg-navy-600 focus:outline-none focus:ring-2 focus:ring-orange-500">Add Item</button>
                        </form>
                    </div>

                    <!-- Stock In and Stock Out Forms -->
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <!-- Stock In Form -->
                        <div>
                            <h4 class="font-semibold text-md mb-2">Stock In</h4>
                            <form action="{{ route('item.stock-in') }}" method="POST" class="flex items-center space-x-4">
                                @csrf
                                <select name="item_id" class="border border-gray-300 dark:border-gray-600 p-2 rounded-md focus:outline-none focus:ring-2 focus:ring-orange-500" required>
                                    <option value="">Select Item</option>
                                    @foreach($items as $item)
                                        <option value="{{ $item->id }}">{{ $item->name }}</option>
                                    @endforeach
                                </select>
                                <input type="number" name="quantity" placeholder="Quantity to Stock In" class="border border-gray-300 dark:border-gray-600 p-2 rounded-md focus:outline-none focus:ring-2 focus:ring-orange-500" required>
                                <button type="submit" class="bg-blue-500 text-black px-4 py-2 rounded-md hover:bg-blue-600 focus:outline-none focus:ring-2 focus:ring-orange-500">Stock In</button>
                            </form>
                        </div>

                        <!-- Stock Out Form -->
                        <div>
                            <h4 class="font-semibold text-md mb-2">Stock Out</h4>
                            <form action="{{ route('item.stock-out') }}" method="POST" class="flex items-center space-x-4">
                                @csrf
                                <select name="item_id" class="border border-gray-300 dark:border-gray-600 p-2 rounded-md focus:outline-none focus:ring-2 focus:ring-orange-500" required>
                                    <option value="">Select Item</option>
                                    @foreach($items as $item)
                                        <option value="{{ $item->id }}">{{ $item->name }} (Current: {{ $item->quantity }})</option>
                                    @endforeach
                                </select>
                                <input type="number" name="quantity" placeholder="Quantity to Stock Out" class="border border-gray-300 dark:border-gray-600 p-2 rounded-md focus:outline-none focus:ring-2 focus:ring-orange-500" required>
                                <button type="submit" class="bg-block text-black px-4 py-2 rounded-md hover:bg-red-600 focus:outline-none focus:ring-2 focus:ring-orange-500">Stock Out</button>
                            </form>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
</x-app-layout>
