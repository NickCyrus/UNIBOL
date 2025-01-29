<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class ConfigsTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('configs')->delete();
        
        \DB::table('configs')->insert(array (
            0 => 
            array (
                'id' => 1,
                'created_at' => '2023-06-17 02:02:53',
                'updated_at' => NULL,
                'keyconf' => 'nameApp',
                'type' => 'input',
                'class' => NULL,
                'onclick' => NULL,
                'onblur' => NULL,
                'onchange' => NULL,
                'group' => NULL,
                'value' => '',
            ),
            1 => 
            array (
                'id' => 2,
                'created_at' => '2023-06-17 02:02:53',
                'updated_at' => NULL,
                'keyconf' => 'shortNameApp',
                'type' => 'input',
                'class' => NULL,
                'onclick' => NULL,
                'onblur' => NULL,
                'onchange' => NULL,
                'group' => NULL,
                'value' => '',
            ),
            2 => 
            array (
                'id' => 3,
                'created_at' => '2023-06-17 02:02:53',
                'updated_at' => NULL,
                'keyconf' => 'paginacion',
                'type' => 'input',
                'class' => NULL,
                'onclick' => NULL,
                'onblur' => NULL,
                'onchange' => NULL,
                'group' => NULL,
                'value' => '30',
            ),
            3 => 
            array (
                'id' => 4,
                'created_at' => '2023-06-17 02:02:53',
                'updated_at' => NULL,
                'keyconf' => 'logoApp',
                'type' => 'file',
                'class' => NULL,
                'onclick' => NULL,
                'onblur' => NULL,
                'onchange' => NULL,
                'group' => NULL,
                'value' => '',
            ),
        ));
        
        
    }
}