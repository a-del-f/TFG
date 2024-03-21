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


        $Controller=new JobsController();
    $functions=$Controller->show();
        if ($job == 1) {
            return view('super-admin',compact( 'users','functions'));  }
        elseif ($job == 2) {
            return view('admin',compact( 'users','functions'));
        } elseif ($job == 3) {
            return view('tech',compact( 'users','functions'));
        } else {
            return view('dashboard',compact( 'users','functions'));
        }

    }

}
