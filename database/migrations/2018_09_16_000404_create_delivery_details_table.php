<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDeliveryDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        // Site 1.
        Schema::connection('mysql')->create('delivery_details_1', function (Blueprint $table) {
            $table->unsignedInteger('id');
            $table->unsignedInteger('delivery_id');
            $table->float('weight');
            $table->timestamps();
        });
        Schema::connection('mysql')->create('delivery_details_2', function (Blueprint $table) {
            $table->unsignedInteger('id');
            $table->longText('description');
            $table->timestamps();
        });

        // Site 2.
        Schema::connection('pgsql')->create('delivery_details_1', function (Blueprint $table) {
            $table->unsignedInteger('id');
            $table->unsignedInteger('delivery_id');
            $table->float('weight');
            $table->timestamps();
        });
        Schema::connection('pgsql')->create('delivery_details_2', function (Blueprint $table) {
            $table->unsignedInteger('id');
            $table->longText('description');
            $table->timestamps();
        });

        // Site 3.
        Schema::connection('sqlsrv')->create('delivery_details_1', function (Blueprint $table) {
            $table->unsignedInteger('id');
            $table->unsignedInteger('delivery_id');
            $table->float('weight');
            $table->timestamps();
        });
        Schema::connection('sqlsrv')->create('delivery_details_2', function (Blueprint $table) {
            $table->unsignedInteger('id');
            $table->longText('description');
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
        Schema::connection('mysql')->dropIfExists('delivery_details_1');
        Schema::connection('mysql')->dropIfExists('delivery_details_2');
        Schema::connection('pgsql')->dropIfExists('delivery_details_1');
        Schema::connection('pgsql')->dropIfExists('delivery_details_2');
        Schema::connection('sqlsrv')->dropIfExists('delivery_details_1');
        Schema::connection('sqlsrv')->dropIfExists('delivery_details_2');
    }
}
