<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        // Site 1.
        Schema::connection('mysql')->create('users_1', function (Blueprint $table) {
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

        Schema::connection('mysql')->create('users_2', function (Blueprint $table) {
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

        // Site 2.
        Schema::connection('pgsql')->create('users_1', function (Blueprint $table) {
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

        Schema::connection('pgsql')->create('users_2', function (Blueprint $table) {
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

        // Site 3.
        Schema::connection('sqlsrv')->create('users_1', function (Blueprint $table) {
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

        Schema::connection('sqlsrv')->create('users_2', function (Blueprint $table) {
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

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::connection('mysql')->dropIfExists('users_1');
        Schema::connection('mysql')->dropIfExists('users_2');
        Schema::connection('pgsql')->dropIfExists('users_1');
        Schema::connection('pgsql')->dropIfExists('users_2');
        Schema::connection('sqlsrv')->dropIfExists('users_1');
        Schema::connection('sqlsrv')->dropIfExists('users_2');
    }
}
