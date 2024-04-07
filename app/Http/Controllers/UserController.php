<?php

namespace App\Http\Controllers;

use App\Models\Message;
use Illuminate\Http\Request;
use App\Models\User;
use App\Http\Controllers\JobController;
class UserController extends Controller
{
    public function index()
    {
        $users = User::simplePaginate(1);

        $job = auth()->user()->job;

        $messages=Message::all();

        $Controller=new JobController();
    $functions=$Controller->show();
        if ($job == 1) {
            return view('super-admin',compact( 'users','functions','messages'));  }
        elseif ($job == 2) {
            return view('admin',compact( 'users','functions','messages'));
        } elseif ($job == 3) {
            return view('tech',compact( 'users','functions','messages'));
        } else {
            return view('dashboard',compact( 'users','functions'));
        }

    }

    public function change_user(Request $request)
    {
        app("debugbar")->info($request);
    $user=User::find($request->input("id"));
        $user->update([
            'job'=>$request->input("job")]);


  return redirect(route('dashboard', absolute: false));
    }

}
