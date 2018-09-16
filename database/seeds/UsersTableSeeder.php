<?php

use App\User;
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
        for ($id = 1; $id <= 60; $id++) {
            switch ($id % 3) {
                case 1:
                    $driver = 'pgsql';
                    $location = 'buruburu';
                    break;

                case 2:
                    $driver = 'sqlsrv';
                    $location = 'south-c';
                    break;

                default:
                    $driver = 'mysql';
                    $location = 'kileleshwa';
                    break;
            }

            $user = new User;
            $user->setConnection($driver);
            $user->create([
                'id' => $id,
                'name' => $faker->name,
                'email' => $faker->unique()->safeEmail,
                'phone_number' => $faker->unique()->e164PhoneNumber,
                'email_verified_at' => date('Y-m-d H:i:s'),
                'location' => $location,
                'role' => $faker->randomElement($array = array ('customer', 'agent')),
                'password' => Hash::make('secret'),
                'remember_token' => str_random(10),
            ]);
        }
    }
}
