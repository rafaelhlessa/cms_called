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
        Schema::create('island_stores', function (Blueprint $table) {
            $table->id();
            $table->integer('amount');
            $table->foreignId('parts_id')
                ->references('id')->on('parts')
                ->onDelete('no action')
                ->onUpdate('no action');
            $table->index(["parts_id"]);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('island_stores');
    }
};
