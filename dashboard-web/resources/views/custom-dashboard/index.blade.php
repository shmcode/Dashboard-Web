<x-app-layout>
    <x-slot name="header">
        <h2 class="font-bold text-2xl text-gray-900 tracking-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-10 bg-gray-100 min-h-screen">
        <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8">
            <!-- Cards Container -->
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
                <!-- Card 1: Total de ciudades -->
                <div class="bg-white shadow-lg rounded-xl p-6 transition duration-200 hover:shadow-xl">
                    <div class="flex items-center justify-between">
                        <div>
                            <h3 class="text-lg font-semibold text-gray-600">Total de Ciudades</h3>
                            <p class="text-3xl font-bold text-blue-600 mt-2">{{ $totalCities }}</p>
                        </div>
                        <div class="bg-blue-100 p-3 rounded-full">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 text-blue-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4" />
                            </svg>
                        </div>
                    </div>
                </div>

                <!-- Card 2: Total de ciudadanos -->
                <div class="bg-white shadow-lg rounded-xl p-6 transition duration-200 hover:shadow-xl">
                    <div class="flex items-center justify-between">
                        <div>
                            <h3 class="text-lg font-semibold text-gray-600">Total de Ciudadanos</h3>
                            <p class="text-3xl font-bold text-green-600 mt-2">{{ $totalCitizens }}</p>
                        </div>
                        <div class="bg-green-100 p-3 rounded-full">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 text-green-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z" />
                            </svg>
                        </div>
                    </div>
                </div>

                <!-- Card 3: Ciudadanos por ciudad -->
                <div class="bg-white shadow-lg rounded-xl p-6 transition duration-200 hover:shadow-xl">
                    <h3 class="text-lg font-semibold text-gray-600 mb-4">Ciudadanos por Ciudad</h3>
                    <div class="space-y-3 max-h-60 overflow-y-auto pr-2">
                        @forelse($citizensByCity as $city)
                            <div class="flex justify-between items-center border-b border-gray-100 pb-2">
                                <span class="text-gray-700">{{ $city->name }}</span>
                                <span class="bg-purple-100 text-purple-800 text-sm font-semibold px-3 py-1 rounded-full">
                                    {{ $city->citizens_count }} ciudadanos
                                </span>
                            </div>
                        @empty
                            <p class="text-gray-500 text-center py-4">No hay datos disponibles</p>
                        @endforelse
                    </div>
                </div>
            </div>

        </div>
    </div>
</x-app-layout>