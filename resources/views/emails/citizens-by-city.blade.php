<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-2xl text-gray-800 dark:text-gray-200 leading-tight">
                {{ __('Ciudadanos por Ciudad') }}
            </h2>
        </div>
    </x-slot>
    
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <h2 class="text-white text-xl font-bold mb-6">Listado de Ciudadanos por Ciudad</h2>
                    
                    <!-- Cards con resumen de estadísticas -->
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-4 mb-8">
                        <!-- Card 1: Total de Ciudades -->
                        <div class="bg-blue-500 dark:bg-blue-600 text-white rounded-lg p-6 shadow-md">
                            <h3 class="font-bold text-xl mb-4">Total de Ciudades</h3>
                            <p class="text-3xl">{{ $cities->count() }}</p>
                        </div>

                        <!-- Card 2: Total de Ciudadanos -->
                        <div class="bg-green-500 dark:bg-green-600 text-white rounded-lg p-6 shadow-md">
                            <h3 class="font-bold text-xl mb-4">Total de Ciudadanos</h3>
                            <p class="text-3xl">{{ $cities->sum(fn($city) => $city->citizens->count()) }}</p>
                        </div>

                        <!-- Card 3: Ciudadanos por Ciudad -->
                        <div class="bg-yellow-500 dark:bg-yellow-600 text-white rounded-lg p-6 shadow-md">
                            <h3 class="font-bold text-xl mb-4">Ciudadanos por Ciudad</h3>
                        </div>
                    </div>

                    <!-- Lista de ciudades y ciudadanos -->
                    <div class="space-y-8">
                        @foreach ($cities as $city)
                        <div class="relative bg-white dark:bg-gray-700 rounded-xl shadow-lg overflow-hidden border border-gray-200 dark:border-gray-600">
                            <!-- Header con gradiente -->
                            <div class="bg-gradient-to-r from-indigo-500 to-purple-600 dark:from-indigo-600 dark:to-purple-700 p-4 flex justify-between items-center">
                                <h3 class="text-lg font-bold text-white">{{ $city->name }}</h3>
                                <span class="bg-white/20 text-white px-3 py-1 rounded-full text-sm font-semibold">
                                    {{ $city->citizens->count() }} ciudadano(s)
                                </span>
                            </div>
                            
                            <!-- Contenido -->
                            <div class="p-5">
                                @if($city->description)
                                <p class="text-gray-700 dark:text-gray-300 mb-4 text-sm italic">
                                    {{ $city->description }}
                                </p>
                                @endif
                                
                                <!-- Lista de ciudadanos -->
                                @if($city->citizens->isNotEmpty())
                                <div class="mt-4 space-y-3">
                                    <h4 class="text-md font-semibold text-gray-800 dark:text-gray-200 mb-2 border-b pb-2 border-gray-100 dark:border-gray-600">
                                        Ciudadanos registrados:
                                    </h4>
                                    
                                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                        @foreach($city->citizens as $citizen)
                                        <div class="bg-gray-50 dark:bg-gray-600 p-3 rounded-lg shadow-sm border border-gray-100 dark:border-gray-500">
                                            <div class="flex items-start space-x-3">
                                                <div class="flex-shrink-0 bg-indigo-100 dark:bg-indigo-900 text-indigo-800 dark:text-indigo-200 rounded-full p-2">
                                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                                                        <path fill-rule="evenodd" d="M10 9a3 3 0 100-6 3 3 0 000 6zm-7 9a7 7 0 1114 0H3z" clip-rule="evenodd" />
                                                    </svg>
                                                </div>
                                                <div>
                                                    <h5 class="font-medium text-gray-900 dark:text-white">{{ $citizen->name }}</h5>
                                                    <p class="text-sm text-gray-600 dark:text-gray-300">
                                                        <span class="font-medium">Phone Number:</span> {{ $citizen->phone }}
                                                    </p>
                                                </div>
                                            </div>
                                        </div>
                                        @endforeach
                                    </div>
                                </div>
                                @else
                                <div class="bg-yellow-50 dark:bg-yellow-900/20 border-l-4 border-yellow-400 dark:border-yellow-600 p-4 my-4 rounded">
                                    <div class="flex">
                                        <div class="flex-shrink-0">
                                            <svg class="h-5 w-5 text-yellow-400 dark:text-yellow-300" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                                                <path fill-rule="evenodd" d="M8.257 3.099c.765-1.36 2.722-1.36 3.486 0l5.58 9.92c.75 1.334-.213 2.98-1.742 2.98H4.42c-1.53 0-2.493-1.646-1.743-2.98l5.58-9.92zM11 13a1 1 0 11-2 0 1 1 0 012 0zm-1-8a1 1 0 00-1 1v3a1 1 0 002 0V6a1 1 0 00-1-1z" clip-rule="evenodd" />
                                            </svg>
                                        </div>
                                        <div class="ml-3">
                                            <p class="text-sm text-yellow-700 dark:text-yellow-300">
                                                Esta ciudad no tiene ciudadanos registrados.
                                            </p>
                                        </div>
                                    </div>
                                </div>
                                @endif
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>  
    </div>
</x-app-layout>
