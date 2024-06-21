<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class ErrorController extends Controller
{
    public function error(){
        return view('error.error');
    }
}