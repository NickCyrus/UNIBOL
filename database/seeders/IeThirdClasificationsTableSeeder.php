<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class IeThirdClasificationsTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('ie_third_clasifications')->delete();
        
        \DB::table('ie_third_clasifications')->insert(array (
            0 => 
            array (
                'id' => 1,
                'name' => 'T1',
                'state' => 1,
                'id_user' => 1,
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
        ));
        
        
    }
}