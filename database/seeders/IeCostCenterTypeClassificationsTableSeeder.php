<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class IeCostCenterTypeClassificationsTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('ie_cost_center_type_classifications')->delete();
        
        \DB::table('ie_cost_center_type_classifications')->insert(array (
            0 => 
            array (
                'id' => 5,
                'id_cost_center' => 1,
                'id_classification' => 1,
                'state' => 1.0,
                'id_user' => 1,
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            1 => 
            array (
                'id' => 6,
                'id_cost_center' => 1,
                'id_classification' => 11,
                'state' => 1.0,
                'id_user' => 1,
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
        ));
        
        
    }
}