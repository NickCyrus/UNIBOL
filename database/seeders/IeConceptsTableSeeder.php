<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class IeConceptsTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('ie_concepts')->delete();
        
        \DB::table('ie_concepts')->insert(array (
            0 => 
            array (
                'id' => 1,
                'name' => 'ANTICIPO DE CLIENTE',
                'state' => 1,
                'id_user' => 1,
                'created_at' => NULL,
                'updated_at' => '2023-06-22 20:08:23',
                'id_classification' => 1,
            ),
            1 => 
            array (
                'id' => 2,
                'name' => 'RECAUDO DE CARTERA',
                'state' => 1,
                'id_user' => 1,
                'created_at' => NULL,
                'updated_at' => NULL,
                'id_classification' => NULL,
            ),
            2 => 
            array (
                'id' => 3,
                'name' => 'COBRO RETEGARANTIA',
                'state' => 1,
                'id_user' => 1,
                'created_at' => NULL,
                'updated_at' => NULL,
                'id_classification' => NULL,
            ),
            3 => 
            array (
                'id' => 4,
                'name' => 'OTROS INGRESOS',
                'state' => 1,
                'id_user' => 1,
                'created_at' => NULL,
                'updated_at' => '2023-06-21 22:54:06',
                'id_classification' => 11,
            ),
            4 => 
            array (
                'id' => 5,
                'name' => 'DEVOLUCION DE IMPUESTOS',
                'state' => 1,
                'id_user' => 1,
                'created_at' => NULL,
                'updated_at' => '2023-06-21 22:51:17',
                'id_classification' => 3,
            ),
            5 => 
            array (
                'id' => 6,
                'name' => 'DEVOLUCION DE GASTOS BANCARIOS',
                'state' => 1,
                'id_user' => 1,
                'created_at' => NULL,
                'updated_at' => NULL,
                'id_classification' => NULL,
            ),
            6 => 
            array (
                'id' => 7,
                'name' => 'DESEMBOLSO DE CREDITO',
                'state' => 1,
                'id_user' => 1,
                'created_at' => NULL,
                'updated_at' => NULL,
                'id_classification' => NULL,
            ),
            7 => 
            array (
                'id' => 8,
                'name' => 'PRESTAMO DE SOCIO',
                'state' => 1,
                'id_user' => 1,
                'created_at' => NULL,
                'updated_at' => NULL,
                'id_classification' => NULL,
            ),
            8 => 
            array (
                'id' => 9,
                'name' => 'PRESTAMO DE INTEREMPRESA',
                'state' => 1,
                'id_user' => 1,
                'created_at' => NULL,
                'updated_at' => NULL,
                'id_classification' => NULL,
            ),
            9 => 
            array (
                'id' => 10,
                'name' => 'INGRESO POR TRASLADO PROPIO',
                'state' => 1,
                'id_user' => 1,
                'created_at' => NULL,
                'updated_at' => NULL,
                'id_classification' => NULL,
            ),
            10 => 
            array (
                'id' => 11,
                'name' => 'DEVOLUCION DE PAGO ANTERIOR',
                'state' => 1,
                'id_user' => 1,
                'created_at' => NULL,
                'updated_at' => NULL,
                'id_classification' => NULL,
            ),
            11 => 
            array (
                'id' => 12,
                'name' => 'MANO DE OBRA LABORAL',
                'state' => 1,
                'id_user' => 1,
                'created_at' => NULL,
                'updated_at' => NULL,
                'id_classification' => NULL,
            ),
            12 => 
            array (
                'id' => 13,
                'name' => 'BIENES',
                'state' => 1,
                'id_user' => 1,
                'created_at' => NULL,
                'updated_at' => NULL,
                'id_classification' => NULL,
            ),
            13 => 
            array (
                'id' => 14,
                'name' => 'ACTIVOS',
                'state' => 1,
                'id_user' => 1,
                'created_at' => NULL,
                'updated_at' => NULL,
                'id_classification' => NULL,
            ),
            14 => 
            array (
                'id' => 15,
                'name' => 'SERVICIOS',
                'state' => 1,
                'id_user' => 1,
                'created_at' => NULL,
                'updated_at' => NULL,
                'id_classification' => NULL,
            ),
            15 => 
            array (
                'id' => 16,
                'name' => 'FIC',
                'state' => 1,
                'id_user' => 1,
                'created_at' => NULL,
                'updated_at' => NULL,
                'id_classification' => NULL,
            ),
            16 => 
            array (
                'id' => 17,
                'name' => 'ICA',
                'state' => 1,
                'id_user' => 1,
                'created_at' => NULL,
                'updated_at' => NULL,
                'id_classification' => NULL,
            ),
            17 => 
            array (
                'id' => 18,
                'name' => 'IVA',
                'state' => 1,
                'id_user' => 1,
                'created_at' => NULL,
                'updated_at' => NULL,
                'id_classification' => NULL,
            ),
            18 => 
            array (
                'id' => 19,
                'name' => 'PREDIAL',
                'state' => 1,
                'id_user' => 1,
                'created_at' => NULL,
                'updated_at' => NULL,
                'id_classification' => NULL,
            ),
            19 => 
            array (
                'id' => 20,
                'name' => 'RENTA',
                'state' => 1,
                'id_user' => 1,
                'created_at' => NULL,
                'updated_at' => NULL,
                'id_classification' => NULL,
            ),
            20 => 
            array (
                'id' => 21,
                'name' => 'RETEFUENTE',
                'state' => 1,
                'id_user' => 1,
                'created_at' => NULL,
                'updated_at' => NULL,
                'id_classification' => NULL,
            ),
            21 => 
            array (
                'id' => 22,
                'name' => 'VEHICULAR ALCALDIA',
                'state' => 1,
                'id_user' => 1,
                'created_at' => NULL,
                'updated_at' => NULL,
                'id_classification' => NULL,
            ),
            22 => 
            array (
                'id' => 23,
                'name' => 'VEHICULAR GOBERNACION',
                'state' => 1,
                'id_user' => 1,
                'created_at' => NULL,
                'updated_at' => NULL,
                'id_classification' => NULL,
            ),
            23 => 
            array (
                'id' => 24,
                'name' => 'GASTOS BANCARIOS',
                'state' => 1,
                'id_user' => 1,
                'created_at' => NULL,
                'updated_at' => NULL,
                'id_classification' => NULL,
            ),
            24 => 
            array (
                'id' => 25,
                'name' => 'GASTOS FINANCIEROS',
                'state' => 1,
                'id_user' => 1,
                'created_at' => NULL,
                'updated_at' => NULL,
                'id_classification' => NULL,
            ),
            25 => 
            array (
                'id' => 26,
                'name' => 'EMBARGOS Y O BLOQUEOS',
                'state' => 1,
                'id_user' => 1,
                'created_at' => NULL,
                'updated_at' => NULL,
                'id_classification' => NULL,
            ),
            26 => 
            array (
                'id' => 27,
                'name' => 'PAGOS DE TARJETA DE CREDITO',
                'state' => 1,
                'id_user' => 1,
                'created_at' => NULL,
                'updated_at' => NULL,
                'id_classification' => NULL,
            ),
            27 => 
            array (
                'id' => 28,
                'name' => 'PAGO DE CAPITAL',
                'state' => 1,
                'id_user' => 1,
                'created_at' => NULL,
                'updated_at' => NULL,
                'id_classification' => NULL,
            ),
            28 => 
            array (
                'id' => 29,
                'name' => 'PRESTAMO A SOCIO',
                'state' => 1,
                'id_user' => 1,
                'created_at' => NULL,
                'updated_at' => NULL,
                'id_classification' => NULL,
            ),
            29 => 
            array (
                'id' => 30,
                'name' => 'PRESTAMO A INTEREMPRESA',
                'state' => 1,
                'id_user' => 1,
                'created_at' => NULL,
                'updated_at' => NULL,
                'id_classification' => NULL,
            ),
            30 => 
            array (
                'id' => 31,
                'name' => 'EGRESO POR TRASLADO PROPIO',
                'state' => 1,
                'id_user' => 1,
                'created_at' => NULL,
                'updated_at' => NULL,
                'id_classification' => NULL,
            ),
            31 => 
            array (
                'id' => 32,
                'name' => 'PAGO POR DEVOLUCION DE PAGO ANTERIOR',
                'state' => 1,
                'id_user' => 1,
                'created_at' => NULL,
                'updated_at' => NULL,
                'id_classification' => NULL,
            ),
            32 => 
            array (
                'id' => 33,
                'name' => 'N/A',
                'state' => 1,
                'id_user' => 1,
                'created_at' => NULL,
                'updated_at' => NULL,
                'id_classification' => NULL,
            ),
        ));
        
        
    }
}