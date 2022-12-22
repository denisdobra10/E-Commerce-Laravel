<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Requests\StoreUserRequest;
use App\Http\Requests\UpdateUserRequest;
use Illuminate\Contracts\Session\Session;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Testing\Fluent\Concerns\Has;
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
            echo "Wrong username or password!<br/>";
            echo '<a href = "/login">Click Here</a> to go back.';
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

        echo "Your account has been successfully created!<br/>";
        echo '<a href = "/login">Click Here</a> to login.';
    }


    public function ChangePassword(Request $req)
    {
        
        if(Hash::check($req->oldpass, session()->get('user')['password']))
        {
            if(Hash::check($req->newpass, session()->get('user')['password']))
            {
                echo "You can't change your password with the same password!<br/>";
                echo '<a href = "changepassword">Click Here</a> to try again.';

                return;
            }

            if($req->newpass == $req->repeatnewpass)
            {
                DB::update('UPDATE users SET password = ? WHERE id = ?', [Hash::make($req->newpass), session()->get('user')['id']]);

                echo "Your password has been successfully changed!<br/>";
                echo '<a href = "/">Click Here</a> to go back.';

                return;
            }
            else
            {
                echo "You didn't type the same new password on password confirmation!<br/>";
                echo '<a href = "changepassword">Click Here</a> to try again.';

                return;
            }
        }
        else
        {
            echo session()->get('user')['password'];
            echo '<br>';
            echo Hash::make($req->oldpass);
            echo "INCORRECT OLD PASSWORD!<br/>";
            echo '<a href = "changepassword">Click Here</a> to try again.';
        }

    }

    public function logout()
    {
        session()->flush();

        return redirect('/');
    }

}
