<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class ShopController extends Controller
{
    public function shop(){

        
      
        $listProducts = DB::table('product')
                        ->orderByDesc('id')
                        ->limit(4)
                        ->get();
        
       

        $listCategory = DB::table('category')
                        ->orderByDesc('id')
                        ->get();
        return view('frontend.shop',[
            'listProducts' => $listProducts
        ]);
    }
    
    public function test(Request $request) {
        // get current page
        if(empty($request->page)) {
            $currentPage = 1;
        }else {
            $currentPage = $request->page;
        }

        $postPerPage = 3;

        // get offset
        $offset = ($currentPage - 1) * $postPerPage;

        //Asign Object from Model
        $query = DB::table('product');

        // case user filter product by category
        $cateSlug = $request->cate;

        $cate = DB::table('category')
                ->where('slug', $cateSlug)
                ->get();

        if (!empty($cate) && isset($cate[0])) {
            $cateId = $cate[0]->id;
        } else {
            // Handle the case where there are no categories
            $cateId = null; // or assign a default value
        }
        // $cateId = $cate[0]->id;

        $query->where('category', $cateId);
        $query->orderByDesc('id');

        $allPost = DB::table('product')
                ->where('category',$cateId)
                ->count('id');

        // count all product by category id
        $cateId   = $cate[0]->id; 
        $query->where('category', $cateId);
        $query->orderByDesc('id');

        // In case user filter promotion product
        
        if ($request->has('price')) {
        if ($request->input('price') === 'max') {
            $query->orderBy('price', 'desc');
        } elseif ($request->input('price') === 'min') {
            $query->orderBy('price', 'asc');
        }
    }

      

        // show all product and sort by DESC
        if(empty($request->cate) && empty($request->price) && empty($request->promotion) ){
           
        }

        $products = $query->offset($offset)
                        ->limit($postPerPage)
                        ->get();
        
        // get total post for pagination lists
        $totalPage  = ceil($allPost / $postPerPage);
        
        // Get list category
        $listCategory = DB::table('category')
                            ->orderByDesc('id')
                            ->get();

        return view('frontend.shop',[
            'products'  => $products,
            'totalPage' => $totalPage,
            'allCategory' => $listCategory
        ]);

        //* get list products
        // $products = DB::table('product')
        //                 ->orderByDesc('id')
        //                 ->offset($offset)
        //                 ->limit($postPerPage)
        //                 ->get();
        
        //* get total post for pagination lists
        // $allPost    = DB::table('product')->count('id');
        // $totalPage  = ceil($allPost / $postPerPage);
        // return view('frontend.shop',[
        //     'products'  => $products,
        //     'totalPage' => $totalPage
        // ]);
    }
}