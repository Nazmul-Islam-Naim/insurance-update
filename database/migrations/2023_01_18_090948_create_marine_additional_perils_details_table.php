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
        Schema::create('marine_additional_perils', function (Blueprint $table) {
            $table->id();
            $table->foreignId('marine_cargo_insurance_id')->nullable()->constrained('marine_cargo_insurances');
            $table->foreignId('perils_id')->nullable()->constrained('additional_perils');
            $table->decimal('amount');
            $table->decimal('premium_rate');
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
        Schema::dropIfExists('marine_additional_perils_details');
    }
};
