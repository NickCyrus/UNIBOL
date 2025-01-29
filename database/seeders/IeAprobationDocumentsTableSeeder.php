<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class IeAprobationDocumentsTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('ie_aprobation_documents')->delete();
        
        \DB::table('ie_aprobation_documents')->insert(array (
            0 => 
            array (
                'id' => 1,
                'name' => 'TR',
                'abbreviation' => 'TR',
                'state' => 1,
                'id_user' => 1,
                'created_at' => NULL,
                'updated_at' => '2023-06-17 13:57:48',
            ),
            1 => 
            array (
                'id' => 2,
                'name' => 'CARTA',
                'abbreviation' => 'CARTA',
                'state' => 1,
                'id_user' => NULL,
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            2 => 
            array (
                'id' => 3,
                'name' => 'CCH',
                'abbreviation' => 'CCH',
                'state' => 1,
                'id_user' => NULL,
                'created_at' => NULL,
                'updated_at' => '2023-06-17 02:22:45',
            ),
            3 => 
            array (
                'id' => 4,
                'name' => 'DEBITO AUTOMATICO',
                'abbreviation' => 'DEBITO AUTOMATICO',
                'state' => 1,
                'id_user' => NULL,
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            4 => 
            array (
                'id' => 5,
                'name' => 'N/A',
                'abbreviation' => 'N/A',
                'state' => 1,
                'id_user' => NULL,
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
        ));
        
        
    }
}