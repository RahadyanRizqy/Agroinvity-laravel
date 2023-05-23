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
        Schema::create('articles', function (Blueprint $table) {
            $table->id();
            $table->string('title', 255);
            $table->text('text');
            $table->string('image');
            $table->timestamp("created_at")->default(Carbon::now()->format('Y-m-d H:i:s'));
            $table->timestamp("updated_at")->default(Carbon::now()->format('Y-m-d H:i:s'));
            $table->unsignedBigInteger("account_fk")->default(1);

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
        Schema::dropIfExists('articles');
    }
};
