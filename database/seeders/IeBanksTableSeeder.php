<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class IeBanksTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('ie_banks')->delete();
        
        \DB::table('ie_banks')->insert(array (
            0 => 
            array (
                'id' => 1,
                'code' => 'BCOL-8247',
                'name' => 'BANCOLOMBIA S. A.',
                'state' => 1,
                'id_user' => 1,
                'created_at' => NULL,
                'updated_at' => '2023-06-17 21:17:12',
                'id_company' => 2,
            ),
            1 => 
            array (
                'id' => 2,
                'code' => 'BBVA-9579',
                'name' => 'BBVA COLOMBIA S. A.',
                'state' => 1,
                'id_user' => 1,
                'created_at' => NULL,
                'updated_at' => '2023-06-22 01:42:49',
                'id_company' => 2,
            ),
            2 => 
            array (
                'id' => 3,
                'code' => 'BCOL-0394',
                'name' => NULL,
                'state' => 1,
                'id_user' => NULL,
                'created_at' => NULL,
                'updated_at' => NULL,
                'id_company' => NULL,
            ),
            3 => 
            array (
                'id' => 4,
                'code' => 'BCOL-1138',
                'name' => NULL,
                'state' => 1,
                'id_user' => NULL,
                'created_at' => NULL,
                'updated_at' => NULL,
                'id_company' => NULL,
            ),
            4 => 
            array (
                'id' => 5,
                'code' => 'BCOL-1219',
                'name' => NULL,
                'state' => 1,
                'id_user' => NULL,
                'created_at' => NULL,
                'updated_at' => NULL,
                'id_company' => NULL,
            ),
            5 => 
            array (
                'id' => 6,
                'code' => 'BCOL-1426',
                'name' => NULL,
                'state' => 1,
                'id_user' => NULL,
                'created_at' => NULL,
                'updated_at' => NULL,
                'id_company' => NULL,
            ),
            6 => 
            array (
                'id' => 7,
                'code' => 'BCOL-5070',
                'name' => NULL,
                'state' => 1,
                'id_user' => NULL,
                'created_at' => NULL,
                'updated_at' => NULL,
                'id_company' => NULL,
            ),
            7 => 
            array (
                'id' => 8,
                'code' => 'BCOL-5341',
                'name' => NULL,
                'state' => 1,
                'id_user' => NULL,
                'created_at' => NULL,
                'updated_at' => NULL,
                'id_company' => NULL,
            ),
            8 => 
            array (
                'id' => 9,
                'code' => 'BCOL-5454',
                'name' => NULL,
                'state' => 1,
                'id_user' => NULL,
                'created_at' => NULL,
                'updated_at' => NULL,
                'id_company' => NULL,
            ),
            9 => 
            array (
                'id' => 10,
                'code' => 'BCOL-7726',
                'name' => NULL,
                'state' => 1,
                'id_user' => NULL,
                'created_at' => NULL,
                'updated_at' => NULL,
                'id_company' => NULL,
            ),
            10 => 
            array (
                'id' => 11,
                'code' => 'BCOL-8344',
                'name' => NULL,
                'state' => 1,
                'id_user' => NULL,
                'created_at' => NULL,
                'updated_at' => NULL,
                'id_company' => NULL,
            ),
            11 => 
            array (
                'id' => 12,
                'code' => 'BOGOTA-0133',
                'name' => NULL,
                'state' => 1,
                'id_user' => NULL,
                'created_at' => NULL,
                'updated_at' => NULL,
                'id_company' => NULL,
            ),
            12 => 
            array (
                'id' => 13,
                'code' => 'BOGOTA-1258',
                'name' => NULL,
                'state' => 1,
                'id_user' => NULL,
                'created_at' => NULL,
                'updated_at' => NULL,
                'id_company' => NULL,
            ),
            13 => 
            array (
                'id' => 14,
                'code' => 'BOGOTA-4516',
                'name' => NULL,
                'state' => 1,
                'id_user' => NULL,
                'created_at' => NULL,
                'updated_at' => NULL,
                'id_company' => NULL,
            ),
            14 => 
            array (
                'id' => 15,
                'code' => 'CREDICORP-4838',
                'name' => NULL,
                'state' => 1,
                'id_user' => NULL,
                'created_at' => NULL,
                'updated_at' => NULL,
                'id_company' => NULL,
            ),
            15 => 
            array (
                'id' => 16,
                'code' => 'CREDICORP-8091',
                'name' => NULL,
                'state' => 1,
                'id_user' => NULL,
                'created_at' => NULL,
                'updated_at' => NULL,
                'id_company' => NULL,
            ),
            16 => 
            array (
                'id' => 17,
                'code' => 'FAFPSOL-4898',
                'name' => NULL,
                'state' => 1,
                'id_user' => NULL,
                'created_at' => NULL,
                'updated_at' => NULL,
                'id_company' => NULL,
            ),
            17 => 
            array (
                'id' => 18,
                'code' => 'OCC-3067',
                'name' => NULL,
                'state' => 1,
                'id_user' => NULL,
                'created_at' => NULL,
                'updated_at' => NULL,
                'id_company' => NULL,
            ),
            18 => 
            array (
                'id' => 19,
                'code' => 'OCC-9890',
                'name' => NULL,
                'state' => 1,
                'id_user' => NULL,
                'created_at' => NULL,
                'updated_at' => NULL,
                'id_company' => NULL,
            ),
            19 => 
            array (
                'id' => 20,
                'code' => 'SOL1-9592',
                'name' => NULL,
                'state' => 1,
                'id_user' => NULL,
                'created_at' => NULL,
                'updated_at' => NULL,
                'id_company' => NULL,
            ),
            20 => 
            array (
                'id' => 21,
                'code' => 'SOL2-4852',
                'name' => NULL,
                'state' => 1,
                'id_user' => NULL,
                'created_at' => NULL,
                'updated_at' => NULL,
                'id_company' => NULL,
            ),
            21 => 
            array (
                'id' => 22,
                'code' => 'SOL3-6946',
                'name' => NULL,
                'state' => 1,
                'id_user' => NULL,
                'created_at' => NULL,
                'updated_at' => NULL,
                'id_company' => NULL,
            ),
            22 => 
            array (
                'id' => 23,
                'code' => 'SOL4-6027',
                'name' => NULL,
                'state' => 1,
                'id_user' => NULL,
                'created_at' => NULL,
                'updated_at' => NULL,
                'id_company' => NULL,
            ),
            23 => 
            array (
                'id' => 24,
                'code' => 'SOL5-1319',
                'name' => NULL,
                'state' => 1,
                'id_user' => NULL,
                'created_at' => NULL,
                'updated_at' => NULL,
                'id_company' => NULL,
            ),
            24 => 
            array (
                'id' => 25,
                'code' => 'SERFI-8758',
                'name' => NULL,
                'state' => 1,
                'id_user' => NULL,
                'created_at' => NULL,
                'updated_at' => NULL,
                'id_company' => NULL,
            ),
            25 => 
            array (
                'id' => 26,
                'code' => 'N/A',
                'name' => NULL,
                'state' => 1,
                'id_user' => 1,
                'created_at' => NULL,
                'updated_at' => '2023-06-17 14:21:03',
                'id_company' => NULL,
            ),
        ));
        
        
    }
}