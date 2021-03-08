<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Bmi extends Model
{
    use HasFactory;
    protected $table='bmis';
    protected $fillable = [
        'username','weight','length','bmi'
    ];

    public function allrecords($username){
        $allrecords=Bmi::where('username',$username)
                        ->orderByDesc('created_at')
                        ->get();
        //dd($display[0]->calculateMAX1)
        return $allrecords;

    }

    public function monthlyrecords($username,$Y,$m){
        $Ym=$Y."-".$m;

        $monthlyrecords=Bmi::where('username',$username)
                        ->where('created_at','like',"%$Ym%")
                        ->orderByDesc('created_at')
                        ->get();
        //dd($display[0]->calculateMAX1)
        return $monthlyrecords;

    }

    public function record($recordinfo){
        $now=date("Y-m-d");
        //dd($now);
        //一日に一つしか記録できなくする
        Bmi::where('created_at','like',"%$now%")
                    ->delete();

        $record= new Bmi;
        foreach($recordinfo as $key=>$recordvalue){
            $record->$key=$recordvalue;
        }
        return $record->save();
    }

    public function comparison($username){
        $user=User::where('username',$username)->first();
        //dd($user->target_weight);
        $Bmi=Bmi::where('username',$username)
                               ->orderByDesc('created_at')
                               ->limit(2)
                               ->get();

        if(count($Bmi)==0){
            $current=" ";
            $trcompare=0;
            $curcompare="※前回の体重なし";
        }else if(count($Bmi)==1){
            $current=$Bmi[0]->weight;
            $curcompare="※前回の体重なし";
            if(!isset($user->target_weight)){
                $trcompare=0;
            }else if(($Bmi[0]->weight-$user->target_weight)<0){
                $trcompare=0;
            }else{
                $trcompare=$Bmi[0]->weight-$user->target_weight;
            }
        }else{
            $current=$Bmi[0]->weight;
            if(!isset($user->target_weight)){
                $trcompare=0;
            }else if(($Bmi[0]->weight-$user->target_weight)<0){
                $trcompare=0;
            }else{
                $trcompare=$Bmi[0]->weight-$user->target_weight;
            }

            if(($Bmi[0]->weight-$Bmi[1]->weight)<=0){
                $curcompare=-($Bmi[0]->weight-$Bmi[1]->weight)."kg減っています";
            }else{
                $curcompare=($Bmi[0]->weight-$Bmi[1]->weight)."kg増えています";
            }

        }
        //dd($curcompare);
        //dd($trcompare);
        
         $comparison = array(
                            "current"=>$current,
                            "trcompare"=>$trcompare,
                            "curcompare"=>$curcompare
                            );
        return $comparison;
    }

}
