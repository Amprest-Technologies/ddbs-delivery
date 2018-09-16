<?php

namespace App\Http;

use App\Http\Helpers;
use Illuminate\Support\Facades\DB;

/**
 * System helpers.
 */
class Helpers
{
    public static function generateID($drivers, $tables)
    {
        $ids = [];

        foreach ($drivers as $driver) {
            foreach ($tables as $table) {
                array_push($ids, DB::connection($driver)
                                    ->table($table)
                                    ->select('id')
                                    ->latest()
                                    ->first()
                                    ->id
                );
            }
        }
        return max($ids) + 1;
    }
}
