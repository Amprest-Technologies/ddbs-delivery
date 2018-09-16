<?php

use App\DeliveryDetail;
use Faker\Generator as Faker;
use Illuminate\Database\Seeder;

class DeliveryDetailsTableSeeder extends Seeder
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

        	DB::connection($driver)->table('delivery_details_1')->insert([
				'id' => $id,
                'delivery_id' => $faker->numberBetween($min = 1, $max = 20),
                'weight' => $faker->numberBetween($min = 1, $max = 10),
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
			]);

            DB::connection($driver)->table('delivery_details_2')->insert([
				'id' => $id,
                'description' => $faker->realText($maxNbChars = 50, $indexSize = 2),
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
			]);
        }
    }
}
