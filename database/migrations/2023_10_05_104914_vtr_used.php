<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        //
        Schema::create('vtr_used', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->id();
            $table->integer('kmstart');
            $table->integer('kmend')->nullable();
            $table->string('fuel', 10);
            $table->date('date_go');
            $table->date('date_back')->nullable();
            $table->index(["cars_id"]);

            $table->index(["drivers_id"]);


            $table->foreignId('cars_id')
                ->nullable()
                ->references('id')->on('cars')
                ->onDelete('no action')
                ->onUpdate('no action');


            $table->foreignId('drivers_id')
                ->nullable()
                ->references('id')->on('drivers')
                ->onDelete('no action')
                ->onUpdate('no action');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('vtr_used');
    }
};
