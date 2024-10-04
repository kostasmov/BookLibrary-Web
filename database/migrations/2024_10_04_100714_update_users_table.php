<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->string('role')->default('user')->after('password');

            $table->renameColumn('name', 'login');

            $table->foreignId('reader_id')->after('role')->unique()->constrained('readers')->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->renameColumn('login', 'name');

            $table->dropForeign(['reader_id']);
            $table->dropColumn('reader_id');

            $table->dropColumn('role');
        });
    }
};

