<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CalculatorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $calcSeed = array(
            
            array('[Bahan Baku: 2000]', 2),
            array('[Operasional: 3000]', 2),
            array('[Produk: 8000]', 2),
            array('[Omzet: 4000]', 3),
            array('[Keuntungan: 5000]', 3),
            array('[Kerugian: 9000]', 3),
            
        );

        foreach ($calcSeed as $c) {
            DB::table('calculators')->insert([
                'histories' => $c[0],
                'account_fk' => $c[1],
            ]);
        }
    }
}
