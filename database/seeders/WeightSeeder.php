<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Bmi;

class WeightSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $ymdt="2021-03-";
        $weight=70;
        for($date=1;$date<=31;$date++){
            $weight += 0.1 * (2 - rand(0, 4));
            $bmi=new Bmi;
            $bmi->username="akito";
            $bmi->weight=$weight;
            $bmi->length=173;
            $bmi->bmi=22.4;
            $bmi->created_at=$ymdt.$date;
            $bmi->save();
        }
    }
}
