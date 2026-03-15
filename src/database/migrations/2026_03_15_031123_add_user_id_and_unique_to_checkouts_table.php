<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('checkouts', function (Blueprint $table) {
            $table->foreignId('user_id')
                  ->after('order_id')
                  ->constrained() //外部キー制約、usersテーブルに存在するもののみ登録
                  ->cascadeOnDelete();

            $table->unique(['user_id', 'material_id']);
        });
    }

    public function down(): void
    {
        Schema::table('checkouts', function (Blueprint $table) {
            $table->dropUnique(['user_id', 'material_id']);
            $table->dropForeign(['user_id']);
            $table->dropColumn('user_id');
        });
    }
};
