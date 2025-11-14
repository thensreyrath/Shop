<?php

namespace App\Http\Controllers\frontend;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\Setting;

use App\Traits\RandomTrait;
use App\Traits\AesTrait;
use App\Traits\RsaTrait;
use App\Traits\ConfigTrait;
use App\Traits\EndpointEnumTrait;
use Carbon\Carbon;

use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;


class HomeController extends Controller
{
    public function Home() {
       
        $newProducts = DB::table('product')
                            ->orderByDesc('id')
                            ->limit(4)
                            ->get();
        
        $promotion   = DB::table('product')
                            ->where('sale_price','<>','0')
                            ->where('qty','>',0)
                            ->orderByDesc('id')
                            ->limit(4)
                            ->get();
        $popularProducts = DB::table('product')
                            ->orderBy('viewer','DESC')
                            ->limit(4)
                            ->get();
        // if(empty($request->page)) {
        //     $currentPage = 1;
        // }else {
        //     $currentPage = $request->page;
        // }
        // $postPerPage = 10;

        // // get offset
        // $offset = ($currentPage - 1) * $postPerPage;

        return view('frontend.product',[
            'newProducts' => $newProducts,
            'promotion'   => $promotion,
            'popularProducts' =>$popularProducts
        ]);
    }

    public function Shop(Request $request) {

        if(empty($request->page)) {
            $currentPage = 1;
        }else {
            $currentPage = $request->page;
        }
        $postPerPage = 10;

        // get offset
        $offset = ($currentPage - 1) * $postPerPage;

        //Asign Object from Model
        $query = DB::table('product');
        // filter product by category
        if(!empty($request->cate)) {
            $cateSlug = $request->cate;
            $cate     = DB::table('category')
                            ->where('slug', $cateSlug)
                            ->get();
            $cateId   = $cate[0]->id; 
            $query->where('category', $cateId);
            $query->orderByDesc('id');

            // count all product by category id
            $allPost = DB::table('product')
                        ->where('category', $cateId)
                        ->count('id');
        }
        
        // fillter product by price(easy for user check for low and hight of price)
        if(!empty($request->price)) {
            $type = $request->price;
            if($type == "max") {
                $query->orderBy('regular_price', 'DESC');
            }
            else {
                $query->orderBy('regular_price', 'ASC');
            }
        }
        // if (!empty($request->promotion) && $request->promotion == 'true') {
        //     $query->where('is_promotion', 1); // Assuming 'is_promotion' is the column name
        // }
        // $products = $query->get();

        // filter promotion product ( click on promotion will show all promotion products)
        if(!empty($request->promotion) && $request->promotion == 'true') {
            $query->where('sale_price', '<>', 0);
            $query->orderByDesc('id');
        }
        // Count total all post
        $allPost = $query->count();

        //  user just show all product and sort by DESC
        if(
            empty($request->cate) &&
            empty($request->price) &&
            empty($request->promotion)
        ) {
            $query->orderByDesc('id');
            $allPost = DB::table('product')->count('id');
        }

        $products = $query->offset($offset)
                            ->limit($postPerPage)
                            ->get();

        // get total post for pagination lists
        $totalPage  = ceil($allPost / $postPerPage);

        // dd($allPost);
        // Get list category
        $listCategory = DB::table('category')
                            ->orderByDesc('id')
                            ->get();

        return view('frontend.shop',[
            'products'  => $products,
            'totalPage' => $totalPage,
            'allCategory' => $listCategory
        ]);
    }

    public function Product($slug) {   
        //Product Detail 
        // $productDetail = DB::table('product')
        //                 ->where('id',$slug) 
        //                 ->get(); 
        // Log::info('Product detail:', ['productDetail' => $productDetail]);

        $productDetail = DB::table('product')->where('slug', $slug)->get();
        $mytime = Carbon::now()->timestamp;
        $setting = DB::table('setting')->get();

        // dd($setting);


        $relateProduct =  DB::table('product')
                        ->where('id','<>',$productDetail[0]->id)
                        ->where('category',$productDetail[0]->category)  
                        ->orderByDesc('id')   
                        ->limit(4) 
                        ->get();
        
        // if (!empty($productDetail) && isset($productDetail[0])) {
        // $relateProduct = DB::table('product')
        //     ->where('id', '<>', $productDetail[0]->id)f
        //     ->where('category', $productDetail[0]->category)
        //     ->orderByDesc('id')
        //     ->limit(4)
        //     ->get();
        // } else {
        //     // Handle the case when $productDetail is empty
        //     $relateProduct = collect(); // Or set a default value as needed
        // }  
        $currentId      = $productDetail[0]->id;
        $currentViewer  = $productDetail[0]->viewer;
        $newViewer      = $currentViewer +1 ;
        DB::table('product')
            ->where('id', $currentId)
            ->update([
                'viewer' => $newViewer
            ]);

        return view('frontend.product-detail',[
                'productDetail'=>$productDetail,
                'relateProduct'=>$relateProduct,
                'mytime' => $mytime,
                'setting' =>$setting
        ]);
    }

