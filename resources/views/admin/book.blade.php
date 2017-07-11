@extends('admin.master')

@section('content')
  <div class="pd-20">
  	<div class="cl pd-5 bg-1 bk-gray mt-20">
  		<span class="l">
  			<a href="javascript:;" onclick="book_add('添加产品','book_add')" class="btn btn-primary radius"><i class="Hui-iconfont">&#xe600;</i> 添加产品</a>
  		</span>
  		<span class="r">共有数据：<strong>{{count($books)}}</strong> 条</span>
  	</div>
  	<div class="mt-20">
  	<table class="table table-border table-bordered table-hover table-bg table-sort">
  		<thead>
  			<tr class="text-c">
  				<th width="80">ID</th>
  				<th width="100">名称</th>
  				<th width="40">简介</th>
  				<th width="90">价格</th>
          <th width="90">类别</th>
  				<th width="50">预览图</th>
  				<th width="50">操作</th>
  			</tr>
  		</thead>
  		<tbody>
  			@foreach($books as $book)
  				<tr class="text-c">
  					<td>{{$book->id}}</td>
  					<td>{{$book->title}}</td>
  					<td>{{$book->summary}}</td>
  					<td>{{$book->price}}</td>
  					<td>{{$book->category->name}}</td>
            <td>@if($book->preview != null)
  						<img src="..{{$book->preview}}" alt="" style="width: 50px; height: 50px;">
  					@endif</td>
  					<td class="td-manage">
              <a title="详情" href="javascript:;" onclick="book_info('产品详情','book_info?id={{$book->id}}')" class="ml-5" style="text-decoration:none"><i class="Hui-iconfont">&#xe695;</i>详情</a><br />
  						<a title="编辑" href="javascript:;" onclick="book_edit('编辑产品','book_edit?id={{$book->id}}')" class="ml-5" style="text-decoration:none"><i class="Hui-iconfont">&#xe6df;</i>编辑</a><br/>
  						<a title="删除" href="javascript:;" onclick='book_del("{{$book->title}}", "{{$book->id}}")' class="ml-5" style="text-decoration:none"><i class="Hui-iconfont">&#xe6e2;</i>删除</a>
  					</td>
  				</tr>
  			@endforeach

  		</tbody>
  	</table>
  	</div>
  </div>
@endsection

@section('my-js')
<script type="text/javascript">
  function book_add(title, url) {
    var index = layer.open({
      type: 2,
      title: title,
      content: url
    });
    layer.full(index);
  }

  function book_info(title, url) {
    var index = layer.open({
      type: 2,
      title: title,
      content: url
    });
    layer.full(index);
  }
  
  function book_edit(title, url) {
    var index = layer.open({
      type: 2,
      title: title,
      content: url
    });
    layer.full(index);}

	function book_del(title, id) {
		layer.confirm('确认要删除【' + title +'】吗？',function(index){
			//此处请求后台程序，下方是成功后的前台处理……
			$.ajax({
        type: 'post', // 提交方式 get/post
        url: 'service/book/del', // 需要提交的 url
        dataType: 'json',
        data: {
          id: id,
          _token: "{{csrf_token()}}"
        },
        success: function(data) {
          if(data == null) {
            layer.msg('服务端错误', {icon:2, time:2000});
            return;
          }
          if(data.status != 0) {
            layer.msg(data.message, {icon:2, time:2000});
            return;
          }

          layer.msg(data.message, {icon:1, time:2000});
          location.replace(location.href);
        },
        error: function(xhr, status, error) {
          console.log(xhr);
          console.log(status);
          console.log(error);
          layer.msg('ajax error', {icon:2, time:2000});
        },
        beforeSend: function(xhr){
          layer.load(0, {shade: false});
        }
			});
		});
	}

</script>
@endsection
