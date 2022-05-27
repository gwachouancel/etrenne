<?php
namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class CatalogSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {            

        $catalogs = [
            [
                'id' => 1,
                'ref_catalog' => 'Ref_cat01',
                'name' => 'Catalogue 1',
                'type' => 'agenda',
                'path' => 'catalogs/agencedigitale.pdf',
                'supplier_id' => 1,
                'filiale_id' => 1,
                'created_at' => date('Y-m-d H:i:s')
            ],
        ];


        DB::table('catalogs')->insert($catalogs);

    }
}