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

        Schema::table('otps', function (Blueprint $table) {
            // ابتدا حذف کلید خارجی
            $table->dropForeign(['user_id']);

            // سپس فیلد user_id را حذف کن
            $table->dropColumn('user_id'); // حذف فیلد user_id
            $table->string('phone')->after('otp'); // اضافه کردن فیلد phone
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('otps', function (Blueprint $table) {
            $table->unsignedBigInteger('user_id')->nullable();

            // سپس، کلید خارجی را دوباره اضافه کن
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');

            // و در نهایت، فیلد phone را کم کن
            $table->dropColumn('phone'); // حذف فیلد phone
        });
    }
};
