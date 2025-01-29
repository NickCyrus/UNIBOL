<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class IeSubCostcentersTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('ie_sub_costcenters')->delete();
        
        \DB::table('ie_sub_costcenters')->insert(array (
            0 => 
            array (
                'id' => 7,
                'id_cost_center' => 1,
                'code' => 'C.C. 1 11',
                'name' => NULL,
                'state' => 1,
                'id_user' => 1,
                'created_at' => '2023-06-21 22:21:20',
                'updated_at' => NULL,
                'id_parent' => NULL,
            ),
            1 => 
            array (
                'id' => 8,
                'id_cost_center' => NULL,
                'code' => 'C.C. 1 11 A',
                'name' => NULL,
                'state' => 1,
                'id_user' => 1,
                'created_at' => '2023-06-21 22:21:34',
                'updated_at' => NULL,
                'id_parent' => 7,
            ),
            2 => 
            array (
                'id' => 9,
                'id_cost_center' => 2,
                'code' => 'SQ01',
                'name' => NULL,
                'state' => 1,
                'id_user' => 1,
                'created_at' => '2023-06-21 22:27:36',
                'updated_at' => NULL,
                'id_parent' => NULL,
            ),
            3 => 
            array (
                'id' => 10,
                'id_cost_center' => NULL,
                'code' => 'SQ0101',
                'name' => NULL,
                'state' => 1,
                'id_user' => 1,
                'created_at' => '2023-06-21 22:29:08',
                'updated_at' => NULL,
                'id_parent' => 9,
            ),
        ));
        
        
    }
}