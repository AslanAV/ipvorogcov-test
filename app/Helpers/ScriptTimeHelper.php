<?php

namespace App\Helpers;

class ScriptTimeHelper
{
    public static function startScriptTime(): float
    {
        return microtime(true);
    }

    public static function calculateScriptTime(float $start): float
    {
        return microtime(true) - $start;
    }
}
