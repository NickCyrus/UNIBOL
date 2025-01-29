<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class IeAccountStatusesTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('ie_account_statuses')->delete();
        
        \DB::table('ie_account_statuses')->insert(array (
            0 => 
            array (
                'id' => 1,
                'name' => 'ABIERTA',
                'state' => 1,
                'id_user' => 1,
                'created_at' => NULL,
                'updated_at' => '2023-06-17 17:40:10',
            ),
            1 => 
            array (
                'id' => 2,
                'name' => 'CERRADO',
                'state' => 1,
                'id_user' => 1,
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
        ));
        
        
    }
}