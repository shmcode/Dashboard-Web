<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Cities') }}
        </h2>
        <br>
        <a href="{{route('cities.create')}}" class="text-white border p-2">Nuevo Registro</a>
    </x-slot>
    <div class="py-12">
        <h2 class="text-white">Listado</h2>
        @foreach ($cities as $city)
        <p class = "text-white"> {{ $city->name }} </p>    
        @endforeach



    </div>

</x-app-layout>