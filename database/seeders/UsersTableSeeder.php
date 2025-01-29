<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('users')->delete();
        
        \DB::table('users')->insert(array (
            0 => 
            array (
                'id' => 1,
                'name' => 'Administrador',
                'email' => 'demo@demo.com',
                'email_verified_at' => NULL,
                'profid' => 1,
                'password' => '$2b$10$GEKciVRhblV0AhblI9xv5uXg.hCCowbnhHJ8I1jeo9U/PrP9DoHz.',
                'avatar' => NULL,
                'remember_token' => NULL,
                'created_at' => '2023-06-17 02:02:54',
                'updated_at' => '2023-06-22 15:20:11',
            ),
        ));
        
        
    }
}