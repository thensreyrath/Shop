<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;

use DateTimeInterface;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Auth;
use Laravel\Sanctum\HasApiTokens;
class User extends Authenticatable
{
 
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    public function generateToken(string $tokenName, array $abilities = ['*'])
    {
        return $this->createToken($tokenName, $abilities)->plainTextToken;
    }
    // public function createToken(string $tokenName, array $abilities )
    // {
    //     return $this->createToken($tokenName, $abilities)->plainTextToken;
    // }

    // public function isAdmin()
    // {
    //     return $this->role === 'admin'; // Adjust this according to your role management logic
    // }
    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];
    
    // $token = $user->createToken('Token Name')->plainTextToken;
  
    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

}
