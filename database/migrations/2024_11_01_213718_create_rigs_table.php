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
        Schema::create('rigs', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('location');
            $table->foreignId('company_id')->constrained('companies'); // Foreign key to 'companies' table
            $table->foreignId('registered_by')->constrained('users');   // Foreign key to 'users' table
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('rigs');
    }
};
