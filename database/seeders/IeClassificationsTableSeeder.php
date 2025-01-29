<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class IeClassificationsTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('ie_classifications')->delete();
        
        \DB::table('ie_classifications')->insert(array (
            0 => 
            array (
                'id' => 1,
                'name' => 'ADMINISTRACION',
                'state' => 1,
                'id_user' => 1,
                'created_at' => NULL,
                'updated_at' => '2023-06-22 00:21:41',
                'id_movement_type' => 4,
            ),
            1 => 
            array (
                'id' => 2,
                'name' => 'DEVOL RECON',
                'state' => 1,
                'id_user' => 1,
                'created_at' => NULL,
                'updated_at' => '2023-06-22 00:21:48',
                'id_movement_type' => 4,
            ),
            2 => 
            array (
                'id' => 3,
                'name' => 'IMPUESTOS',
                'state' => 1,
                'id_user' => 1,
                'created_at' => NULL,
                'updated_at' => NULL,
                'id_movement_type' => 4,
            ),
            3 => 
            array (
                'id' => 4,
                'name' => 'INTER EMPR PAGO TER',
                'state' => 1,
                'id_user' => 1,
                'created_at' => NULL,
                'updated_at' => NULL,
                'id_movement_type' => 4,
            ),
            4 => 
            array (
                'id' => 5,
                'name' => 'NO OPERACIONAL',
                'state' => 1,
                'id_user' => 1,
                'created_at' => NULL,
                'updated_at' => NULL,
                'id_movement_type' => 4,
            ),
            5 => 
            array (
                'id' => 6,
                'name' => 'OBLIGACION FINANCIERA',
                'state' => 1,
                'id_user' => 1,
                'created_at' => NULL,
                'updated_at' => NULL,
                'id_movement_type' => 4,
            ),
            6 => 
            array (
                'id' => 7,
                'name' => 'PRESTAMO INTEREMPRE',
                'state' => 1,
                'id_user' => 1,
                'created_at' => NULL,
                'updated_at' => NULL,
                'id_movement_type' => 4,
            ),
            7 => 
            array (
                'id' => 8,
                'name' => 'PROYECTO',
                'state' => 1,
                'id_user' => 1,
                'created_at' => NULL,
                'updated_at' => NULL,
                'id_movement_type' => 4,
            ),
            8 => 
            array (
                'id' => 9,
                'name' => 'SOCIOS',
                'state' => 1,
                'id_user' => 1,
                'created_at' => NULL,
                'updated_at' => NULL,
                'id_movement_type' => 4,
            ),
            9 => 
            array (
                'id' => 10,
                'name' => 'TRASLADO PROPIO',
                'state' => 1,
                'id_user' => 1,
                'created_at' => NULL,
                'updated_at' => NULL,
                'id_movement_type' => 4,
            ),
            10 => 
            array (
                'id' => 11,
                'name' => 'ADMINISTRACION',
                'state' => 1,
                'id_user' => 1,
                'created_at' => NULL,
                'updated_at' => '2023-06-22 00:53:14',
                'id_movement_type' => 1,
            ),
            11 => 
            array (
                'id' => 12,
                'name' => 'DEVOL RECON',
                'state' => 1,
                'id_user' => 1,
                'created_at' => NULL,
                'updated_at' => '2023-06-22 00:54:19',
                'id_movement_type' => 1,
            ),
            12 => 
            array (
                'id' => 13,
                'name' => 'IMPUESTOS',
                'state' => 1,
                'id_user' => 1,
                'created_at' => NULL,
                'updated_at' => NULL,
                'id_movement_type' => 1,
            ),
            13 => 
            array (
                'id' => 14,
                'name' => 'INTER EMPR PAGO TER',
                'state' => 1,
                'id_user' => 1,
                'created_at' => NULL,
                'updated_at' => NULL,
                'id_movement_type' => 1,
            ),
            14 => 
            array (
                'id' => 15,
                'name' => 'NO OPERACIONAL',
                'state' => 1,
                'id_user' => 1,
                'created_at' => NULL,
                'updated_at' => NULL,
                'id_movement_type' => 1,
            ),
            15 => 
            array (
                'id' => 16,
                'name' => 'OBLIGACION FINANCIERA',
                'state' => 1,
                'id_user' => 1,
                'created_at' => NULL,
                'updated_at' => NULL,
                'id_movement_type' => 1,
            ),
            16 => 
            array (
                'id' => 17,
                'name' => 'PRESTAMO INTEREMPRE',
                'state' => 1,
                'id_user' => 1,
                'created_at' => NULL,
                'updated_at' => NULL,
                'id_movement_type' => 1,
            ),
            17 => 
            array (
                'id' => 18,
                'name' => 'PROYECTO',
                'state' => 1,
                'id_user' => 1,
                'created_at' => NULL,
                'updated_at' => NULL,
                'id_movement_type' => 1,
            ),
            18 => 
            array (
                'id' => 19,
                'name' => 'SOCIOS',
                'state' => 1,
                'id_user' => 1,
                'created_at' => NULL,
                'updated_at' => NULL,
                'id_movement_type' => 1,
            ),
            19 => 
            array (
                'id' => 20,
                'name' => 'TRASLADO PROPIO',
                'state' => 1,
                'id_user' => 1,
                'created_at' => NULL,
                'updated_at' => NULL,
                'id_movement_type' => 1,
            ),
            20 => 
            array (
                'id' => 21,
                'name' => 'N/A',
                'state' => 1,
                'id_user' => 1,
                'created_at' => NULL,
                'updated_at' => '2023-06-22 00:56:47',
                'id_movement_type' => 5,
            ),
            21 => 
            array (
                'id' => 22,
                'name' => 'N/A',
                'state' => 1,
                'id_user' => 1,
                'created_at' => NULL,
                'updated_at' => '2023-06-22 00:57:04',
                'id_movement_type' => 2,
            ),
        ));
        
        
    }
}