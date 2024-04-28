<?php

namespace App\Http\Controllers;

use App\Models\Aula;
use App\Models\Department;
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
        $department=Department::all();
        $aula=Aula::all();
        return view("create_message",compact("incidencies","department","aula"));

    }
    public function store(Request $request )
    {

        $request->validate([
            'description' => ['required', 'string'],
            'id_incidence' => ['required', 'integer'],
            'department'=>["required","integer"],
            'aula'=>["required","string"],

        ]);

        $messages = Message::create([
            'description' => $request->description,
            'id_incidence' => $request->id_incidence,
            'department'=>["required","string"],
            'aula'=>["required","string"],
            'user'=>["required","string"],
            'user'=>["required","string"]
        ]);

        return redirect(route('messages', absolute: false));
    }
}
