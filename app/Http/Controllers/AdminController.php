<?php

namespace App\Http\Controllers;

use DB;
use App\User;
use App\Delivery;
use App\DeliveryDetails;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function index(Request $request)
    {
        $customers = $agents = $pending = $delivered = 0;

        foreach ($this->drivers as $driver) {
            $agents += DB::connection($driver)->table('users_2')->count();
            $customers += DB::connection($driver)->table('users_1')->count();
            $pending += DB::connection($driver)->table('deliveries_1')->count();
            $delivered += DB::connection($driver)->table('deliveries_2')->count();
        }
        return view('admin.index', [
            'agents' => $agents,
            'customers' => $customers,
            'pending' => $pending,
            'delivered' => $delivered
        ]);
    }

    public function deliveries(Request $request)
    {
        $drivers = [];
        $status = strtoupper($request->status);
        $location = strtolower($request->location);

        switch (true) {
            // Return results filtered by status only.
            case ($location == null && $status != null):
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
        return view('admin.deliveries', [
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
            'payload' => $this->getAllUsers($drivers, $table),
            'user' => $user,
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
                        ->orderBy('updated_at', 'DESC')
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
                'deliveries_' .$table. '.id AS id',
                'deliveries_' .$table. '.delivery_no',
                'deliveries_' .$table. '.created_at AS date',
                'deliveries_' .$table. '.updated_at',
                'sender.name AS sender_name',
                'sender.phone_number AS sender_number',
                'sender.location AS sender_location',
                'sender.town AS sender_town',
                'recipient.name AS recipient_name',
                'recipient.phone_number AS recipient_number',
                'recipient.location AS recipient_location',
                'recipient.town AS recipient_town',
                'agent.name AS agent_name',
                'deliveries_' .$table. '.delivery_status',
                'delivery_details_' .$table. '.weight',
                'delivery_details_' .$table. '.description',
            ])
            ->join('users_1 AS sender', 'sender.id', '=', 'deliveries_' .$table. '.sender_id')
            ->join('users_1 AS recipient', 'recipient.id', '=', 'deliveries_' .$table. '.recipient_id')
            ->join('users_2 AS agent', 'agent.id', '=', 'deliveries_' .$table. '.agent_id')
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

    public function updateDelivery($location, $id)
    {
        // Get the driver.
        $driver = $this->driver_locations[mb_strtolower($location)];

        DB::connection($driver)->table('deliveries_1')->where('id', $id)->update(['delivery_status' => 'DELIVERED']);

        $delivery = DB::connection($driver)->table('deliveries_1')->where('id', $id);
        $delivery_detail_1 = DB::connection($driver)->table('delivery_details_1')->where('delivery_id', $id);
        $delivery_detail_2 = DB::connection($driver)->table('delivery_details_2')->where('id', $delivery_detail_1->first()->id);

        DB::connection($driver)->table('deliveries_2')->insert(
            (array)$delivery->first()
        );
        DB::connection($driver)->table('delivery_details_3')->insert(
            (array)$delivery_detail_1->first()
        );
        DB::connection($driver)->table('delivery_details_4')->insert(
            (array)$delivery_detail_2->first()
        );

        $delivery->delete();
        $delivery_detail_1->delete();
        $delivery_detail_2->delete();

        return redirect()->back();
    }

    public function deleteDelivery($location, $id, $status)
    {
        $driver = $this->driver_locations[mb_strtolower($location)];
        switch ($status) {
            case 'PENDING':
                $delivery_table = 1;
                $delivery_detailas_table_1 = 1;
                $delivery_detailas_table_2 = 2;
                break;

            default:
                $delivery_table = 2;
                $delivery_detailas_table_1 = 3;
                $delivery_detailas_table_2 = 4;
                break;
        }

        $delivery = DB::connection($driver)->table('deliveries_'. $delivery_table)->where('id', $id);
        $delivery_detail_1 = DB::connection($driver)->table('delivery_details_'. $delivery_detailas_table_1)->where('delivery_id', $id);
        $delivery_detail_2 = DB::connection($driver)->table('delivery_details_'. $delivery_detailas_table_2)->where('id', $delivery_detail_1->first()->id);

        $delivery->delete();
        $delivery_detail_1->delete();
        $delivery_detail_2->delete();

        return redirect()->back();
    }
}
