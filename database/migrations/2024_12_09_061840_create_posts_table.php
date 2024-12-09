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
        Schema::create('posts', function (Blueprint $table) {
            $table->id(); // Унікальний ідентифікатор
            $table->foreignId('user_id')->constrained()->onDelete('cascade'); // Зв'язок із таблицею users
            $table->string('title'); // Заголовок поста
            $table->text('text'); // Текст поста
            $table->string('image')->nullable(); // URL або ім'я файлу зображення
            $table->timestamps(); // created_at і updated_at
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('posts');
    }
};
