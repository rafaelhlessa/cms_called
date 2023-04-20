<?php

namespace Database\Migrations;

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

return new class extends Migration
{

    public function up(): void
    {
        Schema::create('called_has_parts', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->id();
            $table->unsignedBigInteger('called_id');
            $table->unsignedBigInteger('parts_id');
            $table->string('amount', 45);


            $table->index(["parts_id"]);
            $table->index(["called_id"]);
            $table->timestamps();


            // $table->foreign('called_id')
            //     ->references('id')->on('called')
            //     ->onDelete('no action')
            //     ->onUpdate('no action');

            // $table->foreign('parts_id')
            //     ->references('id')->on('parts')
            //     ->onDelete('no action')
            //     ->onUpdate('no action');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down(): void
    {
        Schema::dropIfExists('called_has_parts');
    }
};
