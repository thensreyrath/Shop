<?php

// namespace App\Http\Controllers;

// use App\Models\User;
// use Illuminate\Http\Request;
// use Illuminate\Support\Facades\Auth;
// use Illuminate\Support\Facades\DB;
// use Illuminate\Support\Facades\Log;

namespace App\Http\Controllers;

use App\Models\News;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\DB;


class ApiController extends Controller
{
    public function listProduct(){
        $products = DB::table('product')
                    ->orderByDesc('id')
                    ->get();

        if($products){
        return $this->apiRespone(200, $products);
        }else{
            return $this->apiRespone(500,[]);
        }

        // if (!$products->isEmpty()) {
        //     return $this->apiRespone(200, $products);
        // } else {
        //     return $this->apiRespone(404, ['message' => 'Product not found.']);
        // }
        
        // $response = [
        //     'status' => 200,
        //     'data' => $products
        // ];

        // // Check if don't have product
        // if ($products->isEmpty()) {
        //     $response['status'] = 404; 
        //     $response['message'] = 'Product not found.';
        // }
        // return response()->json($response);
        
    }
   

    public function productDetail($slug){
        $products = DB::table('product')
                    ->where('slug', $slug)
                    ->get();
      
        if ($products->isEmpty()) {
        return response()->json([
            'status' => 404,
            'message' => 'Product not found'
        ]);
        }

        return response()->json([
            'status' => 200,
            'data' => $products
        ]);
    }
    public function userLogin(Request $request)
    {
        // Validate input
        $request->validate([
            'email' => 'required|email',
            'password' => 'required|string',
        ]);

        Log::info('Login attempt', ['email' => $request->email,'password'=>$request->password]);
        // Log::info('Auth attempt', [
        //     'email' => $request->email,
        //     'exists' => \App\Models\User::where('email', $request->email)->exists(),
        // ]);

        // Attempt to authenticate the user
        if (Auth::attempt(['email' => $request->email, 'password' => $request->password])) {
            $user = Auth::user();

            // Create a new token
            $token = $user->createToken($user->name . '-AuthToken')->plainTextToken;

            return $this->apiRespone(200, [
                'access_token' => $token,
                'token_type' => 'Bearer',
                'user' => $user
            ]);
        }
        // Authentication failed
        return $this->apiRespone(401, 'Invalid user');
    }

    // public function userLogin(Request $request) {
    //     Log::info('Login attempt', $request->all());
    //     if(!empty($request)){
    //         $name = $request->name;
    //         $password = $request->password;
    //         if(Auth::attempt([
    //             'name' => $request->name,
    //             'password' => $request->password
    //         ])) {
    //             $user = Auth::user();
    //             $token = $user->createToken($user->name . '-AuthToken', ['*'])->plainTextToken;
    //             return $this->apiRespone(200, [
    //                 'access_token' => $token,
    //                 'token_type' => 'Bearer',
    //                 'user' => $user
    //             ]);
    //         }else{
    //             return $this->apiRespone(401, 'invalid user');
    //         }
    //     }
    // }

    public function addNews(Request $request) {
        $slug   = $this->GenerateSlug($request->title);
        $author = Auth::user()->id;
        $date   = date('Y:m:d H:i:s');
        $file   = $request->file('thumbnail');
        $thumb  = $this->uploadFile($file);
        // return($request->file('thumbnail'));
        // if ($request->hasFile('thumbnail') && $request->file('thumbnail')->isValid()) {
        // $file   = $request->file('thumbnail');
        // $thumb  = $this->uploadFile($file);
        // } else {
        //     $thumb = null; 
        // }

        $news = DB::table('news')->insert([
            'title' => $request->title,
            'slug'  => $slug,
            'thumbnail' => $thumb,
            'author' => $author,
            'viewer' => 0,
            'description' => $request->description,
            'created_at' => $date,
            'updated_at' => $date
        ]);

        if($news) {
            $data = array(
                'code' => 200,
                'message' => 'success'
            );
        }else {
            $data = array(
                'code' => 500,
                'message' => 'Internal server error'
            );
        }

        return $data;
        if($news){
            $data = array(
                'status' => 200,
                'message' => 'success'
            );
        }else{
            $data = array(
                'status' => 500,
                'message' => 'Internal Server error'
            );
        }

        return $data;
    }
  
    public function listNews(){
        $news = News::select("id","title","slug","author","viewer","thumbnail","description","updated_at")->orderBy('created_at','desc')->get();
        return response()->json([
            'status' =>200,
            'message' => 'success',
            'data' => $news
        ]);
    }

    public function update(Request $request,$id){
        $news = News::find($id);
        $news->update($request->all());
        $news->refresh();
        return response()->json([
            'status'  => 200,
            'message' => 'Updated successfully',
            'data'    => $news
        ]);
    }
    // findOrFail(): Handle not found case
}
