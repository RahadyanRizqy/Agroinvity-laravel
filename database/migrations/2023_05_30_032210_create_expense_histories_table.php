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
        Schema::create('expense_histories', function (Blueprint $table) {
            $table->id();
            $table->string("name", 255);
            $table->integer("quantity");
            $table->integer("price_per_qty");
            $table->timestamp("stored_at")->nullable();
            $table->timestamp("updated_at")->nullable();
            $table->unsignedBigInteger("account_fk");
            $table->unsignedBigInteger("expense_type_fk");
            $table->unsignedBigInteger("expense_fk");

            // foreign
            $table->foreign("expense_fk")
                ->references("id")
                ->on("expenses")
                ->onDelete('cascade')
                ->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('expense_histories');
    }
};
