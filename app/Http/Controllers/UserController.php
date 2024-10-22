<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;

class UserController extends Controller
{
    //

public function show(){

    return view('users.register');

}

public function showLogin(){

    return view('users.login');

}


public function authenticate(Request $request){


    $formfields = $request->validate([

         'email' => ['required', 'email'],
         'password' => 'required'
      
    ]);

    if (Auth::attempt($formfields)) {

        $request->session()->regenerate();
        return redirect('/');
        # code...
    }

    return back()->withErrors(['email' => "Invalid credentials"])->onlyInput('email');





   

}


public function create(Request $request){

    $formfields = $request->validate([

        "email" => ['required', 'email',Rule::unique('users', 'email')],
        'password' => 'required|confirmed|min:6',
        "name" => ['required' ,' min:3']
    ]);

    $formfields['password'] = bcrypt($formfields['password']);

      $user = User::create($formfields);
      Auth::login($user);
      return redirect('/');

}


public function logout(Request $request){
    Auth::logout();
    $request->session()->invalidate();
    return redirect('/');
}


}
