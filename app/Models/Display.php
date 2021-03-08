<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;
use App\Models\Record;
use App\Models\Deadliftrecord;
use App\Models\Squatrecord;
use App\Models\Bmi;

class Display extends Model
{
    use HasFactory;
    private $display_html;
    private function types(){
        $record = new Record;
        $liftrecord = new Deadliftrecord;
        $squatrecord = new Squatrecord;
        $bmi = new Bmi;
        $types=array("benchi"=>$record,
                     "lift"=>$liftrecord,
                      "squat"=>$squatrecord,
                      "bmi"=>$bmi);
        return $types;
    }

    public function date($time){
        $date=explode(" ",$time);
        $date=explode("-",$date[0]);
        return ltrim($date[2],"0");
    }

    public function dele($type,$id){
        //dd($type);
        $types=$this->types();
        $type_model=$types[$type];
        $type_model->destroy($id);
        
    }
    
    public function display($type,$username,$Y,$m,$type_name){
        
        $types=$this->types();
        $monthlyrecords=$types[$type]->monthlyrecords($username,$Y,$m);

        

        //$url="{{url('/record/".$type."/delete')}}";
        $url=$type."/delete";

        //dd($url);
        
        //bmiの記録表示の時
        if($type=="bmi"){
            $this->display_html.= <<< EOS
            <input type="hidden" id="hidden_year" value=$Y>
            <input type="hidden" id="hidden_month" value=$m>
            <input type="hidden" id="hidden_type_name" value=$type_name>
            <input type="hidden" id="hidden_type" value=$type>
            <table class="table table-striped table-dark">
                <thead>
                    <tr>
                    <th scope="col" class="str">$Y-$m</th>
                    <th scope="col" class="str">体重[kg]</th>
                    <th scope="col" class="str">日付</th>
                    <th scope="col" class="str">消去</th>
                    </tr>
                </thead>
                <tbody>
            EOS;

            $i=0;
            foreach($monthlyrecords as $monthlyrecord){
                $i++;
                $date=$this->date($monthlyrecord->created_at);

                $this->display_html.=<<< EOS
                <tr>
                    <th scope="row" class="str">$i</th>
                    <td class="str" id="$date">$monthlyrecord->weight</td>
                    <td class="str">$date</td>
                    <td class="str">
                        <form method="post" action=$url>
                EOS;
                $this->display_html.=csrf_field();
                $this->display_html.=<<< EOS
                            <div class="col-auto my-1 delete">
                                <button type="submit" name="delete" class="btn btn-secondary delete_btn"  value=$monthlyrecord->id>消去</button>
                            </div>
                        </form>
                    </td>
                </tr>
                EOS;
            }
        }else{
            $this->display_html.= <<< EOS
            <input type="hidden" id="hidden_year" value=$Y>
            <input type="hidden" id="hidden_month" value=$m>
            <input type="hidden" id="hidden_type_name" value=$type_name>
            <input type="hidden" id="hidden_type" value=$type>
            <table class="table table-striped table-dark">
                <thead>
                    <tr>
                    <th scope="col" class="str">$Y-$m</th>
                    <th scope="col" class="str">理論値MAX[kg]</th>
                    <th scope="col" class="str">日付</th>
                    <th scope="col" class="str">消去</th>
                    </tr>
                </thead>
                <tbody>
            EOS;

            $i=0;
            foreach($monthlyrecords as $monthlyrecord){
                $i++;
                $date=$this->date($monthlyrecord->created_at);

                $this->display_html.=<<< EOS
                <tr>
                    <th scope="row" class="str">$i</th>
                    <td class="str" id="$date">$monthlyrecord->calculateMAX1</td>
                    <td class="str">$date</td>
                    <td class="str">
                        <form method="post" action=$url>
                EOS;
                $this->display_html.=csrf_field();
                $this->display_html.=<<< EOS
                            <div class="col-auto my-1 delete">
                                <button type="submit" name="delete" class="btn btn-secondary delete_btn" id="delete" value=$monthlyrecord->id>消去</button>
                            </div>
                        </form>
                    </td>
                </tr>
                EOS;
            }
        }
        $this->display_html.= <<< EOS
                </tbody>
        </table>
        EOS;
        //dd($this->display_html);
        return $this->display_html;

    }
}
