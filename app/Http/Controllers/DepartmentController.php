<?php

namespace App\Http\Controllers;

use App\Models\Department;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class DepartmentController extends Controller
{
    public function index()
    {

    return view("departments");}
    public function store(Request $request ): RedirectResponse
    {

        $request->validate([
            'name' => ['required', 'string' ],

        ]);

        $department = Department::create([
            'name' => $request->name,

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
        // Validar la solicitud
        $request->validate([
            'department' => ['required' ,'integer'],
        ]);

        // Obtener el ID del departamento a eliminar
        $departmentId = $request->input('department');

        // Buscar el departamento en la base de datos
        $department = Department::find($departmentId);

        // Verificar si el departamento existe
        if (!$department) {
            // Si no existe, redirigir con un mensaje de error
            return redirect()->back()->withErrors(['errorMessage' => 'El departamento seleccionado no existe.']);
        }

        // Eliminar el departamento
        $department->delete();

        // Redirigir de vuelta al dashboard con un mensaje de éxito
        return redirect()->route('dashboard')->with('successMessage', '¡Departamento eliminado correctamente!');
    }

}
