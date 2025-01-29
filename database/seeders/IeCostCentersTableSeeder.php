<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class IeCostCentersTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('ie_cost_centers')->delete();
        
        \DB::table('ie_cost_centers')->insert(array (
            0 => 
            array (
                'id' => 1,
                'code' => 'C.C. 1',
                'name' => NULL,
                'state' => 1,
                'id_user' => 1,
                'created_at' => NULL,
                'updated_at' => NULL,
                'id_company' => 3,
            ),
            1 => 
            array (
                'id' => 2,
                'code' => 'C.C. 1SQ',
                'name' => NULL,
                'state' => 1,
                'id_user' => 1,
                'created_at' => NULL,
                'updated_at' => NULL,
                'id_company' => 3,
            ),
            2 => 
            array (
                'id' => 3,
                'code' => 'C.C. 2SQ',
                'name' => NULL,
                'state' => 1,
                'id_user' => 1,
                'created_at' => NULL,
                'updated_at' => NULL,
                'id_company' => 3,
            ),
        ));
        
        
    }
}