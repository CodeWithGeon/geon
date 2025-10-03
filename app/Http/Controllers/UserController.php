<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User; // Assuming you have a User model

class UserController extends Controller
{
    /**
     * Show the profile for the given user.
     */
    public function show($id)
    {
        $user = User::findOrFail($id); // Find user or throw 404
        return view('users.Profile',['user'=> $user]);// Pass user data to a view
    }
}
