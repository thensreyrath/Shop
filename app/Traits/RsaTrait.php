<?php
namespace App\Traits;

use Illuminate\Support\Facades\Log;

class RsaTrait {
    public static function encrypt_RSA($plainData, $privatePEMKey)
    {
        $encrypted = '';
        $plainData = str_split($plainData, 200);
        foreach($plainData as $chunk)
        {
            $partialEncryepted = '';

            $priPem = chunk_split($privatePEMKey, 64, "\n");
            $privatePEMKey ="-----BEGIN PRIVATE KEY-----\n" . $priPem . "-----END PRIVATE KEY-----\n";

            if (is_null( $privatePEMKey)) {
                die('Private PEM key is null.');
            }
           
            //using for example OPENSSL_PKCS1_PADDING as padding

            $encryptionOk = openssl_private_encrypt($chunk, $partialEncrypted, $privatePEMKey, OPENSSL_PKCS1_PADDING);
            if($encryptionOk === false){return false;}//also you can return and error. If too big this will be false
            $encrypted .= $partialEncrypted;
        }
        return base64_encode($encrypted);//encoding the whole binary String as MIME base 64
    }
   
    //For decryption we would use:
    public static function decrypt_RSA($publicPEMKey, $data)
    {
        $decrypted = '';

        $pubPem = chunk_split($publicPEMKey, 64, "\n");
        $publicPEMKey ="-----BEGIN PUBLIC KEY-----\n" . $pubPem . "-----END PUBLIC KEY-----\n";
        //decode must be done before spliting for getting the binary String
        $data = base64_decode($data);
        openssl_public_decrypt($data, $partial, $publicPEMKey, OPENSSL_PKCS1_PADDING);

        $decrypted .=$partial;
        $data = str_split(base64_decode($data), 256);
        foreach($data as $chunk)
        {
        $partial = '';

        // //be sure to match padding
        $decryptionOK = openssl_public_decrypt($chunk, $partial, $publicPEMKey, OPENSSL_PKCS1_PADDING);
        if($decryptionOK === false){return false;}//here also processed errors in decryption. If too big this will be false
        $decrypted .= $partial;
        }
        return $decrypted;
        }
}
