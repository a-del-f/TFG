<?php

namespace App\Http\Controllers;

use App\Models\Incidences;
use App\Models\User;
class IncidencesController
{
    public function index()
    {
        $incidencias = Incidences::all();
        $users=User::all();
        return view("incidencies",compact('incidencias','users'));
    }
    public function show()
    {
        $functions = Incidences::all();

        return $functions;


    }

}
