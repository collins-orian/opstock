<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Reagents') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">

                    <!-- Display Reagents -->
                    <div class="mb-6">
                        <h4 class="font-semibold text-md mb-4">Reagents Available</h4>
                        <table class="min-w-full bg-white dark:bg-gray-700 border border-gray-300 dark:border-gray-600 rounded-lg">
                            <thead class="bg-gray-100 dark:bg-gray-900">
                                <tr>
                                    <th class="py-2 px-4 border-b">Name</th>
                                    <th class="py-2 px-4 border-b">Quantity</th>
                                    <th class="py-2 px-4 border-b">Expiry Date</th>
                                    <th class="py-2 px-4 border-b">Registered By</th>
                                    <th class="py-2 px-4 border-b">Created At</th>
                                    <th class="py-2 px-4 border-b">Updated At</th>
                                    <th class="py-2 px-4 border-b">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($reagents as $reagent)
                                    <tr class="border-b hover:bg-gray-50 dark:hover:bg-gray-800">
                                        <td class="py-2 px-4">{{ $reagent->name }}</td>
                                        <td class="py-2 px-4">{{ $reagent->quantity }}</td>
                                        <td class="py-2 px-4">{{ $reagent->expiry_date ? $reagent->expiry_date->format('d, F Y') : 'N/A' }}</td>
                                        <td class="py-2 px-4">{{ $reagent->creator ? $reagent->creator->name : 'N/A' }}</td>
                                        <td class="py-2 px-4">
                                            {{ $reagent->created_at->format('d, F Y - H:i') }}
                                        </td>
                                        <td class="py-2 px-4">
                                            {{ $reagent->updated_at->format('d, F Y - H:i') }}
                                        </td>
                                        <td class="py-2 px-4 flex space-x-2">
                                            <!-- Edit Button -->
                                            {{--                                        <a href="{{ route('reagent.edit', $reagent->id) }}" class="bg-blue-500 text-white px-3 py-1 rounded-md hover:bg-blue-600 focus:outline-none focus:ring-2 focus:ring-blue-500">Edit</a>--}}

                                            <!-- Delete Button -->
                                            <form action="{{ route('reagents.delete', $reagent->id) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this item?');">
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
                    <!-- Link to Add Reagent -->
                    <a href="{{ route('reagents.create') }}" class="btn btn-primary font-semibold text-md mb-2">Add New Reagent</a>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
