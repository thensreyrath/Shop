<?php

namespace App\Http\Controllers\form;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Crypt;


class GenPassController extends Controller
{
    // $hashedPassword = Hash::make($password);
    public function index(Request $request){
        return view('frontend.form.generate-pass');
    }
    public function generatePassword(Request $request){
            $password = $request->input('password');
            if ($password) {
                $isStrongPassword = preg_match('/[A-Z]/', $password) && 
                                    preg_match('/[a-z]/', $password) && 
                                    preg_match('/[0-9]/', $password) && 
                                    preg_match('/[\W_]/', $password) && 
                                    strlen($password) >= 8; 

               if ($isStrongPassword) {
                    $encryptedPassword = Crypt::encryptString($password);
                    return redirect()->back()->with('password',  $encryptedPassword);
                    
                } else {
                    return redirect()->back()->withErrors([
                        'password' => 'Your password must be at least 8 characters long, include at least one uppercase letter, one lowercase letter, one number, and one special character.'
                    
                    ]);
                }

            }
           

    }
            

           
        
    
}
