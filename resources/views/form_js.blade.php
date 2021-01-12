@extends('body')
@section('title','タイトル')
@include('head')
@include('header')
@section('content')
<div id="app">
<div class="row">
    <h1>Form_js</h1>
</div>
<div class="row">
@{{text}}
<form-tmp :csrf="{{json_encode(csrf_token())}}"></form-tmp>
    
</div>
</div>


@endsection
@include('footer')