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
        Schema::create('motor_additional_perils_details', function (Blueprint $table) {
            $table->id();
            $table->foreignId('motor_insurance_id')->nullable()->constrained('motor_insurances');
            $table->foreignId('perils_id')->nullable()->constrained('additional_perils');
            $table->decimal('amount')->default(0);
            $table->decimal('premium_rate')->default(0);
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
        Schema::dropIfExists('motor_additional_perils_details');
    }
};
