<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class ListasTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('listas')->delete();
        
        \DB::table('listas')->insert(array (
            0 => 
            array (
                'id' => 1,
                'id_parent' => NULL,
                'valor' => 'Bancos',
                'state' => 1,
                'dato' => NULL,
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            1 => 
            array (
                'id' => 2,
                'id_parent' => 1,
                'valor' => 'BANCO DE BOGOTA',
                'state' => 1,
                'dato' => NULL,
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            2 => 
            array (
                'id' => 3,
                'id_parent' => 1,
                'valor' => 'BANCO POPULAR S. A.',
                'state' => 1,
                'dato' => NULL,
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            3 => 
            array (
                'id' => 4,
                'id_parent' => 1,
                'valor' => 'BANCOLOMBIA S. A.',
                'state' => 1,
                'dato' => NULL,
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            4 => 
            array (
                'id' => 5,
                'id_parent' => 1,
                'valor' => 'BANCO W S. A.',
                'state' => 1,
                'dato' => NULL,
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            5 => 
            array (
                'id' => 6,
                'id_parent' => 1,
                'valor' => 'BANCO DE OCCIDENTE',
                'state' => 1,
                'dato' => NULL,
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            6 => 
            array (
                'id' => 7,
                'id_parent' => 1,
                'valor' => 'BANCO SERFINANSA',
                'state' => 1,
                'dato' => NULL,
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            7 => 
            array (
                'id' => 8,
                'id_parent' => 1,
                'valor' => 'BANCO COMERCIAL AV VILLAS S. A.',
                'state' => 1,
                'dato' => NULL,
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            8 => 
            array (
                'id' => 9,
                'id_parent' => 1,
                'valor' => 'LULO BANK S.A.',
                'state' => 1,
                'dato' => NULL,
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            9 => 
            array (
                'id' => 10,
                'id_parent' => 1,
                'valor' => 'BANCAMÍA S. A.',
                'state' => 1,
                'dato' => NULL,
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            10 => 
            array (
                'id' => 11,
                'id_parent' => 1,
                'valor' => 'GLOBAL COLOMBIA 81 S.A.',
                'state' => 1,
                'dato' => NULL,
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            11 => 
            array (
                'id' => 12,
                'id_parent' => 1,
                'valor' => 'SANTANDER CONSUMER S.A. COMPAÑÍA DE FINANCIAMIENTO',
                'state' => 1,
                'dato' => NULL,
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            12 => 
            array (
                'id' => 13,
                'id_parent' => 1,
                'valor' => 'NU COLOMBIA COMPAÑÍA DE FINANCIAMIENTO S.A.',
                'state' => 1,
                'dato' => NULL,
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            13 => 
            array (
                'id' => 14,
                'id_parent' => 1,
                'valor' => 'BANCO COOPCENTRAL',
                'state' => 1,
                'dato' => NULL,
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            14 => 
            array (
                'id' => 15,
                'id_parent' => 1,
                'valor' => 'LA HIPOTECARIA COMPAÑÍA DE FINANCIAMIENTO S. A.',
                'state' => 1,
                'dato' => NULL,
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            15 => 
            array (
                'id' => 16,
                'id_parent' => 1,
                'valor' => 'BANCO UNIÓN',
                'state' => 1,
                'dato' => NULL,
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            16 => 
            array (
                'id' => 17,
                'id_parent' => 1,
                'valor' => 'CITIBANK',
                'state' => 1,
                'dato' => NULL,
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            17 => 
            array (
                'id' => 18,
                'id_parent' => 1,
                'valor' => 'FINANCIERA JURISCOOP COOPERATIVA FINANCIERA',
                'state' => 1,
                'dato' => NULL,
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            18 => 
            array (
                'id' => 19,
                'id_parent' => 1,
                'valor' => 'BANCO MUNDO MUJER',
                'state' => 1,
                'dato' => NULL,
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            19 => 
            array (
                'id' => 20,
                'id_parent' => 1,
                'valor' => 'PAGOS GDE S. A.',
                'state' => 1,
                'dato' => NULL,
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            20 => 
            array (
                'id' => 21,
                'id_parent' => 1,
                'valor' => 'AVAL SOLUCIONES DIGITALES S. A.',
                'state' => 1,
                'dato' => NULL,
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            21 => 
            array (
                'id' => 22,
                'id_parent' => 1,
                'valor' => 'RAPPIPAY COMPAÑÍA DE FINANCIAMIENTO S.A.',
                'state' => 1,
                'dato' => NULL,
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            22 => 
            array (
                'id' => 23,
                'id_parent' => 1,
                'valor' => 'BOLD COMPAÑÍA DE FINANCIAMIENTO S.A.',
                'state' => 1,
                'dato' => NULL,
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            23 => 
            array (
                'id' => 24,
                'id_parent' => 1,
                'valor' => 'MOVII S.A SEDPE',
                'state' => 1,
                'dato' => NULL,
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            24 => 
            array (
                'id' => 25,
                'id_parent' => 1,
                'valor' => 'STONEX GLOBAL PAYMENTS COLOMBIA S.A',
                'state' => 1,
                'dato' => NULL,
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            25 => 
            array (
                'id' => 26,
                'id_parent' => 1,
                'valor' => 'BANCO ITAÚ CORPBANCA COLOMBIA S.A.',
                'state' => 1,
                'dato' => NULL,
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            26 => 
            array (
                'id' => 27,
                'id_parent' => 1,
                'valor' => 'TECNIPAGOS SA',
                'state' => 1,
                'dato' => NULL,
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            27 => 
            array (
                'id' => 28,
                'id_parent' => 1,
                'valor' => 'COINK S.A',
                'state' => 1,
                'dato' => NULL,
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            28 => 
            array (
                'id' => 29,
                'id_parent' => 1,
                'valor' => 'Mercadopago S.A Compañía de Financiamiento',
                'state' => 1,
                'dato' => NULL,
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            29 => 
            array (
                'id' => 30,
                'id_parent' => 1,
                'valor' => 'TUYA S. A.',
                'state' => 1,
                'dato' => NULL,
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            30 => 
            array (
                'id' => 31,
                'id_parent' => 1,
                'valor' => 'COLTEFINANCIERA S. A.',
                'state' => 1,
                'dato' => NULL,
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            31 => 
            array (
                'id' => 32,
                'id_parent' => 1,
                'valor' => 'CORPORACIÓN FINANCIERA COLOMBIANA S. A.',
                'state' => 1,
                'dato' => NULL,
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            32 => 
            array (
                'id' => 33,
                'id_parent' => 1,
                'valor' => 'BANCO GNB SUDAMERIS S. A.',
                'state' => 1,
                'dato' => NULL,
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            33 => 
            array (
                'id' => 34,
                'id_parent' => 1,
                'valor' => 'BBVA COLOMBIA S. A.',
                'state' => 1,
                'dato' => NULL,
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            34 => 
            array (
                'id' => 35,
                'id_parent' => 1,
                'valor' => 'BCSC S. A.',
                'state' => 1,
                'dato' => NULL,
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            35 => 
            array (
                'id' => 36,
                'id_parent' => 1,
                'valor' => 'GM FINANCIAL COLOMBIA S.A. COMPAÑÍA DE FINANCIAMIENTO',
                'state' => 1,
                'dato' => NULL,
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            36 => 
            array (
                'id' => 37,
                'id_parent' => 1,
                'valor' => 'BANCA DE INVERSIÓN BANCOLOMBIA',
                'state' => 1,
                'dato' => NULL,
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            37 => 
            array (
                'id' => 38,
                'id_parent' => 1,
                'valor' => 'BANCO DAVIVIENDA S. A.',
                'state' => 1,
                'dato' => NULL,
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            38 => 
            array (
                'id' => 39,
                'id_parent' => 1,
                'valor' => 'BANCO JP MORGAN',
                'state' => 1,
                'dato' => NULL,
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            39 => 
            array (
                'id' => 40,
                'id_parent' => 1,
                'valor' => 'SCOTIABANK COLPATRIA S.A.',
                'state' => 1,
                'dato' => NULL,
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            40 => 
            array (
                'id' => 41,
                'id_parent' => 1,
                'valor' => 'BANCO AGRARIO DE COLOMBIA S. A.',
                'state' => 1,
                'dato' => NULL,
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            41 => 
            array (
                'id' => 42,
                'id_parent' => 1,
                'valor' => 'BANCA TECNOLOGÍA CO S.A. COMPAÑÍA DE FINANCIAMIENTO',
                'state' => 1,
                'dato' => NULL,
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            42 => 
            array (
                'id' => 43,
                'id_parent' => 1,
                'valor' => 'IRIS CF - COMPAÑÍA DE FINANCIAMIENTO S.A.',
                'state' => 1,
                'dato' => NULL,
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            43 => 
            array (
                'id' => 44,
                'id_parent' => 1,
                'valor' => 'BANCO CREDIFINANCIERA S.A.',
                'state' => 1,
                'dato' => NULL,
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            44 => 
            array (
                'id' => 45,
                'id_parent' => 1,
                'valor' => 'BANCO COOMEVA S. A.',
                'state' => 1,
                'dato' => NULL,
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            45 => 
            array (
                'id' => 46,
                'id_parent' => 1,
                'valor' => 'BANCO FINANDINA S. A.',
                'state' => 1,
                'dato' => NULL,
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            46 => 
            array (
                'id' => 47,
                'id_parent' => 1,
                'valor' => 'CREDIFAMILIA COMPAÑIA DE FINANCIAMIENTO S. A.',
                'state' => 1,
                'dato' => NULL,
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            47 => 
            array (
                'id' => 48,
                'id_parent' => 1,
                'valor' => 'BNP PARIBAS COLOMBIA CORPORACION FINANCIERA',
                'state' => 1,
                'dato' => NULL,
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            48 => 
            array (
                'id' => 49,
                'id_parent' => 1,
                'valor' => 'BANCO FALABELLA S. A.',
                'state' => 1,
                'dato' => NULL,
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            49 => 
            array (
                'id' => 50,
                'id_parent' => 1,
                'valor' => 'BANCO PICHINCHA S. A.',
                'state' => 1,
                'dato' => NULL,
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            50 => 
            array (
                'id' => 51,
                'id_parent' => 1,
                'valor' => 'CORPORACIÓN FINANCIERA DAVIVIENDA S. A.',
                'state' => 1,
                'dato' => NULL,
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            51 => 
            array (
                'id' => 52,
                'id_parent' => 1,
                'valor' => 'BANCO MIBANCO',
                'state' => 1,
                'dato' => NULL,
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            52 => 
            array (
                'id' => 53,
                'id_parent' => 1,
                'valor' => 'CREZCAMOS S.A COMPAÑÍA DE FINANCIAMIENTO',
                'state' => 1,
                'dato' => NULL,
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            53 => 
            array (
                'id' => 54,
                'id_parent' => 1,
                'valor' => 'BANCO SANTANDER DE NEGOCIOS COLOMBIA S. A.',
                'state' => 1,
                'dato' => NULL,
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            54 => 
            array (
                'id' => 55,
                'id_parent' => 1,
                'valor' => 'RCI COLOMBIA S.A. COMPAÑÍA DE FINANCIAMIENTO',
                'state' => 1,
                'dato' => NULL,
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            55 => 
            array (
                'id' => 56,
                'id_parent' => 1,
                'valor' => 'CORPORACION FINANCIERA GNB SUDAMERIS S. A.',
                'state' => 1,
                'dato' => NULL,
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            56 => 
            array (
                'id' => 57,
                'id_parent' => 1,
                'valor' => 'BANCO BTG PACTUAL COLOMBIA S.A.',
                'state' => 1,
                'dato' => NULL,
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
        ));
        
        
    }
}