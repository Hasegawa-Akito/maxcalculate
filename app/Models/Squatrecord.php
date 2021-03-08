<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Squatrecord extends Model
{
    use HasFactory;
    protected $table='squatrecords';
    protected $fillable = [
        'username','limitweight','limitrep','calculateMAX1','calculateMAX2'
    ];

    public function allrecords($username){
        $allrecords=Squatrecord::where('username',$username)
                        ->orderByDesc('created_at')
                        ->get();
        //dd($display[0]->calculateMAX1)
        return $allrecords;

    }


    public function monthlyrecords($username,$Y,$m){
        $Ym=$Y."-".$m;

        $monthlyrecords=Squatrecord::where('username',$username)
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
        Squatrecord::where('created_at','like',"%$now%")
                    ->delete();

        $record= new Squatrecord;

        foreach($recordinfo as $key=>$recordvalue){
            $record->$key=$recordvalue;
        }

        return $record->save();
    }   

    public function display($username){
        $display_records=Squatrecord::where('username',$username)
                               ->orderByDesc('calculateMAX1')
                               ->limit(3)
                               ->get();
        return $display_records;
    }
}
