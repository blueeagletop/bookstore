@extends('admin.master')

@section('content')
<div class="pd-30">
	<p class="f-20 text-success">欢迎来到蓝鹰书城项目 <span class="f-14">后台管理</span></p>
	<p>以下是本项目的一些重要信息</p>
	<table class="table table-border table-bordered table-bg mt-20">
		<thead>
			<tr>
				<th colspan="2" scope="col">项目信息</th>
			</tr>
		</thead>
		<tbody>
			<tr>
				<td>开发语言</td>
				<td>PHP+MySQL</td>
			</tr>
			<tr>
				<td>所用到的框架</td>
				<td>laravel框架、前端weui框架、后端H-ui.Admin框架</td>
			</tr>
			<tr>
				<td>开发环境</td>
				<td>WAMP</td>
			</tr>
			<tr>
				<td>适用环境</td>
				<td>PHP5.2版本以上</td>
			</tr>
			<tr>
				<td>上线前请查看</td>
				<td>上线前需修改的地方.html</td>
			</tr>
			<tr>
				<td>开通支付功能请查看</td>
				<td>微信支付接口备注.html  和  支付宝支付接口备注.html</td>
			</tr>
			<tr>
				<td>开发软件环境</td>
				<td>NetBeans IDE8.2</td>
			</tr>
			<tr>
				<td>本项目已在GitHub开源</td>
				<td>https://github.com/blueeaglefly/book_shop</td>
			</tr>
			<tr>
				<td>开发员</td>
				<td>BlueEagleFly</td>
			</tr>
			<tr>
				<td>开发员网站</td>
				<td>www.blueeaglefly.com</td>
			</tr>
			<tr>
				<td>开发员联系方式</td>
				<td>blueeaglefly@126.com</td>
			</tr>
		</tbody>
	</table>
        <footer class="footer mt-20">
	<div class="container">
		<p>感谢jQuery、layer、laypage、Validform、UEditor、My97DatePicker、iconfont、Datatables、WebUploaded、icheck、highcharts、bootstrap-Switch<br>
			Copyright &copy;2015-2017 H-ui.admin v3.0 All Rights Reserved.<br>
			本后台系统由<a href="http://www.h-ui.net/" target="_blank" title="H-ui前端框架">H-ui前端框架</a>提供前端技术支持</p>
	</div>
</footer>
</div>

@endsection

@section('my-js')

@endsection