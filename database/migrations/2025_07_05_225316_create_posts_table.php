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
    Schema::create('posts', function (Blueprint $table) {
        $table->id();
        $table->string('titulo');
        $table->string('slug')->unique();
        $table->text('extracto')->nullable();
        $table->mediumText('contenido')->nullable();
        $table->string('img_path')->nullable();

        $table->foreignId('user_id')
            ->constrained()
            ->onDelete('cascade');

        $table->foreignId('categoria_id') 
            ->constrained()  
            ->onDelete('cascade');

        $table->boolean('publicado')->default(false);
        $table->timestamp('publicado_en')->nullable();

        $table->timestamps();
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
