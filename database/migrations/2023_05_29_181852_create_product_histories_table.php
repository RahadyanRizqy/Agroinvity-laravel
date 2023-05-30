<?php

use Carbon\Carbon;
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
        Schema::create('product_histories', function (Blueprint $table) {
            $table->id();
            $table->string("name", 255);
            $table->integer("price_per_qty");
            $table->timestamp("stored_at")->nullable();
            $table->timestamp("updated_at")->nullable();
            $table->integer("total_qty");
            $table->integer("sold_products");
            $table->integer("stock_products");
            $table->unsignedBigInteger("product_fk");
            $table->unsignedBigInteger("account_fk");

            // foreign
            $table->foreign("product_fk")
                ->references("id")
                ->on("products")
                ->onDelete("cascade")
                ->onUpdate("cascade");
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('product_histories');
    }
};
