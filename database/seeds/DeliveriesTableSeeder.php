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
        for ($id = 1; $id <= 60; $id++) {
            switch ($id % 3) {
                case 1:
                    $driver = 'pgsql';
                    break;

                case 2:
                    $driver = 'sqlsrv';
                    break;

                default:
                    $driver = 'mysql';
                    break;
            }

            $delivery = new Delivery;
            $delivery->setConnection($driver);
            $delivery->create([
            	'id' => $id,
                'delivery_no' => $faker->ean13,
		        'sender_id' => $faker->numberBetween($min = 1, $max = 20),
		        'recipient_id' => $faker->numberBetween($min = 1, $max = 60),
		        'agent_id' => $faker->numberBetween($min = 1, $max = 20),
		        'delivery_status' => $faker->randomElement($array = array ('PENDING', 'DELIVERED')),
            ]);
        }
    }
}
