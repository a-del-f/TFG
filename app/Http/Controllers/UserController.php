<?php

namespace App\Http\Controllers;

use App\Models\Job;
use App\Models\Message;
use Illuminate\Http\Request;
use App\Models\User;
use App\Http\Controllers\JobController;
class UserController extends Controller
{
    public function index()
    {
        $users = User::simplePaginate(5);

        $job = auth()->user()->job;

        if (auth()->user()->job == 3) {
            $messages = Message::where("user", auth()->user()->id)->get();
        } else {
            $messages = Message::all();
        }


    $functions=Job::all();
        if ($job == 1) {
            return view('super-admin',compact( 'users','functions','messages'));  }
        elseif ($job == 2) {
            return redirect()->route('messages');
        }
            else {
                return redirect()->route('messages');
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
    public function eleminar(Request $request)
    {
        $user=User::find($request->input("id"));
    $user->delete();

        return redirect()->route('dashboard');

    }

}
