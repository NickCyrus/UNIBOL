<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class LogActionsTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('log_actions')->delete();
        
        \DB::table('log_actions')->insert(array (
            0 => 
            array (
                'id' => 1,
                'created_at' => '2023-06-17 02:06:24',
                'updated_at' => NULL,
                'userid' => 1,
                'ipaccess' => '127.0.0.1',
                'comment' => 'Actualizo el perfil <b>Administrador</b>.',
                'action' => 'update',
                'fbefore' => '',
                'fafter' => '',
            ),
            1 => 
            array (
                'id' => 2,
                'created_at' => '2023-06-17 02:06:49',
                'updated_at' => NULL,
                'userid' => 1,
                'ipaccess' => '127.0.0.1',
                'comment' => 'Agrego el módulos <b>Tpo de doc. de aprobación</b>.',
                'action' => 'insert',
                'fbefore' => '',
                'fafter' => '',
            ),
            2 => 
            array (
                'id' => 3,
                'created_at' => '2023-06-17 02:07:01',
                'updated_at' => NULL,
                'userid' => 1,
                'ipaccess' => '127.0.0.1',
                'comment' => 'Actualizo el perfil <b>Administrador</b>.',
                'action' => 'update',
                'fbefore' => '',
                'fafter' => '',
            ),
            3 => 
            array (
                'id' => 4,
                'created_at' => '2023-06-17 06:33:30',
                'updated_at' => NULL,
                'userid' => 1,
                'ipaccess' => '127.0.0.1',
                'comment' => 'Agrego el módulos <b>Bancos</b>.',
                'action' => 'insert',
                'fbefore' => '',
                'fafter' => '',
            ),
            4 => 
            array (
                'id' => 5,
                'created_at' => '2023-06-17 06:33:46',
                'updated_at' => NULL,
                'userid' => 1,
                'ipaccess' => '127.0.0.1',
                'comment' => 'Elimino el perfil <b>Administrador</b>.',
                'action' => 'delete',
                'fbefore' => '',
                'fafter' => '',
            ),
            5 => 
            array (
                'id' => 6,
                'created_at' => '2023-06-17 06:36:40',
                'updated_at' => NULL,
                'userid' => 1,
                'ipaccess' => '127.0.0.1',
                'comment' => 'Actualizo el perfil <b>Administrador</b>.',
                'action' => 'update',
                'fbefore' => '',
                'fafter' => '',
            ),
            6 => 
            array (
                'id' => 7,
                'created_at' => '2023-06-17 06:37:04',
                'updated_at' => NULL,
                'userid' => 1,
                'ipaccess' => '127.0.0.1',
                'comment' => 'Actualizo el perfil <b>Administrador</b>.',
                'action' => 'update',
                'fbefore' => '',
                'fafter' => '',
            ),
            7 => 
            array (
                'id' => 8,
                'created_at' => '2023-06-17 14:25:55',
                'updated_at' => NULL,
                'userid' => 1,
                'ipaccess' => '127.0.0.1',
                'comment' => 'Actualizo el perfil <b>Administrador</b>.',
                'action' => 'update',
                'fbefore' => '',
                'fafter' => '',
            ),
            8 => 
            array (
                'id' => 9,
                'created_at' => '2023-06-17 14:26:35',
                'updated_at' => NULL,
                'userid' => 1,
                'ipaccess' => '127.0.0.1',
                'comment' => 'Actualizo el perfil <b>Administrador</b>.',
                'action' => 'update',
                'fbefore' => '',
                'fafter' => '',
            ),
            9 => 
            array (
                'id' => 10,
                'created_at' => '2023-06-17 14:31:27',
                'updated_at' => NULL,
                'userid' => 1,
                'ipaccess' => '127.0.0.1',
                'comment' => 'Agrego el módulos <b>Tpo mov Contable</b>.',
                'action' => 'insert',
                'fbefore' => '',
                'fafter' => '',
            ),
            10 => 
            array (
                'id' => 11,
                'created_at' => '2023-06-17 14:32:09',
                'updated_at' => NULL,
                'userid' => 1,
                'ipaccess' => '127.0.0.1',
                'comment' => 'Actualizo el perfil <b>Administrador</b>.',
                'action' => 'update',
                'fbefore' => '',
                'fafter' => '',
            ),
            11 => 
            array (
                'id' => 12,
                'created_at' => '2023-06-17 14:33:51',
                'updated_at' => NULL,
                'userid' => 1,
                'ipaccess' => '127.0.0.1',
                'comment' => 'Actualizo el módulos <b>Tpo mov Contable</b>.',
                'action' => 'update',
                'fbefore' => '',
                'fafter' => '',
            ),
            12 => 
            array (
                'id' => 13,
                'created_at' => '2023-06-17 14:34:49',
                'updated_at' => NULL,
                'userid' => 1,
                'ipaccess' => '127.0.0.1',
                'comment' => 'Actualizo el módulos <b>Tpo mov Contable</b>.',
                'action' => 'update',
                'fbefore' => '',
                'fafter' => '',
            ),
            13 => 
            array (
                'id' => 14,
                'created_at' => '2023-06-17 14:35:31',
                'updated_at' => NULL,
                'userid' => 1,
                'ipaccess' => '127.0.0.1',
                'comment' => 'Actualizo el módulos <b>Tpo mov Contable</b>.',
                'action' => 'update',
                'fbefore' => '',
                'fafter' => '',
            ),
            14 => 
            array (
                'id' => 15,
                'created_at' => '2023-06-17 14:36:39',
                'updated_at' => NULL,
                'userid' => 1,
                'ipaccess' => '127.0.0.1',
                'comment' => 'Actualizo el módulos <b>Tpo mov Contable</b>.',
                'action' => 'update',
                'fbefore' => '',
                'fafter' => '',
            ),
            15 => 
            array (
                'id' => 16,
                'created_at' => '2023-06-17 15:08:30',
                'updated_at' => NULL,
                'userid' => 1,
                'ipaccess' => '127.0.0.1',
                'comment' => 'Agrego el módulos <b>Conceptos</b>.',
                'action' => 'insert',
                'fbefore' => '',
                'fafter' => '',
            ),
            16 => 
            array (
                'id' => 17,
                'created_at' => '2023-06-17 15:08:43',
                'updated_at' => NULL,
                'userid' => 1,
                'ipaccess' => '127.0.0.1',
                'comment' => 'Actualizo el perfil <b>Administrador</b>.',
                'action' => 'update',
                'fbefore' => '',
                'fafter' => '',
            ),
            17 => 
            array (
                'id' => 18,
                'created_at' => '2023-06-17 15:25:05',
                'updated_at' => NULL,
                'userid' => 1,
                'ipaccess' => '127.0.0.1',
                'comment' => 'Agrego el módulos <b>Tipo de Cuentas</b>.',
                'action' => 'insert',
                'fbefore' => '',
                'fafter' => '',
            ),
            18 => 
            array (
                'id' => 19,
                'created_at' => '2023-06-17 15:27:24',
                'updated_at' => NULL,
                'userid' => 1,
                'ipaccess' => '127.0.0.1',
                'comment' => 'Actualizo el perfil <b>Administrador</b>.',
                'action' => 'update',
                'fbefore' => '',
                'fafter' => '',
            ),
            19 => 
            array (
                'id' => 20,
                'created_at' => '2023-06-17 15:36:28',
                'updated_at' => NULL,
                'userid' => 1,
                'ipaccess' => '127.0.0.1',
                'comment' => 'Agrego el módulos <b>Estado de cuentas</b>.',
                'action' => 'insert',
                'fbefore' => '',
                'fafter' => '',
            ),
            20 => 
            array (
                'id' => 21,
                'created_at' => '2023-06-17 15:36:40',
                'updated_at' => NULL,
                'userid' => 1,
                'ipaccess' => '127.0.0.1',
                'comment' => 'Actualizo el perfil <b>Administrador</b>.',
                'action' => 'update',
                'fbefore' => '',
                'fafter' => '',
            ),
            21 => 
            array (
                'id' => 22,
                'created_at' => '2023-06-17 15:42:41',
                'updated_at' => NULL,
                'userid' => 1,
                'ipaccess' => '127.0.0.1',
                'comment' => 'Agrego el módulos <b>Cuentas</b>.',
                'action' => 'insert',
                'fbefore' => '',
                'fafter' => '',
            ),
            22 => 
            array (
                'id' => 23,
                'created_at' => '2023-06-17 15:49:40',
                'updated_at' => NULL,
                'userid' => 1,
                'ipaccess' => '127.0.0.1',
                'comment' => 'Actualizo el perfil <b>Administrador</b>.',
                'action' => 'update',
                'fbefore' => '',
                'fafter' => '',
            ),
            23 => 
            array (
                'id' => 24,
                'created_at' => '2023-06-17 18:05:35',
                'updated_at' => NULL,
                'userid' => 1,
                'ipaccess' => '127.0.0.1',
                'comment' => 'Agrego el módulos <b>Clasificación</b>.',
                'action' => 'insert',
                'fbefore' => '',
                'fafter' => '',
            ),
            24 => 
            array (
                'id' => 25,
                'created_at' => '2023-06-17 18:08:02',
                'updated_at' => NULL,
                'userid' => 1,
                'ipaccess' => '127.0.0.1',
                'comment' => 'Actualizo el perfil <b>Administrador</b>.',
                'action' => 'update',
                'fbefore' => '',
                'fafter' => '',
            ),
            25 => 
            array (
                'id' => 26,
                'created_at' => '2023-06-17 18:11:54',
                'updated_at' => NULL,
                'userid' => 1,
                'ipaccess' => '127.0.0.1',
                'comment' => 'Agrego el módulos <b>Compañias</b>.',
                'action' => 'insert',
                'fbefore' => '',
                'fafter' => '',
            ),
            26 => 
            array (
                'id' => 27,
                'created_at' => '2023-06-17 18:12:07',
                'updated_at' => NULL,
                'userid' => 1,
                'ipaccess' => '127.0.0.1',
                'comment' => 'Actualizo el perfil <b>Administrador</b>.',
                'action' => 'update',
                'fbefore' => '',
                'fafter' => '',
            ),
            27 => 
            array (
                'id' => 28,
                'created_at' => '2023-06-17 18:35:02',
                'updated_at' => NULL,
                'userid' => 1,
                'ipaccess' => '127.0.0.1',
                'comment' => 'Agrego el módulos <b>Clasificación de Terceros</b>.',
                'action' => 'insert',
                'fbefore' => '',
                'fafter' => '',
            ),
            28 => 
            array (
                'id' => 29,
                'created_at' => '2023-06-17 18:36:10',
                'updated_at' => NULL,
                'userid' => 1,
                'ipaccess' => '127.0.0.1',
                'comment' => 'Actualizo el perfil <b>Administrador</b>.',
                'action' => 'update',
                'fbefore' => '',
                'fafter' => '',
            ),
            29 => 
            array (
                'id' => 30,
                'created_at' => '2023-06-17 18:45:22',
                'updated_at' => NULL,
                'userid' => 1,
                'ipaccess' => '127.0.0.1',
                'comment' => 'Agrego el módulos <b>Terceros</b>.',
                'action' => 'insert',
                'fbefore' => '',
                'fafter' => '',
            ),
            30 => 
            array (
                'id' => 31,
                'created_at' => '2023-06-17 18:45:43',
                'updated_at' => NULL,
                'userid' => 1,
                'ipaccess' => '127.0.0.1',
                'comment' => 'Actualizo el perfil <b>Administrador</b>.',
                'action' => 'update',
                'fbefore' => '',
                'fafter' => '',
            ),
            31 => 
            array (
                'id' => 32,
                'created_at' => '2023-06-21 14:11:25',
                'updated_at' => NULL,
                'userid' => 1,
                'ipaccess' => '127.0.0.1',
                'comment' => 'Agrego el módulos <b>Centro de costos</b>.',
                'action' => 'insert',
                'fbefore' => '',
                'fafter' => '',
            ),
            32 => 
            array (
                'id' => 33,
                'created_at' => '2023-06-21 14:30:42',
                'updated_at' => NULL,
                'userid' => 1,
                'ipaccess' => '127.0.0.1',
                'comment' => 'Actualizo el perfil <b>Administrador</b>.',
                'action' => 'update',
                'fbefore' => '',
                'fafter' => '',
            ),
            33 => 
            array (
                'id' => 34,
                'created_at' => '2023-06-21 15:55:06',
                'updated_at' => NULL,
                'userid' => 1,
                'ipaccess' => '127.0.0.1',
                'comment' => 'Agrego el módulos <b>SUBCENTROS DE COSTO</b>.',
                'action' => 'insert',
                'fbefore' => '',
                'fafter' => '',
            ),
            34 => 
            array (
                'id' => 35,
                'created_at' => '2023-06-21 15:59:16',
                'updated_at' => NULL,
                'userid' => 1,
                'ipaccess' => '127.0.0.1',
                'comment' => 'Actualizo el perfil <b>Administrador</b>.',
                'action' => 'update',
                'fbefore' => '',
                'fafter' => '',
            ),
            35 => 
            array (
                'id' => 36,
                'created_at' => '2023-06-22 03:53:23',
                'updated_at' => NULL,
                'userid' => 1,
                'ipaccess' => '127.0.0.1',
                'comment' => 'Agrego el módulos <b>Registrar Ingresos/Egresos</b>.',
                'action' => 'insert',
                'fbefore' => '',
                'fafter' => '',
            ),
            36 => 
            array (
                'id' => 37,
                'created_at' => '2023-06-22 03:54:00',
                'updated_at' => NULL,
                'userid' => 1,
                'ipaccess' => '127.0.0.1',
                'comment' => 'Actualizo el módulos <b>Registrar Ingresos/Egresos</b>.',
                'action' => 'update',
                'fbefore' => '',
                'fafter' => '',
            ),
            37 => 
            array (
                'id' => 38,
                'created_at' => '2023-06-22 03:54:25',
                'updated_at' => NULL,
                'userid' => 1,
                'ipaccess' => '127.0.0.1',
                'comment' => 'Actualizo el perfil <b>Administrador</b>.',
                'action' => 'update',
                'fbefore' => '',
                'fafter' => '',
            ),
            38 => 
            array (
                'id' => 39,
                'created_at' => '2023-06-22 03:57:56',
                'updated_at' => NULL,
                'userid' => 1,
                'ipaccess' => '127.0.0.1',
                'comment' => 'Actualizo el módulos <b>Movimientos Ingresos/Egresos</b>.',
                'action' => 'update',
                'fbefore' => '',
                'fafter' => '',
            ),
        ));
        
        
    }
}