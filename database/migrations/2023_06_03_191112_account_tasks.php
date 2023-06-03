<?php

use App\Models\Expenses;
use App\Models\Products;
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
        $changes = array(
            array(1, 50000, 20, 5),
            array(2, 25000, 15, 10),
            array(1, 55000, 23, 7),
            array(2, 23500, 50, 9),
            array(1, 75000, 5, 0),
            array(2, 21000, 9, 2),
            array(1, 14000, 20, 7),
            array(2, 60000, 30, 16),
        
        );

        for ($i = 0; $i < count($changes); $i++) {
            Products::where('id', $changes[$i][0])->update(
                [
                    'price_per_qty' => $changes[$i][1],
                    'total_qty' => $changes[$i][2],
                    'sold_products' => $changes[$i][3],
                ],
            );
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
    }
};
