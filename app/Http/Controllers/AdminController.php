<?php

namespace App\Http\Controllers;

use DB;
use App\User;
use App\Delivery;
use App\DeliveryDetails;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    /**
     * Get the deliveries from the three tables.
     */
    public function index()
    {
        $deliveries = collect([]);
        $drivers = ['sqlsrv', 'pgsql', 'mysql'];
        $tables = ['deliveries_1', 'deliveries_2'];
        foreach ($drivers as $driver) {
            foreach ($tables as $table) {
                $deliveries = $deliveries->merge(
                    DB::connection($driver)->table($table)
                        ->select('*')
                        ->get()
                );
            }
        }
        return $deliveries;
    }
}
