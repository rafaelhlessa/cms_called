<?php

namespace Database\Migrations;

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

return new class extends Migration
{

    public function up(): void
    {
        Schema::create('report_has_parts', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->id();
            // $table->unsignedBigInteger('reports_id');
            // $table->unsignedBigInteger('parts_id');
            $table->integer('amount');

            $table->foreignId('parts_id')
                ->references('id')->on('parts')
                ->onDelete('no action')
                ->onUpdate('no action');

            $table->foreignId('report_id')
                ->references('id')->on('report')
                ->onDelete('no action')
                ->onUpdate('no action');
    
            $table->index(["parts_id"]);
            $table->index(["report_id"]);
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
        Schema::dropIfExists('report_has_parts');
    }
};
