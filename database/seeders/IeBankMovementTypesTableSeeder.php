<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class IeBankMovementTypesTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('ie_bank_movement_types')->delete();
        
        \DB::table('ie_bank_movement_types')->insert(array (
            0 => 
            array (
                'id' => 13,
                'id_movement_type' => 4,
                'id_bank' => 1,
                'state' => 1,
                'id_user' => 1,
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            1 => 
            array (
                'id' => 14,
                'id_movement_type' => 1,
                'id_bank' => 1,
                'state' => 1,
                'id_user' => 1,
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            2 => 
            array (
                'id' => 15,
                'id_movement_type' => 2,
                'id_bank' => 1,
                'state' => 1,
                'id_user' => 1,
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            3 => 
            array (
                'id' => 16,
                'id_movement_type' => 6,
                'id_bank' => 1,
                'state' => 1,
                'id_user' => 1,
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            4 => 
            array (
                'id' => 17,
                'id_movement_type' => 4,
                'id_bank' => 2,
                'state' => 1,
                'id_user' => 1,
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            5 => 
            array (
                'id' => 18,
                'id_movement_type' => 5,
                'id_bank' => 2,
                'state' => 1,
                'id_user' => 1,
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            6 => 
            array (
                'id' => 19,
                'id_movement_type' => 1,
                'id_bank' => 2,
                'state' => 1,
                'id_user' => 1,
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            7 => 
            array (
                'id' => 20,
                'id_movement_type' => 2,
                'id_bank' => 2,
                'state' => 1,
                'id_user' => 1,
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
        ));
        
        
    }
}