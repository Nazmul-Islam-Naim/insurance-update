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
        Schema::create('bill_collection_motors', function (Blueprint $table) {
            $table->id();
            $table->foreignId('insurance_id')->nullable();
            $table->decimal('amount',15,2)->default(0);
            $table->tinyInteger('collection_type')->nullable();
            $table->string('cheque_number')->nullable();
            $table->string('bank_name')->nullable();
            $table->integer('bank_id')->nullable();
            $table->date('date')->nullable();
            $table->string('note')->nullable();
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
        Schema::dropIfExists('bill_collection_motors');
    }
};
