@extends('traininglayout')

@section('css')
<link rel="stylesheet" href="../../css/training.css">
@endsection

@section('event', 'デッドリフト')

@section('formtag')
<form method="post" action="{{url('/MAXcalculate/'.$info.'/deadlift')}}" autocomplete='off'>
@endsection

@section('check')
<div class="form-group form-check">
      <input type="checkbox" class="form-check-input" id="exampleCheck1" name='record_on' value='on'>
      <label class="form-check-label " for="exampleCheck1">理論値を記録</label>
</div>
@endsection

@section('special')
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
    <div class='record'>
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
        <table class="table">
        <thead>
            <tr>
            <th colspan="4" class="center">過去の記録</th>
            </tr>
        </thead>
        <thead>
            <tr>
                <th scope="col"> </th>
                <th scope="col">日付</th>
                <th scope="col">重さ[kg]</th>
                <th scope="col">回数[回]</th>
            </tr>
        </thead>
        <tbody>
            <tr>
            <th scope="row">1</th>
            <td>{{$calculateMAX1s[0]->date}}</td>
            <td>{{$calculateMAX1s[0]->calculateMAX1}}</td>
            <td>{{$calculateMAX1s[0]->limitrep}}</td>
            </tr>
            <tr>
            <th scope="row">2</th>
            <td>{{$calculateMAX1s[1]->date}}</td>
            <td>{{$calculateMAX1s[1]->calculateMAX1}}</td>
            <td>{{$calculateMAX1s[1]->limitrep}}</td>
            </tr>
            <tr>
            <th scope="row">3</th>
            <td>{{$calculateMAX1s[2]->date}}</td>
            <td>{{$calculateMAX1s[2]->calculateMAX1}}</td>
            <td>{{$calculateMAX1s[2]->limitrep}}</td>
            </tr>
        </tbody>
        </table>
        <div class='recordadd'>
        
        
        </div>
        
    </div>
    <div class="tr_menu">
        <div class="tr_menu_header">
            オススメメニュー
        </div>
            <textarea class="text" name="text" rows="10" readonly>デッドリフトのオススメメニュー
・筋力アップが目的
→{{$trainingmenu["strength"]}}kgを3rep

・筋肥大が目的
→{{$trainingmenu["size"]}}kgを8rep

・筋持久力の向上が目的
→{{$trainingmenu["endurance"]}}kgを20rep
※今回のマックス理論値をもとに計算
            </textarea>
            
    </div>
</div>
@endsection

@section('js')
<script src="../../js/training.js"></script>
@endsection