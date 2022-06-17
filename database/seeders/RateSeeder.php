<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class RateSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        for ($i=1; $i <= 12; $i++) { 
            \App\Models\Rate::create([
                'month' => $i, 
                'year' => 2022, 
                'halfdayrs' => 51.75, 
                'Internationalrs' => 74, 
                'fulldayrs' => 69, 
            ]);        
        }
    }
}
