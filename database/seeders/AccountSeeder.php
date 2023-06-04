<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Faker\Factory as Faker;

class AccountSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void {
        $faker = Faker::create();

        $startDate = '2023-05-25 00:00:00';
        $endDate = '2023-06-01 00:00:00';
        
        $accountSeed = array(
            'fullname' => [
                'Nisak', 
                'Eka', 
                'Ilham', 
                'Raden', 
                'Reza',
                'Titan',
                'Amin',
                'Habil',
                'Rafif',
            ],
            'email' => [
                'sitikhoirunnisak12@gmail.com',
                'ekahaswidya@internetkeno.com',
                'ilhamhibatul@internetkeno.com',
                'radenrizqy@internetkeno.com',
                'rezaocta@internetkeno.com',
                'titanangga@mail.net',
                'aminamru@mail.net',
                'habilrahman@mail.net',
                'rafiffernanda@mail.net'

            ],
            'password' => [
                'KhoirunNisak',
                'EkaHas',
                'IlhamHibatul',
                'RadenRizqy',
                'RezaOcta',
                'titanangga',
                'aminamru',
                'habil',
                'rafif',
            ],
            'phone_number' => [
                6287745960427,
                6283845979969,
                62895410873321,
                6288804897436,
                6282131959759,
                6289683864754,
                6282230405608,
                628987823044,
                6282143289622,
    
            ],
            'account_type_fk' => [
                1,
                2,
                2,
                3,
                3,
                2,
                2,
                3,
                3,
            ],
            'account_rel_fk' => [
                null,
                null,
                null,
                2,
                3,
                null,
                null,
                6,
                7,
            ],
            // 'created_at' => [
            //     '2023-05-25 11:35:09',
            //     '2023-04-15 11:35:09',
            //     '2023-05-20 11:35:09',
            //     '2023-05-01 11:35:09',
            //     '2023-05-10 11:35:09',
            //     '2023-05-15 11:35:09',
            //     '2023-05-15 11:35:09',
            //     '2023-05-15 11:35:09',
            //     '2023-05-15 11:35:09',
            // ],
            // 'status' => [
            //     true,
            //     true,
            //     true,
            //     true,
            //     true,
            // ]
        );

        for ($i = 0; $i < count($accountSeed['fullname']); $i++) {
            // DB::statement('UPDATE accounts SET date_now = CURRENT_TIMESTAMP(), status=true');
            // DB::statement('UPDATE accounts AS b JOIN accounts AS a ON b.account_rel_fk = a.account_id SET b.status = a.status WHERE b.account_rel_fk = a.account_id;');
            // EXECUTE BOTH ON ADMIN REFRESH
            // $query = 'UPDATE accounts SET date_now = CURRENT_TIMESTAMP(), status=true; UPDATE accounts AS b JOIN accounts AS a ON b.account_rel_fk = a.account_id SET b.status = a.status WHERE b.account_rel_fk = a.account_id;'
            
            DB::table('accounts')->insert(
                [
                    'fullname' => $accountSeed['fullname'][$i],
                    'email' => $accountSeed['email'][$i],
                    'password' => Hash::make($accountSeed['password'][$i]),
                    'phone_number' => $accountSeed['phone_number'][$i],
                    'account_type_fk' => $accountSeed['account_type_fk'][$i],
                    'account_rel_fk' => $accountSeed['account_rel_fk'][$i],
                    'registered_at' => $faker->dateTimeBetween($startDate, $endDate)->format('Y-m-d H:i:s'),
                    // 'status' => $accountSeed['status'][$i],
                ]
            );
        }
    }
}
