@extends('admin.master')

@section('content')

  <style>
    .row.cl {
      margin: 20px 0;
    }
  </style>

<form class="form form-horizontal" action="" method="post">
  <div class="row cl">
    <label class="form-label col-3"><span class="c-red"></span>书籍标题：</label>
    <div class="formControls col-5">
      {{$book->title}}
    </div>
    <div class="col-4"> </div>
  </div>
  <div class="row cl">
    <label class="form-label col-3"><span class="c-red"></span>简介：</label>
    <div class="formControls col-5">
      {{$book->summary}}
    </div>
    <div class="col-4"> </div>
  </div>
  <div class="row cl">
    <label class="form-label col-3"><span class="c-red"></span>价格：</label>
    <div class="formControls col-5">
      {{$book->price}}
    </div>
    <div class="col-4"> </div>
  </div>
  <div class="row cl">
    <label class="form-label col-3"><span class="c-red"></span>类别：</label>
    <div class="formControls col-5">
      {{$book->category->name}}
    </div>
  </div>
  <div class="row cl">
    <label class="form-label col-3">预览图：</label>
    <div class="formControls col-5">
      @if($book->preview != null)
        <img id="preview_id" src="../{{$book->preview}}" style="border: 1px solid #B8B9B9; width: 100px; height: 100px;"/>
      @endif
    </div>
  </div>
  <div class="row cl">
    <label class="form-label col-3">详细内容：</label>
    <div class="formControls col-8">
      {{$book_content->content}}
    </div>
  </div>
  <div class="row cl">
    <label class="form-label col-3">书籍图片：</label>
    <div class="formControls col-8">
      @foreach($book_images as $book_image)
        <img src="../{{$book_image->path}}" style="border: 1px solid #B8B9B9; width: 100px; height: 100px;" />
      @endforeach
    </div>
  </div>
</div>
@endsection
