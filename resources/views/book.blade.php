@extends('master')

@section('title', '书籍列表')

@section('content')
<div class="weui_cells weui_cells_access"  style="top: 0;">
    @foreach($books as $book)
    <a class="weui_cell" href="../{{$book->id}}">
        <div class="weui_cell_hd"><img class="bk_preview" src="http://localhost/laravel52/public{{$book->preview}}"></div>
        <div class="weui_cell_bd weui_cell_primary">
          <div style="margin-bottom: 10px;">
            <span class="bk_title">{{$book->title}}</span>
            <span class="bk_price" style="float: right;">&nbsp;￥{{$book->price}}</span><br />
            <span class="bk_value" style="float: right">原价{{$book->value}}</span>
          </div>

            <p class="bk_summary">{{$book->summary}}</p>
        </div>
        <div class="weui_cell_ft"></div>
    </a>
    @endforeach
</div>
@endsection

@section('my-js')

@endsection
