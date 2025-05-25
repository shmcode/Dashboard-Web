<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\City;
use App\Models\Citizen;

class NewDashboardController extends Controller
{
    public function index()
    {
        $totalCities = City::count();
        $totalCitizens = Citizen::count();
        
        $citizensByCity = City::withCount('citizens')
                            ->orderBy('citizens_count', 'desc')
                            ->get();
        
        $recentCitizens = Citizen::with('city')
                               ->orderBy('created_at', 'desc')
                               ->take(5)
                               ->get();

        return view('custom-dashboard.index', compact(
            'totalCities',
            'totalCitizens',
            'citizensByCity',
            'recentCitizens'
        ));
    }
}



