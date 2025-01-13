<?php

namespace App\Http\Controllers;

use App\Models\Users;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index()
    {
        $users = Users::paginate(10);
        return view('users', compact('users'));
        // return view('users', $data);
    }
}
