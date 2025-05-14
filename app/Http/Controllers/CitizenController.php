<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Citizen;
use App\Models\City;

class CitizenController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $perPage = 3;
        $page = $request->get('page', 1);

        $citizens = Citizen::orderBy('name', 'asc')->paginate($perPage, ['*'], 'page', $page);

        if ($citizens->isEmpty() && $page > 1) {
            return redirect()->route('citizens.index', ['page' => $page - 1]);
        }

        return view('citizens.index', compact('citizens'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $cities = City::all();
        return view('citizens.create', compact('cities'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'surname' => 'required|string|max:255',
            'birthdate' => 'required|date',
            'city_id' => 'required|exists:cities,id',
            'address' => 'required|string|max:255',
            'phone' => 'required|string|max:15',
        ]);

        Citizen::create($request->all());
        return redirect()->route('citizens.index')->with('success', 'Citizen created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $citizen = Citizen::findOrFail($id);
        return view('citizens.show', compact('citizen'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $citizen = Citizen::findOrFail($id);
        $cities = City::all();
        $selectedCity = $citizen->city_id;
        return view('citizens.edit', compact('citizen', 'cities', 'selectedCity'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'surname' => 'required|string|max:255',
            'birthdate' => 'required|date',
            'city_id' => 'required|exists:cities,id',
            'address' => 'required|string|max:255',
            'phone' => 'required|string|max:15',
        ]);

        $citizen = Citizen::findOrFail($id);
        $citizen->update($request->all());

        $page = $request->input('page', 1);

        return redirect()->route('citizens.index', ['page' => $page])->with('success', 'Citizen updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request, string $id)
    {
        $page = $request->input('page', 1);
        $citizen = Citizen::findOrFail($id);
        $citizen->delete();

        return redirect()->route('citizens.index', ['page' => $page])
                        ->with('success', 'Citizen deleted successfully.');
    }
}
