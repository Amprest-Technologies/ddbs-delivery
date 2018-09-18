<?php

use App\SysTable;
use App\Delivery;
use Faker\Generator as Faker;
use Illuminate\Database\Seeder;

class DeliveriesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(Faker $faker)
    {
        // Truncate the entire table.
        $drivers = ['sqlsrv', 'pgsql', 'mysql'];
        $tables = ['deliveries_1', 'deliveries_2'];
        foreach ($drivers as $driver) {
            foreach ($tables as $table) {
                DB::connection($driver)->table($table)->truncate();
            }
        }

        $id = 1;
        while ($id <= 20) {
            $sender = $faker->numberBetween($min = 1, $max = 19);
            $recipient = $faker->numberBetween($min = 1, $max = 19);
            $agent = $faker->numberBetween($min = 2, $max = 20);
            DB::connection('mysql')->table('deliveries_1')->insert([
                'id' => $id,
                'delivery_no' => substr($faker->swiftBicNumber, 4),
		        'sender_id' => $sender % 2 == 0 ? $sender + 1 : $sender,
		        'recipient_id' => $recipient % 2 == 0 ? $recipient + 1 : $recipient,
		        'agent_id' => $agent % 2 == 0 ? $agent : $agent + 1,
                'delivery_status' => 'PENDING',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
        	]);

            DB::connection('mysql')->table('deliveries_2')->insert([
                'id' => $id + 1,
                'delivery_no' => substr($faker->swiftBicNumber, 4),
		        'sender_id' => $sender % 2 == 0 ? $sender + 1 : $sender,
		        'recipient_id' => $recipient % 2 == 0 ? $recipient + 1 : $recipient,
		        'agent_id' => $agent % 2 == 0 ? $agent : $agent + 1,
                'delivery_status' => 'DELIVERED',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
        	]);
            $id = $id + 2;
        }

        while ($id <= 40) {
            $sender = $faker->numberBetween($min = 21, $max = 39);
            $recipient = $faker->numberBetween($min = 21, $max = 39);
            $agent = $faker->numberBetween($min = 22, $max = 40);
            DB::connection('pgsql')->table('deliveries_1')->insert([
                'id' => $id,
                'delivery_no' => substr($faker->swiftBicNumber, 4),
		        'sender_id' => $sender % 2 == 0 ? $sender + 1 : $sender,
		        'recipient_id' => $recipient % 2 == 0 ? $recipient + 1 : $recipient,
		        'agent_id' => $agent % 2 == 0 ? $agent : $agent + 1,
                'delivery_status' => 'PENDING',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
        	]);

            DB::connection('pgsql')->table('deliveries_2')->insert([
                'id' => $id + 1,
                'delivery_no' => substr($faker->swiftBicNumber, 4),
		        'sender_id' => $sender % 2 == 0 ? $sender + 1 : $sender,
		        'recipient_id' => $recipient % 2 == 0 ? $recipient + 1 : $recipient,
		        'agent_id' => $agent % 2 == 0 ? $agent : $agent + 1,
                'delivery_status' => 'DELIVERED',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
        	]);
            $id = $id + 2;
        }

        while ($id <= 60) {
            $sender = $faker->numberBetween($min = 41, $max = 59);
            $recipient = $faker->numberBetween($min = 41, $max = 59);
            $agent = $faker->numberBetween($min = 42, $max = 60);
            DB::connection('sqlsrv')->table('deliveries_1')->insert([
                'id' => $id,
                'delivery_no' => substr($faker->swiftBicNumber, 4),
		        'sender_id' => $sender % 2 == 0 ? $sender + 1 : $sender,
		        'recipient_id' => $recipient % 2 == 0 ? $recipient + 1 : $recipient,
		        'agent_id' => $agent % 2 == 0 ? $agent : $agent + 1,
                'delivery_status' => 'PENDING',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
        	]);

            DB::connection('sqlsrv')->table('deliveries_2')->insert([
                'id' => $id + 1,
                'delivery_no' => substr($faker->swiftBicNumber, 4),
		        'sender_id' => $sender % 2 == 0 ? $sender + 1 : $sender,
		        'recipient_id' => $recipient % 2 == 0 ? $recipient + 1 : $recipient,
		        'agent_id' => $agent % 2 == 0 ? $agent : $agent + 1,
                'delivery_status' => 'DELIVERED',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
        	]);
            $id = $id + 2;
        }

        // Update the latest ID
        SysTable::create([
            'model' => 'Delivery',
            'latest_driver' => 'sqlsrv',
            'latest_table_name' => 'deliveries_2',
            'latest_id' => 60,
        ]);
    }
}
