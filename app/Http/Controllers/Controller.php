<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    // Validate
    public function uploadImage($request) {
        $validatedData = $request->validate([
            'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        // If validation passes, handle the upload
        $file = $request->file('image');
        $fileName = uniqid() . '-' . $file->getClientOriginalName();
        // $fileName = $this->uploadFile($file);

        $path = 'uploads';

        // Move the file to the uploads directory
        $file->move($path, $fileName);

        // Return the file name or any response
        return response()->json(['file_name' => $fileName], 200);
    }
    //Move File Upload
    public function uploadFile($File) {
        // $file = $request->file('image');
        if (!$File || !is_object($File)) {
        // Optional: return null or a placeholder path
        return null;
    }

    // 🛡️ 2. Check if it's a valid upload
    if (method_exists($File, 'isValid') && !$File->isValid()) {
        return null;
    }
        $fileName = uniqid() . '-' . $File->getClientOriginalName();
        // $path = public_path('uploads/news');
        $path = 'uploads';
        // $fileName  = rand(1,999).'-'.$File->getClientOriginalName();
        $File->move($path, $fileName);
        return $fileName;
    }

    //Log Activities
    public function logActivity($title, $type, $action, $date) {
        DB::table('log_activity')->insert([
            'title'      => $title,
            'post_type'  => $type,
            'action'     => $action,
            'author'     => Auth::user()->id,
            'created_at' => $date,
            'updated_at' => $date
        ]);
    }

    //Generate Slug 
    public function GenerateSlug($text) {
        return strtolower(preg_replace('/[^A-Za-z0-9-]+/', '-', $text));
    }
    public function apiRespone($code, $data){
        if($code == 200){
            $result = array(
                'code'  => 200,
                'message' => 'success',
                'data'  => $data
            );
        }else{
            $result = array(
                'code' =>   500,
                'message' => 'fail'
            );
        }
        return response()->json($result);
    }
    
}
