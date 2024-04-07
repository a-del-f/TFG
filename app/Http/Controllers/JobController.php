<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Job;

class JobController extends Controller
{
    public function show()
    {
        $functions = Job::all();

        return $functions;


    }

}
