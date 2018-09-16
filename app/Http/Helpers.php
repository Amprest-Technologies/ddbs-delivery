<?php

namespace App\Http;

use Illuminate\Database\Eloquent\Model;

/**
 * System helpers.
 */
class Helpers
{
    public static function generateID($model, $drivers)
    {
        $ids = [];
        $model = 'App\\'. ucfirst($model);

        foreach ($drivers as $driver) {
            $user = new $model;
            $user->setConnection($driver);
            array_push($ids, $user->latest()->first()->id);
        }
        return max($ids) + 1;
    }
}
