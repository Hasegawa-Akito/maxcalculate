@extends('layout')
@section('title', '筋トレMAX理論値')

@section('css')
<link rel="stylesheet" href="../css/bmi.css">
@endsection


@section('content')
<div class="heading-max">
  <h3>身長、体重を入力して様々な理論値を計算</h3>
</div>
<form method="post" action="{{url('/bmi/'.$info)}}" autocomplete='off'>
@csrf
  <div class="form-row align-items-center form">
    <div class="col-sm-3 my-1 weight">
      <div class="input-group">
        <div class="input-group-prepend">
          <div class="input-group-text">kg</div>
        </div>
        <input type="text" name="weight"  class="form-control" id="weight" placeholder="体重" >
      </div>
    </div>
    <div class="col-sm-3 my-1 length">
      <div class="input-group">
        <div class="input-group-prepend">
          <div class="input-group-text">cm</div>
        </div>
        <input type="text" name="length"  class="form-control" id="length" placeholder="身長" >
      </div>
    </div>
  </div>
    
    <div class="form-group form-check">
      <input type="checkbox" class="form-check-input" id="exampleCheck1" name='record_on' value='on'>
      <label class="form-check-label " for="exampleCheck1">身長体重を記録</label>
    </div>
    
    <div class="col-auto my-1 submit">
      <button type="submit" name="submit" class="btn btn-primary" id="button">Submit</button>
    </div>
  </div>
</form>

<table class="table table-striped table-dark">
  <thead>
    <tr>
      <th scope="col">内容</th>
      <th scope="col">BMI値</th>
      <th scope="col">体型</th>
    </tr>
  </thead>
  <tbody>
    <tr>
      <th scope="row">BMI</th>
      <td>{{$bmi}}</td>
      <td>{{$style}}</td>
    </tr>
　</tbody>
　<thead>
    <tr>
      <th scope="col"></th>
      <th scope="col">MAX値</th>
      <th scope="col">階級</th>
    </tr>
  </thead>
  <tbody>
    <tr>
      <th scope="row">ベンチプレス階級</th>
      <td>{{$benchlevel['MAX1']}}</td>
      <td>{{$benchlevel['level']}}</td>
    </tr>
    <tr>
      <th scope="row">スクワット階級</th>
      <td>{{$squatlevel['MAX1']}}</td>
      <td>{{$squatlevel['level']}}</td>
    </tr>
    <tr>
      <th scope="row">デッドリフト階級</th>
      <td>{{$liftlevel['MAX1']}}</td>
      <td>{{$liftlevel['level']}}</td>
    </tr>
    
  </tbody>
</table>
<div class="member">
    <div class="member-header">
        <div class="menumark">
            <button class="menu-trigger opa" onfocus="this.blur()">menu</button>
        </div>
        <div class="recordmark">
            <button class="record-trigger opa" onfocus="this.blur()">record</button>
        </div>
        <div class="profile">
            <a class="profilename">{{$userinfo->username}}</a>
        </div>
    </div>
    <div class="comment">
        <div class="menu">
                <div><a href="{{url('/MAXcalculate/'.$info)}}">ベンチプレス</a></div>
                <div><a href="{{url('/MAXcalculate/'.$info.'/squat')}}">スクワット</a></div>
                <div><a href="{{url('/MAXcalculate/'.$info.'/deadlift')}}">デッドリフト</a></div>
                <div><a href="{{url('/bmi/'.$info)}}">BMI</a></div>
                <div><a href="{{url('/member/logout')}}">ログアウト</a></div>
        </div>
        <div class="record-menu">
                <div><a href="{{url('/record/benchi')}}">ベンチプレス</a></div>
                <div><a href="{{url('/record/squat')}}">スクワット</a></div>
                <div><a href="{{url('/record/lift')}}">デッドリフト</a></div>
                <div><a href="{{url('/record/bmi')}}">BMI</a></div>
        </div>
        <div class="comment_header">
            筋トレアドバイス
        </div>
            <textarea class="text" name="text" rows="12" readonly>次の筋トレレベル
・ベンチプレス
→{{$benchlevel['next']}}kg upで{{$benchlevel['nextlevel']}}レベルです。

・スクワット
→{{$squatlevel['next']}}kg upで{{$squatlevel['nextlevel']}}レベルです。

・デッドリフト
→{{$liftlevel['next']}}kg upで{{$liftlevel['nextlevel']}}レベルです。
※記録されているマックス理論値をもとに計算
            </textarea>
      <div class="target">
        <div class="target-form">
        <form method="post"  action="{{url('/bmi/'.$info.'/target')}}" autocomplete='off'>
          @csrf
              <div class="targetweight">
                <div class="input-group">
                  <div class="input-group-prepend">
                    <div class="input-group-text">kg</div>
                  </div>
                  <input type="text" name="targetweight"  class="form-control" id="targetweight" placeholder="目標体重" >
                </div>
                
                </div>
                <div class="set-form">
                  <button type="submit"  name="set" class="btn btn-primary set" id="set">目標設定</button>
                  <div class="null"></div>
                </div>
              </div>
              
        </form>
          <div class="targetnum">
            <h2>目標:{{$userinfo->target_weight}}kg</h2>
            <h2>目標まであと{{$comparison["trcompare"]}}kg</h2>
            <h2>現在の体重は{{$comparison["current"]}}kg</h2>
            <h2>前回の体重より</h2>
            <h2>{{$comparison["curcompare"]}}</h2>
          </div>
        </div>
        
        
      </div>      
    </div>
</div>


@endsection

@section('js')
<script src="../js/bmi.js"></script>
@endsection
