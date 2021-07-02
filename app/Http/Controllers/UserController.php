<?php

namespace App\Http\Controllers;

use App\Mail\PasswordMailable;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Auth\Events\Registered;
use Illuminate\Auth\Listeners\SendEmailVerificationNotification;
use Illuminate\Support\Facades\Hash; 
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Gate;

class UserController extends Controller
{
    protected $listen = [
        Registered::class => [
            SendEmailVerificationNotification::class,
        ]
    ];

    public function __construct()
    {
        $this->middleware('admin')->except('index');
    }

    public function index()
    {
        if (!Gate::allows('admin-users')){
            return view('layouts.404NotFound');
        }
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

        //Eviamos correo para que verifiquen sus correos los usuarios
        event(new Registered($user = User::create($userData)));

        //Enviar correo al usuario con su informacion para logearse
        $mail = new PasswordMailable($request->all());
        Mail::to($request->email)->send($mail);

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
            //Enviar correo al usuario con su informacion actualizada de contrasenia y/o correo
            $mail = new PasswordMailable($request->all());
            Mail::to($request->email)->send($mail);
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
