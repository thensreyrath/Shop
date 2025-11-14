<?php

namespace App\Http\Controllers\frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Setting;
use Illuminate\Support\Facades\DB;

use Illuminate\Support\Facades\Log;

class SettingController extends Controller
{
   
    public function setting(Request $request){
        
        $url = 'https://dbapi-uat.princebank.com.kh';
        $PUBLIC_PEM_KEY = 'MIIBIjANBgkqhkiG9w0BAQEFAAOCAQ8AMIIBCgKCAQEAzT00cO3c0GKpFSRA2JTfYKiPfwthrG3Q1PRaOEm1rdBkGWEL3120Ukh/OBRPpzSJHgffyivWtdxUIREEFehdARG3Ru/nhehmPbzODLInVUXib6VTmyc+o9NssQwzuqyXtHCpFOAcZUyIliI12MREz3pWRFdU9vutPE7egBdiInzRdm5hC1z809Q/OA4HkosQqpvHF24Tmjfvj97gUY/zwrX0dY5PRsIlJjuV1K5zhXu3TDYbbC8Nyclmbsk1AYGS9kQKtJsYWaN4zIM8svz5IGT8Mg/FTARGKyhSXDR0lJ3ZvLYdvrVNu1XD5/OR6m+9Z1BbWeYPwXK5tGe9LEH2nQIDAQAB';
        $PRIVATE_PEM_KEY = 'MIIEvQIBADANBgkqhkiG9w0BAQEFAASCBKcwggSjAgEAAoIBAQD2gYjPEcxKFDyGLhraLJRgxCrsqpBSIzOqhtlBhyJ+PIJ8uF5ey/ZQ+bzYpBwSL2FwAWaABeFE+JFF4og9EcGWtidRX03l4ax3Z8yky+14yfD4YZvgWXs03ZlGygoI/iQxnMoBRXS0qTUtSpw6etNYSoEfyy36Q2tvyma56AaFfK4UU8lnK2VhK5y4gP9mPsjiPtJaXAvcwn7iJk7UTXmBNRhP7Qfy1AGgmaNzXRIB3itWwlQAQYSA5gXMXw9/NbOGrCBcDRervvBF1ci0+17W2DM4fiMBf37RmB92KevBItFS+mz9NblRxZHshgPo9vqLF/E2W3zwERnapWT2KkZhAgMBAAECggEAAfke9niwFS63c6PWVgU8fyV1f3/3rZn3svzR1omwSmjjFYBR9w8fDrO1DISMb05+80B7niON6PlWtlkTb0O0tDy121ujL2d18926QF5xLUHr4nJrkZPocyT2nLUHeAjKvYqW/llx5J6kcj3yOrCa1PksXUFege3nZAAaKuZIeRSL+E58iP1684ox+Hf7wOEHppKruSwB2kyHV4FsUzngdVAuiLEqYSfofTSrwNFod2naHGs89nd82rpeeFYK9lj6KljgSo6GjXSTo7kypgxE7318knBl27q6OYGZ2/HsDgIBcTnK8IxCSRoKyG7VyzAsd2uTmPXTN32I8OBiQIrMcQKBgQD68WIMaVZOQnvLpFF1DyizHXWqf2ycoKb6beohrgRGhMPAQ3BKJxK3Szp/rwd3elrxV7monplWqsp242AzDD4OqyVHGrhN4cyobbRQrZ7vUfI2opdt1WXscDE2aWxi9apZQxf/FrTGfqE9OCD9OnGZtKv7MJ3M3i5O06oDe/8LCQKBgQD7eULn6CY1kd25kxb9suWDj4R8pEm+jJB9KGySVoprtJjIzJVE+r94jqJh89YYXAGG40AdraW+tasOtVeIXLYVBaM/hnk2n6FOfTzRqUwYcjBWK8ZF2D4x2DHS8ezpaeFqKbco90if2bEtT3ETMiLOjXGa6PIaTSMfFsPZEyy+mQKBgA8wk03LBoVgMtwlyyR50W3eJ6Q1aF6mvtTD2HtHbEzUdoDp1B849EISFK1r69jImD6pn7xcNU3wsqa1proQUKVUqMIAFQ3p0BiV42dKyycTX8T83IuyciP4upHfmcb3teMHU6mGN1UYjywEfMK3Se8S56Ih1Dt1a3osB8uEMvD5AoGBANTtCOSZoXisaIQP8mCf0EwEAhcTeEl6dYEz8DI8SnoF8XPcHevJMMRgaUftEXOQu849rvUyKev/oLYUf+g7MAU+v8ozD4FbylZOHmgcJA1y6lCcQgazoX3M4+sL4yCEAVRFvAtYzkpjJe0KneC2C9i+1Nlosk3o0HsraGruHG3JAoGAW0V/xnZGMffGJs8gtouI6xpzDe9uHjL721w3PknD/gNi5Hrhd7mV1AUFhFD4cegu9I0sjyP35K6/rlXEa8ajmg8wghUA+k0j//GkhrOurFfgfgiWGcqRYyg0CQSX0SS4OV2QZuhlV8Z5cv0K/BbMHQy2HnvJ5ffGErvZV2fpJC8=';
        $ENCRYPT_KEY_ID = '9gjgpJztdiMJaFGQEWw';
        $MERCHANT_NO = '0000033';
        $callback_url = 'https://dbapi-uat.princebank.com.kh/merchant-online/order/api/v1/callback';
        $merchant_name = 'Test';
        $setting_name = 'PPO';
        $submerName = 'GFT';
        $date     = date('Y:m:d H:i:s');

        
        $setting = DB::table('setting')->insert([
            'url' => $url,
            'callback_url' => $callback_url,
            'PUBLIC_PEM_KEY' => $PUBLIC_PEM_KEY,
            'PRIVATE_PEM_KEY' => $PRIVATE_PEM_KEY,
            'ENCRYPT_KEY_ID' => $ENCRYPT_KEY_ID,
            'MERCHANT_NO' => $MERCHANT_NO,
            'merchant_name' => $merchant_name,
            'setting_name' => $setting_name,
            'submerName' =>$submerName,
            'created_at'    => $date,
            'updated_at'    => $date
        ]);
     
    }      
    
}
