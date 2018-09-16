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
            DB::connection('mysql')->table('deliveries_1')->insert([
                'id' => $id,
                'delivery_no' => $faker->ean13,
		        'sender_id' => $faker->numberBetween($min = 1, $max = 20),
		        'recipient_id' => $faker->numberBetween($min = 1, $max = 60),
		        'agent_id' => $faker->numberBetween($min = 1, $max = 20),
                'delivery_status' => 'PENDING',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
        	]);

            DB::connection('mysql')->table('deliveries_2')->insert([
                'id' => $id + 1,
                'delivery_no' => $faker->ean13,
		        'sender_id' => $faker->numberBetween($min = 1, $max = 20),
		        'recipient_id' => $faker->numberBetween($min = 1, $max = 60),
		        'agent_id' => $faker->numberBetween($min = 1, $max = 20),
                'delivery_status' => 'DELIVERED',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
        	]);
            $id = $id + 2;
        }

        while ($id <= 40) {
            DB::connection('pgsql')->table('deliveries_1')->insert([
                'id' => $id,
                'delivery_no' => $faker->ean13,
		        'sender_id' => $faker->numberBetween($min = 21, $max = 40),
		        'recipient_id' => $faker->numberBetween($min = 1, $max = 60),
		        'agent_id' => $faker->numberBetween($min = 21, $max = 40),
                'delivery_status' => 'PENDING',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
        	]);

            DB::connection('pgsql')->table('deliveries_2')->insert([
                'id' => $id + 1,
                'delivery_no' => $faker->ean13,
		        'sender_id' => $faker->numberBetween($min = 21, $max = 40),
		        'recipient_id' => $faker->numberBetween($min = 1, $max = 60),
		        'agent_id' => $faker->numberBetween($min = 21, $max = 40),
                'delivery_status' => 'DELIVERED',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
        	]);
            $id = $id + 2;
        }

        while ($id <= 60) {
            DB::connection('sqlsrv')->table('deliveries_1')->insert([
                'id' => $id,
                'delivery_no' => $faker->ean13,
		        'sender_id' => $faker->numberBetween($min = 41, $max = 60),
		        'recipient_id' => $faker->numberBetween($min = 1, $max = 60),
		        'agent_id' => $faker->numberBetween($min = 41, $max = 60),
                'delivery_status' => 'PENDING',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
        	]);

            DB::connection('sqlsrv')->table('deliveries_2')->insert([
                'id' => $id + 1,
                'delivery_no' => $faker->ean13,
		        'sender_id' => $faker->numberBetween($min = 41, $max = 60),
		        'recipient_id' => $faker->numberBetween($min = 1, $max = 60),
		        'agent_id' => $faker->numberBetween($min = 41, $max = 60),
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
