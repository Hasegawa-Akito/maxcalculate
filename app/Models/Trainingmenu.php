<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Trainingmenu extends Model
{
    use HasFactory;

    public function rm_method($MAXcalcurate){

        $strength = round(($MAXcalcurate["1rep"]*0.93)/2.5)*2.5;
        $size = round(($MAXcalcurate["1rep"]*0.8)/2.5)*2.5;
        $endurance = round(($MAXcalcurate["1rep"]*0.63)/2.5)*2.5;

        $trainingmenu= array("strength"=>$strength,
                                "size"=>$size,
                                "endurance"=>$endurance);

        return $trainingmenu;
    }

}
