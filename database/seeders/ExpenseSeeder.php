<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;

class ExpenseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $countExpense = 15;
        
        // $expenseSeed = array(
        //     'fullname' => [
        //         'Biji Kopi', 
        //         'Jamur', 
        //         'Apel', 
        //         'Biji Wijen', 
        //         'Biji Unta',
        //         'Daun Teh',
        //     ],
        //     'email' => [
        //         'sitikhoirunisak@mail.net',
        //         'ekahas@mail.net',
        //         'ilhamhibatul@mail.net',
        //         'radenrizqy@mail.net',
        //         'rezaocta@mail.net',
        //     ],
        //     'password' => [
        //         'khoirunnisak',
        //         'ekahaswidya',
        //         'ilhamhibatul',
        //         'radenrizqy',
        //         'rezaocta'
        //     ],
        //     'phone_number' => [
        //         6287745960427,
        //         6283845979969,
        //         62895410873321,
        //         6288804897436,
        //         6282131959759,
    
        //     ],
        //     'account_type_fk' => [
        //         1,
        //         2,
        //         2,
        //         3,
        //         3,
        //     ],
        //     'account_rel_fk' => [
        //         null,
        //         null,
        //         null,
        //         2,
        //         3,
        //     ]
        // );


        $expenseSeed = array(
                // nama, qty, harga, user, tipe

            // Bahan Baku
            array('Biji Kopi 1kg', 10, 25500, 3, 1),
            array('Daun Teh 1kg', 10, 55000, 2, 1),
            array('Kedelai 500g', 2, 50000, 3, 1),
            array('Biji Kacang 250g', 8, 17500, 2, 1),
            array('Benih Jamur 50g', 7, 24000, 3, 1),
            array('Kokoa 1kg', 6, 35000, 2, 1),

            // Operasional
            array('Wajan', 4, 7000, 3, 2),
            array('Pupuk Phonska 500g', 5, 80000, 2, 2),
            array('Panci', 6, 27500, 3, 2),
            array('Gas LPG 1kg', 7, 87500, 2, 2),
            array('Blue Gas 5kg', 19, 180000, 3, 2),
            array('Pestisida Marshal 250g', 28, 100000, 2, 2),
        );

        for ($i = 0; $i < count($expenseSeed); $i++) {
            DB::table('expenses')->insert(
                [
                    'name' => $expenseSeed[$i][0],
                    'quantity' => $expenseSeed[$i][1],
                    'price_per_qty' => $expenseSeed[$i][2],
                    'account_fk' => $expenseSeed[$i][3],
                    'expense_type_fk' => $expenseSeed[$i][4],
                    'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                    'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
                ]
            );
        }
    }
}
