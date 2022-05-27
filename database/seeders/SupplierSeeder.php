<?php
namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class SupplierSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {            

        $supplier = [

            [
                'id' => 2,
                'company' => 'Digital Sarl',
                'address' => 'Douala Bonanjo',
                'country' => 'Cameroon',
                'rib' => 'ribs/supplier2.pdf',
                'product_type' => 'gift',
                'user_id' => 5,
            ],
            [
                'id' => 3,
                'company' => 'Agence Digital',
                'address' => 'Lome',
                'country' => 'Togo',
                'rib' => 'ribs/supplier3.pdf',
                'product_type' => 'gift',
                'user_id' => 6,
            ],
            [
                'id' => 4,
                'company' => 'St Digital',
                'address' => 'Port-Gentil',
                'country' => 'Gabon',
                'rib' => 'ribs/supplier4.pdf',
                'product_type' => 'gift',
                'user_id' => 7,
            ],
            [
                'id' => 5,
                'company' => 'Finkeo',
                'address' => 'Douala Makepe',
                'country' => 'Cameroon',
                'rib' => 'ribs/supplier5.pdf',
                'product_type' => 'gift',
                'user_id' => 8,
            ]
        ];

        DB::table('suppliers')->insert($supplier);
    }
}