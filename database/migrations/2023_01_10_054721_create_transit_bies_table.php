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
        Schema::create('transit_bies', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('slug');
            $table->foreignId('voyage_via_id')->nullable()->constrained('voyage_vias');
            $table->decimal('stamp_amount')->default(0);
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
        Schema::dropIfExists('transit_bies');
    }
};
