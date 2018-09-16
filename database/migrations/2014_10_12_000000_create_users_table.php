<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration
{
    /**
     * Avail variables to all models.
     *
    */
    public function __construct() {
        $this->drivers = ['mysql', 'pgsql', 'sqlsrv'];
        $this->tables = ['users_1', 'users_2'];
    }

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        foreach ($this->drivers as $driver) {
            Schema::connection($driver)->create($this->tables[0], function (Blueprint $table) {
                $table->unsignedInteger('id');
                $table->string('name');
                $table->string('email')->unique();
                $table->string('location');
                $table->string('role')->default('customer');
                $table->string('phone_number')->unique();
                $table->timestamp('email_verified_at')->nullable();
                $table->string('password');
                $table->rememberToken();
                $table->timestamps();
            });

            Schema::connection($driver)->create($this->tables[1], function (Blueprint $table) {
                $table->unsignedInteger('id');
                $table->string('name');
                $table->string('email')->unique();
                $table->string('location');
                $table->string('role')->default('customer');
                $table->string('phone_number')->unique();
                $table->timestamp('email_verified_at')->nullable();
                $table->string('password');
                $table->rememberToken();
                $table->timestamps();
            });
        }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        foreach ($this->drivers as $driver) {
            foreach ($this->tables as $table) {
                Schema::connection($driver)->dropIfExists($table);
            }
        }
    }
}
