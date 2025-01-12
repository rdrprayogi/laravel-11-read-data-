<?php

namespace App\Http\Controllers;

use App\Models\Users;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index()
    {
        $users = Users::paginate(10); // or however you are fetching the users
        if ($users->isEmpty()) {
            return "No users found"; // Debugging line
        }
        return view('users', compact('users'));
    }
}
