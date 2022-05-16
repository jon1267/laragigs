<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class UserController extends Controller
{
    // Show Register/Create (user) Form
    public function create()
    {
        return view('users.register');
    }
}
