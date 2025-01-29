<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class ModulesappsTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('modulesapps')->delete();
        
        \DB::table('modulesapps')->insert(array (
            0 => 
            array (
                'id' => 1,
                'id_parent' => 22,
                'created_at' => '2022-04-28 02:59:28',
                'updated_at' => NOW(),
                'nameapp' => 'Módulos',
                'iconapp' => 'bxs-component',
                'urlapp' => 'modules',
                'orderapp' => 1,
                'state' => 1,
            ),
            1 => 
            array (
                'id' => 2,
                'id_parent' => 22,
                'created_at' => '2022-04-28 02:59:28',
                'updated_at' => NOW(),
                'nameapp' => 'Perfiles',
                'iconapp' => 'bxs-user-detail',
                'urlapp' => 'perfiles',
                'orderapp' => 2,
                'state' => 1,
            ),
            2 => 
            array (
                'id' => 3,
                'id_parent' => 22,
                'created_at' => '2022-04-28 02:59:28',
                'updated_at' => NOW(),
                'nameapp' => 'Usuarios',
                'iconapp' => 'bxs-user',
                'urlapp' => 'usuarios',
                'orderapp' => 3,
                'state' => 1,
            ),
            3 => 
            array (
                'id' => 4,
                'id_parent' => 22,
                'created_at' => '2022-04-28 02:59:28',
                'updated_at' => '2022-05-03 03:28:54',
                'nameapp' => 'Logs de usuarios',
                'iconapp' => 'bxs-book-reader',
                'urlapp' => 'logsusers',
                'orderapp' => 5,
                'state' => 1,
            ),
            4 => 
            array (
                'id' => 8,
                'id_parent' => 20,
                'created_at' => NOW(),
                'updated_at' => '2022-05-11 12:13:36',
                'nameapp' => 'Personal',
                'iconapp' => 'bx-user',
                'urlapp' => 'personal',
                'orderapp' => 9,
                'state' => 1,
            ),
            5 => 
            array (
                'id' => 9,
                'id_parent' => 20,
                'created_at' => NOW(),
                'updated_at' => '2022-05-11 12:13:47',
                'nameapp' => 'Equipos',
                'iconapp' => 'bx-wrench',
                'urlapp' => 'equipos',
                'orderapp' => 10,
                'state' => 1,
            ),
            6 => 
            array (
                'id' => 10,
                'id_parent' => 20,
                'created_at' => NOW(),
                'updated_at' => '2023-06-16 04:46:26',
                'nameapp' => 'Contratos',
                'iconapp' => 'bx-briefcase-alt',
                'urlapp' => 'contratos',
                'orderapp' => 6,
                'state' => 1,
            ),
            7 => 
            array (
                'id' => 11,
                'id_parent' => 20,
                'created_at' => NOW(),
                'updated_at' => '2022-05-11 12:13:54',
                'nameapp' => 'Materiales',
                'iconapp' => 'bxs-calculator',
                'urlapp' => 'materiales',
                'orderapp' => 11,
                'state' => 1,
            ),
            8 => 
            array (
                'id' => 12,
                'id_parent' => 20,
                'created_at' => NOW(),
                'updated_at' => '2022-05-11 12:13:15',
                'nameapp' => 'Base de datos de items',
                'iconapp' => 'bx-list-check',
                'urlapp' => 'items',
                'orderapp' => 7,
                'state' => 1,
            ),
            9 => 
            array (
                'id' => 13,
                'id_parent' => 20,
                'created_at' => '2022-05-19 02:29:11',
                'updated_at' => '2022-05-26 00:23:19',
                'nameapp' => 'Categorías Ppto Téc.',
                'iconapp' => 'bx bx-list-ol',
                'urlapp' => 'categorias',
                'orderapp' => 12,
                'state' => 1,
            ),
            10 => 
            array (
                'id' => 14,
                'id_parent' => 20,
                'created_at' => '2022-05-19 02:30:25',
                'updated_at' => NOW(),
                'nameapp' => 'Diversos',
                'iconapp' => 'bx bx-category-alt',
                'urlapp' => 'diversos',
                'orderapp' => 13,
                'state' => 1,
            ),
            11 => 
            array (
                'id' => 15,
                'id_parent' => 20,
                'created_at' => '2022-05-19 02:31:34',
                'updated_at' => '2022-05-19 02:31:47',
                'nameapp' => 'Salarios Admon',
                'iconapp' => 'bx bx-dollar-circle',
                'urlapp' => 'salariosadmon',
                'orderapp' => 14,
                'state' => 1,
            ),
            12 => 
            array (
                'id' => 16,
                'id_parent' => 20,
                'created_at' => '2022-05-19 02:32:35',
                'updated_at' => NOW(),
                'nameapp' => 'Salarios no propios',
                'iconapp' => 'bx bx-dollar',
                'urlapp' => 'salariosnopropios',
                'orderapp' => 15,
                'state' => 1,
            ),
            13 => 
            array (
                'id' => 17,
                'id_parent' => 20,
                'created_at' => '2022-05-19 02:33:09',
                'updated_at' => NOW(),
                'nameapp' => 'Salarios propios',
                'iconapp' => 'bx bxs-badge-dollar',
                'urlapp' => 'salariospropios',
                'orderapp' => 16,
                'state' => 1,
            ),
            14 => 
            array (
                'id' => 18,
                'id_parent' => 20,
                'created_at' => '2022-05-26 00:06:54',
                'updated_at' => NOW(),
                'nameapp' => 'Equi. Sub contratados',
                'iconapp' => 'bx-wrench',
                'urlapp' => 'equipossub',
                'orderapp' => 10,
                'state' => 1,
            ),
            15 => 
            array (
                'id' => 19,
                'id_parent' => 20,
                'created_at' => '2022-05-26 00:39:59',
                'updated_at' => NOW(),
                'nameapp' => 'Impuestos',
                'iconapp' => 'bx bx-pin',
                'urlapp' => 'taxes',
                'orderapp' => 18,
                'state' => 1,
            ),
            16 => 
            array (
                'id' => 20,
                'id_parent' => NULL,
                'created_at' => NOW(),
                'updated_at' => NOW(),
                'nameapp' => 'Fronteras',
                'iconapp' => '',
                'urlapp' => 'fronteras',
                'orderapp' => 2,
                'state' => 1,
            ),
            17 => 
            array (
                'id' => 21,
                'id_parent' => NULL,
                'created_at' => NOW(),
                'updated_at' => NOW(),
                'nameapp' => 'Ingreso/Egresos',
                'iconapp' => '',
                'urlapp' => 'ie',
                'orderapp' => 3,
                'state' => 1,
            ),
            18 => 
            array (
                'id' => 22,
                'id_parent' => NULL,
                'created_at' => NOW(),
                'updated_at' => '2023-06-16 21:45:12',
                'nameapp' => 'Configuración',
                'iconapp' => '',
                'urlapp' => 'config',
                'orderapp' => 1,
                'state' => 1,
            ),
            19 => 
            array (
                'id' => 23,
                'id_parent' => 21,
                'created_at' => '2023-06-17 02:06:49',
                'updated_at' => NULL,
                'nameapp' => 'Tpo de doc. de aprobación',
                'iconapp' => 'bx-briefcase-alt',
                'urlapp' => 'tipo-documento-aprobacion',
                'orderapp' => 30,
                'state' => 1,
            ),
            20 => 
            array (
                'id' => 24,
                'id_parent' => 21,
                'created_at' => '2023-06-17 06:33:30',
                'updated_at' => NULL,
                'nameapp' => 'Bancos',
                'iconapp' => 'bx bx-dollar-circle',
                'urlapp' => 'banks',
                'orderapp' => 30,
                'state' => 1,
            ),
            21 => 
            array (
                'id' => 25,
                'id_parent' => 21,
                'created_at' => '2023-06-17 14:31:27',
                'updated_at' => '2023-06-17 14:36:39',
                'nameapp' => 'Tpo mov Contable',
                'iconapp' => 'bxs-calculator',
                'urlapp' => 'tipo-movimiento-contable',
                'orderapp' => 30,
                'state' => 1,
            ),
            22 => 
            array (
                'id' => 26,
                'id_parent' => 21,
                'created_at' => '2023-06-17 15:08:31',
                'updated_at' => NULL,
                'nameapp' => 'Conceptos',
                'iconapp' => 'bx bx-list-ul',
                'urlapp' => 'conceptos',
                'orderapp' => 30,
                'state' => 1,
            ),
            23 => 
            array (
                'id' => 27,
                'id_parent' => 29,
                'created_at' => '2023-06-17 15:25:05',
                'updated_at' => NULL,
                'nameapp' => 'Tipo de Cuentas',
                'iconapp' => 'bx bx-circle',
                'urlapp' => 'tipo-de-cuentas',
                'orderapp' => 3,
                'state' => 1,
            ),
            24 => 
            array (
                'id' => 28,
                'id_parent' => 29,
                'created_at' => '2023-06-17 15:36:28',
                'updated_at' => NULL,
                'nameapp' => 'Estado de cuentas',
                'iconapp' => 'bx-circle',
                'urlapp' => 'estado-de-cuenta',
                'orderapp' => 2,
                'state' => 1,
            ),
            25 => 
            array (
                'id' => 29,
                'id_parent' => 21,
                'created_at' => '2023-06-17 15:42:41',
                'updated_at' => NULL,
                'nameapp' => 'Cuentas',
                'iconapp' => 'bx-circle',
                'urlapp' => 'cuentas',
                'orderapp' => 1,
                'state' => 1,
            ),
            26 => 
            array (
                'id' => 30,
                'id_parent' => 21,
                'created_at' => '2023-06-17 18:05:35',
                'updated_at' => NULL,
                'nameapp' => 'Clasificación',
                'iconapp' => 'bx-circle',
                'urlapp' => 'clasificacion',
                'orderapp' => 30,
                'state' => 1,
            ),
            27 => 
            array (
                'id' => 31,
                'id_parent' => 21,
                'created_at' => '2023-06-17 18:11:54',
                'updated_at' => NULL,
                'nameapp' => 'Compañias',
                'iconapp' => 'bx-circle',
                'urlapp' => 'compania',
                'orderapp' => 3,
                'state' => 1,
            ),
            28 => 
            array (
                'id' => 32,
                'id_parent' => 33,
                'created_at' => '2023-06-17 18:35:02',
                'updated_at' => NULL,
                'nameapp' => 'Clasificación de Terceros',
                'iconapp' => 'bx-circle',
                'urlapp' => 'clasificacion-de-terceros',
                'orderapp' => 2,
                'state' => 1,
            ),
            29 => 
            array (
                'id' => 33,
                'id_parent' => 21,
                'created_at' => '2023-06-17 18:45:22',
                'updated_at' => NULL,
                'nameapp' => 'Terceros',
                'iconapp' => 'bx-circle',
                'urlapp' => 'terceros',
                'orderapp' => 1,
                'state' => 1,
            ),
            30 => 
            array (
                'id' => 34,
                'id_parent' => 21,
                'created_at' => '2023-06-21 14:11:25',
                'updated_at' => NULL,
                'nameapp' => 'Centro de costos',
                'iconapp' => 'bx-circle',
                'urlapp' => 'categorias-centro-de-costo',
                'orderapp' => NULL,
                'state' => 1,
            ),
            31 => 
            array (
                'id' => 35,
                'id_parent' => 34,
                'created_at' => '2023-06-21 15:55:06',
                'updated_at' => NULL,
                'nameapp' => 'Subcentros de costos',
                'iconapp' => 'bx-circle',
                'urlapp' => 'sub-centros-de-costos',
                'orderapp' => NULL,
                'state' => 1,
            ),
            32 => 
            array (
                'id' => 36,
                'id_parent' => 21,
                'created_at' => '2023-06-22 03:53:23',
                'updated_at' => '2023-06-22 03:57:56',
                'nameapp' => 'Movimientos Ingresos/Egresos',
                'iconapp' => 'bx bxs-dollar-circle',
                'urlapp' => 'registro-ingresos-egresos',
                'orderapp' => 1,
                'state' => 1,
            ),
        ));
        
        
    }
}