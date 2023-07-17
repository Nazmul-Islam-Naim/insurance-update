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
        Schema::create('account_info_motor_insurances', function (Blueprint $table) {
            $table->id();
            $table->foreignId('motor_insurance_id')->nullable()->constrained('motor_insurances')->onDelete('cascade');
            $table->decimal('insured_amount',15,2)->default(0);
            $table->decimal('premium_percent')->default(0);
            $table->decimal('ncb_percent')->nullable();
            $table->decimal('net_premium',15,2)->default(0);
            $table->decimal('vat_percent')->default(0);
            $table->decimal('grand_total',15,2)->default(0);
            $table->decimal('payment_percent')->nullable();
            $table->decimal('payment',15,2)->nullable();
            $table->decimal('collected_amount',15,2)->nullable();
            $table->decimal('due',15,2)->nullable();
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
        Schema::dropIfExists('account_info_motor_insurances');
    }
};
