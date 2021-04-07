<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{

    public function index(Request $request)
    {
        $users = User::orderBy('id');
        if ($request->has('username')) {
            $users = $users->where('name', '=', $request->username);
        }
        $users = $users->get();
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
        // $request->validate([
        //     'name' => 'required',
        // ]);

        $user = new User();
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = $request->password;
        $user->save();

        $customer = new Customer();
        $customer->name = $request->customerName;
        $customer->staff = $request->customerName;
        $customer->address = $request->customerName;
        $customer->phone = $request->customerName;
        $customer->user()->associate($user);
        $customer->save();

        $request->session()->flash('message', '登録完了');
        return back()->withInput();
    }

    public function edit(Request $request, User $user)
    {
        echo $user->name;
        // return view('users.edit', [
        //     'user' => $user,
        // ]);
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
