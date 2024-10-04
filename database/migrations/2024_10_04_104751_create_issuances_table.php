<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('issuances', function (Blueprint $table) {
            $table->id();

            $table->foreignId('book_id')->constrained()->onDelete('cascade');
            $table->foreignId('reader_id')->constrained()->onDelete('cascade');
            $table->date('book_date')->nullable();
            $table->date('return_date')->nullable();
            $table->string('status')->default('pending');

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('issuances');
    }
};
