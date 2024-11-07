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
                    <div>
                        <form action="{{ route('reagents.add') }}" method="POST">
                            @csrf
                            <label class="font-semibold py-4 px-4 border-b" for="name">Name</label>
                            <input type="text" id="name" name="name" required>

                            <label class="font-semibold py-4 px-4 border-b" for="quantity">Quantity</label>
                            <input type="number" id="quantity" name="quantity" required>

                            <label class="font-semibold py-4 px-4 border-b" for="expiry_date">Expiry Date</label>
                            <input type="date" id="expiry_date" name="expiry_date" required>

                            <button class="font-semibold text-md mb-2 py-4 px-4" type="submit">Add Reagent</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
