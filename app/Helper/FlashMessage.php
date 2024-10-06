<?php

namespace App\Helper;

class FlashMessage
{
    public static function flash($type, $msg)
    {
        return flash()->flash($type, $msg, [
            'timeout' => 3000, // 3 seconds
            'position' => 'bottom-center',
        ]);
    }
}