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
        try {
            $deliveries = [];
            $drivers = ['sqlsrv', 'pgsql', 'mysql'];
            foreach ($drivers as $driver) {
                foreach ($tables as $table) {
                    array_push($deliveries,
                        DB::connection($driver)->table($table)->select('*')->get()
                    );
                }
            }
            $payload['data'] = $deliveries;
            $payload['status'] = 200;
        } catch (\Exception $e) {
            $payload['status'] = 401;
            $payload['data'] = $e->getMessage();
        } finally {
            return view('admin.index', ['payload' => $payload['data']]);
        }
    }
}
