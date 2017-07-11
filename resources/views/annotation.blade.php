@extends('master')

@include('component.loading')

@section('title', '本功能已被注释')

@section('content')
<div class="weui_cells_title"></div>
<div class="weui_cells weui_cells_form">
    <div class="weui_cell">
        <h3>可能原因如下：</h3>
    </div>
    <div class="weui_cell">
        <p>1.该功能为企业级应用</p>
    </div>
    <div class="weui_cell">
        <p>2.该功能只适用于生产环境，项目展示不予与实现</p>
    </div>
    <div class="weui_cell">
        <p>3.服务器不支持</p>
    </div>
</div>
<div class="weui_cells_tips"></div>
<div class="weui_btn_area">
    <a class="weui_btn weui_btn_primary" href="../">首页</a>
</div>
<a href="../register" class="bk_bottom_tips bk_important">没有帐号? 去注册</a>
@endsection

@section('my-js')


@endsection
