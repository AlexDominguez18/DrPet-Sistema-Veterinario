<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function index()
    {
        $users = User::get();
        return view('users.usersList',compact(['users']));
    }

    public function create()
    {
        return view('users.newUser');
    }

    public function store(Request $request)
    {
        $request->validate([ 
            "name" => ['required','min:3','max:50'],
            "email" => ['email','unique:App\Models\User,email'],
            "password" => ['min:8','required_with:confirm_password','same:confirm_password'],
            "password_confirmation" => ['min:8']
        ]);

        $userData = $request->except('_token');
        $userData['password'] = Hash::make($request->password);

        User::create($userData);

        return redirect()->route('user.index');
    }

    public function edit(User $user)
    {
        return view('users.userEdit', compact(['user']));
    }

    public function update(Request $request, User $user)
    {
        $request->validate([
            "name" => ['required','min:3','max:50'],
            "email" => ['email']
        ]);

        $userToUpdate = User::findOrFail($user->id);

        $userToUpdate['name'] = $request->name;
        $userToUpdate['email'] = $request->email;
        $userToUpdate['admin'] = $request->admin;

        //Si los campos estan vacios no actualizamos nada
        if ($request->filled('password') && $request->filled('confirm_password')){
            $request->validate([
                "password" => ['nullable','min:8','required_with:confirm_password','same:confirm_password'],
                "password_confirmation" => ['nullable','min:8']
            ]);
            $userToUpdate['password'] = Hash::make($request->password);
        }

        //Guardamos los cambios
        $userToUpdate->save();

        return redirect()->route('user.index');
    }

    public function destroy(User $user)
    {
        User::destroy($user->id);

        return redirect()->route('user.index');
    }
}
