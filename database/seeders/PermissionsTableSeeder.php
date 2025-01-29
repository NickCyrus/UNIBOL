<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class PermissionsTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('permissions')->delete();
        
        \DB::table('permissions')->insert(array (
            0 => 
            array (
                'id' => 1,
                'created_at' => '2023-06-17 02:02:54',
                'updated_at' => NULL,
                'userid' => 1,
                'profid' => 1,
            ),
        ));
        
        
    }
}