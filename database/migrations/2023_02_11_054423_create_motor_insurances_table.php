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
        Schema::create('motor_insurances', function (Blueprint $table) {
            $table->id();
            $table->string('insurance_code',15)->nullable();
            $table->foreignId('client_id')->nullable()->constrained('client_insureds');
            $table->foreignId('bank_id')->nullable()->constrained('banks');
            $table->foreignId('tarrif_calculation_id')->nullable()->constrained('tarrif_calculations');
            $table->text('reg_no')->nullable();
            $table->text('engine_no')->nullable();
            $table->text('chassis_no')->nullable();
            $table->text('model_no')->nullable();
            $table->date('period_from')->nullable();
            $table->date('period_to')->nullable();
            $table->text('declaration')->nullable();
            $table->text('risk_option')->nullable();
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
        Schema::dropIfExists('motor_insurances');
    }
};
