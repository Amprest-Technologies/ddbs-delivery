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
        $id = 1;

        // Site 1
        while ( $id <= 20) {
            $user = new User;
            $user->setConnection('mysql');
            $user->create([
                'id' => $id,
                'name' => $faker->name,
                'email' => $faker->unique()->safeEmail,
                'phone_number' => $faker->unique()->e164PhoneNumber,
                'location' => 'Kileleshwa',
                'role' => $faker->randomElement($array = array ('customer', 'agent')),
                'password' => '$2y$10$TKh8H1.PfQx37YgCzwiKb.KjNyWgaHb9cbcoQgdIVFlYg7B77UdFm', // secret
                'remember_token' => str_random(10),
            ]);
            $id++;
        }

        // Site 2
        while ( $id <= 40) {
            $user = new User;
            $user->setConnection('pgsql');
            $user->create([
                'id' => $id,
                'name' => $faker->name,
                'email' => $faker->unique()->safeEmail,
                'phone_number' => $faker->unique()->e164PhoneNumber,
                'location' => 'Buruburu',
                'role' => $faker->randomElement($array = array ('customer', 'agent')),
                'password' => '$2y$10$TKh8H1.PfQx37YgCzwiKb.KjNyWgaHb9cbcoQgdIVFlYg7B77UdFm', // secret
                'remember_token' => str_random(10),
            ]);
            $id++;
        }

        // Site 3
        while ( $id <= 60) {
            $user = new User;
            $user->setConnection('sqlsrv');
            $user->create([
                'id' => $id,
                'name' => $faker->name,
                'email' => $faker->unique()->safeEmail,
                'phone_number' => $faker->unique()->e164PhoneNumber,
                'location' => 'South C',
                'role' => $faker->randomElement($array = array ('customer', 'agent')),
                'password' => '$2y$10$TKh8H1.PfQx37YgCzwiKb.KjNyWgaHb9cbcoQgdIVFlYg7B77UdFm', // secret
                'remember_token' => str_random(10),
            ]);
            $id++;
        }
    }
}
