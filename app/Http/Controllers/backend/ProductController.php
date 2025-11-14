<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use App\Models\Products;
use Dotenv\Util\Regex;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

use function PHPUnit\Framework\returnSelf;

class ProductController extends Controller
{
    public function AddProduct() {
        // Get Category 
        $cates = DB::table('category')
                    ->orderByDesc('id')
                    ->get();

        // Get Attribute Color
        $colors = DB::table('attribute')
                        ->where('type', 'color')
                        ->orderByDesc('id')
                        ->get();
        // Get Attribute Size               
        $sizes = DB::table('attribute')
                        ->where('type', 'size')
                        ->orderByDesc('id')
                        ->get();

        return view('backend.product.add-product',[
            'cates'  => $cates,
            'colors' => $colors,
            'sizes'  => $sizes
        ]);
    }

    public function AddProductSubmit(Request $request) {
        // Get local timezone
        date_default_timezone_set("Asia/Bangkok");

        $name          = $request->name;
        $slug          = $this->GenerateSlug($name);
        $qty           = $request->qty;
        $regular_price = $request->regular_price;
        $sale_price    = $request->sale_price != '' ? $request->sale_price : 0;
        $category_id   = $request->category;
        $description   = $request->description;
        $date          = date('Y-m-d H:i:s');

        $file      = $request->file('thumbnail');
        $thumbnail = $this->uploadFile($file);
    
//implode=>array->string
        $size     = $request->size;
        $sizeVal  = implode(", ", $size);
        $color    = $request->color;
        $colorVal = implode(", ", $color);

        $product = DB::table('product')->insert([
            'name'          => $name,
            'slug'          => $slug,
            'qty'           => $qty,
            'regular_price' => $regular_price,
            'sale_price'    => $sale_price,
            'color'         => $colorVal,
            'size'          => $sizeVal,
            'category'      => $category_id,
            'author'        => Auth::user()->id,
            'viewer'        => 0,
            'thumbnail'     => $thumbnail,
            'description'   => $description,
            'created_at'    => $date,
            'updated_at'    => $date
        ]);

        if($product) {
            $this->logActivity($name, 'Product', 'Insert', $date);
            return redirect('/admin/add-product')->with('message', 'Product Inserted');
        }

    }

    public function ListProduct() {
        $products = DB::table('product')
                        ->leftJoin('users', 'users.id', 'product.author')
                        ->leftJoin('category', 'category.id', 'product.category')
                        ->select('users.name AS username', 'category.name AS category_name', 'product.*')
                        ->orderByDesc('product.id')
                        ->get();
        return view('backend.product.list-product',[
            'products' => $products
        ]);
    }
    public function updateProduct($id){
        $category   = DB::table('category')
                        ->orderBy('id','DESC')
                        ->get();
        $attrColor = DB::table('attribute')
                        ->where('type','color')
                        ->orderBy('id','DESC')
                        ->get();
        $attrSize = DB::table('attribute')
                        ->where('type','size')
                        ->select('value')
                        ->orderByDesc('id')
                        ->get();
        
        $product = DB::table('product')->find($id);
                
        $size = str_replace(" ", "",$product->size);
        $color = str_replace(" ", "", $product->color) ;
        

        return view('backend.product.edit-product',[
            'product' => $product,
            'category' => $category,
            'attrSize' => $attrSize,
            'attrColor' => $attrColor,
            'size'     =>explode("," , $size),
            'color'    =>explode("," , $color),
        ]);
    }

    public function updateProductSubmit(Request $request){
        //Check file upload 
        if (!empty($request->file('thumbnail'))) {
            $file = $request->file('thumbnail');
            $thumbnail = $this->uploadFile($file);
        } else {
            $thumbnail = $request->old_thumbnail;
        }
        // multiple size,color(selected),convert arr->str it easy store in db
        $size = $request->size;
        $sizeVal = implode(", ",$size);
        $color= $request->color;
        $colorVal = implode(", ",$color);

        // Query builder(find pro by id)
        $product = DB::table('product')
                ->where('id',$request->id)
                ->update([
                    'name' => $request->name,
                    'slug' => $this->GenerateSlug($request->name),
                    'qty' => $request->qty,
                    'regular_price' => $request->regular_price,
                    'sale_price' => $request->sale_price != '' ? $request->sale_price : 0,
                    'color' => $colorVal,
                    'size' => $sizeVal,
                    'author' => Auth::user()->id,
                    'category' => $request->category,
                    'viewer' => 0,
                    'thumbnail' =>$thumbnail,
                    'description' => $request->description,
                    'updated_at' => date('Y-m-d H:i:s')

                ]);
        if($product){

        }
        return redirect('/admin/list-product')->with('message','Updated');
    }
    
    public function destroy(Request $request){
        Log::info($request);
        $product = DB::table('product')
                    ->where('id',$request->remove_id)
                    ->delete();
        
        return redirect('/admin/list-product')->with('message','Product Removed');
    }
}
   

