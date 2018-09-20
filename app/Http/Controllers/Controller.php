<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    /**
     * Current database drivers.
     */
    protected $drivers = ['sqlsrv', 'pgsql', 'mysql'];

    /**
     * Locations in each driver.
     */
    protected $driver_locations = [
        'buruburu' => 'pgsql',
        'south_c' => 'sqlsrv',
        'kileleshwa' => 'mysql'
    ];
}
