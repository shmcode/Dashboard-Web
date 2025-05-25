<?php

namespace App\Http\Controllers;

use App\Models\City;
use Illuminate\Http\Request;
use App\Mail\ReportMail;
use App\Models\Citizen;
use Illuminate\Support\Facades\Mail;

class ReportCitizenController extends Controller
{
    public function send_report(Request $request)
    {
        $user = $request->user();
        $email = $user->email;

        // Ciudades con sus ciudadanos ordenados
        $cities = City::with(['citizens' => function($query) {
            $query->orderBy('first_name');
        }])->orderBy('name')->get();

        $subject = "Reporte de ciudadanos";

        Mail::to($email)->send(new ReportMail($cities, $subject));
        return back()->with('success', 'Reporte enviado exitosamente.');
    }
}