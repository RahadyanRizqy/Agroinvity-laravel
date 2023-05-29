<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Faker\Factory as Faker;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Faker::create();

        $startDate = '2023-04-25 00:00:00';
        $endDate = '2023-05-31 00:00:00';

        $productSeed = array(
            // nama, harga, total_qty, sold_products, account_fk

        // user = 2
        array('Susu Kedelai', 10, 15000, 3, 2),
        array('Tahu', 20, 1000, 5, 3),
        array('Kopi Susu', 15, 2000, 7, 2),
        array('Bubuk Kopi', 20, 2000, 5, 3),
        array('Bubuk Susu', 25, 1500, 5, 2),
        array('Tempe', 20, 1000, 5, 3),
        array('Jamur Krispi', 7, 10500, 2, 2),
        array('Bubuk Teh', 5, 12000, 2, 3),
        array('Bubuk Kacang', 5, 15000, 2, 2),
        array('Kaldu Jamur', 8, 20000, 2, 3),
        array('Nugget Tempe', 7, 10000, 2, 2),
        array('Permen Kopi', 9, 3000, 2, 3),
        array('Kering Tempe', 14, 4500, 2, 2),
        array('Kaldu Bawang', 20, 2500, 2, 3),
        array('Cabe Saos', 9, 7550, 2, 2),
        array('Nugget Telur', 10, 5000, 2, 3),
        array('Permen Mint', 8, 9000, 2, 2),
        array('Sosis Ikan', 5, 13000, 0, 3),
        array('Sosis Tong', 10, 25000, 2, 2),
        array('Tahu Frozen', 7, 29000, 2, 3),
        array('Bakso Ikan', 0, 50000, 0, 2),
        array('Bakso Lebah', 25, 75000, 2, 3),
        array('Opak opak', 55, 20000, 0, 2),
        array('Otak otak', 35, 19000, 0, 3),
    
        );

    for ($i = 0; $i < count($productSeed); $i++) {
        DB::table('products')->insert([
                'name' => $productSeed[$i][0],
                'total_qty' => $productSeed[$i][1],
                'price_per_qty' => $productSeed[$i][2],
                'sold_products' => $productSeed[$i][3],
                'account_fk' => $productSeed[$i][4],
                'stored_at' => $faker->dateTimeBetween($startDate, $endDate)->format('Y-m-d H:i:s'),
                // 'stored_at' => Carbon::now()->format('Y-m-d H:i:s'),
            ]
        );
    }   
    }
}
