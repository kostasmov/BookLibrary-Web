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

            $table->unsignedBigInteger('reader_id')->after('role');
            $table->foreign('reader_id')->references('id')->on('readers')->onDelete('cascade')->onUpdate('cascade');
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

