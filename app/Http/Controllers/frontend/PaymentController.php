<?php

namespace App\Http\Controllers\frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PaymentController extends Controller
{
    public function pay($id,Request $request){
        
        $payment = DB::table('order')
                ->select('product.name', 'order.updated_at', 'order.order_id', 'order.amount', 'order.currency')
                ->join('product', 'product.id', '=', 'order.product_id')
                ->where('order.order_id',$id)
                ->first();
        // if ($payment !== null) {
        //     // Access payment properties here
        //     $updatedAt = $payment->updated_at;
        // } else {
        //     return response()->json(['error' => 'Payment not found'], 404);
        // }
        // dd($payment);
        return view('frontend.payment.payment-success',compact('payment'));
    }
}
