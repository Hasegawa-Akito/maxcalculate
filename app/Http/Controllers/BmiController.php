<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Record;
use App\Models\Deadliftrecord;
use App\Models\Squatrecord;
use App\Models\Bmi;



class BmiController extends Controller
{
    private function style($bmi){
        if($bmi<16){
            return "痩せすぎ";
        }
        elseif($bmi>=16&&$bmi<17){
            return "痩せ";
        }
        elseif($bmi>=17&&$bmi<18.5){
            return "痩せぎみ";
        }
        elseif($bmi>=18.5&&$bmi<25){
            return "普通体重";
        }
        elseif($bmi>=25&&$bmi<30){
            return "前肥満";
        }
        elseif($bmi>=30&&$bmi<35){
            return "肥満(1度)";
        }
        elseif($bmi>=35&&$bmi<40){
            return "肥満(2度)";
        }
        elseif($bmi>=40){
            return "肥満(3度)";
        }
    }

    private function benchlevel($weight,$username){
        $record = Record::where('username', $username)
                        ->orderBy('calculateMAX1','desc')
                        ->first();
        //dd($record->calculateMAX1);
        if(!$record){
            $record_MAX=null;
        }else{
            $record_MAX=$record->calculateMAX1;
        }

        $level="";
        $next="";
        $nextlevel="";
        switch(true){
            case(!$record_MAX):
                break;
            case($record_MAX<$weight*0.95):
                $level="初心者";
                $next=$weight*0.95-$record_MAX;
                $nextlevel="初級者";
                break;
            case($weight*0.95<=$record_MAX&&$record_MAX<$weight*1.15):
                $level="初級者";
                $next=$weight*1.15-$record_MAX;
                $nextlevel="中級者";
                break;
            case($weight*1.15<=$record_MAX&&$record_MAX<$weight*1.5):
                $level="中級者";
                $next=$weight*1.5-$record_MAX;
                $nextlevel="上級者";
                break;
            case($weight*1.5<=$record_MAX&&$record_MAX<$weight*1.95):
                $level="上級者";
                $next=$weight*1.95-$record_MAX;
                $nextlevel="アスリート";
                break; 
            case($weight*1.95<=$record_MAX):
                $level="アスリート";
                $next=0;
                $nextlevel="アスリート";
                break;  
            default:
                $level="";
                $next="";
                $nextlevel="";

        }
        //dd($level);

        $benchlevel = array("MAX1"=>$record_MAX,
                            "level"=>$level,
                            "next"=>$next,
                            "nextlevel"=>$nextlevel
                        );
        return $benchlevel;
    }

    private function squatlevel($weight,$username){
        $record = Squatrecord::where('username', $username)
                        ->orderBy('calculateMAX1','desc')
                        ->first();
        //dd($record);
        if(!$record){
            $record_MAX=null;
        }else{
            $record_MAX=$record->calculateMAX1;
        }

        $level="";
        $next="";
        $nextlevel="";
        switch(true){
            case(!$record_MAX):
                break;
            case($record_MAX<$weight*1.3):
                $level="初心者";
                $next=$weight*1.3-$record_MAX;
                $nextlevel="初級者";
                break;
            case($weight*1.3<=$record_MAX&&$record_MAX<$weight*1.5):
                $level="初級者";
                $next=$weight*1.5-$record_MAX;
                $nextlevel="中級者";
                break;
            case($weight*1.5<=$record_MAX&&$record_MAX<$weight*2):
                $level="中級者";
                $next=$weight*2-$record_MAX;
                $nextlevel="上級者";
                break;
            case($weight*2<=$record_MAX&&$record_MAX<$weight*2.75):
                $level="上級者";
                $next=$weight*2.75-$record_MAX;
                $nextlevel="アスリート";
                break; 
            case($weight*2.75<=$record_MAX):
                $level="アスリート";
                $next=0;
                $nextlevel="アスリート";
                break;  
            default:
                $level="";
                $next="";
                $nextlevel="";

        }
        //dd($level);

        $squatlevel = array("MAX1"=>$record_MAX,
                            "level"=>$level,
                            "next"=>$next,
                            "nextlevel"=>$nextlevel
                            );
        return $squatlevel;
    }

