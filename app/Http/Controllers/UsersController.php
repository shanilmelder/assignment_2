<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use Log;

class UsersController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function userList()
    {
        $users = User::all();
        return view('userlist', compact('users'));
    }

    public function edit($id)
    {
        $user = User::find($id);
        return view('useredit', compact('user'));
    }

    public function update(Request $request)
    {
        $user = User::find(Request::input('id'));
        $user->firstname = request('fristname');
        $user->lastname = request('lastname');
        $user->email = request('email');
        $user->address1 = request('address1');
        $user->address2 = request('address2');
        $user->city = request('city');
        $user->state = request('state');
        $user->postcode = request('postcode');
        $user->role = request('role');
        $user->update();
        $users = User::all();
        return view('userlist', compact('users'));
    }
}
