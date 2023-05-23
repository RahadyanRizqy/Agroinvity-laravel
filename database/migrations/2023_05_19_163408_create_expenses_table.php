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
        Schema::create('expenses', function (Blueprint $table) {
            $table->id();
            $table->string("name", 255)->unique();
            $table->integer("quantity");
            $table->integer("price_per_qty");
            $table->timestamp("created_at")->default(Carbon::now()->format('Y-m-d H:i:s'));
            $table->timestamp("updated_at")->default(Carbon::now()->format('Y-m-d H:i:s'));
            $table->unsignedBigInteger("account_fk");
            $table->unsignedBigInteger("expense_type_fk");

            // foreign
            $table->foreign("account_fk")
                ->references("id")
                ->on("accounts")
                ->onDelete('cascade')
                ->onUpdate('cascade');

            $table->foreign("expense_type_fk")
                ->references("id")
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
