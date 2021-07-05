<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
// use Illuminate\Support\Facades\Validator;
use Validator;
use Hash;
use Session;

class AuthController extends Controller
{
    public function getLogin()
    {
        if(Auth::check()){
            return redirect()->route('itemMaster');
        }
        return view('login');
    }

    public function postLogin(Request $request)
    {
        // $credential = $request->only('email', 'password');
        // Auth::attempt($credential);
        // if(Auth::check())
        // {
        //     return redirect()->route('itemMaster');
        // }

        //Error messages
        $messages = [
            "email.required" => "Email is required",
            "email.email" => "Email is not valid",
            "email.exists" => "Email doesn't exists",
            "password.required" => "Password is required",
            "password.min" => "Password must be at least 6 characters"
        ];

        // validate the form data
        $validator = Validator::make($request->all(), [
                'email' => 'required|email|exists:users,email',
                'password' => 'required|min:6'
            ], $messages);

        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        } else {
            // attempt to log
            if (Auth::attempt(['email' => $request->email, 'password' => $request->password ], $request->remember)) {
                // if successful -> redirect forward
                return redirect()->intended(route('itemMaster'));
            }

            // if unsuccessful -> redirect back
            return redirect()->back()->withInput($request->only('email', 'remember'))->withErrors([
                'password' => 'Wrong password or this account not approved yet.',
            ]);
        }
    }

    public function getRegister()
    {
        return view('/register');
    }

    public function postRegister(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|min:3',
            'email' => 'required|email|unique:users',
            'password' => 'required|confirmed|min:6',
        ]);

        $emailToLower = strtolower($request -> input('email'));
        $user = User::create([
            'name' => $request->name,
            'email' => $emailToLower,
            'password' => bcrypt($request->password)
        ]);
        return redirect('login');
    }

    public function getLogout(){
        Auth::logout(); // deleted active session
        return redirect('login');
    }

}
