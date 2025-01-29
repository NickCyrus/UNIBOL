<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class LogLoginsTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('log_logins')->delete();
        
        \DB::table('log_logins')->insert(array (
            0 => 
            array (
                'id' => 1,
                'created_at' => '2023-06-17 02:05:01',
                'updated_at' => NULL,
                'userid' => 1,
                'ipaccess' => '127.0.0.1',
                'device' => 'PC',
                'agent' => 'Windows 10.0, Chrome/114.0.0.0',
                'event' => 'Logout',
                'info' => '',
            ),
            1 => 
            array (
                'id' => 2,
                'created_at' => '2023-06-17 02:05:04',
                'updated_at' => NULL,
                'userid' => 1,
                'ipaccess' => '127.0.0.1',
                'device' => 'PC',
                'agent' => 'Windows 10.0, Chrome/114.0.0.0',
                'event' => 'Login',
                'info' => '',
            ),
            2 => 
            array (
                'id' => 3,
                'created_at' => '2023-06-17 05:51:13',
                'updated_at' => NULL,
                'userid' => 1,
                'ipaccess' => '127.0.0.1',
                'device' => 'PC',
                'agent' => 'Windows 10.0, Chrome/114.0.0.0',
                'event' => 'Login',
                'info' => '',
            ),
            3 => 
            array (
                'id' => 4,
                'created_at' => '2023-06-17 06:34:31',
                'updated_at' => NULL,
                'userid' => 1,
                'ipaccess' => '127.0.0.1',
                'device' => 'PC',
                'agent' => 'Windows 10.0, Chrome/114.0.0.0',
                'event' => 'Logout',
                'info' => '',
            ),
            4 => 
            array (
                'id' => 5,
                'created_at' => '2023-06-17 06:34:33',
                'updated_at' => NULL,
                'userid' => 1,
                'ipaccess' => '127.0.0.1',
                'device' => 'PC',
                'agent' => 'Windows 10.0, Chrome/114.0.0.0',
                'event' => 'Login',
                'info' => '',
            ),
            5 => 
            array (
                'id' => 6,
                'created_at' => '2023-06-17 13:21:23',
                'updated_at' => NULL,
                'userid' => 1,
                'ipaccess' => '127.0.0.1',
                'device' => 'PC',
                'agent' => 'Windows 10.0, Chrome/114.0.0.0',
                'event' => 'Login',
                'info' => '',
            ),
            6 => 
            array (
                'id' => 7,
                'created_at' => '2023-06-20 14:22:29',
                'updated_at' => NULL,
                'userid' => 1,
                'ipaccess' => '127.0.0.1',
                'device' => 'PC',
                'agent' => 'Windows 10.0, Chrome/114.0.0.0',
                'event' => 'Login',
                'info' => '',
            ),
            7 => 
            array (
                'id' => 8,
                'created_at' => '2023-06-20 20:15:50',
                'updated_at' => NULL,
                'userid' => 1,
                'ipaccess' => '127.0.0.1',
                'device' => 'PC',
                'agent' => 'Windows 10.0, Chrome/114.0.0.0',
                'event' => 'Login',
                'info' => '',
            ),
            8 => 
            array (
                'id' => 9,
                'created_at' => '2023-06-21 02:01:44',
                'updated_at' => NULL,
                'userid' => 1,
                'ipaccess' => '127.0.0.1',
                'device' => 'PC',
                'agent' => 'Windows 10.0, Chrome/114.0.0.0',
                'event' => 'Login',
                'info' => '',
            ),
            9 => 
            array (
                'id' => 10,
                'created_at' => '2023-06-21 13:00:12',
                'updated_at' => NULL,
                'userid' => 1,
                'ipaccess' => '127.0.0.1',
                'device' => 'PC',
                'agent' => 'Windows 10.0, Chrome/114.0.0.0',
                'event' => 'Login',
                'info' => '',
            ),
            10 => 
            array (
                'id' => 11,
                'created_at' => '2023-06-22 15:20:11',
                'updated_at' => NULL,
                'userid' => 1,
                'ipaccess' => '127.0.0.1',
                'device' => 'PC',
                'agent' => 'Windows 10.0, Chrome/114.0.0.0',
                'event' => 'Login',
                'info' => '',
            ),
        ));
        
        
    }
}