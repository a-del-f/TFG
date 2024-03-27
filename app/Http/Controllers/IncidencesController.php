<?php

namespace App\Http\Controllers;

use App\Models\Incidences;

class IncidencesController
{
    public function index()
    {
        $incidencias = Incidences::all();

        return view("incidencies",compact('incidencias'));
    }
    public function show()
    {
        $functions = Incidences::all();

        return $functions;


    }

}
