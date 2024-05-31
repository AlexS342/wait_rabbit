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
        Schema::create('reviews', function (Blueprint $table) {
            $table->id();

            $table->string('username', length: 15)->comment('имя пользователя (цифры и латинские буквы)');
            $table->string('email', length: 50)->comment('почта пользователя');
            $table->text('review')->comment('отзыв пользователя');
            $table->string('ip', length: 15)->comment('ip пользователя');
            $table->text('browser')->comment('браузер пользователя');

            $table->bigInteger('created_at')->comment('Дата создания записи');
            $table->bigInteger('updated_at')->comment('Дата внесенных изменений');
            $table->bigInteger('deleted_at')->nullable()->comment('Дата удаления записи');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::drop('reviews');
    }
};
