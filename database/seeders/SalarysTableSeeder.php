<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class SalarysTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('salarys')->delete();
        
        
        
    }
}