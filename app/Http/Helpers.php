<?php

namespace App\Http;

use App\SysTable;
use Illuminate\Support\Facades\DB;

/**
 * System helpers.
 */
class Helpers
{
    public static function generateID($model)
    {
        return SysTable::where('model', ucfirst($model))
                        ->latest()->first()
                        ->latest_id + 1;
    }

    public static function getUser($drivers, $credentials)
    {
        // Get the driver from the user id.
        foreach ($drivers as $driver) {
            $user = DB::connection($driver)->table('users_1')
                ->where('phone_number', '+254'. substr($credentials['phone_number'], -9))
                ->where('password', md5($credentials['password']))
                ->first();
            if ($user) break;
        }
        return $user;
    }
}
