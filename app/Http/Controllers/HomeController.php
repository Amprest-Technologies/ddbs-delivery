<?php

namespace App\Http\Controllers;

use DB;
use App\SysTable;
use App\Http\Helpers;
use Illuminate\Http\Request;
use Faker\Generator as Faker;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        // $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // Get all the users.
        $payload = [
            'message' => null,
            'users' => $this->getAllUsers(
                [$this->driver_locations[session('user')->location]], 1,
                ['id', 'name']
            )
        ];
        return view('home', ['payload' => $payload]);
    }

    public function store(Request $request, Faker $faker)
    {
        $driver = $this->driver_locations[session('user')->location];

        // Generate an ID for the delivery and delivery item.
        $date = date('Y-m-d H:i:s');
        $agent_id = DB::connection($driver)->table('users_2')->select('id')->inRandomOrder()->take(1)->first()->id;
        $delivery_id = Helpers::generateID('delivery');
        $deliveryDetails_id = Helpers::generateID('deliveryDetail');

        // Create the delivery.
        DB::connection($driver)->table('deliveries_1')->insert([
            'id' => $delivery_id,
            'delivery_no' => substr($faker->swiftBicNumber, 4),
            'sender_id' => session('user')->id,
            'recipient_id' => $request->recipient_id,
            'agent_id' => $agent_id,
            'delivery_status' => 'PENDING',
            'created_at' => $date,
            'updated_at' => $date,
        ]);

        DB::connection($driver)->table('delivery_details_1')->insert([
            'id' => $deliveryDetails_id,
            'delivery_id' => $delivery_id,
            'weight' => $request->weight,
            'created_at' => $date,
            'updated_at' => $date,
        ]);

        DB::connection($driver)->table('delivery_details_2')->insert([
            'id' => $deliveryDetails_id,
            'description' => $request->description,
            'created_at' => $date,
            'updated_at' => $date,
        ]);

        // Update the latest ID
        SysTable::updateorCreate([
            'model' => 'Delivery'
        ],[
            'latest_driver' => $driver,
            'latest_table_name' => 'deliveries_1',
            'latest_id' => $delivery_id,
        ]);

        // Update the latest ID
        SysTable::updateorCreate([
            'model' => 'DeliveryDetail'
        ],[
            'latest_driver' => $driver,
            'latest_table_name' => 'deliveries_1',
            'latest_id' => $deliveryDetails_id,
        ]);
        // Update the latest ID
        SysTable::updateorCreate([
            'model' => 'DeliveryDetail'
        ],[
            'latest_driver' => $driver,
            'latest_table_name' => 'deliveries_2',
            'latest_id' => $deliveryDetails_id,
        ]);

        $payload = [
            'message' => 'Successfully requested a delivery',
            'users' => $this->getAllUsers($this->drivers, 1, ['id', 'name'])
        ];
        return view('home', ['payload' => $payload]);
    }

    /**
     * Get all the users unless filtered
     */
    public function getAllUsers($drivers, $table, $filters = ['*'])
    {
        // Create a user collection
        $users = collect([]);
        // Get all users from all drivers
        foreach ($drivers as $driver) {
            $users = $users->merge(
                DB::connection($driver)->table('users_'. $table)
                    ->select($filters)->get()
            );
        }
        // Return all users
        return $users;
    }
}
