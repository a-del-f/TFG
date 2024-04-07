<?php

namespace App\Http\Controllers;

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
    public function show(){
        $incidencies=Incidence::all();
        return view("create_message",compact("incidencies"));

    }
    public function store(Request $request ): RedirectResponse
    {
        $request->validate([
            'description' => ['required', 'string'],
            'id_incidence' => ['required', 'integer'],

        ]);

        $messages = Message::create([
            'description' => $request->description,
            'id_incidence' => $request->id_incidence,

        ]);

        return redirect(route('messages', absolute: false));
    }
}
