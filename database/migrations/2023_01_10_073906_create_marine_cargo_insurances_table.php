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
        Schema::create('marine_cargo_insurances', function (Blueprint $table) {
            $table->id();
            $table->string('insurance_code',15)->nullable();
            $table->foreignId('client_id')->nullable()->constrained('client_insureds');
            $table->foreignId('bank_id')->nullable()->constrained('banks');
            $table->foreignId('interest_covered_id')->nullable()->constrained('products');
            $table->foreignId('voyage_from_id')->nullable()->constrained('voyage_froms');
            $table->foreignId('voyage_to_id')->nullable()->constrained('voyage_tos');
            $table->foreignId('voyage_via_id')->nullable()->constrained('voyage_vias');
            $table->foreignId('transit_by_id')->nullable()->constrained('transit_bies');
            $table->date('period_from')->nullable();
            $table->date('period_to')->nullable();
            $table->decimal('amount_in_dollar',15,2)->default(0);
            $table->decimal('extra_percent')->default(0);
            $table->foreignId('currency_id')->nullable();
            $table->decimal('rate')->default(0);
            $table->decimal('amount_in_bdt',15,2)->default(0);
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
        Schema::dropIfExists('marine_cargo_insurances');
    }
};
