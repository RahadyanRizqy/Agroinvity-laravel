<?php

use Carbon\Carbon;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('tokens', function (Blueprint $table) {
            $table->id();
            $table->string("token");
            $table->timestamp('requested_at')->default(Carbon::now()->format('Y-m-d H:i:s'));
            $table->timestamp('expired_at')->default(DB::raw('DATE_ADD(requested_at, INTERVAL 7 MINUTE)'));
            $table->boolean("status")->default(true);
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
        Schema::dropIfExists('tokens');
    }
};
