@extends('layout')
@section('title', '記録')
@section('css')
<link rel="stylesheet" href="../css/record.css">
@endsection

@section('content')

<header>
    <div class="header-name">
        <h6>{{$type_name}}記録</h6>
    </div>
    <div class="profile">
        <a class="profilename">akito</a>
    </div>
    <div class="menumark">
        <button class="menu-trigger opa" onfocus="this.blur()">menu</button>
    </div>
</header>
<div class="main">
    <div class="menu">
        <div><a href="{{url('/MAXcalculate/'.$info)}}">ベンチプレス</a></div>
        <div><a href="{{url('/MAXcalculate/'.$info.'/squat')}}">スクワット</a></div>
        <div><a href="{{url('/MAXcalculate/'.$info.'/deadlift')}}">デッドリフト</a></div>
        <div><a href="{{url('/bmi/'.$info)}}">BMI</a></div>
        <div><a href="{{url('/member/logout')}}">ログアウト</a></div>
    </div>
    <form method="post" action="{{url('/record/change')}}">
@csrf

        <div class="form-row align-items-center form">
            <div class="col-sm-3 my-1 select">
                <div class="input-group">
                    <div class="input-group-prepend">
                        <div class="input-group-text">種類</div>
                    </div>
                    <select class="form-control"  name="type" id="type_select">
                        <option value="benchi" >ベンチプレス</option>
                        <option value="squat" >スクワット</option>
                        <option value="lift" >デッドリフト</option>
                        <option value="bmi" >体重</option>
                        
                    </select>
                </div>
            </div>
            <div class="col-auto my-1 submit">
                <button type="submit" name="submit" class="btn btn-primary submit" >表示</button>
            </div>
        </div>
    </form>
    <form method="post" action="{{url('/record/'.$type.'/date')}}">
@csrf

        <div class="form-row align-items-center form">
            <div class="col-sm-3 my-1 select year">
                <div class="input-group">
                    <div class="input-group-prepend">
                        <div class="input-group-text">年</div>
                    </div>
                    <select class="form-control"  name="year" id="year_select">
                        <option value="2021" >2021</option>
                        <option value="2022" >2022</option>
                        <option value="2023" >2023</option>
                        <option value="2024" >2024</option>
                        <option value="2025" >2025</option>
                        <option value="2026" >2026</option>
                    </select>
                </div>
            </div>
            <div class="col-sm-3 my-1 select month">
                <div class="input-group">
                    <div class="input-group-prepend">
                        <div class="input-group-text">月</div>
                    </div>
                    <select class="form-control"  name="month" id="month_select">
                        <option value="01" >1</option>
                        <option value="02" >2</option>
                        <option value="03" >3</option>
                        <option value="04" >4</option>
                        <option value="05" >5</option>
                        <option value="06" >6</option>
                        <option value="07" >7</option>
                        <option value="08" >8</option>
                        <option value="09" >9</option>
                        <option value="10" >10</option>
                        <option value="11" >11</option>
                        <option value="12" >12</option>
                    </select>
                </div>
            </div>
            <div class="col-auto my-1 submit">
                <button type="submit" name="submit" class="btn btn-primary submit" >表示</button>
            </div>
        </div>
    </form>
    <div class="swichi">
        <a class="swichi-name">グラフ表示</a>
        <input type="radio" name="switch" id="radio-on">
        <label for="radio1">ON</label>
        <input type="radio" name="switch" id="radio-off" checked>
        <label for="radio2">OFF</label>
    </div>
    <div class="record-menu">
        {!!$display_html!!}
    </div>
    <div class="chart">
        <canvas id="myChart" class="myChart" ></canvas>
        <script src="https://cdn.jsdelivr.net/npm/chart.js@2.9.4/dist/Chart.min.js"></script>
    </div>
</div>


@endsection

@section('js')
<script src="../js/record.js"></script>
@endsection