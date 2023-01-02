<?php

namespace App\Helpers;

class ScriptMemoryHelper
{
    public static function startScriptMemory(): int
    {
        return memory_get_usage();
    }

    public static function calculateScriptMemory(int $start): int
    {
        return memory_get_usage() - $start;
    }
}
