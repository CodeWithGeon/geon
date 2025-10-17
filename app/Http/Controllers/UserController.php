<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User; // Assuming you have a User model

class UserController extends Controller
{
    /**
     * show
     *
     * @param  mixed $id
     * @return void
     */
    public function show($id)
    {
        $user = User::findOrFail($id);
        return view('users.Profile', ['user' => $user]);
    }
}
