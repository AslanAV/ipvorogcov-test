<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Token extends Model
{
    use HasFactory;
    protected $fillable = [
        'id',
        'login',
        'password',
        'token',
        'expires_at',
        'created_at',
    ];

    public function labels(): BelongsToMany
    {
        return $this->belongsToMany(Data::class);
    }
}
