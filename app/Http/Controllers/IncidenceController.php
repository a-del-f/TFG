<?php

namespace App\Http\Controllers;

use App\Models\Incidence;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class IncidenceController extends Controller
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
    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'id' => 'required|integer|unique:incidences',
            'description' => 'required|string|unique:incidences',
        ], [
            'id.unique' => 'El código de incidencia ya está en uso.',
            'description.unique' => 'La descripción de la incidencia ya está en uso.',
        ]);



        Incidence::create([
            'id'=>$request->id,
            'description' => $request->input('description'),

        ]);

        return redirect()->route('dashboard');
    }

    public function create()
    {
return view("create_incidences");
    }

}
