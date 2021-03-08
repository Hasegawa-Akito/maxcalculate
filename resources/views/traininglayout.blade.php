@extends('layout')
@section('title', '筋トレMAX理論値')


@section('content')
<div class="heading-max">
  <h3>自分の限界の記録を入力して、<br>MAXの理論値を計算[@yield('event')]</h3>
</div>
@yield('formtag')
@csrf
  <div class="form-row align-items-center form">
    <div class="col-sm-3 my-1 weight">
      <div class="input-group">
        <div class="input-group-prepend">
          <div class="input-group-text">kg</div>
        </div>
        <input type="text" name="weight"  class="form-control" id="weight" placeholder="重量" onchange="numjudge()">
      </div>
    </div>
    <div class="col-sm-3 my-1 rep">
      <div class="input-group">
        <div class="input-group-prepend">
          <div class="input-group-text">回数</div>
        </div>
        <select class="form-control" id="inlineFormCustomSelectPref" name="rep">
            <option value="1">1</option>
            <option value="2">2</option>
            <option value="3">3</option>
            <option value="4">4</option>
            <option value="5">5</option>
            <option value="6">6</option>
            <option value="7">7</option>
            <option value="8">8</option>
            <option value="9">9</option>
            <option value="10">10</option>
        </select>
      </div>
    </div>
  </div>
  @yield('check')
    
    <div class="col-auto my-1 submit">
      <button type="submit" name="submit" class="btn btn-primary" id="button">Submit</button>
    </div>
</form>
<table class="table table-striped table-dark">
  <thead>
    <tr>
      <th scope="col">内容</th>
      <th scope="col">重量[kg]</th>
      <th scope="col">回数</th>
      
    </tr>
  </thead>
  <tbody>
    <tr>
      <th scope="row">現在の記録</th>
      <td>{{$limitweight}}</td>
      <td>{{$limitrep}}</td>
      
    </tr>
    <tr>
      <th scope="row">MAX理論値(1rep)</th>
      <td>{{$MAXcalcurate["1rep"]}}</td>
      <td>1</td>
      
    </tr>
    <tr>
      <th scope="row">MAX理論値(3rep)</th>
      <td>{{$MAXcalcurate["3rep"]}}</td>
      <td>3</td>
      
    </tr>
    
  </tbody>
</table>
  @yield('special')

@endsection

