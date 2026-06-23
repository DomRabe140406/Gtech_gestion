<?php

namespace App\Helpers;

use Illuminate\Support\Facades\Session;

class AdminHistory
{
    public static function add($message)
    {
        $history = Session::get('admin_history', []);

        array_unshift($history, [
            'time' => now()->format('d/m/Y H:i:s'),
            'message' => $message
        ]);

        Session::put('admin_history', $history);
    }

    public static function get()
    {
        return Session::get('admin_history', []);
    }

    public static function clear()
    {
        Session::forget('admin_history');
    }
}