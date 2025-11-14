<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Setting extends Model
{
    use HasFactory;

    protected $table = 'setting';
        protected $fillable = [
            'url',
            'PUBLIC_PEM_KEY',
            'PRIVATE_PEM_KEY',
            'ENCRYPT_KEY_ID',
            'MERCHANT_NO',
            'setting_name',
            'status'
        ];
    
}