<!DOCTYPE html>
<html class="loginHtml">
<head>
	<meta charset="utf-8">
	<title>KeWo Demo--kewo内容管理模板</title>
	<meta name="renderer" content="webkit">
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
	<meta name="apple-mobile-web-app-status-bar-style" content="black">
	<meta name="apple-mobile-web-app-capable" content="yes">
	<meta name="format-detection" content="telephone=no">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="icon" href="/admin/favicon.ico">
	<link rel="stylesheet" href="/admin/layui/css/layui.css" media="all" />
	<link rel="stylesheet" href="/admin/css/public.css" media="all" />
</head>
<body class="loginBody">

<form class="layui-form">
	<div class="login_face"><img src="/admin/images/face.jpg" class="userAvatar"></div>
	<div class="layui-form-item input-item">
		<label for="userName">用户名</label>
		<input type="text" placeholder="请输入用户名" id="admin_username" autocomplete="off" id="userName" class="layui-input" lay-verify="required">
	</div>
	<div class="layui-form-item input-item">
		<label for="password">密码</label>
		<input type="password" placeholder="请输入密码" id="admin_pwd" autocomplete="off" id="password" class="layui-input" lay-verify="required">
	</div>
	<div class="layui-form-item input-item" id="embed-captcha"></div>
	<p id="wait" class="show">正在加载验证码......</p>
	<p id="notice" class="hide">请先完成验证</p>
	</div>
	<br>
	<div class="layui-form-item">
		<button class="layui-btn layui-block layui-btn-normal" lay-filter="login" lay-submit>登录</button>
		<span style="font-size:12px;margin-top:5px; display: inline-block;">Tips:如加载时间过长，请刷新重试</span>
	</div>
</form>

<script>
	var verifyGeetestUrl = "{{route('admin.verifyGeetest')}}",
			geetestUrl = "{{route('admin.geetest')}}",
			dashbordUrl = "{{route('admin.index')}}"
</script>

<script src="/admin/layui/layui.js"></script>
<script src="/admin/js/gt.js"></script>
<script src="/admin/js/cache.js"></script>
<script src="/admin/js/login.js"></script>

</body>
</html>