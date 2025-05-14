<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-2xl text-gray-800 dark:text-gray-200 leading-tight">
                {{ __('Cities') }}
            </h2>
            <a href="{{ route('cities.create') }}" class="bg-indigo-600 hover:bg-indigo-700 text-white font-bold py-2 px-4 rounded shadow-md transition duration-300">
                + Nuevo Registro
            </a>
        </div>
    </x-slot>
    
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <h2 class="text-white text-lg font-semibold mb-4">Listado de Ciudades</h2>
                    
                    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
                        @foreach ($cities as $city)
                        <div class="bg-gray-100 dark:bg-gray-700 p-4 rounded-lg shadow-md overflow-hidden transition-transform transform hover:scale-105 hover:shadow-2xl duration-300">
                            <h3 class="text-lg font-semibold text-gray-900 dark:text-gray-200 mb-2 truncate">{{ $city->name }}</h3>
                            <p class="text-sm text-gray-700 dark:text-gray-400 mb-4 overflow-hidden text-ellipsis">
                                @if($city->description)
                                    {{ $city->description }}
                                @else
                                    <span class="text-gray-400 dark:text-gray-500 italic">No hay descripción disponible</span>
                                @endif
                            </p>
                            <div class="flex justify-between flex-wrap">
                                <!-- Botón Editar -->
                                <button type="button" class="text-indigo-600 dark:text-indigo-400 hover:text-indigo-900 dark:hover:text-indigo-600 px-3 py-1 border border-indigo-600 dark:border-indigo-400 rounded" onclick="openEditModal({{ $city->id }})">
                                    Editar
                                </button>
                                
                                <!-- Botón Borrar -->
                                <button type="button" class="text-red-600 dark:text-red-400 hover:text-red-900 dark:hover:text-red-600 px-3 py-1 border border-red-600 dark:border-red-400 rounded" onclick="openDeleteModal({{ $city->id }})">
                                    Borrar
                                </button>
                            </div>
                        </div>
                        @endforeach
                    </div>
                    <div class="mt-6">
                        {{ $cities->withQueryString()->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Modales fuera del contenedor principal -->
    @foreach ($cities as $city)
    <!-- Modal Editar -->
    <div id="edit-modal-{{ $city->id }}" class="hidden fixed inset-0 bg-gray-800 bg-opacity-75 flex items-center justify-center z-50">
        <div class="bg-white dark:bg-gray-700 rounded-lg shadow-lg p-6 w-96">
            <h2 class="text-lg font-semibold text-gray-900 dark:text-gray-200 mb-4">Editar Ciudad</h2>
            <form action="{{ route('cities.update', $city->id) }}" method="POST">
                @csrf
                @method('PUT')
                <input type="hidden" name="page" value="{{ request()->query('page', 1) }}">
                <div class="mb-4">
                    <label for="name-{{ $city->id }}" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Nombre</label>
                    <input type="text" id="name-{{ $city->id }}" name="name" value="{{ $city->name }}" class="mt-1 block w-full rounded-md border-gray-300 dark:border-gray-600 dark:bg-gray-800 dark:text-gray-200 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">
                </div>
                <div class="mb-4">
                    <label for="description-{{ $city->id }}" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Descripción</label>
                    <textarea id="description-{{ $city->id }}" name="description" rows="3" class="mt-1 block w-full rounded-md border-gray-300 dark:border-gray-600 dark:bg-gray-800 dark:text-gray-200 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">{{ $city->description }}</textarea>
                </div>
                <div class="flex justify-end space-x-4">
                    <button type="button" class="px-4 py-2 bg-gray-300 dark:bg-gray-600 text-gray-800 dark:text-gray-200 rounded hover:bg-gray-400 dark:hover:bg-gray-500" onclick="closeEditModal({{ $city->id }})">
                        Cancelar
                    </button>
                    <button type="submit" class="px-4 py-2 bg-indigo-600 text-white rounded hover:bg-indigo-700">
                        Guardar
                    </button>
                </div>
            </form>
        </div>
    </div>

    <!-- Modal Borrar -->
    <div id="delete-modal-{{ $city->id }}" class="hidden fixed inset-0 bg-gray-800 bg-opacity-75 flex items-center justify-center z-50">
        <div class="bg-white dark:bg-gray-700 rounded-lg shadow-lg p-6 w-96">
            <h2 class="text-lg font-semibold text-gray-900 dark:text-gray-200 mb-4">Confirmar eliminación</h2>
            <p class="text-sm text-gray-700 dark:text-gray-400 mb-6">¿Estás seguro de que deseas borrar esta ciudad? Esta acción no se puede deshacer.</p>
            <div class="flex justify-end space-x-4">
                <button type="button" class="px-4 py-2 bg-gray-300 dark:bg-gray-600 text-gray-800 dark:text-gray-200 rounded hover:bg-gray-400 dark:hover:bg-gray-500" onclick="closeDeleteModal({{ $city->id }})">
                    Cancelar
                </button>
                <form action="{{ route('cities.destroy', $city->id) }}" method="POST" class="inline">
                    @csrf
                    @method('DELETE')
                    <input type="hidden" name="page" value="{{ request()->query('page', 1) }}">
                    <button type="submit" class="px-4 py-2 bg-red-600 text-white rounded hover:bg-red-700">
                        Borrar
                    </button>
                </form>
            </div>
        </div>
    </div>
    @endforeach

    <script>
        function openEditModal(cityId) {
            document.getElementById(`edit-modal-${cityId}`).classList.remove('hidden');
            document.body.classList.add('overflow-hidden');
        }

        function closeEditModal(cityId) {
            document.getElementById(`edit-modal-${cityId}`).classList.add('hidden');
            document.body.classList.remove('overflow-hidden');
        }

        function openDeleteModal(cityId) {
            document.getElementById(`delete-modal-${cityId}`).classList.remove('hidden');
            document.body.classList.add('overflow-hidden');
        }

        function closeDeleteModal(cityId) {
            document.getElementById(`delete-modal-${cityId}`).classList.add('hidden');
            document.body.classList.remove('overflow-hidden');
        }

        // Cerrar modales al hacer clic fuera del contenido
        document.addEventListener('DOMContentLoaded', function() {
            @foreach ($cities as $city)
            const editModal{{ $city->id }} = document.getElementById('edit-modal-{{ $city->id }}');
            const deleteModal{{ $city->id }} = document.getElementById('delete-modal-{{ $city->id }}');
            
            editModal{{ $city->id }}?.addEventListener('click', function(e) {
                if (e.target === editModal{{ $city->id }}) {
                    closeEditModal({{ $city->id }});
                }
            });
            
            deleteModal{{ $city->id }}?.addEventListener('click', function(e) {
                if (e.target === deleteModal{{ $city->id }}) {
                    closeDeleteModal({{ $city->id }});
                }
            });
            @endforeach
        });
    </script>
</x-app-layout>