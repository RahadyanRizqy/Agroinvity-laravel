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
        Schema::create('expenses', function (Blueprint $table) {
            $table->increments("expense_id");
            $table->string("name", 255)->unique();
            $table->integer("quantity");
            $table->integer("price_per_qty");
            $table->timestamps();
            $table->unsignedTinyInteger("account_fk");
            $table->unsignedTinyInteger("expense_type_fk");

            // foreign
            $table->foreign("account_fk")
                ->references("account_id")
                ->on("accounts")
                ->onDelete('cascade')
                ->onUpdate('cascade');

            $table->foreign("expense_type_fk")
                ->references("expense_type_id")
                ->on("expense_types")
                ->onDelete('cascade')
                ->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('expenses');
    }
};
