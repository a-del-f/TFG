<?php

namespace App\Http\Controllers;

use App\Models\Department;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class DepartmentController
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

        $department = Department::create([
            'name' => $request->name,
            'ndevices' => $request->ndevices,

        ]);

        return redirect(route('dashboard', absolute: false));
    }

    public function delete_index()
    {
        $departments=Department::all();
        return view("delete_department",compact("departments"));
    }
    public function delete(Request $request)
    {
        $departments = Department::all();

        if ($departments->isEmpty()) {
            // Si no hay departamentos disponibles, pasa el mensaje de error y los datos necesarios a la vista
            $errorMessage = 'No hay departamentos disponibles en este momento. Por favor, inténtalo de nuevo más tarde.';
            return view('delete_department', compact( 'departments', 'errorMessage'));
        }
        $this->delete($request);
        return redirect(route('dashboard', absolute: false));

    }
}
