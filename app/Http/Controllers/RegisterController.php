<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\RegisterRequest;
use Hash;
Use App\Models\User;
use App\Events\UserRegisteredEvent;


class RegisterController extends Controller
{
    public function register(){
        return view('register');
    }

    public function registerUser(RegisterRequest $request) {
        $first_name = $request->first_name;
        $last_name = $request->last_name;
        $info = [
            'name' => $first_name. ' ' . $last_name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => User::ADMIN_ROLE,

        ];
    $user =  User::create($info);

   if ($user && $user->id > 0) {
     UserRegisteredEvent::dispatch($user);
//    event (new UserRegisteredEvent($user));
   return redirect()->route('login')->with('message' , 'Account Created succesfully');
   }
   else{
    return redirect()->back()->with('error' , 'Something went wrong. Please  try again ');

   }
    }
    public function forgotPassword(){
        return view('forgot_password');
    }
}
