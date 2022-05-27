<?php
namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Route;


class MenuSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $_menus = config('app.menus');
        $perms_menus = array();

        $i = 1;
        foreach($_menus as $name){
            $menus[] = array(
                'code' => $name,
            );
            $i++;
        }

        foreach(DB::table('permissions')->get() as $perm){  
            $perms_menus[] = array(
                'permission_id' => $perm->id,
                'menu_id' => 9
            );
            $perms_menus[] = array(
                'permission_id' => $perm->id,
                'menu_id' => 11
            );
            $perms_menus[] = array(
                'permission_id' => $perm->id,
                'menu_id' => 12
            );
            $perms_menus[] = array(
                'permission_id' => $perm->id,
                'menu_id' => 13
            );
        }

        DB::table('menus')->insert($menus);
        DB::table('permission_menus')->insert($perms_menus);
    }
}
