<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Deadliftrecord extends Model
{
    use HasFactory;
    protected $table='deadliftrecords';
    protected $fillable = [
        'username','limitweight','limitrep','calculateMAX1','calculateMAX2'
    ];

    public function allrecords($username){
        $allrecords=Deadliftrecord::where('username',$username)
                        ->orderByDesc('created_at')
                        ->get();
        //dd($display[0]->calculateMAX1)
        return $allrecords;

    }

    public function monthlyrecords($username,$Y,$m){
        $Ym=$Y."-".$m;

        $monthlyrecords=Deadliftrecord::where('username',$username)
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
        Deadliftrecord::where('created_at','like',"%$now%")
                    ->delete();

        $record= new Deadliftrecord;

        foreach($recordinfo as $key=>$recordvalue){
            $record->$key=$recordvalue;
        }

        return $record->save();
    }   

    public function display($username){
        $display_records=Deadliftrecord::where('username',$username)
                               ->orderByDesc('calculateMAX1')
                               ->limit(3)
                               ->get();
        return $display_records;
    }
}
