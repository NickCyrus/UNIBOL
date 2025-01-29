<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class IeThirdpartiesTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('ie_thirdparties')->delete();
        
        \DB::table('ie_thirdparties')->insert(array (
            0 => 
            array (
                'id' => 1,
                'nit' => '900.258.868-9',
                'name' => 'Nick Cyrus Lemus Duque',
                'email' => 'nicklemusduque@gmail.com',
                'cellphone' => '3159269395',
                'address' => 'Carrera 44A #26-26, Costa Hermosa',
                'id_cat_third' => 1,
                'state' => 1,
                'id_user' => 1,
                'created_at' => NULL,
                'updated_at' => '2023-06-20 22:09:24',
                'code' => '123',
            ),
        ));
        
        
    }
}