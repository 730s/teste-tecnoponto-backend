<?php

namespace App\Helpers;

class TranslateHelper
{
    public static function translateCharacterStatus(string $status)
    {
        return match ($status) {
            'alive' => 'Vivo',
            'dead' => 'Morto',
            'unknown' => 'Desconhecido',
            default => $status
        };
    }
}
