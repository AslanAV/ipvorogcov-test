<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Token extends Model
{
    use HasFactory;

    public mixed $login;
    public mixed $password;
    public mixed $token;
    public mixed $expires_at;


    protected $fillable = [
        'id',
        'login',
        'password',
        'token',
        'expires_at',
        'created_at',
    ];
}
