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
        Schema::create('team_employee', function (Blueprint $table) {
            $table->id();
            $table->foreignId('team_id')->nullable()->references('id')->on('teams')->onDelete('no action')->onUpdate('no action');
            $table->foreignId('employee_id')->nullable()->references('id')->on('employees')->onDelete('no action')->onUpdate('no action');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('team_employee');
    }
};
