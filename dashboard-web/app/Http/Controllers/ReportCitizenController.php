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
    $count_city = City::count();
    $count_citizen = Citizen::count();
    $datos = 'Registros a reportar: ' . $count_citizen . ' ciudadanos y ' . $count_city . ' ciudades';
    Mail::to($email)->send(new ReportMail($datos));
    return back()->with('success', 'Reporte enviado correctamente');
    }
}
