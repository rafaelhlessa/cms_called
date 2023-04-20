<?php

namespace Database\Migrations;

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

return new class extends Migration
{

    public function up(): void
    {
        Schema::create('called', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->id();
            $table->string('glpi', 45);
            $table->string('pim', 45)->nullable();
            $table->string('name', 45)->nullable();
            $table->string('phone', 45)->nullable();
            $table->text('service');

            // $table->unsignedBigInteger('tecnic_id');
            // $table->unsignedBigInteger('status_id');

            $table->index(["technic_id"]);

            $table->index(["status_id"]);


            $table->foreignId('technic_id')
                ->nullable()
                ->references('id')->on('technic')
                ->onDelete('no action')
                ->onUpdate('no action');


            $table->foreignId('status_id')
                ->nullable()
                ->references('id')->on('status')
                ->onDelete('no action')
                ->onUpdate('no action');
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
        Schema::dropIfExists('called');
    }
};
