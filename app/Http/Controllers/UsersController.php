<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Requests\StoreUserRequest;
use App\Http\Requests\UpdateUserRequest;
use Illuminate\Contracts\Session\Session;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;

class UsersController extends Controller
{

    public function login(Request $req)
    {
        $user = User::where(['username' => $req->username])->first();

        if($user && Hash::check($req->password, $user->password))
        {
            // Set user details in session
            $req->session()->put('user', $user);
            return redirect('/index');
        }
        else
        {
            return "wrong username or password";
        }
    }


    public function register(Request $req)
    {
        $formFields = $req->validate(
            [
                'email' => ['required', 'email', Rule::unique('users', 'email')],
                'username' => ['required', 'min:6', Rule::unique('users', 'username')],
                'password' => ['required', 'min:6'],
                'name' => ['required', 'min:3']
            ]
        );

        // Hash password
        $formFields['password'] = Hash::make($formFields['password']);

        // Create user
        $user = User::create($formFields);

        return "Account successfully created";
    }

    public function logout()
    {
        session()->flush();

        return redirect('/');
    }

}
