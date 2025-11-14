<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class AdminController extends Controller {
    public function index()
    {
        return view('backend.dashboard');
    }

    public function AddPost()
    {
        return view('backend.add-post');
    }

    public function ListPost()
    {
        return view('backend.list-post');
    }

    //View Log
    public function ViewLog()
    {
        $logs = DB::table('log_activity')
                    ->join('users', 'users.id', 'log_activity.author')
                    ->select('users.name', 'log_activity.*')
                    ->orderBy('log_activity.id', 'DESC')
                    ->get();
        return view('backend.list-log',[
            'logs' => $logs
        ]);
    }

    //Website Logo
    public function AddLogo()
    {
        return view('backend.logo.add-logo');
    }

    public function AddLogoSubmit(Request $request) {
        if($request && !empty($request->file('thumbnail'))) {
            $file = $request->file('thumbnail');
            $logo = $this->uploadFile($file);

            $date = date('Y:m:d H:i:s');

            $logo = DB::table('logo')->insert([
                'thumbnail'  => $logo,
                'created_at' => $date,
                'updated_at' => $date
            ]);

            if($logo) {
                $this->logActivity('Logo', 'Logo', 'Insert', $date);
                return redirect('/admin/add-logo')->with('message', 'Post Inserted');
            }

        }
    }

    public function ListLogo()
    {
        $logos = DB::table('logo')
                    ->orderBy('id', 'DESC')
                    ->get();
        return view('backend.logo.list-logo',[
            'logos' => $logos
        ]);
    }

    public function UpdateLogo($id) {
        $logo = DB::table('logo')->find($id);
        return view('backend.logo.update-logo',[
            'logo' => $logo
        ]);
    }

    public function UpdateLogoSubmit(Request $request) {
        if(!empty($request->file('thumbnail'))) {
            $file      = $request->file('thumbnail');
            $thumbnail = $this->uploadFile($file);
        }
        else {
            $thumbnail = $request->old_thumbnail;
        }

        $logo = DB::table('logo')
                    ->where('id', $request->id)
                    ->update([
                        'thumbnail'  => $thumbnail,
                        'updated_at' => date('Y-m-d H:i:s')
                    ]);
        if($logo) {
            $this->logActivity('Logo', 'Logo', 'Update', date('Y-m-d H:i:s'));
            return redirect('/admin/list-logo')->with('message', 'Post Updated');
        }
    }

    public function RemoveLogoSubmit(Request $request) {
        $logo = DB::table('logo')
                    ->where('id', $request->remove_id)
                    ->delete();
        if($logo) {
            $this->logActivity('Logo', 'Logo', 'Delete', date('Y-m-d H:i:s'));
            return redirect('/admin/list-logo')->with('message', 'Post Removed');
        }           
    }
}
