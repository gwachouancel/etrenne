<?php
namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class OrderSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {    
        $orders = [
            [
                'id' => 1,
                'status' => 'production_start',
                'user_id' => 1,
                'filiale_id' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id' => 2,
                'status' => 'production_end',
                'user_id' => 3,
                'filiale_id' => 2,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id' => 3,
                'status' => 'production_start',
                'user_id' => 1,
                'filiale_id' => 3,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ];

        $orderDetails = [
            [
                'id' => 1,
                'ref_catalog' => 'CAT1',
                'ref_product' => 'PRO1',
                'type' => 'VIP',
                'category' => 'gift',
                'product_name' => 'Stylos',
                'page' => 24,
                'quantity' => 1568,
                'price' => 100,
                'order_id' => 1,
                'supplier_id' => 4,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id' => 2,
                'ref_catalog' => 'CAT2',
                'ref_product' => 'PRO2',
                'type' => 'VIP',
                'category' => 'gift',
                'product_name' => 'Stylos',
                'page' => 24,
                'quantity' => 1568,
                'price' => 200,
                'order_id' => 1,
                'supplier_id' => 4,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id' => 3,
                'ref_catalog' => 'CAT3',
                'ref_product' => 'PRO3',
                'type' => 'VIP',
                'category' => 'gift',
                'product_name' => 'Stylos',
                'page' => 24,
                'quantity' => 1568,
                'price' => 300,
                'order_id' => 1,
                'supplier_id' => 4,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id' => 4,
                'ref_catalog' => 'CAT4',
                'ref_product' => 'PRO4',
                'type' => 'VIP',
                'category' => 'agenda',
                'product_name' => 'Stylos',
                'page' => 24,
                'quantity' => 1568,
                'price' => 400,
                'order_id' => 2,
                'supplier_id' => 4,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id' => 5,
                'ref_catalog' => 'CAT5',
                'ref_product' => 'PRO5',
                'type' => 'VIP',
                'category' => 'gift',
                'product_name' => 'Stylos',
                'page' => 24,
                'quantity' => 1568,
                'price' => 500,
                'order_id' => 2,
                'supplier_id' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id' => 6,
                'ref_catalog' => 'CAT6',
                'ref_product' => 'PRO6',
                'type' => 'VIP',
                'category' => 'gift',
                'product_name' => 'Stylos',
                'page' => 24,
                'quantity' => 1568,
                'price' => 600,
                'order_id' => 2,
                'supplier_id' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id' => 7,
                'ref_catalog' => 'CAT7',
                'ref_product' => 'PRO7',
                'type' => 'VIP',
                'category' => 'agenda',
                'product_name' => 'Cahiers',
                'page' => 2,
                'quantity' => 68,
                'price' => 400,
                'order_id' => 2,
                'supplier_id' => 4,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id' => 8,
                'ref_catalog' => 'CAT8',
                'ref_product' => 'PRO8',
                'type' => 'VIP',
                'category' => 'gift',
                'product_name' => 'Traceuses',
                'page' => 4,
                'quantity' => 15,
                'price' => 60,
                'order_id' => 3,
                'supplier_id' => 4,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id' => 9,
                'ref_catalog' => 'CAT9',
                'ref_product' => 'PRO9',
                'type' => 'VIP',
                'category' => 'gift',
                'product_name' => 'Traceuses',
                'page' => 4,
                'quantity' => 15,
                'price' => 60,
                'order_id' => 3,
                'supplier_id' => 4,
                'created_at' => now(),
                'updated_at' => now(),
            ]
        ];

        $bats = [
            ['orderitem_id'=>1],
            ['orderitem_id'=>2],
            ['orderitem_id'=>3],
            ['orderitem_id'=>4],
            ['orderitem_id'=>5],
            ['orderitem_id'=>6],
            ['orderitem_id'=>7],
            ['orderitem_id'=>8],
            ['orderitem_id'=>9],
        ];

        DB::table('orders')->insert($orders);
        DB::table('orderitems')->insert($orderDetails);
        DB::table('bats')->insert($bats);
    }
}