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
        Schema::create('fire_insurance_product_details', function (Blueprint $table) {
            $table->id();
            $table->foreignId('fire_insurance_id')->nullable()->constrained('fire_insurances');
            $table->foreignId('product_id')->nullable()->constrained('products');
            $table->decimal('product_amount',15,2)->default(0);
            $table->decimal('s_per')->default(0);
            $table->decimal('product_rate')->default(0);
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
        Schema::dropIfExists('fire_insurance_product_details');
    }
};
