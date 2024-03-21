<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Jobs;

class JobsController extends Controller
{
    public function show()
    {
        $functions = Jobs::all();

        return $functions;


    }

}
