<?php

namespace App\Helpers;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;

class IsValidTimeTokenHelper
{
    public static function validateToken(Collection|array $token): bool
    {
        $expires_at = $token->value('expires_at');
        $expiresTime = Carbon::create($expires_at)->timestamp;
        $now = Carbon::now()->timestamp;
        return $expiresTime >= $now;
    }

}
