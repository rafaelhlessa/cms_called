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
        Schema::create('cars', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->id();
            $table->string('plate', 8);
            $table->string('brandmodel', 200);
            $table->integer('km');
            $table->integer('fuel');
            $table->boolean('used');
            $table->string('qrcode', 200)->nullable();
            $table->index(["drivers_id"]);

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
        Schema::dropIfExists('cars');
    }
};
