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
        Schema::create('bank_client_ledgers', function (Blueprint $table) {
            $table->id();
            $table->foreignId('client_id')->nullable();
            $table->foreignId('bank_id')->nullable();
            $table->integer('creator_id')->nullable();
            $table->integer('insurance_id')->nullable();
            $table->string('insurance_type')->nullable();
            $table->string('reason')->nullable();
            $table->decimal('amount',15,2)->default(0);
            $table->date('date')->nullable();
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
        Schema::dropIfExists('bank_client_ledgers');
    }
};
