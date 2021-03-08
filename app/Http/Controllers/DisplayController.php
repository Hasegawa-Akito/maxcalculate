<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Record;
use App\Models\Deadliftrecord;
use App\Models\Squatrecord;
use App\Models\Bmi;
use App\Models\Display;


class DisplayController extends Controller
{
    private function type_names(){
        $type_names=array(
            "benchi"=>"ベンチプレス",
            "squat"=>"スクワット",
            "lift"=>"デッドリフト",
            "bmi"=>"体重"
        );
        return $type_names;
    }
    public function display(Request $request,$type){
        $sessionname=$request->session()->get('username');
        $username=$sessionname;

        if(!isset($username)){
            return redirect("/");
        }


        $Y=$request->old('Y');
        $m=$request->old('m');
        //dd($Y);

        if(!$Y){
            $Ym=date("Y-m");
            //dd($Ym);
            $Y_m=explode("-",$Ym);
            $Y=$Y_m[0];
            $m=$Y_m[1];
            //dd($m);
        }
        
        

        $type_names=$this->type_names();
        $type_name=$type_names[$type];

        $display= new Display;
        $display_html=$display->display($type,$username,$Y,$m,$type_name);

        $info="member";

        return view('recordlayout',["display_html"=>$display_html,
                    "info"=>$info,
                    "type"=>$type,
                    "type_name"=>$type_name]);
    }
    public function display_change(Request $request){
        
        $sessionname=$request->session()->get('username');
        $username=$sessionname;

        $type=$request->type;
        $url=url('/record/'.$type);

        return redirect($url);


    }

    public function display_date(Request $request,$type){
        $send_date=[
            'Y'=>$request->year,
            'm'=>$request->month
        ];
        return redirect('/record/'.$type)->withInput($send_date);
    }

    public function dele(Request $request,$type){
        $id=$request->delete;
        //dd($id);
        $display= new Display;
        $display->dele($type,$id);
        return redirect('/record/'.$type);
    }
}
