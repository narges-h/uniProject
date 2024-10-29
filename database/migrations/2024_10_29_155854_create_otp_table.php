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
        Schema::create('otp', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->string('otp');
            $table->unsignedBigInteger('user_id'); // تعریف فیلد user_id
        

            // تعریف کلید خارجی به صورت جداگانه
            $table->foreign('user_id')
                  ->references('id')->on('users')
                  ->onDelete('cascade'); // حذف کاربر موجب حذف OTP می‌شود
        });

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('otp');
    }
};
