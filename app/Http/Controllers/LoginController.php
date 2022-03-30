<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;
use App\Models\Register;

class LoginController extends Controller
{
    public function index()
    {
        return view('admin.login');
    }
   
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [ 
            'email' => 'required', 'password' => 'required',
        ]);
        if($validator->fails()){ return back()->withErrors($validator)->withInput(); }

        $user = Register::where('email', $request->email)->first();
        if ($user != null && Hash::check($request->password, $user->password)) {
            $request->session()->put('loggedUser', $user);
            return redirect('/home')->with('message', 'Log In Successfully');
        }
        else{
            return back()->with('error', 'Wrong Email/Password!');
        }
    }

    public function logout(Request $request)
    {
        $request->session()->flush();
        return redirect('/login')->with('error', 'Log Out Successfully',);
    }

}