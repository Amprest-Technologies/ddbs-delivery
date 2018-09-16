<?php

namespace App\Http;

use App\SysTable;
use App\Http\Helpers;
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
}
