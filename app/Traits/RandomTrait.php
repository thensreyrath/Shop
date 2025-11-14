<?php
namespace App\Traits;
class RandomTrait {
       
    protected $length;
    protected $chars = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789";
    public function __construct($length){
        $this->length = $length;
    }
    public function getKey(){
        return substr(str_shuffle($this->chars),0, $this->length);
    }
    
}