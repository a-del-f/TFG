<?php

namespace App\Http\Controllers;

class IncidenciesController
{
    public function index()
    {

        return view("incidencies",compact());
    }

}
