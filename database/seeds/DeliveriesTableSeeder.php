<?php

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
        $id = 1;

        // Site 1
        while ( $id <= 20) {
            $delivery = new Delivery;
            $delivery->setConnection('mysql');
            $delivery->create([
            	'id' => $id,
                'delivery_no' => $faker->ean13,
		        'sender_id' => $faker->numberBetween($min = 1, $max = 20),
		        'recipient_id' => $faker->numberBetween($min = 1, $max = 60),
		        'agent_id' => $faker->numberBetween($min = 1, $max = 20),
		        'delivery_status' => $faker->randomElement($array = array ('PENDING', 'DELIVERED')),
            ]);
            $id++;
        }

        // Site 2
        while ( $id <= 40) {
            $delivery = new Delivery;
            $delivery->setConnection('pgsql');
            $delivery->create([
            	'id' => $id,
                'delivery_no' => $faker->ean13,
		        'sender_id' => $faker->numberBetween($min = 21, $max = 40),
		        'recipient_id' => $faker->numberBetween($min = 1, $max = 60),
		        'agent_id' => $faker->numberBetween($min = 21, $max = 40),
		        'delivery_status' => $faker->randomElement($array = array ('PENDING', 'DELIVERED')),
            ]);
            $id++;
        }

         // Site 3
        while ( $id <= 60) {
            $delivery = new Delivery;
            $delivery->setConnection('sqlsrv');
            $delivery->create([
            	'id' => $id,
                'delivery_no' => $faker->ean13,
		        'sender_id' => $faker->numberBetween($min = 41, $max = 60),
		        'recipient_id' => $faker->numberBetween($min = 1, $max = 60),
		        'agent_id' => $faker->numberBetween($min = 41, $max = 60),
		        'delivery_status' => $faker->randomElement($array = array ('PENDING', 'DELIVERED')),
            ]);
            $id++;
        }      
    }
}
