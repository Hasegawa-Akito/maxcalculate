<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Abraham\TwitterOAuth\TwitterOAuth;
use App\Models\User;
use App\Models\Record;
use App\Models\Trainingmenu;


//記録の数が足りない時に差し込むよう
class nothing {
    public $calculateMAX1=null;
    public $calculateMAX3=null;
    public $limitweight=null;
    public $limitrep=null;
    public $updated_at=" ";
}

class TrainingController extends Controller
{   
    

    
    private function MAXcalcurate1($weight,$rep){
        $MAX1 = ($weight*$rep)/40 + $weight;
        if($rep==1){
            $MAX1=$weight;
        }
        $MAX1=round($MAX1,1,PHP_ROUND_HALF_DOWN);
        return $MAX1;
    }
    private function MAXcalcurate3($MAX1){
        $MAX3 = 40*$MAX1/43;
        $MAX3=round($MAX3,1,PHP_ROUND_HALF_DOWN);
        return $MAX3;
    }

    public function display_MAX1($username){
            $record = new Record;
            $null = new nothing;

            $calculateMAX1s=$record->display($username);

            //記録が三つに満たないときにnullの情報を入れる
            $array_length=count($calculateMAX1s);
            $array_length_copy=count($calculateMAX1s);

            for($array_length;$array_length<3;$array_length++){
                $calculateMAX1s[$array_length]=$null;
            }

            //表示させる回数をlimitrepに入れる。 
            for($i=0;$i<= $array_length_copy-1;$i++){
                $calculateMAX1s[$i]->limitrep=1;
            }

            //日にちの表示の仕方変更
            for($i=0;$i<=2;$i++){
                $date=explode(" ",$calculateMAX1s[$i]->updated_at);
                
                $calculateMAX1s[$i]->date=$date[0];
                
            }

            return $calculateMAX1s;
    }
    
    
                
                


    public function index(Request $request,$info){
        
        $MAXcalcurate = array("1rep"=>"  ","3rep"=>"  ");
        $limitweight  = "  ";
        $limitrep     = "  ";


       
        
        
        if($info=="guest"){
            return view('training_guest', ['MAXcalcurate' => $MAXcalcurate,
                                    'limitweight'  => $limitweight,
                                    'limitrep'     => $limitrep,
                                    'info'         =>$info
                                    ]);
        }else{
            $sessionname=$request->session()->get('username');
            $username=$request->old('username');
            //dd($sessionname);
            //dd($username);

            $user = User::where('username', $sessionname)->first();
            //dd($user);
            

            //sessionに保存してあればMaxcalcurate/memberにログインなしでそのまま入れる。
            if(isset($username)){
                $request->session()->put('username',$username);

            }elseif(isset($sessionname)){

                //セッションには保存してあるがusernameが登録から消えているとき
                if(!$user){
                    return redirect("/");
                }
                
                $username=$sessionname;
                $request->session()->put('username',$username);
            }else{
                //sessionに保存されておらずログインを経ていない場合はログイン画面へ
                return redirect("/");
            }

            //記録表示
            $calculateMAX1s=$this->display_MAX1($username);
            //dd($calculateMAX1s);


            //modelのUserのメソッド関数を使う
            $user= new User;
            $userinfo= $user->infomation_serch($username);
            //dd($userinfo->name);

            $trainingmenu= array("strength"=>"　",
                                "size"=>"　",
                                "endurance"=>"　");
            

            

            return view('training', ['MAXcalcurate' => $MAXcalcurate,
                                    'limitweight'  => $limitweight,
                                    'limitrep'     => $limitrep,
                                    'info'         =>$info,
                                    'userinfo'       =>$userinfo,
                                    'calculateMAX1s'=>$calculateMAX1s,
                                    'trainingmenu'=>$trainingmenu
                                    ]);
        }
        
    }

    public function MAX(Request $request,$info){
        $limitweight = $request->weight;
        $limitrep    = $request->rep;
        $recordon    = $request->record_on;

       

        $MAX1   = $this->MAXcalcurate1($limitweight,$limitrep);
        $MAX3   = $this->MAXcalcurate3($MAX1);
        $MAXcalcurate = array("1rep"=>$MAX1,"3rep"=>$MAX3);
        
        

        if($info=="guest"){
            return view('training_guest', ['MAXcalcurate' => $MAXcalcurate,
                                    'limitweight'  => $limitweight,
                                    'limitrep'     => $limitrep,
                                    'info'         =>$info
                                    ]);
        }
        else{
                //sessionからidを入手
                $sessionname=$request->session()->get('username');
                $username=$sessionname;
                if(!isset($username)){
                    return redirect("/");
                }

                //modelのUserのメソッド関数を使う
                $user= new User;
                $userinfo= $user->infomation_serch($username);
                //dd($userinfo->name);

                //記録
                if(isset($recordon)){
                   
                    $recordinfo = array("username"=>$username,
                                "limitweight"=>$limitweight,
                                "limitrep"=>$limitrep,
                                "calculateMAX1"=>$MAX1,
                                "calculateMAX2"=>$MAX3
                            );
                    $record=new Record;
                    $record-> record($recordinfo);

                }

                //記録表示
                $calculateMAX1s=$this->display_MAX1($username);

                $training_menu= new Trainingmenu;
                $trainingmenu=$training_menu->rm_method($MAXcalcurate);
                //dd($trainingmenu);

                return view('training', ['MAXcalcurate' => $MAXcalcurate,
                                        'limitweight'  => $limitweight,
                                        'limitrep'     => $limitrep,
                                        'info'         =>$info,
                                        'userinfo'     =>$userinfo,
                                        'calculateMAX1s'=>$calculateMAX1s,
                                        'trainingmenu'=>$trainingmenu
                                        ]);
            }
    }
}
