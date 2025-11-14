<?php
namespace App\Traits;
class EndpointEnumTrait {
    public static function QR_PAY(){
        return '/api/payment/sdk/order/create';
    }
    public static function APP_PAY(){
        return '/api/payment/app/order/create';
    }
    public static function CHECK_TRAN(){
        return '/api/payment/pay/order/check';
    }
    public static function REFUND_PAY(){
        return '/api/payment/refund/order/create';
    }
    public static function CHECK_REFUND(){
        return '/api/payment/refund/order/check';
    }
    public static function NOTIFY(){
        return "https://sl.seokey.site/notify.php";
    }
}


