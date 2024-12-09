<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::table('cart_items', function (Blueprint $table) {
            // حذف کلید خارجی قبلی
            $table->dropForeign(['product_id']);

            // اضافه کردن کلید خارجی جدید به جدول 'books'
            $table->foreign('product_id')
                ->references('id')->on('books')
                ->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::table('cart_items', function (Blueprint $table) {
            // حذف کلید خارجی در زمان بازگشت
            $table->dropForeign(['product_id']);
        });
    }
};
