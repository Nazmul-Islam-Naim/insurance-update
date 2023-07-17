<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOtherReceiveVouchersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('other_receive_vouchers', function (Blueprint $table) {
            $table->id();
            $table->foreignId('receive_type_id')->constrained('other_receive_types')->onDelete('cascade');
            $table->foreignId('receive_sub_type_id')->constrained('other_receive_sub_types')->onDelete('cascade');
            $table->foreignId('bank_id')->constrained('bank_accounts')->onDelete('cascade');
            $table->text('receive_from');
            $table->decimal('amount');
            $table->date('receive_date');
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
        Schema::dropIfExists('other_receive_vouchers');
    }
}
