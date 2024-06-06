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
    public function index(Request $request)
    {
        $user = auth()->user();
        $isUserAdmin = $user->job != 3;

        $query = $isUserAdmin ? Message::query() : Message::where("user", $user->id);

        // Obtener el conteo de mensajes por estado
        $messagesByState = $query->clone()->get()->unique('id_message')->groupBy('estado')->map->count();

        // Ordenar según los filtros aplicados
        if ($request->has('fecha') && $request->has('estado')) {
            $query->orderBy('fecha_creacion', 'desc')
                ->orderByRaw("FIELD(estado, 'abierta', 'en proceso', 'solucionado') ASC");
        } elseif ($request->has('fecha')) {
            $query->orderBy('fecha_creacion', 'desc');
        } elseif ($request->has('estado')) {
            $query->orderByRaw("FIELD(estado, 'abierta', 'en proceso', 'solucionado') ASC");
        }

        // Obtener solo el primer mensaje de cada grupo, ordenado por fecha de creación (de más antiguo a más nuevo)
        $messages = $query->orderBy('fecha_creacion', 'asc')->get()->groupBy('id_message')->map(function ($group) {
            return $group->sortBy('fecha_creacion')->first(); // Obtener solo el primer mensaje de cada grupo, ordenado por fecha de creación
        });

        $users = User::all();

        return view("messages", compact('messages', 'users', 'messagesByState'));
    }





    public function create(Request $request, $id=null){
        $incidencies=Incidence::all();
        $departments=Department::all();
        $messageIds = Message::distinct()->pluck('id_message');
        $aula=Aula::all();
        return view("create_message",compact("id","messageIds","incidencies","departments","aula"));

    }
    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'description' => ['required', 'string'],
            'id_incidence_hidden' => [ 'required','integer'],
            'id_department_hidden' => ['required', 'integer'],
            'id_aula_hidden' => [ 'required','integer'],
            'estado_hidden' => [ 'required','string'],
            'id_message' => ['nullable', 'integer', 'min:1'],
        ]);

        $nextIdMessage = Message::max('id_message') + 1;

        $idMessage = $request->input('id_message') !== null ? $request->input('id_message') : $nextIdMessage;

        Message::create([
            'description' => $request->description,
            'id_incidence' => $request->id_incidence_hidden,
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
        Message::where('id_message', $request->id_message)->update([
            'estado' => $request->estado
        ]);

        return redirect()->route('dashboard');

    }
    public function details($id)
    {
        if (auth()->user()->job == 3) {
            $message = Message::where('id_message', $id)
                ->where("user", auth()->user()->id)->first();

        }else {
            $message = Message::where("id_message", $id)->first();
        }
        if (!$message) {
            return response()->json(['error' => 'Message not found'], 404);
        }


        return response()->json([
            'department_id' => $message->department->id,
            'department_name' => $message->department->name,
            'aula_id' => $message->aula->id,
            'aula_name' => $message->aula->name,
            'estado' => $message->estado,
            'incidence_name' =>$message->incidences->description ,
            'incidence_id' =>  $message->incidences->id ,
        ]);
    }

    public function information($id)
    {
        $messages = Message::where("id_message", $id)->get();

        $response = $messages->map(function($message) {
            return [
                'description' => $message->description,
                'aula_id' => $message->aula->id,
                'incidence_name' => $message->incidences->description,
                'incidence_id' => $message->incidences->id,
                'fecha_creacion' => $message->fecha_creacion,
                'user' => $message->users->name . ' ' . $message->users->surname
            ];
        });

        return response()->json($response);
    }





}
