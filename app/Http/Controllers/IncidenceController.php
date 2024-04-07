<?php

namespace App\Http\Controllers;

use App\Models\Incidence;
use App\Models\User;
class IncidenceController
{
    public function index()
    {
        $incidencias = Incidence::all();
        $users=User::all();
        return view("incidencies",compact('incidencias','users'));
    }
    public function show()
    {
        $functions = Incidence::all();

        return $functions;


    }

}
