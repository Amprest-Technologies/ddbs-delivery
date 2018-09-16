<?php

use App\User;
use Faker\Generator as Faker;
use Illuminate\Database\Seeder;

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
                    $location = 'Buruburu';
                    break;

                case 2:
                    $driver = 'sqlsrv';
                    $location = 'South C';
                    break;

                default:
                    $driver = 'mysql';
                    $location = 'Kileleshwa';
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
                'password' => '$2y$10$TKh8H1.PfQx37YgCzwiKb.KjNyWgaHb9cbcoQgdIVFlYg7B77UdFm', // secret
                'remember_token' => str_random(10),
            ]);
        }
    }
}
