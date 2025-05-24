<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Citizen;
use App\Models\City;
use App\Mail\ReportMail;
use Illuminate\Support\Facades\Mail;

class ReportCitizenController extends Controller
{
    
    public function send_report(Request $request)
    {
        $user = $request->user();

        $cities = City::all();
        $citizens = Citizen::all();

        // Enviar los datos al mailable
        Mail::to($user->email)->send(new ReportMail($cities, $citizens));

        // Redirigir a la vista de éxito
        return back()->with('status', '¡Reporte enviado con éxito!');
    }

    public function index()
    {
        $cities = City::with('citizens')->orderBy('name')->get();
        
        return view('emails.citizens-by-city', compact('cities'));
    }
    
}
