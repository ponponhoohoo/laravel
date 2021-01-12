@extends('body')
@section('title','タイトル')
@include('head')
@include('header')
@section('content')
<div class="row">
    <h1>お問い合わせ</h1>
</div>
<div class="row">
    {{Form::open(['route' => 'form.send'])}}
    	@csrf
    <div class="form-group">
        <label for="InputSubject">名前</label>
        {{ $input["name"] }}
    </div>
    <div class="form-group">
        <label for="InputEmail">メールアドレス</label>
        {{ $input["email"] }}
    </div>
    <div class="form-group">
        <label for="InputSubject">件名</label>
        {{ $input["subject"] }}
    </div>
    <div class="form-group">
        <label for="InputMessage">メッセージ</label>
        {{ $input["message"] }}
    </div>
    @csrf
    <button type="submit" name="action" class="btn btn-primary" value="back">戻る</button>
    <button type="submit" name="action" class="btn btn-primary" value="send">送信する</button>
     {!! Form::close() !!}
</div>
@endsection

@include('footer')