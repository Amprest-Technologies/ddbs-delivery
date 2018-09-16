<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDeliveriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        // Site 1.
        Schema::connection('mysql')->create('deliveries_1', function (Blueprint $table) {
            $table->unsignedInteger('id');
            $table->string('delivery_no');
            $table->unsignedInteger('sender_id');
            $table->unsignedInteger('recipient_id');
            $table->unsignedInteger('agent_id')->nullable();
            $table->string('delivery_status')->default('PENDING');
            $table->timestamps();
        });

        Schema::connection('mysql')->create('deliveries_2', function (Blueprint $table) {
            $table->unsignedInteger('id');
            $table->string('delivery_no');
            $table->unsignedInteger('sender_id');
            $table->unsignedInteger('recipient_id');
            $table->unsignedInteger('agent_id')->nullable();
            $table->string('delivery_status')->default('DELIVERED');
            $table->timestamps();
        });

        // Site 2.
        Schema::connection('pgsql')->create('deliveries_1', function (Blueprint $table) {
            $table->unsignedInteger('id');
            $table->string('delivery_no');
            $table->unsignedInteger('sender_id');
            $table->unsignedInteger('recipient_id');
            $table->unsignedInteger('agent_id')->nullable();
            $table->string('delivery_status')->default('PENDING');
            $table->timestamps();
        });

        Schema::connection('pgsql')->create('deliveries_2', function (Blueprint $table) {
            $table->unsignedInteger('id');
            $table->string('delivery_no');
            $table->unsignedInteger('sender_id');
            $table->unsignedInteger('recipient_id');
            $table->unsignedInteger('agent_id')->nullable();
            $table->string('delivery_status')->default('DELIVERED');
            $table->timestamps();
        });

        // Site 3.
        Schema::connection('sqlsrv')->create('deliveries_1', function (Blueprint $table) {
            $table->unsignedInteger('id');
            $table->string('delivery_no');
            $table->unsignedInteger('sender_id');
            $table->unsignedInteger('recipient_id');
            $table->unsignedInteger('agent_id')->nullable();
            $table->string('delivery_status')->default('PENDING');
            $table->timestamps();
        });

        Schema::connection('sqlsrv')->create('deliveries_2', function (Blueprint $table) {
            $table->unsignedInteger('id');
            $table->string('delivery_no');
            $table->unsignedInteger('sender_id');
            $table->unsignedInteger('recipient_id');
            $table->unsignedInteger('agent_id')->nullable();
            $table->string('delivery_status')->default('DELIVERED');
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
        Schema::connection('mysql')->dropIfExists('deliveries_1');
        Schema::connection('mysql')->dropIfExists('deliveries_2');
        Schema::connection('pgsql')->dropIfExists('deliveries_1');
        Schema::connection('pgsql')->dropIfExists('deliveries_2');
        Schema::connection('sqlsrv')->dropIfExists('deliveries_1');
        Schema::connection('sqlsrv')->dropIfExists('deliveries_2');
    }
}
