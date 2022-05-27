<?php
namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    { 
        DB::table('permissions')->insert([
            [
                'code' => 'daf',
                'name' => 'Direction Administrative et Financière',
                'status' => true,
            ],
            [
                'code' => 'mgh',
                'name' => 'Moyen Généraux Holding',
                'status' => true,
            ],
            [
                'code' => 'mgf',
                'name' => 'Moyen Généraux Filiale',
                'status' => true,
            ],
            [
                'code' => 'dgf',
                'name' => 'Direction Générale Filiale',
                'status' => true,
            ],
            [
                'code' => 'dc',
                'name' => 'Direction Commerciale',
                'status' => true,
            ]
        ]
        );
    }
}
