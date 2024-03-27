<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Http\Controllers\JobsController;
class UserController extends Controller
{
    public function index()
    {
        $users = User::all();

        $job = auth()->user()->job;

        $Controller=new IncidencesController();
    $incidencias=$Controller->show();
        $Controller=new JobsController();
    $functions=$Controller->show();
        if ($job == 1) {
            return view('super-admin',compact( 'users','functions','incidencias'));  }
        elseif ($job == 2) {
            return view('admin',compact( 'users','functions','incidencias'));
        } elseif ($job == 3) {
            return view('tech',compact( 'users','functions','incidencias'));
        } else {
            return view('dashboard',compact( 'users','functions'));
        }

    }

}
