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
        $id = 1;
        while ($id <= 20) {
            DB::connection('mysql')->table('delivery_details_1')->insert([
                'id' => $id,
                'delivery_id' => $faker->numberBetween($min = 1, $max = 20),
                'weight' => $faker->numberBetween($min = 1, $max = 10),
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ]);

            DB::connection('mysql')->table('delivery_details_2')->insert([
                'id' => $id,
                'description' => $faker->realText($maxNbChars = 50, $indexSize = 2),
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ]);

           DB::connection('mysql')->table('delivery_details_3')->insert([
                'id' => $id+1,
                'delivery_id' => $faker->numberBetween($min = 1, $max = 20),
                'weight' => $faker->numberBetween($min = 1, $max = 10),
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ]);

            DB::connection('mysql')->table('delivery_details_4')->insert([
                'id' => $id+1,
                'description' => $faker->realText($maxNbChars = 50, $indexSize = 2),
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ]);
            $id = $id + 2;
        }

        while ($id <= 40) {
            DB::connection('pgsql')->table('delivery_details_1')->insert([
                'id' => $id,
                'delivery_id' => $faker->numberBetween($min = 21, $max = 40),
                'weight' => $faker->numberBetween($min = 1, $max = 10),
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ]);

            DB::connection('pgsql')->table('delivery_details_2')->insert([
                'id' => $id,
                'description' => $faker->realText($maxNbChars = 50, $indexSize = 2),
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ]);

           DB::connection('pgsql')->table('delivery_details_3')->insert([
                'id' => $id+1,
                'delivery_id' => $faker->numberBetween($min = 21, $max = 40),
                'weight' => $faker->numberBetween($min = 1, $max = 10),
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ]);

            DB::connection('pgsql')->table('delivery_details_4')->insert([
                'id' => $id+1,
                'description' => $faker->realText($maxNbChars = 50, $indexSize = 2),
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ]);
            $id = $id + 2;
        }

        while ($id <= 60) {
            DB::connection('sqlsrv')->table('delivery_details_1')->insert([
                'id' => $id,
                'delivery_id' => $faker->numberBetween($min = 41, $max = 60),
                'weight' => $faker->numberBetween($min = 1, $max = 10),
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ]);

            DB::connection('sqlsrv')->table('delivery_details_2')->insert([
                'id' => $id,
                'description' => $faker->realText($maxNbChars = 50, $indexSize = 2),
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ]);

            DB::connection('sqlsrv')->table('delivery_details_3')->insert([
                'id' => $id+1,
                'delivery_id' => $faker->numberBetween($min = 41, $max = 60),
                'weight' => $faker->numberBetween($min = 1, $max = 10),
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ]);

            DB::connection('sqlsrv')->table('delivery_details_4')->insert([
                'id' => $id+1,
                'description' => $faker->realText($maxNbChars = 50, $indexSize = 2),
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ]);
            $id = $id + 2;
        }
    }
}
