<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;


class CategoriesController extends Controller
{
    // Category
    public function AddCategory() {
        return view('backend.category.add-category');
    }

    public function AddCategorySubmit(Request $request) {

        $name = $request->name;
        $slug = $this->GenerateSlug($name);
        $date = date('Y-m-d H:i:s');

        $cate = DB::table('category')->insert([
            'name'       => $name,
            'slug'       => $slug,
            'created_at' => $date,
            'updated_at' => $date
        ]);

        if($cate) {
            $this->logActivity($name, 'Category', 'Insert', $date);
            return redirect('/admin/add-category')->with('message', 'Post Inserted');
        }

    }

    public function ListCategory() {
        $cate = DB::table('category')
                    ->orderByDesc('id')
                    ->get();
        return view('backend.category.list-category',[
            'cate' => $cate
        ]);
    }

    public function categoryUpdate($id){
        $cate = DB::table('category')
                ->orderBy('id','DESC')
                ->get();
        return view('');
    }
    public function removeCate(Request $request){
        $cate = DB::table('category')
                    ->where('id',$request->remove_id)
                    ->delete();
        Log::info($cate);
        return redirect('/admin/list-category');
    }

    // Attribute
    public function AddAttribute() {
   
        return view('backend.attribute.add-attribute');
    }
    public function AddAttributeSubmit(Request $request) {
        $type  = $request->type;
        $value = $request->value;
        $date  = date('Y-m-d H:i:s');

        $attrs = DB::table('attribute')->insert([
            'type'       => $type,
            'value'      => $value,
            'created_at' => $date,
            'updated_at' => $date
        ]);

        if($attrs) {
            $this->logActivity($type, 'Attribute', 'Insert', $date);
            return redirect('/admin/add-attribute')->with('message', 'Post Inserted');
        }

    }

    public function ListAttribute() {
        $attrs = DB::table('attribute')
                    ->orderByDesc('id')
                    ->get();
        return view('backend.attribute.list-attribute',[
            'attrs' => $attrs
        ]);
    }

    public function edit($id){
        $attrs = DB::table('attribute')
                ->find($id);
        return view('backend.attribute.edit',[
            'attrs' =>$attrs
        ]);
    }

    public function update(Request $request){
        $type  = $request->type;
        $value = $request->value;
        $date  = date('Y-m-d H:i:s');

        $attrs = DB::table('attribute')
                ->where('id',$request->id)
                ->update([
                    'type' => $type,
                    'value' => $value,
                    'created_at' => $date,
                    'updated_at' => $date
                ]);
        return redirect('/admin/list-attribute');
    }

    public function delete(Request $request){
        $attrs = DB::table('attribute')
                ->where('id', $request->remove_id)
                ->delete();
        Log::info($request->remove_id);
        return redirect('admin/list-attribute');
    }

}
