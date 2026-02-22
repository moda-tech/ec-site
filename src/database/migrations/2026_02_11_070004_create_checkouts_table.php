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
        Schema::create('checkouts', function (Blueprint $table) {
            // PK
            $table->id();

            // 注文FK
            $table->foreignId('order_id')
            ->constrained()
            ->cascadeOnDelete();

            // 商品FK
            $table->foreignId('material_id')
                  ->constrained()
                  ->cascadeOnDelete();

            // 個数
            $table->integer('quantity');

            // 購入時単価
            $table->integer('price');

            // 小計
            $table->integer('subtotal');

            $table->timestamp('created_at')->useCurrent();
            $table->timestamp('updated_at')->useCurrent()->useCurrentOnUpdate();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('checkouts');
    }
};

