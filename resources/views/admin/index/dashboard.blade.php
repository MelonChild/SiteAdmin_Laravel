@extends('admin.layout.base')

@section('content')
	<blockquote class="layui-elem-quote layui-bg-green">
		<div id="nowTime"></div>
	</blockquote>
	<div class="layui-row layui-col-space10 panel_box">
		<div class="panel layui-col-xs12 layui-col-sm6 layui-col-md4 layui-col-lg2">
			<a href="javascript:;" @can('permission-check','article.index') data-url="/admins/articles" @endcan target="_blank">
				<div class="panel_icon layui-bg-green">
					<i class="layui-anim seraph icon-good"></i>
				</div>
				<div class="panel_word">
					<span>12</span>
					<cite>文章数量</cite>
				</div>
			</a>
		</div>
		<div class="panel layui-col-xs12 layui-col-sm6 layui-col-md4 layui-col-lg2">
			<a href="javascript:;" data-url="{{$configs['domain']}}" target="_blank">
				<div class="panel_icon layui-bg-black">
					<i class="layui-anim seraph icon-github"></i>
				</div>
				<div class="panel_word">
					<span>点击跳转</span>
					<cite>前台网站</cite>
				</div>
			</a>
		</div>
		<div class="panel layui-col-xs12 layui-col-sm6 layui-col-md4 layui-col-lg2">
			<a href="javascript:;" data-url="https://gitee.com/layuicms/layuicms2.0" target="_blank">
				<div class="panel_icon layui-bg-red">
					<i class="layui-anim seraph icon-oschina"></i>
				</div>
				<div class="panel_word">
					<span>图库</span>
					<cite>图库链接</cite>
				</div>
			</a>
		</div>
		<div class="panel layui-col-xs12 layui-col-sm6 layui-col-md4 layui-col-lg2">
			<a href="javascript:;"  @can('permission-check','user.index') data-url="/admins/users" @endcan>
				<div class="panel_icon layui-bg-orange">
					<i class="layui-anim seraph icon-icon10" data-icon="icon-icon10"></i>
				</div>
				<div class="panel_word userAll">
					<span>123</span>
					<em>用户总数</em>
					<cite class="layui-hide">用户中心</cite>
				</div>
			</a>
		</div>
		<div class="panel layui-col-xs12 layui-col-sm6 layui-col-md4 layui-col-lg2">
			<a href="javascript:;">
				<div class="panel_icon layui-bg-cyan">
					<i class="layui-anim layui-icon" data-icon="&#xe857;">&#xe857;</i>
				</div>
				<div class="panel_word outIcons">
					<span>12</span>
					<em>院校数量</em>
					<cite class="layui-hide">院校管理</cite>
				</div>
			</a>
		</div>
		<div class="panel layui-col-xs12 layui-col-sm6 layui-col-md4 layui-col-lg2">
			<a href="javascript:;">
				<div class="panel_icon layui-bg-blue">
					<i class="layui-anim seraph icon-clock"></i>
				</div>
				<div class="panel_word">
					<span class="loginTime">{{date('Y年m月d日  H:I:s',$adminUser['last_login'])}}</span>
					<cite>上次登录时间</cite>
				</div>
			</a>
		</div>
	</div>

	<div class="layui-row layui-col-space10">
		<div class="layui-col-lg6 layui-col-md12">
			<blockquote class="layui-elem-quote title">系统基本参数</blockquote>
			<table class="layui-table magt0">
				<colgroup>
					<col width="150">
					<col>
				</colgroup>
				<tbody>
					<tr>
						<td>当前用户</td>
						<td class="version">{{$adminUser['nickname']}}</td>
					</tr>
					<tr>
						<td>登录次数</td>
						<td class="author">{{$adminUser['logins']}}</td>
					</tr>
					<tr>
						<td>网站名称</td>
						<td class="homePage">{{$configs['webname']}}</td>
					</tr>
					<tr>
						<td>网站首页</td>
						<td class="server">{{$configs['domain']}}</td>
					</tr>
					<tr>
						<td>最大上传限制</td>
						<td class="maxUpload">500kb</td>
					</tr>
					<tr>
						<td>当前用户权限</td>
						<td class="userRights">{{$adminUser->role['name']}}</td>
					</tr>
				</tbody>
			</table>
			<blockquote class="layui-elem-quote title ">快捷菜单</blockquote>
			<fieldset class="panel layui-elem-field site-demo-button" style="text-align:left;padding-top:10px;">
				@can('permission-check','article.index')<a href="javascript:;" data-url="/admins/articles" class="layui-btn layui-btn-lg layui-btn-normal">文章管理<cite class="layui-hide">文章管理</cite></a>@endcan
				@can('permission-check','user.index')<a href="javascript:;" data-url="page/user/userList.html" class="layui-btn layui-btn-lg layui-btn-normal">用户管理<cite class="layui-hide">用户管理</cite></a>@endcan
			</fieldset>
			<blockquote class="layui-elem-quote title">最新文章 <i class="layui-icon layui-red">&#xe756;</i></blockquote>
			<table class="layui-table mag0" lay-skin="line">
				<colgroup>
					<col>
					<col width="110">
				</colgroup>
				<tbody class="hot_news">
					@forelse($articles as $article)
					<tr>
						<td align="left">
							<a href="javascript:;">{{$article}}</a>
						</td>
						<td>

						</td>
					</tr>
					@empty
					@endforelse
				</tbody>
			</table>
		</div>
		<div class="layui-col-lg6 layui-col-md12">
			<blockquote class="layui-elem-quote title">7日发文统计</blockquote>
			<div class="layui-elem-quote layui-quote-nm magb0">
				<div id="main" style="width: 100%;height:600px;"></div>
			</div>
		</div>
	</div>
@endsection

@section('script')
	<script>
		var lasttime = "{{date('Y年m月d日  H:I:s',$adminUser['last_login'])}}"; //上次登录时间
		var x = {!!json_encode($data['x'])!!}; //统计图表x轴数据
    	var y = {!!json_encode($data['y'])!!}; //统计图表y轴数据
    	var data =  {!!json_encode($data['data'])!!}; //统计图表数据
	</script>
	<script src="/admin/js/echarts.min.js"></script>
    <script src="/admin/js/echars-gl.js"></script>
	<script src="/admin/js/main.js"></script>
@endsection