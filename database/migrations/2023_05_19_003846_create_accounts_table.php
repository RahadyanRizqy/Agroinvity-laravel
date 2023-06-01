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
        Schema::create('accounts', function (Blueprint $table) {
            $table->id();
            $table->string("fullname", 255);
            $table->string("email", 255)->unique();
            $table->string("password", 255);
            $table->bigInteger("phone_number");
            $table->boolean("status")->default(true);
            $table->timestamp("registered_at");
            // $table->timestamp("created_at")->default(Carbon::now()->format('Y-m-d H:i:s'));
            // $table->timestamp("updated_at")->default(Carbon::now()->format('Y-m-d H:i:s'));
            $table->timestamp("date_now")->default(DB::raw('CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP'));
            $table->timestamp("end_date")->default(DB::raw('DATE_ADD(registered_at, INTERVAL 30 DAY)'));
            $table->integer("remaining_days")->default(DB::raw('DATEDIFF(end_date, CURDATE())'));
            
            $table->unsignedBigInteger('account_type_fk')->default(2);
            $table->unsignedBigInteger('account_rel_fk')->nullable();

            $table->foreign('account_type_fk')
                ->references('id')
                ->on('account_types')
                ->onDelete('cascade')
                ->onUpdate('cascade');

            $table->foreign('account_rel_fk')
                ->references('id')
                ->on('accounts')
                ->onDelete('cascade')
                ->onUpdate('cascade');
        });

            // Define the foreign key constraint for the recursive relation
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('accounts');
    }
};
