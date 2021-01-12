@extends('body')
@section('title','タイトル')
@include('head')
@include('header')
@section('content')
<div class="row">
    <h1>お問い合わせ</h1>
</div>
<div class="row">
    {{Form::open(['route' => 'form.post','files' => true])}}
    	@csrf
    <div class="form-group">
        <label for="InputSubject">名前</label>
        <input type="text" name="name" class="form-control" id="InputSubject" value="{{ old('name') }}">
        @if($errors->has('name'))
            <p class="text-danger">{{ $errors->first('name')}}</p>
        @endif
    </div>
    <div class="form-group">
        <label for="InputEmail">メールアドレス</label>
        <input type="email" name="email" class="form-control" id="InputEmail" value="{{ old('email') }}">
        @if($errors->has('email'))
            <p class="text-danger">{{ $errors->first('email')}}</p>
        @endif
    </div>
    <div class="form-group">
        <label for="InputSubject">件名</label>
        <input type="text" name="subject" class="form-control" id="InputSubject" value="{{ old('subject') }}">
        @if($errors->has('subject'))
            <p class="text-danger">{{ $errors->first('subject')}}</p>
        @endif
    </div>
    <div class="form-group">
        <label for="InputMessage">メッセージ</label>
        <textarea name="message" id="InputMessage" class="form-control" cols="40" rows="4">
        {{ old('message') }}
        </textarea>
        @if($errors->has('message'))
            <p class="text-danger">{{ $errors->first('message')}}</p>
        @endif
    </div>
    <div class="form-group">
        <label for="InputSubject">画像</label>
        <input type="file" name="image_url">
        @if($errors->has('image_url'))
            <p class="text-danger">{{ $errors->first('image_url')}}</p>
        @endif
    </div>
    @csrf
    <button type="submit" name="action" class="btn btn-primary" value="sent">送信する</button>
     {!! Form::close() !!}
</div>
@endsection

@include('footer')