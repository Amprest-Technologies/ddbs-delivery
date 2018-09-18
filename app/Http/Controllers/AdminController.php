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

            $deliveries = $deliveries->merge(DB::connection($driver)->table('deliveries_1')
                ->select([
                    'deliveries_1.id',
                    'deliveries_1.delivery_no',
                    'sender.name as sender_name',
                    'sender.phone_number as sender_number',
                    'sender.location as sender_location',
                    'recipient.name as recipient_name',
                    'recipient.phone_number as recipient_number',
                    'recipient.location as recipient_location',
                    'agent.name as agent_name',
                    'deliveries_1.delivery_status',
                    'delivery_details_1.weight',
                    'delivery_details_1.description',
                ])
                ->join('users_1 as sender', 'sender.id', '=', 'deliveries_1.sender_id')
                ->join('users_1 as recipient', 'recipient.id', '=', 'deliveries_1.recipient_id')
                ->join('users_2 as agent', 'agent.id', '=', 'deliveries_1.agent_id')
                ->joinSub($deliveryDetails1, 'delivery_details_1', function($join) {
                    $join->on('deliveries_1.id', '=', 'delivery_details_1.delivery_id');
                })
                ->union(
                    DB::connection($driver)->table('deliveries_2')
                        ->select([
                            'deliveries_2.id',
                            'deliveries_2.delivery_no',
                            'sender.name as sender_name',
                            'sender.phone_number as sender_number',
                            'sender.location as sender_location',
                            'recipient.name as recipient_name',
                            'recipient.phone_number as recipient_number',
                            'recipient.location as recipient_location',
                            'agent.name as agent_name',
                            'deliveries_2.delivery_status',
                            'delivery_details_2.weight',
                            'delivery_details_2.description',
                        ])
                        ->join('users_1 as sender', 'sender.id', '=', 'deliveries_2.sender_id')
                        ->join('users_1 as recipient', 'recipient.id', '=', 'deliveries_2.recipient_id')
                        ->join('users_2 as agent', 'agent.id', '=', 'deliveries_2.agent_id')
                        ->joinSub($deliveryDetails2, 'delivery_details_2', function($join) {
                            $join->on('deliveries_2.id', '=', 'delivery_details_2.delivery_id');
                        })
                )
                ->get()
            );
        }

        // Return result
        return view('admin.index', [
            'payload' => $deliveries
        ]);
    }
}
