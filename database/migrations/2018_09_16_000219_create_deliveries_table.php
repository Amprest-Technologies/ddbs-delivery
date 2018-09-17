<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDeliveriesTable extends Migration
{
    /**
     * Avail variables to all models.
     *
    */
    public function __construct() {
        $this->drivers = ['sqlsrv', 'mysql', 'pgsql'];
        $this->tables = ['deliveries_1', 'deliveries_2'];
    }
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        foreach ($this->drivers as $driver) {
            foreach ($this->tables as $table) {
                Schema::connection($driver)->create($table, function (Blueprint $table) {
                    $table->unsignedInteger('id');
                    $table->string('delivery_no');
                    $table->unsignedInteger('sender_id');
                    $table->unsignedInteger('recipient_id');
                    $table->unsignedInteger('agent_id')->nullable();
                    $table->string('delivery_status');
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
        foreach ($this->drivers as $driver) {
            foreach ($this->tables as $table) {
                Schema::connection($driver)->dropIfExists($table);
            }
        }
    }
}
