<?php

namespace App\Http\Controllers;


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
}
