<x-app-layout>
    <x-slot name="header">
        <h2 class="font-bold text-2xl text-gray-900">Ciudadanos agrupados por ciudad</h2>
    </x-slot>

    <div class="max-w-5xl mx-auto py-8">
        @foreach ($cities as $city)
            <div x-data="{ open: false }" class="mb-4 border border-gray-200 rounded-lg shadow">
                <button @click="open = !open"
                    class="w-full px-4 py-3 text-left bg-gray-100 hover:bg-gray-200 font-semibold text-lg flex justify-between items-center">
                    <span>{{ $city->name }}</span>
                    <svg :class="{'rotate-180': open}" class="w-5 h-5 transition-transform" fill="none"
                        stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M19 9l-7 7-7-7" />
                    </svg>
                </button>
                <div x-show="open" class="px-6 py-4 bg-white" x-transition>
                    @if ($city->citizens->isEmpty())
                        <p class="text-gray-500 italic">No hay ciudadanos registrados.</p>
                    @else
                        <table class="w-full table-auto text-left text-sm border-collapse">
                            <thead>
                                <tr class="bg-gray-100 text-gray-700">
                                    <th class="px-4 py-2 border-b">#</th>
                                    <th class="px-4 py-2 border-b">Nombre completo</th>
                                    <th class="px-4 py-2 border-b">Edad</th>
                                    <th class="px-4 py-2 border-b">Dirección</th>
                                    <th class="px-4 py-2 border-b">Teléfono</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($city->citizens as $index => $citizen)
                                    <tr class="hover:bg-gray-50">
                                        <td class="px-4 py-2 border-b">{{ $index + 1 }}</td>
                                        <td class="px-4 py-2 border-b">{{ $citizen->getFullName() }}</td>
                                        <td class="px-4 py-2 border-b">{{ $citizen->getAge() }} años</td>
                                        <td class="px-4 py-2 border-b">{{ $citizen->address }}</td>
                                        <td class="px-4 py-2 border-b">{{ $citizen->phone }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    @endif
                </div>
            </div>
        @endforeach
    </div>

    <script src="//unpkg.com/alpinejs" defer></script>
</x-app-layout>
