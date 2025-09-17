<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('sliders', function (Blueprint $table) {
            $table->id();
            $table->string('photo'); // Putanja do slike
            $table->string('title')->nullable(); // Naslov slajdera
            $table->text('description')->nullable(); // Opis
            $table->boolean('is_active')->default(true); // Da li je slajder aktivan
            $table->timestamps(); // created_at i updated_at
        });
    }

    public function down()
    {
        Schema::dropIfExists('sliders');
    }
};