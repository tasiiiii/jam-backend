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
        Schema::create('team_user_roles', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('permission');
            $table->unsignedBigInteger('team_id');
            $table->foreign('team_id')->on('teams')->references('id');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('team_user_roles');
    }
};
