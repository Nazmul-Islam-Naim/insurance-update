<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tarrif_calculations', function (Blueprint $table) {
            $table->id();
            $table->foreignId('tarrif_id')->nullable()->constraind('traffi_types');
            $table->decimal('basic',15,2)->default(0);
            $table->decimal('act_laibility',15,2)->default(0);
            $table->decimal('per_passenger_fee',15,2)->default(0);
            $table->integer('passenger')->default(0);
            $table->decimal('driver_fee',15,2)->default(0);
            $table->decimal('net_amount',15,2)->default(0);
            $table->decimal('vat_percent')->default(0);
            $table->integer('branch_id')->default(1);
            $table->integer('created_by')->default(1);
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
        Schema::dropIfExists('tarrif_calculations');
    }
};
