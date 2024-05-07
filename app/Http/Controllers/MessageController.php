<?php

namespace App\Http\Controllers;

use App\Models\Aula;
use App\Models\Department;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;

use App\Models\Incidence;
use App\Models\Message;
use App\Models\User;
class MessageController
{
    public function index()
    {
        $messages = Message::all();
        $users=User::all();
        return view("messages",compact('messages','users'));
    }

    public function create(){
        $incidencies=Incidence::all();
        $departments=Department::all();
        $aula=Aula::all();
        return view("create_message",compact("incidencies","departments","aula"));

    }
    public function store(Request $request )
    {
        $request->validate([
            'description' => ['required', 'string'],
            'id_incidence' => ['required', 'integer'],
            'id_department' => ['required', 'integer'],
            'id_aula' => ['required', 'integer'],
            'estado' => ['required', 'string']
        ]);

        $messages = Message::create([
            'description' => $request->description,
            'id_incidence' => $request->id_incidence,
            'id_department'=>$request->id_department,
            'id_aula'=>$request->id_aula,
            'user'=>auth()->user()->name." ".auth()->user()->surname,
            'estado'=>$request->estado,
            'fecha_creacion' => Carbon::now()
        ]);
        return redirect()->route('messages');
    }



}
