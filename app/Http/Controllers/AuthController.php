<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
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
        $credential = $request->only('email', 'password');
        Auth::attempt($credential);
        if(Auth::check())
        {
            return redirect()->route('itemMaster');
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
