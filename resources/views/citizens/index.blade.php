<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-2xl text-gray-800 dark:text-gray-200 leading-tight">
                {{ __('Citizen List') }}
            </h2>
            <a href="{{ route('citizens.create') }}" class="bg-indigo-600 hover:bg-indigo-700 text-white font-bold py-2 px-4 rounded shadow-md transition duration-300">
                + Add New Citizen
            </a>
        </div>
    </x-slot>
    
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <h2 class="text-white text-lg font-semibold mb-4">Citizen List</h2>
                    
                    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
                        @foreach ($citizens as $citizen)
                        <div class="bg-gray-100 dark:bg-gray-700 p-4 rounded-lg shadow-md overflow-hidden transition-transform transform hover:scale-105 hover:shadow-2xl duration-300">
                            <h3 class="text-lg font-semibold text-gray-900 dark:text-gray-200 mb-2 truncate">{{ $citizen->name }} {{ $citizen->surname }}</h3>
                            <p class="text-sm text-gray-700 dark:text-gray-400 mb-4">
                                <span class="font-semibold">Birthdate:</span> {{ $citizen->birthdate }}<br>
                                <span class="font-semibold">Address:</span> {{ $citizen->address }}<br>
                                <span class="font-semibold">Phone:</span> {{ $citizen->phone }}<br>
                                <span class="font-semibold">City:</span> {{ $citizen->city->name ?? 'N/A' }}
                            </p>
                            <div class="flex justify-between flex-wrap">
                                <a href="{{ route('citizens.edit', $citizen->id) }}" class="text-indigo-600 dark:text-indigo-400 hover:text-indigo-900 dark:hover:text-indigo-600 px-3 py-1 border border-indigo-600 dark:border-indigo-400 rounded">
                                    Edit
                                </a>
                                <form action="{{ route('citizens.destroy', $citizen->id) }}" method="POST" class="inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="text-red-600 dark:text-red-400 hover:text-red-900 dark:hover:text-red-600 px-3 py-1 border border-red-600 dark:border-red-400 rounded" onclick="return confirm('Are you sure?')">
                                        Delete
                                    </button>
                                </form>
                            </div>
                        </div>
                        @endforeach
                    </div>
                    
                    <div class="mt-6">
                        {{ $citizens->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
