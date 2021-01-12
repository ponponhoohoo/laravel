@extends('body')
@section('title','タイトル')
@include('head')
@include('header')
@section('content')

    <table>
  	@foreach($items as $item)
        <tr>
			<th>{{ $item->name }}</th>
 			<td><a href="edit/{{$item->id}}/">編集する</a> <a href="del/{{$item->id}}/">削除する</a>{{ $item->subject }} {{ $item->email }}</a></td>
	    </tr>
    @endforeach
  </table>

  //pager
  {{ $items->links() }}
@endsection

