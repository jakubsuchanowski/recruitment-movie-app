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
        Schema::create('movies', function (Blueprint $table) {
            $table->id();
            $table->integer('external_id');
            $table->string('title_pl')->nullable();
            $table->string('title_en')->nullable();
            $table->string('title_de')->nullable();
            $table->text('overview_pl')->nullable();
            $table->text('overview_en')->nullable();
            $table->text('overview_de')->nullable();
            $table->float('vote_average')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('movies');
    }
};