    private function liftlevel($weight,$username){
        $record = Deadliftrecord::where('username', $username)
                        ->orderBy('calculateMAX1','desc')
                        ->first();
        //dd($record->calculateMAX1);
        if(!$record){
            $record_MAX=null;
        }else{
            $record_MAX=$record->calculateMAX1;
        }

        $level="";
        $next="";
        $nextlevel="";
        switch(true){
            case(!$record_MAX):
                break;
            case($record_MAX<=$weight*1.5):
                $level="初心者";
                $next=$weight*1.5-$record_MAX;
                $nextlevel="初級者";
                break;
            case($weight*1.5<=$record_MAX&&$record_MAX<$weight*1.85):
                $level="初級者";
                $next=$weight*1.85-$record_MAX;
                $nextlevel="中級者";
                break;
            case($weight*1.85<=$record_MAX&&$record_MAX<$weight*2.5):
                $level="中級者";
                $next=$weight*2.5-$record_MAX;
                $nextlevel="上級者";
                break;
            case($weight*2.5<=$record_MAX&&$record_MAX<$weight*3.3):
                $level="上級者";
                $next=$weight*3.3-$record_MAX;
                $nextlevel="アスリート";
                break; 
            case($weight*3.3<=$record_MAX):
                $level="アスリート";
                $next=0;
                $nextlevel="アスリート";
                break;  
            default:
                $level="";
                $next="";
                $nextlevel="";

        }
        //dd($level);

        $liftlevel = array("MAX1"=>$record_MAX,
                            "level"=>$level,
                            "next"=>$next,
                            "nextlevel"=>$nextlevel
                        );
        return $liftlevel;
    }
    public function target(Request $request,$info){
        $target_weight=$request->targetweight;
        $username=$request->session()->get('username');
        $user=new User;
        $user->targetrc($target_weight,$username);

        return redirect("/bmi/member");
    }

    public function bmi_index(Request $request,$info){
        
            $sessionname=$request->session()->get('username');
            //dd($sessionname);
            

            $user= new User;
            $userinfo= $user->infomation_serch($sessionname);
            //dd($user->username);

            
            $user = User::where('username', $sessionname)->first();
            //sessionに保存してあればログインなしでそのまま入れる。
            if(isset($sessionname)){

                //セッションには保存してあるがusernameが登録から消えているとき
                if(!$user){
                    return redirect("/");
                }
                
                $username=$sessionname;
                $request->session()->put('username',$username);
            }else{
                //sessionに保存されていない場合はログイン画面へ
                return redirect("/");
            }
        
        $Bmi=new Bmi;
        $comparison=$Bmi->comparison($username);
        

        $bmi="";
        $style="";
        $benchlevel = array("MAX1"=>" ","level"=>" ","next"=>" ","nextlevel"=>" ");
        $squatlevel = array("MAX1"=>" ","level"=>" ","next"=>" ","nextlevel"=>" ");
        $liftlevel = array("MAX1"=>" ","level"=>" ","next"=>" ","nextlevel"=>" ");

        return view('bmi',['bmi'=>$bmi,
                           'style'=>$style,
                           'benchlevel'=>$benchlevel,
                           'squatlevel'=>$squatlevel,
                           'liftlevel'=>$liftlevel,
                           'info'=>$info,
                           'userinfo'=>$userinfo,
                           'comparison'=>$comparison
        ]);
    }

    public function bmi(Request $request,$info){
        $sessionname=$request->session()->get('username');
        $username=$sessionname;

        $user= new User;
        $userinfo= $user->infomation_serch($username);
        //dd($user);

        $weight=$request->weight;
        $length=$request->length;
        $recordon=$request->record_on;
        //dd($length);
        $bmi=round($weight/(($length/100)*($length/100)),2,PHP_ROUND_HALF_DOWN);
        $style=$this->style($bmi);
        //dd($bmi);
        //dd($style);

        $benchlevel=$this->benchlevel($weight,$username);
        $squatlevel=$this->squatlevel($weight,$username);
        $liftlevel=$this->liftlevel($weight,$username);

        if(isset($recordon)){
            $recordinfo = array("username"=>$username,
                                    "weight"=>$weight,
                                    "length"=>$length,
                                    "bmi"=>$bmi
                                );
            $record= new Bmi;
            $record->record($recordinfo);
        }

        $Bmi=new Bmi;
        $comparison=$Bmi->comparison($username);

        return view('bmi',['bmi'=>$bmi,
                           'style'=>$style,
                           'benchlevel'=>$benchlevel,
                           'squatlevel'=>$squatlevel,
                           'liftlevel'=>$liftlevel,
                           'info'=>$info,
                           'userinfo'=>$userinfo,
                           'comparison'=>$comparison
        ]);
    }
}
