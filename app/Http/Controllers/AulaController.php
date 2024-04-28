<?php

namespace App\Http\Controllers;

use App\Models\Department;
use http\Env\Request;

class AulaController
{
    public function index()
    {
        $department = Department::all();

        return view("aula",compact('department'));
    }
    public  function store(Request $request)
    {
        $request->validate([
            'name' => ['required', 'string'],
            'department'=>["required","integer"],


        ]);

        $messages = Aula::create([
            'name' => $request->name,
            'department' => $request->department,

        ]);

        return redirect(route('messages', absolute: false));
    }
}
