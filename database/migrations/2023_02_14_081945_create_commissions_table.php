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
        Schema::create('commissions', function (Blueprint $table) {
            $table->id();
            $table->foreignId('insurance_id')->constrained('marine_cargo_insurances')->onDelete('cascade');
            $table->unsignedBigInteger('client_id');
            $table->unsignedBigInteger('bank_id');
            $table->unsignedBigInteger('payment_method');
            $table->string('insurance_type');
            $table->date('date');
            $table->text('note')->nullable();
            $table->decimal('insured_amount',15,2)->default(0);
            $table->decimal('total_percent')->default(0);
            $table->decimal('total_amount',15,2)->default(0);
            $table->integer('branch_id')->default(1)->default(0);
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
        Schema::dropIfExists('commissions');
    }
};
