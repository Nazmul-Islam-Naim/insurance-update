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
        Schema::create('account_information_marin_insurances', function (Blueprint $table) {
            $table->id();
            $table->foreignId('marine_cargo_insurance_id')->nullable();
            $table->decimal('amount_in_dollar',15,2)->default(0);
            $table->decimal('extra_percent')->default(0);
            $table->decimal('extra_percent_amount')->default(0);
            $table->foreignId('currency_id')->nullable();
            $table->decimal('rate')->default(0);
            $table->decimal('amount_in_bdt',15,2)->default(0);
            $table->decimal('premium_percent')->default(0);
            $table->decimal('premium',15,2)->default(0);
            $table->decimal('discount_percent')->nullable();
            $table->decimal('discount_amount',15,2)->nullable();
            $table->decimal('net_premium',15,2)->default(0);
            $table->decimal('vat_percent')->default(0);
            $table->decimal('vat_amount',15,2)->default(0);
            $table->decimal('stamp_duty',15,2)->default(0);
            $table->decimal('grand_total',15,2)->default(0);
            $table->decimal('payment_percent')->nullable();
            $table->decimal('payment_percent_amount',15,2)->nullable();
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
        Schema::dropIfExists('account_information_marin_insurances');
    }
};