    public function callQr(Request $req){
        // Log::info($req);
        $config = Setting::first();
        Log::info($config);        
        $length =16;
        $transOrderNo = $req->transOrderNo;
        $amt = $req->amt;

        $currency = $req->currency;
        $remark = $req->remark;
        $notifyUrl = $req->notifyUrl;
        $expireMinutes = $req->expireMinutes;
        $submerName =  $req->submerName;

        if (DB::table('order')->where('order_id', $transOrderNo)->doesntExist()) {
            $order = Order::create([
                'order_id' => $transOrderNo,
                'product_id' => $req->id,
                'amount' => $amt,
                'currency' => $currency
            ]);
        }
        // if (!Order::where('order_id', $transOrderNo)->exists()) {
        //     if ($req->id) {
        //         $order = Order::create([
        //             'order_id' => $transOrderNo,
        //             'product_id' => $req->id,
        //             'amount' => $amt,
        //             'currency' => $currency
        //         ]);
        //     }
          
        // }

        $data = [
            'transOrderNo' => $transOrderNo,
            'amt' => $amt,
            'currency' => $currency,
            'remark' => $remark,
            'notifyUrl' => $notifyUrl,
            'expireMinutes' => $expireMinutes,
            'submerName' => $submerName,
        ];
        $url = $config->url;
        $PRIVATE_PEM_KEY = $config->PRIVATE_PEM_KEY;
        $ENCRYPT_KEY_ID = $config->ENCRYPT_KEY_ID;
        $MERCHANT_NO = $config->MERCHANT_NO;
        $callback_url = $config->callback_url;
        $data['notifyUrl'] = $callback_url;
        $keys = new RandomTrait($length);
        $key = $keys->getKey();
        $aesClass = new AesTrait($key);
        $aesEncryption = $aesClass->encrypt(json_encode($data));
        $publicData['signData'] = hash('sha256', json_encode($data));
        $randomClass = new RandomTrait($length);
        $publicData['random'] = $randomClass->getKey();
        $publicData['encryptKeyId'] = $ENCRYPT_KEY_ID;
        $publicData['merNo'] = $MERCHANT_NO;
        $publicData['encryptData'] =  base64_encode($aesEncryption);
        $encryptKeyData = RsaTrait::encrypt_RSA($key, $PRIVATE_PEM_KEY);
        $publicData['encryptKey'] = base64_encode($encryptKeyData);
        $publicData['timestamp'] = intval(microtime(true) * 1000);
    
        $result = '';
        try {
            // Log::channel('customlog')->info('Url '.$url);
            // HTTP REQUEST
            $ch = curl_init($url . EndpointEnumTrait::QR_PAY());
            $payload = json_encode($publicData);
            curl_setopt($ch, CURLOPT_POSTFIELDS, $payload);

            curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type:application/json'));
            // # Return response instead of printing.
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            // # Send request.
            $result = curl_exec($ch);
            Log::info(   $result);
            if (curl_error($ch)) {
                echo 'Request Error:' . curl_error($ch);
            }
        } catch (\Exception $e) {
            echo "Invalid input info" . $e;
            exit;
        }
        
        $result = base64_encode($result);
        Log::info($result);
        // Log::channel('customlog')->info('qrcode '.$result);
        curl_close($ch);
        # Print response.
        Log::info($result);

        $pngQr = '<img style="width:200px" src="data:image/png;base64,' . $result . '"/>';

        if(!$result ){
            return "";
        }else{
            return $pngQr;
        }
        
    }
    public function News() {
        
        return view('frontend.news');
    }

    public function Article() {
        return view('frontend.news-detail');
    }

    public function Search(Request $request) {
       
        $search = $request->input('search');
        $products = DB::table('product')
                    ->where('name', 'LIKE', '%' . $search . '%')
                    // ->orWhere('description', 'LIKE', '%' . $search . '%')
                    ->get();
        
      
        return view('frontend.search',[
            'products' =>$products
        ]);
    }
}
