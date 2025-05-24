<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\City;

class CityController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request){
        $perPage = 3;
        $page = $request->get('page', 1);

        $cities = City::orderBy('name', 'asc')->paginate($perPage, ['*'], 'page', $page);

        // Si no hay resultados en esta página y no estamos en la primera
        if ($cities->isEmpty() && $page > 1) {
            return redirect()->route('cities.index', ['page' => $page - 1]);
        }

        return view('cities.index', compact('cities'));
    }


    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('cities.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        City::create($request->all());
        return redirect()->route('cities.index')->with('status', 'Ciudad guardada con éxito');

    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $city = City::findOrFail($id);
        return view('cities.edit', compact('city'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string'
        ]);

        $city = City::findOrFail($id);
        $city->update($request->all());

        $page = $request->input('page', 1);

        return redirect()->route('cities.index', ['page' => $page])->with('status', 'Ciudad actualizada exitosamente.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request, string $id){
        $page = $request->input('page', 1);
        $city = City::findOrFail($id);
        $city->delete();

        // Redirige a la misma página (index se encargará de bajarla si está vacía)
        return redirect()->route('cities.index', ['page' => $page])
                        ->with('success', 'Ciudad eliminada exitosamente.');
    }

}
