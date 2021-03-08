<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Record extends Model
{
    use HasFactory;
    protected $table='records';
    protected $fillable = [
        'username','limitweight','limitrep','calculateMAX1','calculateMAX2'
    ];

    
    public function allrecords($username){
        $allrecords=Record::where('username',$username)
                        ->orderByDesc('created_at')
                        ->get();

        //dd($display[0]->calculateMAX1)
        return $allrecords;

    }

    public function monthlyrecords($username,$Y,$m){
        $Ym=$Y."-".$m;

        $monthlyrecords=Record::where('username',$username)
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
        Record::where('created_at','like',"%$now%")
                    ->delete();

        $record= new Record;
        foreach($recordinfo as $key=>$recordvalue){
            $record->$key=$recordvalue;
        }

        return $record->save();
    }   

    public function display($username){
        $R="Record";
        $display_records=Record::where('username',$username)
                               ->orderByDesc('calculateMAX1')
                               ->limit(3)
                               ->get();
        return $display_records;
    }

}
