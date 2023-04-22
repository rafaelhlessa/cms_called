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
        Schema::create('purchase', function (Blueprint $table) {
            $table->id();
            $table->integer('amount');
            $table->decimal('priceu', 10,2)->nullable();
            $table->date('buy_date')->nullable();
            $table->foreignId('parts_id')
                ->references('id')->on('parts')
                ->onDelete('no action')
                ->onUpdate('no action');
            $table->index(["parts_id"]);
            $table->decimal('pricet', 10,2)->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('purchase');
    }
};
