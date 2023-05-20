<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;


class AccountTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $types = ['admin', 'partner', 'worker'];
        foreach ($types as $type) {
            DB::table('account_types')->insert(
                ['account_type_name' => "$type",]
            );
        }
    }
}
