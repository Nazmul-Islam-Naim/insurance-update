<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOtherPaymentVouchersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('other_payment_vouchers', function (Blueprint $table) {
            $table->id();
            $table->foreignId('payment_type_id')->constrained('other_payment_types')->onDelete('cascade');
            $table->foreignId('payment_sub_type_id')->constrained('other_payment_sub_types')->onDelete('cascade');
            $table->foreignId('bank_id')->constrained('bank_accounts')->onDelete('cascade');
            $table->text('payment_for');
            $table->decimal('amount');
            $table->date('payment_date');
            $table->string('issue_by');
            $table->text('note')->nullable();
            $table->tinyInteger('status');
            $table->tinyInteger('created_by');
            $table->string('tok');
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
        Schema::dropIfExists('other_payment_vouchers');
    }
}
