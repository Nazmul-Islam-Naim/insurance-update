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
        Schema::create('fire_insurances', function (Blueprint $table) {
            $table->id();
            $table->string('insurance_code',15)->nullable();
            $table->foreignId('client_id')->nullable()->constrained('client_insureds');
            $table->foreignId('bank_id')->nullable()->constrained('banks');
            $table->date('period_from')->nullable();
            $table->date('period_to')->nullable();
            $table->string('used_as')->nullable();
            $table->text('situation')->nullable();
            $table->text('construction_premises')->nullable();
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
        Schema::dropIfExists('fire_insurances');
    }
};
