<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDeliveryDetailsTable extends Migration
{
    public function __construct() {
        $this->drivers = ['sqlsrv', 'mysql', 'pgsql'];
        $this->tables = [
            ['delivery_details_1', 'delivery_details_2'],
            ['delivery_details_3', 'delivery_details_4'],
        ];
    }

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        foreach ($this->drivers as $driver) {
            for ($i = 0; $i < 2; $i++) {
                Schema::connection($driver)->create($this->tables[$i][0], function (Blueprint $table) {
                    $table->unsignedInteger('id');
                    $table->unsignedInteger('delivery_id');
                    $table->float('weight');
                    $table->timestamps();
                });
                Schema::connection($driver)->create($this->tables[$i][1], function (Blueprint $table) {
                    $table->unsignedInteger('id');
                    $table->longText('description');
                    $table->timestamps();
                });
            }
        }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        // Drop databases from all drivers
        foreach ($this->drivers as $driver) {
            Schema::connection($driver)->dropIfExists('delivery_details_1');
            Schema::connection($driver)->dropIfExists('delivery_details_2');
            Schema::connection($driver)->dropIfExists('delivery_details_3');
            Schema::connection($driver)->dropIfExists('delivery_details_4');
        }
    }
}
