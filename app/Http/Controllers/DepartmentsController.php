<?php

namespace App\Http\Controllers;

use App\Models\Departments;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class DepartmentsController
{
    public function index()
    {

    return view("departments");}
    public function store(Request $request ): RedirectResponse
    {
        $request->validate([
            'name' => ['required', 'string', ],
            'ndevices' => ['required', 'integer'],

        ]);

        $department = Departments::create([
            'name' => $request->name,
            'ndevices' => $request->ndevices,

        ]);

        return redirect(route('dashboard', absolute: false));
    }
}
