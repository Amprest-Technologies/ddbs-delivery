<?php

use App\User;
use App\IdLogs;
use Faker\Generator as Faker;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UsersTableSeeder extends Seeder
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
            DB::connection('mysql')->table('users_1')->insert([
                'id' => $id,
                'name' => $faker->name,
                'email' => $faker->unique()->safeEmail,
                'phone_number' => $faker->unique()->e164PhoneNumber,
                'email_verified_at' => date('Y-m-d H:i:s'),
                'location' => 'kileleshwa',
                'role' => 'customer',
                'password' => Hash::make('secret'),
                'remember_token' => str_random(10),
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
        	]);

            DB::connection('mysql')->table('users_2')->insert([
                'id' => $id + 1,
                'name' => $faker->name,
                'email' => $faker->unique()->safeEmail,
                'phone_number' => $faker->unique()->e164PhoneNumber,
                'email_verified_at' => date('Y-m-d H:i:s'),
                'location' => 'kileleshwa',
                'role' => 'agent',
                'password' => Hash::make('secret'),
                'remember_token' => str_random(10),
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
        	]);
            $id = $id + 2;
        }

        while ($id <= 40) {
            DB::connection('pgsql')->table('users_1')->insert([
                'id' => $id,
                'name' => $faker->name,
                'email' => $faker->unique()->safeEmail,
                'phone_number' => $faker->unique()->e164PhoneNumber,
                'email_verified_at' => date('Y-m-d H:i:s'),
                'location' => 'buruburu',
                'role' => 'customer',
                'password' => Hash::make('secret'),
                'remember_token' => str_random(10),
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
        	]);

            DB::connection('pgsql')->table('users_2')->insert([
                'id' => $id + 1,
                'name' => $faker->name,
                'email' => $faker->unique()->safeEmail,
                'phone_number' => $faker->unique()->e164PhoneNumber,
                'email_verified_at' => date('Y-m-d H:i:s'),
                'location' => 'buruburu',
                'role' => 'agent',
                'password' => Hash::make('secret'),
                'remember_token' => str_random(10),
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
        	]);
            $id = $id + 2;
        }

        while ($id <= 60) {
            DB::connection('sqlsrv')->table('users_1')->insert([
                'id' => $id,
                'name' => $faker->name,
                'email' => $faker->unique()->safeEmail,
                'phone_number' => $faker->unique()->e164PhoneNumber,
                'email_verified_at' => date('Y-m-d H:i:s'),
                'location' => 'south-c',
                'role' => 'customer',
                'password' => Hash::make('secret'),
                'remember_token' => str_random(10),
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
        	]);

            DB::connection('sqlsrv')->table('users_2')->insert([
                'id' => $id + 1,
                'name' => $faker->name,
                'email' => $faker->unique()->safeEmail,
                'phone_number' => $faker->unique()->e164PhoneNumber,
                'email_verified_at' => date('Y-m-d H:i:s'),
                'location' => 'south-c',
                'role' => 'agent',
                'password' => Hash::make('secret'),
                'remember_token' => str_random(10),
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
        	]);
            $id = $id + 2;
        }
    }
    // Update the latest ID
    IdLogs::create([
        'model' => 'DeliveryDetail',
        'driver' => 'sqlsrv',
        'table_name' => 'users_2',
        'latest_id' => '60',
    ]);
}
