<?php
namespace Database\Seeders;

use Illuminate\Support\Str;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {            

        $token = Str::random(50);

        $admins = [
            [
                'id' => 1,
                'name' => 'admin',
                'lastname' => 'admin',
                'email' => 'admin@gmail.com',
                'password' => Hash::make( 'admin' ),
                'phone' => '690041995',
                'status' => 'active',
                'role' => 'admin',
                'permission_id' => null,
                'token' => hash('sha256', $token)
            ],
            [
                'id' => 2,
                'name' => 'user',
                'lastname' => 'user',
                'email' => 'user@gmail.com',
                'password' => Hash::make( 'user' ),
                'phone' => '690041996',
                'status' => 'active',
                'role' => 'user',
                'permission_id' => 3,
                'token' => hash('sha256', $token)
            ],
            [
                'id' => 3,
                'name' => 'le daf',
                'lastname' => 'le daf',
                'email' => 'daf@gmail.com',
                'password' => Hash::make( 'daf' ),
                'phone' => '690041997',
                'status' => 'active',
                'role' => 'user',
                'permission_id' => 1,
                'token' => hash('sha256', $token)
            ]
        ];

        $others = [
            [
                'id' => 4,
                'name' => 'supplier',
                'lastname' => 'supplier',
                'email' => 'supplier@gmail.com',
                'password' => Hash::make( 'supplier' ),
                'phone' => '690041997',
                'status' => 'active',
                'role' => 'supplier',
                'token' => hash('sha256', $token)
            ],
            [
                'id' => 5,
                'name' => 'supplier 2',
                'lastname' => 'supplier 2',
                'email' => 'supplier2@gmail.com',
                'password' => Hash::make( 'supplier2' ),
                'phone' => '690041998',
                'status' => 'active',
                'role' => 'supplier',
                'token' => hash('sha256', $token)
            ],
            [
                'id' => 6,
                'name' => 'supplier 3',
                'lastname' => 'supplier 3',
                'email' => 'supplier3@gmail.com',
                'password' => Hash::make( 'supplier3' ),
                'phone' => '690041999',
                'status' => 'active',
                'role' => 'supplier',
                'token' => hash('sha256', $token)
            ],
            [
                'id' => 7,
                'name' => 'supplier 4',
                'lastname' => 'supplier 4',
                'email' => 'supplier4@gmail.com',
                'password' => Hash::make( 'supplier4' ),
                'phone' => '690041997',
                'status' => 'active',
                'role' => 'supplier',
                'token' => hash('sha256', $token)
            ],
            [
                'id' => 8,
                'name' => 'supplier 5',
                'lastname' => 'supplier 5',
                'email' => 'supplier5@gmail.com',
                'password' => Hash::make( 'supplier5' ),
                'phone' => '690041987',
                'status' => 'active',
                'role' => 'supplier',
                'token' => hash('sha256', $token)
            ]
        ];

        DB::table('users')->insert($admins);
        DB::table('users')->insert($others);

        $companies = [
            ['user_id' => 2, 'filiale_id' => 2, 'fonction' => 'user'],
            ['user_id' => 1, 'filiale_id' => 1, 'fonction' => 'admin'],
            ['user_id' => 3, 'filiale_id' => 3, 'fonction' => 'DAF']
        ];
        DB::table('companies')->insert($companies);
        DB::table('suppliers')->insert(['user_id' => 4,'company' => 'SABC']);

    }
}
