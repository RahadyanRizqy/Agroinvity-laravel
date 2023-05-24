<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Carbon\Carbon;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->string("name", 255)->unique();
            $table->integer("price_per_qty");
            $table->timestamp("stored_at")->default(Carbon::now()->format('Y-m-d H:i:s'));
            $table->integer("total_qty");
            $table->integer("sold_products");
            $table->integer("stock_products")->virtualAs("total_qty-sold_products");

            $table->unsignedBigInteger("account_fk");

            // foreign
            $table->foreign("account_fk")
                ->references("id")
                ->on("accounts")
                ->onDelete('cascade')
                ->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('incomes');
    }
};
