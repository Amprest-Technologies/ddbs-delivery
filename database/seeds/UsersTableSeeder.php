<?php

use App\SysTable;
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
        // Truncate the entire table.
        $drivers = ['sqlsrv', 'pgsql', 'mysql'];
        $tables = ['users_1', 'users_2'];
        foreach ($drivers as $driver) {
            foreach ($tables as $table) {
                DB::connection($driver)->table($table)->truncate();
            }
        }

        // Start seeding.
        $id = 1;
        while ($id <= 20) {
            DB::connection('sqlsrv')->table('users_1')->insert([
                'id' => $id,
                'name' => $faker->name,
                'email' => $faker->unique()->safeEmail,
                'phone_number' => $faker->unique()->e164PhoneNumber,
                'email_verified_at' => date('Y-m-d H:i:s'),
                'location' => 'Nairobi',
                'town' => $faker->randomElement($array = ['Buruburu', 'South C', 'Athi River', 'Westlands', 'Runda', 'Muthaiga']),
                'role' => 'customer',
                'password' => md5('secret'),
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
                'location' => 'Nairobi',
                'town' => $faker->randomElement($array = ['Buruburu', 'South C', 'Athi River', 'Westlands', 'Runda', 'Muthaiga']),
                'role' => 'agent',
                'password' => md5('secret'),
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
                'location' => 'Mombasa',
                'town' => $faker->randomElement($array = ['Nyali', 'Likoni', 'Kisauni', 'Mvita', 'Jomvu', 'Mikindani', 'Kongowea']),
                'role' => 'customer',
                'password' => md5('secret'),
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
                'location' => 'Mombasa',
                'town' => $faker->randomElement($array = ['Nyali', 'Likoni', 'Kisauni', 'Mvita', 'Jomvu', 'Mikindani', 'Kongowea']),
                'role' => 'agent',
                'password' => md5('secret'),
                'remember_token' => str_random(10),
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
        	]);
            $id = $id + 2;
        }

        while ($id <= 60) {
            DB::connection('mysql')->table('users_1')->insert([
                'id' => $id,
                'name' => $faker->name,
                'email' => $faker->unique()->safeEmail,
                'phone_number' => $faker->unique()->e164PhoneNumber,
                'email_verified_at' => date('Y-m-d H:i:s'),
                'location' => 'Kisumu',
                'town' => $faker->randomElement($array = ['Nyando', 'Mohoroni', 'Nyakach', 'Nyando', 'Seme', 'Kisumu West', 'Kisumu Central', 'Kisumu East']),
                'role' => 'customer',
                'password' => md5('secret'),
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
                'location' => 'Kisumu',
                'town' => $faker->randomElement($array = ['Nyando', 'Mohoroni', 'Nyakach', 'Nyando', 'Seme', 'Kisumu West', 'Kisumu Central', 'Kisumu East']),
                'role' => 'agent',
                'password' => md5('secret'),
                'remember_token' => str_random(10),
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
        	]);
            $id = $id + 2;
        }

        // Update the latest ID
        SysTable::create([
            'model' => 'User',
            'latest_driver' => 'mysql',
            'latest_table_name' => 'users_2',
            'latest_id' => 60,
        ]);
    }
}
