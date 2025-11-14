<?php

namespace App\Http\Controllers\backend;

use App\Models\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    // Sign In
    public function Signin() {
        return view('backend.login');
    }

    public function SigninSubmit(Request $request) {
    

    // If login fails, redirect back with message
        if($request) {
            $name_email = $request->name_email;
        
            $password   = $request->password;
            $remember   = $request->remember;
            
            if(Auth::attempt([
                'name'     => $name_email,
                'password' => $password
            ], $remember)) {
                return redirect('/admin');
            }
            else if(Auth::attempt([
                'email'    => $name_email,
                'password' => $password
            ], $remember)) {
                return redirect('/admin');
            }
            else {
                return redirect('/signin')->with('message', 'Invalid User');
            }
        }
        //     $name_email = $request->name_email;
        
    //     $password   = $request->password;
    //     $remember   = $request->remember;
    //     if (Auth::attempt(['name' => $name_email, 'password' => $password], $remember)) {
    //     return redirect('/home'); // Redirect to home for normal users
    // }

    // // Attempt to log in using email
    // if (Auth::attempt(['email' => $name_email, 'password' => $password], $remember)) {
    //     // Check if the user is an admin
    //     if (Auth::user()->isAdmin()) {
    //         return redirect('/admin'); // Redirect to admin page
    //     } else {
    //         return redirect('/home'); // Redirect to home for regular users
    //     }
    // }
    }

    // Sign Up
    public function Signup() {
        return view('backend.register');
    }

    public function SignupSubmit(Request $request) {
        if(!empty($request)) {
            $name     = $request->name;
            $email    = $request->email;
            $password = Hash::make($request->password);
            $date     = date('Y:m:d H:i:s');

            $file     = $request->file('profile');
            $fileName = $this->uploadFile($file);

            //Insert to DB
            $user = DB::table('users')->insert([
                'name'       => $name,
                'email'      => $email,
                'password'   => $password,
                'profile'    => $fileName,
                'created_at' => $date,
                'updated_at' => $date
            ]);

            if($user) {
                return redirect('/signup')->with('message', 'Account Registerd');
            }
        }
    }

    //Logout
    public function SignOut() {
        Auth::logout();
        return redirect('signin');
    }
}
