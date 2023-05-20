<?php

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
        DB::unprepared('
        CREATE TRIGGER update_status_trigger BEFORE UPDATE ON accounts
        FOR EACH ROW
        BEGIN
            IF NEW.remaining_days < 0 THEN
                SET NEW.status = false;
            END IF;
        END
    ');
        // DB::unprepared('CREATE TRIGGER `update_child_status` BEFORE UPDATE ON `accounts` FOR EACH ROW UPDATE accounts AS b JOIN accounts AS a ON b.account_rel_fk = a.account_id SET b.status = a.status WHERE b.account_rel_fk = a.account_id;');

        // DB::unprepared('CREATE TRIGGER `update_child_status` BEFORE UPDATE ON `accounts` FOR EACH ROW UPDATE accounts AS b JOIN accounts AS a ON b.account_rel_fk = a.account_id SET b.status = a.status WHERE b.account_rel_fk = a.account_id;');
    }
    

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('trigger');
    }
};
