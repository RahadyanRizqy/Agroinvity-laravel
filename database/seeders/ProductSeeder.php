<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $productSeed = array(
            // nama, harga, total_qty, sold_products, account_fk

        // user = 2
        array('Susu Kedelai', 10, 15000, 3, 2),
        array('Tahu', 20, 1000, 5, 3),
        array('Kopi Susu', 15, 2000, 7, 2),
        array('Bubuk Kopi', 20, 2000, 5, 3),
        array('Bubuk Susu', 25, 1500, 5, 2),
        array('Tempe', 20, 1000, 5, 3),
        array('Jamur Krispi', 7, 10000, 2, 2),
        array('Bubuk Teh', 5, 10000, 2, 3),
        array('Bubuk Kacang', 5, 10000, 2, 2),
        array('Kaldu Jamur', 5, 10000, 2, 3),
        array('Nugget Tempe', 5, 10000, 2, 2),
        array('Permen Kopi', 5, 10000, 2, 3),
        array('Kering Tempe', 5, 10000, 2, 2),
        array('Kaldu Bawang', 5, 10000, 2, 3),
        array('Cabe Bubuk', 5, 10000, 2, 2),
        array('Nugget Tahu', 5, 10000, 2, 2),
    
        );

    for ($i = 0; $i < count($productSeed); $i++) {
        DB::table('products')->insert([
                'name' => $productSeed[$i][0],
                'total_qty' => $productSeed[$i][1],
                'price_per_qty' => $productSeed[$i][2],
                'sold_products' => $productSeed[$i][3],
                'account_fk' => $productSeed[$i][4],
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            ]
        );
    }   
    }
}
