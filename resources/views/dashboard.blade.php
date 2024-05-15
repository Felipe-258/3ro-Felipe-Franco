<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    {{ __("You're logged in!") }}
                </div>
                <div class="button-grid">
                    <a href="{{ route('products.index') }}" class="button">Products</a>
                    <a href="{{ route('students.index') }}" class="button">Students</a>
                    <a href="{{ route('assist.form') }}" class="button">Assist Form</a>
                    <a href="{{ route('notes.index') }}" class="button">Notes</a>
                </div>
                
            </div>
        </div>
    </div>
    <style>
        .button-grid {
    display: grid;
    grid-template-columns: repeat(4, 1fr);
    gap: 10px;
}

.button {
    display: inline-block;
    padding: 10px 20px;
    background-color: #4CAF50;
    color: white;
    text-align: center;
    text-decoration: none;
    border: none;
    border-radius: 5px;
    cursor: pointer;
    transition: background-color 0.3s;
}

.button:hover {
    background-color: #45a049;
}

    </style>
</x-app-layout>

