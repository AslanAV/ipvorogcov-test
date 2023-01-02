<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Data extends Model
{
    use HasFactory;

    protected $fillable = [
        'id',
        'data',
        'token_id',
        'script_time',
        'script_memory',
    ];

    public function tokens(): BelongsToMany
    {
        return $this->belongsToMany(Token::class);
    }
}
