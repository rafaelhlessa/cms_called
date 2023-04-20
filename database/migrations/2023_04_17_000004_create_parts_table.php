<?php

namespace Database\Migrations;

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

return new class extends Migration
{

    public function up(): void
    {
        Schema::create('parts', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->id();
            $table->string('description', 200);
            $table->string('price', 45)->nullable();
            $table->date('buy_date')->nullable();
            $table->unsignedBigInteger('parts_type_id');


            $table->index(["parts_type_id"]);


            // $table->foreign('parts_type_id')
            //     ->references('id')->on('parts_type')
            //     ->onDelete('no action')
            //     ->onUpdate('no action');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down(): void
    {
        Schema::dropIfExists('parts');
    }
};
