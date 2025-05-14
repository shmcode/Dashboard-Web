<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Editar Ciudadano') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <form method="POST" action="{{ route('citizens.update', $citizen->id) }}">
                        @csrf
                        @method('PUT')

                        <div class="mb-4">
                            <label for="name" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Name</label>
                            <input type="text" name="name" id="name" value="{{ old('name', $citizen->name) }}"
                                   class="mt-1 block w-full rounded-md border-gray-300 dark:border-gray-600 shadow-sm focus:ring-indigo-500 dark:bg-gray-700 dark:text-white" required>
                            @error('name')
                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="mb-4">
                            <label for="surname" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Surname</label>
                            <input type="text" name="surname" id="surname" value="{{ old('surname', $citizen->surname) }}"
                                   class="mt-1 block w-full rounded-md border-gray-300 dark:border-gray-600 shadow-sm focus:ring-indigo-500 dark:bg-gray-700 dark:text-white" required>
                            @error('surname')
                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="mb-4">
                            <label for="birthdate" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Birthdate</label>
                            <input type="date" name="birthdate" id="birthdate" value="{{ old('birthdate', $citizen->birthdate) }}"
                                   class="mt-1 block w-full rounded-md border-gray-300 dark:border-gray-600 shadow-sm focus:ring-indigo-500 dark:bg-gray-700 dark:text-white" required>
                            @error('birthdate')
                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="mb-4">
                            <label for="city_id" class="block text-sm font-medium text-gray-700 dark:text-gray-300">City</label>
                            <select name="city_id" id="city_id"
                                    class="mt-1 block w-full rounded-md border-gray-300 dark:border-gray-600 shadow-sm focus:ring-indigo-500 dark:bg-gray-700 dark:text-white" required>
                                @foreach ($cities as $city)
                                    <option value="{{ $city->id }}" {{ old('city_id', $citizen->city_id) == $city->id ? 'selected' : '' }}>
                                        {{ $city->name }}
                                    </option>
                                @endforeach
                            </select>
                            @error('city_id')
                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="mb-4">
                            <label for="address" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Address</label>
                            <textarea name="address" id="address" rows="3"
                                      class="mt-1 block w-full rounded-md border-gray-300 dark:border-gray-600 shadow-sm focus:ring-indigo-500 dark:bg-gray-700 dark:text-white">{{ old('address', $citizen->address) }}</textarea>
                            @error('address')
                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="mb-4">
                            <label for="phone" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Phone</label>
                            <input type="text" name="phone" id="phone" value="{{ old('phone', $citizen->phone) }}"
                                   class="mt-1 block w-full rounded-md border-gray-300 dark:border-gray-600 shadow-sm focus:ring-indigo-500 dark:bg-gray-700 dark:text-white">
                            @error('phone')
                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="flex items-center justify-end">
                            <button type="submit" class="bg-indigo-600 text-white px-4 py-2 rounded-md hover:bg-indigo-700">
                                Actualizar Ciudadano
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>