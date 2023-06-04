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

            INSERT INTO activity_logs
            (logs, account_fk)

            VALUES
            (CONCAT('Telah mengubah data produk dengan id: ', NEW.id), NEW.account_fk);
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

            INSERT INTO activity_logs
            (logs, account_fk)

            VALUES
            (CONCAT('Telah menginputkan data produk baru dengan id: ', NEW.id), NEW.account_fk);
        END;
        ");

        DB::unprepared("
        CREATE TRIGGER product_delete_trigger AFTER DELETE ON products
        FOR EACH ROW
        BEGIN
            INSERT INTO activity_logs
            (logs, account_fk)

            VALUES
            (CONCAT('Telah menghapus data produk dengan id: ', OLD.id), OLD.account_fk);
        END;
        ");
     
        // SELF
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

                IF NEW.expense_type_fk = 1 THEN
                    INSERT INTO activity_logs
                    (logs, account_fk)
                    VALUES
                    (CONCAT('Telah mengubah data bahan baku dengan id: ', NEW.id), NEW.account_fk);
                ELSEIF NEW.expense_type_fk = 2 THEN
                    INSERT INTO activity_logs
                    (logs, account_fk)
                    VALUES
                    (CONCAT('Telah mengubah data operasional dengan id: ', NEW.id), NEW.account_fk);
                END IF;
            END IF;
        END
        ");

        DB::unprepared("
        CREATE TRIGGER expense_insert_trigger AFTER INSERT ON expenses
        FOR EACH ROW
        BEGIN
            INSERT INTO expense_histories 
            (name, price_per_qty, quantity, account_fk, stored_at, updated_at, expense_type_fk, expense_fk)
            VALUES 
            (NEW.name, NEW.price_per_qty, NEW.quantity, NEW.account_fk, NEW.stored_at, DATE_FORMAT(NOW(), '%Y-%m-%d %H:%i:%s'), NEW.expense_type_fk, NEW.id);

            IF NEW.expense_type_fk = 1 THEN
                INSERT INTO activity_logs
                (logs, account_fk)
                VALUES
                (CONCAT('Telah menginputkan data bahan baku baru dengan id: ', NEW.id), NEW.account_fk);
            ELSEIF NEW.expense_type_fk = 2 THEN
                INSERT INTO activity_logs
                (logs, account_fk)
                VALUES
                (CONCAT('Telah menginputkan data operasional baru dengan id: ', NEW.id), NEW.account_fk);
            END IF;
        END
        ");

        DB::unprepared("
        CREATE TRIGGER expense_delete_trigger AFTER DELETE ON expenses
        FOR EACH ROW
        BEGIN
            IF OLD.expense_type_fk = 1 THEN
                INSERT INTO activity_logs
                (logs, account_fk)
                VALUES
                (CONCAT('Telah menghapus data bahan baku dengan id: ', OLD.id), OLD.account_fk);
            ELSEIF OLD.expense_type_fk = 2 THEN
                INSERT INTO activity_logs
                (logs, account_fk)
                VALUES
                (CONCAT('Telah menghapus data operasional dengan id: ', OLD.id), OLD.account_fk);
            END IF;
        END
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
