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
use Illuminate\Support\Facades\DB;

class MessageController extends Controller
{
    public function index()
    {
        if (auth()->user()->job == 3) {
            $messages = Message::where("user", auth()->user()->id)->get();
            $messagesByState = Message::where('user', auth()->user()->id)
                ->get()
                ->groupBy('estado')
                ->map(function ($group) {
                    return $group->pluck('id_message')->count();
                });
        } else {
            $messages = Message::all();
            $messagesByState = Message::all()->groupBy('estado')->map(function ($group) {
                return $group->unique('id_message')->count();
            });
        }
        $users = User::all();

        return view("messages", compact('messages', 'users','messagesByState'));
    }


    public function create(){
        $incidencies=Incidence::all();
        $departments=Department::all();
        $messageIds = Message::distinct()->pluck('id_message');
        $aula=Aula::all();
        return view("create_message",compact("messageIds","incidencies","departments","aula"));

    }
    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'description' => ['required', 'string'],
            'id_incidence' => ['required', 'integer'],
            'id_department_hidden' => ['required', 'integer'],
            'id_aula_hidden' => ['required', 'integer'],
            'estado_hidden' => ['required', 'string'],
            'id_message' => ['nullable', 'integer', 'min:1'],
        ]);

        $nextIdMessage = Message::max('id_message') + 1;

        $idMessage = $request->input('id_message') !== null ? $request->input('id_message') : $nextIdMessage;

        Message::create([
            'description' => $request->description,
            'id_incidence' => $request->id_incidence,
            'id_department' => $request->id_department_hidden,
            'id_aula' => $request->id_aula_hidden,
            'user' => auth()->user()->id,
            'estado' => $request->estado_hidden,
            'fecha_creacion' => now(),
            'id_message' => $idMessage
        ]);

        return redirect()->route('dashboard');
    }



    public function change_estado(Request $request){
        Message::where('id_message', $request->input('id_message'))->update([
            'estado' => $request->input('estado')
        ]);

        return redirect()->route('dashboard');

    }
    public function details($id)
    {
        $message = Message::with(['department', 'aula', 'incidences'])->where("id_message", $id)->first();

        if (!$message) {
            return response()->json(['error' => 'Message not found'], 404);
        }

        $incidence = $message->incidences; // Obtener la relación de incidencias

        return response()->json([
            'department_id' => $message->department->id,
            'department_name' => $message->department->name,
            'aula_id' => $message->aula->id,
            'aula_name' => $message->aula->name,
            'estado' => $message->estado,
            'incidence_name' => $incidence ? $incidence->description : "0", // Acceder al nombre de la incidencia
            'incidence_id' => $incidence ? $incidence->id : 0, // Acceder al ID de la incidencia
        ]);
    }






}
