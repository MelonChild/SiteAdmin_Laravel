<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>KeWo Demo--kewo内容管理模板</title>
	<meta name="renderer" content="webkit">
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
	<meta http-equiv="Access-Control-Allow-Origin" content="*">
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
	<meta name="apple-mobile-web-app-status-bar-style" content="black">
	<meta name="apple-mobile-web-app-capable" content="yes">
	<meta name="format-detection" content="telephone=no">
	<meta name="csrf-token" content="{{ csrf_token() }}">
	<link rel="icon" href="/admin/favicon.ico">
	<link rel="stylesheet" href="/admin/layui/css/layui.css" media="all" />
	<link rel="stylesheet" href="/admin/css/index.css" media="all" />
</head>
<body class="main_body">
<div class="layui-layout layui-layout-admin">
	<!-- 顶部 -->
	<div class="layui-header header">
		<div class="layui-main mag0">
			<a href="#" class="logo">Kewo Demo</a>
			<!-- 显示/隐藏菜单 -->
			<a href="javascript:;" class="seraph hideMenu icon-caidan"></a>
			<!-- 顶级菜单 -->
			<ul class="layui-nav  mobileTopLevelMenus" mobile lay-filter="demo">
				<li class="layui-nav-item " data-menu="{{$menus[0]['id']}}">
					<a href="javascript:;"><i class="seraph icon-caidan"></i><cite>菜单</cite></a>
					<dl class="layui-nav-child">
						@forelse($menus as $menu)
							<dd @if($loop->index == 0) class="layui-this" @endif data-menu="{{$menu['id']}}">
								<a href="javascript:;">
									<i class="layui-icon" data-icon="{{$menu['icon']}}">{{$menu['icon']}}</i><cite>{{$menu['title']}}</cite>
								</a>
							</dd>
						@empty
						@endforelse
					</dl>
				</li>
			</ul>
			<ul class="layui-nav topLevelMenus" pc>
				@forelse($menus as $menu)
					<li class="layui-nav-item  @if($loop->index == 0) layui-this @endif" data-menu="{{$menu['id']}}">
						<a href="javascript:;"><i class="layui-icon" data-icon="{{$menu['icon']}}">{{$menu['icon']}}</i><cite>{{$menu['title']}}</cite></a>
					</li>
				@empty
				@endforelse
			</ul>
			<!-- 顶部右侧菜单 -->
			<ul class="layui-nav top_menu">
				<li class="layui-nav-item" pc>
					<a href="javascript:;" class="clearCache"><i class="layui-icon" data-icon="&#xe640;">&#xe640;</i><cite>清除缓存</cite><span class="layui-badge-dot"></span></a>
				</li>
				<li class="layui-nav-item" id="userInfo">
					<a href="javascript:;"><img src="/{{$adminUser['avatar'] or 'admin/images/face.jpg'}}" class="layui-nav-img userAvatar" width="35" height="35"><cite class="adminName">{{$adminUser['nickname']}}</cite></a>
					<dl class="layui-nav-child">
						<dd><a href="javascript:;" class="showNotice"><i class="layui-icon">&#xe645;</i><cite>系统公告</cite><span class="layui-badge-dot"></span></a></dd>
						<dd pc><a href="javascript:;" class="functionSetting"><i class="layui-icon">&#xe620;</i><cite>功能设定</cite><span class="layui-badge-dot"></span></a></dd>
						<dd pc><a href="javascript:;" class="changeSkin"><i class="layui-icon">&#xe61b;</i><cite>更换皮肤</cite></a></dd>
						<dd><a href="{{route('admin.logout')}}" class="signOut"><i class="seraph icon-tuichu"></i><cite>退出</cite></a></dd>
					</dl>
				</li>
			</ul>
		</div>
	</div>
	<!-- 左侧导航 -->
	<div class="layui-side layui-bg-black">
		<div class="user-photo">
			<a class="img" title="{{$adminUser['nickname']}}" ><img src="/{{$adminUser['avatar'] or 'admin/images/face.jpg'}}" class="userAvatar"></a>
			<p>你好！<span class="userName">{{$adminUser['nickname']}}</span></p>
		</div>
		<div class="navBar layui-side-scroll" id="navBar">
			<ul class="layui-nav layui-nav-tree">
				<li class="layui-nav-item layui-this">
					<a href="javascript:;" data-url="{{route('admin.dashboard')}}"><i class="layui-icon" data-icon=""></i><cite>后台首页</cite></a>
				</li>
			</ul>
		</div>
	</div>
	<!-- 右侧内容 -->
	<div class="layui-body layui-form">
		<div class="layui-tab mag0" lay-filter="bodyTab" id="top_tabs_box">
			<ul class="layui-tab-title top_tab" id="top_tabs">
				<li class="layui-this" lay-id=""><i class="layui-icon">&#xe68e;</i> <cite>后台首页</cite></li>
			</ul>
			<ul class="layui-nav closeBox">
				<li class="layui-nav-item">
				<a href="javascript:;"><i class="layui-icon caozuo">&#xe643;</i> 页面操作</a>
				<dl class="layui-nav-child">
					<dd><a href="javascript:;" class="refresh refreshThis"><i class="layui-icon">&#x1002;</i> 刷新当前</a></dd>
					<dd><a href="javascript:;" class="closePageOther"><i class="seraph icon-prohibit"></i> 关闭其他</a></dd>
					<dd><a href="javascript:;" class="closePageAll"><i class="seraph icon-guanbi"></i> 关闭全部</a></dd>
				</dl>
				</li>
			</ul>
			<div class="layui-tab-content clildFrame">
				<div class="layui-tab-item layui-show">
					<iframe src="{{route('admin.dashboard')}}"></iframe>
				</div>
			</div>
		</div>
	</div>
	<!-- 底部 -->
	<div class="layui-footer footer">
		<p><span>copyright @2018 melon</span></p>
	</div>
</div>

<!-- 移动导航 -->
<div class="site-tree-mobile"><i class="layui-icon">&#xe602;</i></div>
<div class="site-mobile-shade"></div>

<!-- 公告 -->
<div class="notice" style="display:none;">
	<div style="padding:10px;">{!!$announce!!}</div>
</div>

</body>

<script>
	
	var getMenuUrl = "{{route('admin.getMenu')}}"; //定义获取菜单地址
	var showNoticeFlag = {{$canAlert}};//定义是否自动展示公告

</script>
<script src="/admin/layui/layui.js"></script>
<script src="/admin/js/index.js"></script>
<script src="/admin/js/cache.js"></script>

</html>
