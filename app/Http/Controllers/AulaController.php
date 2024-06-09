<?php

namespace App\Http\Controllers;

use App\Models\Aula;
use App\Models\Department;
use Illuminate\Http\Request;

class AulaController extends Controller
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
            'id_department' => $request->department,

        ]);

        return redirect(route('dashboard', absolute: false));
    }
    public function getAulasByDepartment($department_id): \Illuminate\Http\JsonResponse
    {
        $aulas = Aula::where('id_department', $department_id)->get();
        return response()->json($aulas);
    }
}
