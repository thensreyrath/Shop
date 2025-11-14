<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class QrController extends Controller
{
    public function callQr(Request $request){
        $request->validate([
            'url' => 'required',
            'callback_url' => 'required',
            'PUBLIC_PEM_KEY' => 'required',
            'PRIVATE_PEM_KEY' => 'required',
            'ENCRYPT_KEY_ID' => 'required',
            'MERCHANT_NO' => 'required',
            'merchant_name' => 'required',
            'setting_name' => 'required',
            'status' => 'required'
        ]);
        return view('frotend.product-detail');
    }
}
