<?php
namespace App\Traits;
class AesTrait
{
    protected $secret_key;
    protected $mode;
    protected $pad_method;
    protected $options;
    protected $iv;

    public function __construct($key, $method = 'AES-128-ECB', $iv = '', $options=0)
    {
        $this->secret_key = $key;

        $this->pad_method =$method;

        $this->iv = $iv;

      $this->options =$options;
    }
    public function encrypt($data){
        return openssl_encrypt($data, $this->pad_method,$this->secret_key, $this->options, $this->iv);
    }
    public function decrypt($data){
        return openssl_decrypt(base64_decode($data), $this->pad_method,$this->secret_key, $this->options, $this->iv);
    }
}
