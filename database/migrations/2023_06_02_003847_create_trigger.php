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
        DB::unprepared("
        CREATE TRIGGER product_update_trigger AFTER UPDATE ON products
        FOR EACH ROW
        BEGIN
        IF NEW.price_per_qty != OLD.price_per_qty OR
            NEW.total_qty != OLD.total_qty OR
            NEW.sold_products != OLD.sold_products OR
            NEW.name != OLD.name THEN

            INSERT INTO product_histories 
            (name, price_per_qty, total_qty, sold_products, stock_products, updated_at, product_fk, account_fk)

            VALUES 
            (NEW.name, NEW.price_per_qty, NEW.total_qty, NEW.sold_products, NEW.stock_products, DATE_FORMAT(NOW(), '%Y-%m-%d %H:%i:%s'), NEW.id, NEW.account_fk);
        END IF;
        END;
        ");

        DB::unprepared("
        CREATE TRIGGER product_insert_trigger AFTER INSERT ON products
        FOR EACH ROW
        BEGIN
        INSERT INTO product_histories 
        (name, price_per_qty, total_qty, sold_products, stock_products, stored_at, updated_at, product_fk, account_fk)

        VALUES 
        (NEW.name, NEW.price_per_qty, NEW.total_qty, NEW.sold_products, NEW.stock_products, NEW.stored_at, DATE_FORMAT(NOW(), '%Y-%m-%d %H:%i:%s'), NEW.id, NEW.account_fk);
        END;
        ");

        DB::unprepared("
        CREATE TRIGGER expense_update_trigger AFTER UPDATE ON expenses
        FOR EACH ROW
        BEGIN
        IF NEW.price_per_qty != OLD.price_per_qty OR
            NEW.quantity != OLD.quantity OR
            NEW.name != OLD.name THEN

            INSERT INTO expense_histories 
            (name, price_per_qty, quantity, account_fk, updated_at, expense_type_fk, expense_fk)

            VALUES 
            (NEW.name, NEW.price_per_qty, NEW.quantity, NEW.account_fk, DATE_FORMAT(NOW(), '%Y-%m-%d %H:%i:%s'), NEW.expense_type_fk, NEW.id);
        END IF;
        END;
        ");

        DB::unprepared("
        CREATE TRIGGER expense_insert_trigger AFTER INSERT ON expenses
        FOR EACH ROW
        BEGIN
        INSERT INTO expense_histories 
        (name, price_per_qty, quantity, account_fk, stored_at, updated_at, expense_type_fk, expense_fk)

        VALUES 
        (NEW.name, NEW.price_per_qty, NEW.quantity, NEW.account_fk, NEW.stored_at, DATE_FORMAT(NOW(), '%Y-%m-%d %H:%i:%s'), NEW.expense_type_fk, NEW.id);
        END;
        ");
    }
    

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('trigger');
    }
};
