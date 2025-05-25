<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\City;

class CityController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        try{
            $cities = City::orderBy('name', 'asc')->paginate(6);
            return view('cities.index', compact('cities'));
        }catch(\Exception $e){
            return redirect()->back()->with('error', 'Error al obtener las ciudades: ' . $e->getMessage());}
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        try{
            return view('cities.create');
        }catch(\Exception $e){
            return redirect()->back()->with('error', 'Error al cargar el formulario de creación: ' . $e->getMessage());
        }
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string|max:1000',
        ]);

        try {
            City::create($request->all());
            return redirect()->route('cities.index')->with([
                'swal_type' => 'success',
                'swal_title' => 'Éxito',
                'swal_text' => 'Ciudad creada con éxito.'
            ]);
        } catch (\Exception $e) {
            return redirect()->back()->with([
                'swal_type' => 'error',
                'swal_title' => 'Error',
                'swal_text' => 'Error al crear la ciudad: ' . $e->getMessage()
            ]);
        }
    }

    public function update(Request $request, string $id)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string|max:1000',
        ]);

        try {
            $city = City::findOrFail($id);
            $city->update($request->all());
            return redirect()->route('cities.index')->with([
                'swal_type' => 'success',
                'swal_title' => 'Éxito',
                'swal_text' => 'Ciudad actualizada con éxito.'
            ]);
        } catch (\Exception $e) {
            return redirect()->back()->with([
                'swal_type' => 'error',
                'swal_title' => 'Error',
                'swal_text' => 'Error al actualizar la ciudad: ' . $e->getMessage()
            ]);
        }
    }


    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        try {
            $city = City::findOrFail($id);
            return view('cities.show', compact('city'));
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Error al obtener la ciudad: ' . $e->getMessage());
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        try {
            $city = City::findOrFail($id);
            return view('cities.edit', compact('city'));
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Error al cargar el formulario de edición: ' . $e->getMessage());
        }
    }



    public function destroy(string $id)
    {
        try {
            $city = City::findOrFail($id);

            // Validar que la relación citizens exista antes de contar
            if (method_exists($city, 'citizens') && $city->citizens()->count() > 0) {
                return redirect()->route('cities.index')->with([
                    'swal_type' => 'error',
                    'swal_title' => 'Alerta',
                    'swal_text' => 'Esta ciudad no se puede eliminat porque tiene ciudadanos asociados.'
                ]);
            }

            $city->delete();
            return redirect()->route('cities.index')->with([
                'swal_type' => 'success',
                'swal_title' => 'Eliminado',
                'swal_text' => 'Ciudad eliminada con éxito.'
            ]);
        } catch (\Exception $e) {
            return redirect()->route('cities.index')->with([
                'swal_type' => 'error',
                'swal_title' => 'Error',
                'swal_text' => 'Error al eliminar la ciudad: ' . $e->getMessage()
            ]);
        }
    }


    
}