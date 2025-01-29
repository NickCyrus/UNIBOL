<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class IeMovementTypesTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('ie_movement_types')->delete();
        
        \DB::table('ie_movement_types')->insert(array (
            0 => 
            array (
                'id' => 1,
                'name' => 'INGRESO',
                'number' => 1,
                'state' => 1,
                'id_user' => 1,
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            1 => 
            array (
                'id' => 2,
                'name' => 'INGRESO MR',
                'number' => 1,
                'state' => 1,
                'id_user' => 1,
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            2 => 
            array (
                'id' => 3,
                'name' => 'MR DE INGRESO',
                'number' => 1,
                'state' => 1,
                'id_user' => 1,
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            3 => 
            array (
                'id' => 4,
                'name' => 'EGRESO',
                'number' => -1,
                'state' => 1,
                'id_user' => 1,
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            4 => 
            array (
                'id' => 5,
                'name' => 'EGRESO MR',
                'number' => -1,
                'state' => 1,
                'id_user' => 1,
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            5 => 
            array (
                'id' => 6,
                'name' => 'MR DE EGRESO',
                'number' => -1,
                'state' => 1,
                'id_user' => 1,
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
        ));
        
        
    }
}