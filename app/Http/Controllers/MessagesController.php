<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;

use App\Models\Incidences;
use App\Models\Messages;
use App\Models\User;
class MessagesController
{
    public function index()
    {
        $messages = Messages::all();
        $users=User::all();
        return view("messages",compact('messages','users'));
    }
    public function show(){
        $incidencies=Incidences::all();
        return view("create_message",compact("incidencies"));

    }
    public function store(Request $request ): RedirectResponse
    {
        $request->validate([
            'description' => ['required', 'string'],
            'id_incidence' => ['required', 'integer'],

        ]);

        $messages = Messages::create([
            'description' => $request->description,
            'id_incidence' => $request->id_incidence,

        ]);

        return redirect(route('messages', absolute: false));
    }
}
