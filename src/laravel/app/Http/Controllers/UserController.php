<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{

    public function index(Request $request)
    {
        $users = User::where('name', '=', $request->username)->get();
        return view('users.index', [
            'users' => $users,
        ]);
    }

    public function create(Request $request)
    {
        return view('users.create');
    }

    public function save(Request $request)
    {
        // 
    }

    public function edit(Request $request)
    {
        $user = null;
        return view('users.edit', [
            'user' => $user,
        ]);
    }

    public function update(Request $request)
    {
        // 
    }

    public function delete(Request $request)
    {
        // 
    }
}
