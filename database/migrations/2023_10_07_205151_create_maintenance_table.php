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
        Schema::create('maintenance', function (Blueprint $table) {
            $table->id();
            $table->text('description');
            $table->integer('oil')->nullable();
            $table->boolean('active');
            $table->decimal('cost', 8, 2)->nullable();
            $table->date('forecast')->nullable();
            $table->string('icon')->nullable();
            $table->string('iconBackground')->nullable();
            $table->string('service', 100)->nullable();
            $table->index(["cars_id"]);
            $table->index(["drivers_id"]);
            $table->index(["factory_id"]);

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
            $table->foreignId('factory_id')
                ->nullable()
                ->references('id')->on('factory')
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
        Schema::dropIfExists('maintenance');
    }
};
