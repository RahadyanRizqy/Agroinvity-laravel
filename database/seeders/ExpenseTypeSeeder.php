<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ExpenseTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $types = ['material', 'operational'];
        foreach ($types as $type) {
            DB::table('expense_types')->insert(
                ['expense_type_name' => "$type",]
            );
        }
    }
}
