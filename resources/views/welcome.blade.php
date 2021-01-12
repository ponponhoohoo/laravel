<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
  <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <script src="{{ asset('/css/app.css') }}"></script>
  <title>Title</title>
</head>
<body>
<div id="app">
    @{{ data1 }}
    <example-component></example-component>
@{{ message }}
    <input v-model="message">

    <header-top v-bind:items="{{ $items }}"></header-top>

<section v-if ="show">
	<div class="card text-white bg-dark mb-3" v-for="item in {{ $items }}">
	    <div class="row no-gutters">
	        <div class="card-body">
	            <h3 class="card-title">@{{ item.id }} @{{ item.name }} </h3>
	        </div>
	    </div>
	</div>
</section>


<footer-tmp mess="OKEY"></footer-tmp>
<hello-world></hello-world>

<ul>
	<li v-for="(t,index) in cat" v-bind:key="index" > @{{ t.name }}</li>
</ul>
</div>

データベースの値<br>
@foreach($items as $item)
        <p>{{ $item->name }}</p>
@endforeach

<script src="{{ asset('/js/app.js') }}"></script>

</body>
</html>

