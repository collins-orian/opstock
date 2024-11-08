<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Add New Reagent') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">

                    <!-- Display Reagents -->
                    <div class="bg-gray-50 dark:bg-gray-700 rounded-lg p-6">
                        <form action="{{ route('reagents.add') }}" method="POST" class="space-y-4">
                            @csrf

                            <div>
                                <label class="block font-semibold text-gray-700 dark:text-gray-200 mt-6" for="name">Name</label>
                                <input type="text" id="name" name="name" required
                                       class="w-full p-2 border border-gray-300 rounded-md dark:border-gray-600 dark:bg-gray-800 focus:outline-none focus:ring-2 focus:ring-blue-500">
                            </div>

                            <div>
                                <label class="block font-semibold text-gray-700 dark:text-gray-200 mt-6" for="quantity">Quantity</label>
                                <input type="number" id="quantity" name="quantity" required
                                       class="w-full p-2 border border-gray-300 rounded-md dark:border-gray-600 dark:bg-gray-800 focus:outline-none focus:ring-2 focus:ring-blue-500">
                            </div>

                            <div>
                                <label class="block font-semibold text-gray-700 dark:text-gray-200 mt-6" for="expiry_date">Expiry Date</label>
                                <input type="date" id="expiry_date" name="expiry_date" required
                                       class="w-full p-2 border border-gray-300 rounded-md dark:border-gray-600 dark:bg-gray-800 focus:outline-none focus:ring-2 focus:ring-blue-500">
                            </div>

                            <button type="submit"
                                    class="w-full py-2 mt-6 bg-blue-600 text-black font-semibold rounded-md hover:bg-blue-700 transition duration-200">
                                Add Reagent
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
