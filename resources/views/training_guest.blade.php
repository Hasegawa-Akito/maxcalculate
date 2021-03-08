@extends('traininglayout')

@section('css')
<link rel="stylesheet" href="../css/training.css">
@endsection

@section('event', 'ベンチプレス')

@section('formtag')
<form method="post" action="{{url('/MAXcalculate/'.$info)}}" autocomplete='off'>
@endsection

@section('js')
<script src="../js/training.js"></script>
@endsection