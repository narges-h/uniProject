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
        Schema::table('users', function (Blueprint $table) {
            $table->string('mobile')->nullable();
            $table->boolean('is_verified')->default(false);
            $table->string('family')->nullable();
            $table->date('birthdate')->nullable();
            $table->string('nationalCode')->nullable()->unique();
            $table->text('address')->nullable();
            $table->string('province')->nullable();
            $table->string('city')->nullable();
            $table->enum('user_type', ['admin', 'user'])->default('user');

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            //
        });
    }
};
