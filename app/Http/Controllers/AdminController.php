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

    public function index(Request $request)
    {
        $drivers = [];
        $status = strtoupper($request->status);
        $location = strtolower($request->location);

        switch (true) {
            // Return results filtered by status only.
            case($location == null && $status != null):
                $drivers = $this->drivers;
                $table = $status == 'PENDING' ? '1' : '2';
                break;

            // Return results filtered by location only.
            case ($location != null && $status == null):
                $locations = explode(",", $location);
                foreach ($locations as $location) {
                    array_push($drivers, $this->driver_locations[$location]);
                }
                $table = null;
                break;

            // Return results filtered by both location and status.
            case ($location != null && $status != null):
                $locations = explode(",", $location);
                foreach ($locations as $location) {
                    array_push($drivers, $this->driver_locations[$location]);
                }
                $table = $status == 'PENDING' ? '1' : '2';
                break;

            // Return all results.
            default:
                $drivers = $this->drivers;
                $table = null;
                break;
        }
        // Return View
        return view('admin.index', [
            'payload' => $this->getAllDeliveries($drivers, $table)
        ]);
    }

    public function users(Request $request, $user)
    {
        $drivers = [];
        $location = strtolower($request->location);

        // Determine if user is a customer or an agent
        $table = $user == 'customer' ?  1 :  2;

        // Get the appropriate drivers
        switch ($location) {
            case(!null):
                $locations = explode(",", $location);
                foreach ($locations as $location) {
                    array_push($drivers, $this->driver_locations[$location]);
                }
                break;
            default:
                $drivers = $this->drivers;
                break;
        }

        // Return View
        return view('admin.users', [
            'payload' => $this->getAllUsers($drivers, $table)
        ]);

    }

    public function getAllDeliveries($drivers, $table)
    {
        $deliveries = collect([]);
        foreach ($drivers as $driver) {
            $deliveryDetails1 = DB::connection($driver)->table('delivery_details_1')
                ->select([
                    'delivery_details_1.id',
                    'delivery_details_1.delivery_id',
                    'delivery_details_2.description',
                    'delivery_details_1.weight',
                ])
                ->join('delivery_details_2', 'delivery_details_1.id', '=', 'delivery_details_2.id');

            $deliveryDetails2 = DB::connection($driver)->table('delivery_details_3')
                ->select([
                    'delivery_details_3.id',
                    'delivery_details_3.delivery_id',
                    'delivery_details_4.description',
                    'delivery_details_3.weight',
                ])
                ->join('delivery_details_4', 'delivery_details_3.id', '=', 'delivery_details_4.id');

            switch ($table) {
                case null:
                    $results = $this->getDeliveries($driver, '1', $deliveryDetails1)
                        ->union($this->getDeliveries($driver, '2', $deliveryDetails2))
                        ->get();
                    break;

                default:
                    $results = $this->getDeliveries($driver, $table, ${ 'deliveryDetails' .$table })
                        ->get();
                    break;
            }
            $deliveries = $deliveries->merge($results);
        }
        return $deliveries;
    }

    public function getDeliveries($driver, $table, $deliveryDetails)
    {
        return $deliveries = DB::connection($driver)->table('deliveries_'. $table)
            ->select([
                'deliveries_' .$table. '.id',
                'deliveries_' .$table. '.delivery_no',
                'sender.name as sender_name',
                'sender.phone_number as sender_number',
                'sender.location as sender_location',
                'recipient.name as recipient_name',
                'recipient.phone_number as recipient_number',
                'recipient.location as recipient_location',
                'agent.name as agent_name',
                'deliveries_' .$table. '.delivery_status',
                'delivery_details_' .$table. '.weight',
                'delivery_details_' .$table. '.description',
            ])
            ->join('users_1 as sender', 'sender.id', '=', 'deliveries_' .$table. '.sender_id')
            ->join('users_1 as recipient', 'recipient.id', '=', 'deliveries_' .$table. '.recipient_id')
            ->join('users_2 as agent', 'agent.id', '=', 'deliveries_' .$table. '.agent_id')
            ->joinSub($deliveryDetails, 'delivery_details_'. $table, function($join) use ($table) {
                $join->on('deliveries_' .$table. '.id', '=', 'delivery_details_' .$table. '.delivery_id');
            });
    }

    public function getAllUsers($drivers, $table)
    {
        // Create a user collection
        $users = collect([]);

        // Get all users from all drivers
        foreach ($drivers as $driver) {
            $users = $users->merge(
                DB::connection($driver)->table('users_'.$table)
                    ->select('*')->get()
            );
        }

        // Return all users
        return $users;
    }
}
