<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth , Hash;
use App\Models\User;

class LoginController extends Controller
{
    public function login(){
        return view('login');
    }


    public function authenticate(Request $request){
        // dd($request);
       $request->validate([
        'email' => 'required|email',
        'password' => 'required',
       ]);
       $email = $request->email;
       $password = $request->password;
       $remember = request('remember' ,0);


       $credentials = [
        'email' => $email,
        'password' => $password,
        'role' => User::ADMIN_ROLE,
       ];



       if (Auth::attempt($credentials , $remember)) {
           $request->session()->regenerate();
           return redirect()->intended(route('dashboard'));
       }
       else{
        return redirect()->back()->With('error' , 'Invalid Credentials');
       }


}
}
