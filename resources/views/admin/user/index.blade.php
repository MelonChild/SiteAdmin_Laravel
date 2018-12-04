@extends('admin.layout.base')

@section('content')
	<blockquote class="layui-elem-quote quoteBox">

		<form class="searchForm layui-form">
			<div class="layui-inline">
				<div class="layui-input-inline">
					<input type="text" class="layui-input searchVal" placeholder="请输入搜索的内容" name="keyword" id="demoReload" autocomplete="off">
				</div>
				<a class="layui-btn searchBtn" data-type="reload">搜索</a>
			</div>
			<div class="layui-inline">
                <a id="reloadTable" class="layui-btn layui-btn-normal"><i class="fa fa-refresh" aria-hidden="true"></i>刷新数据</a>
				<a class="layui-btn layui-btn-normal add_btn">新增</a>
			</div>
			<div class="layui-inline">
				<a class="layui-btn layui-btn-danger layui-btn-normal delAll_btn">批量删除</a>
			</div>
		</form>
	</blockquote>
	<table id="list" lay-filter="list"></table>
	<!--状态-->
    @verbatim
       
        <script type="text/html" id="active">
            {{#  if(d.active == "1"){ }}
            激活
            {{#  } else { }}
            <span class="layui-red">禁用
            {{#  }}}
        </script>
    @endverbatim

	<!--操作-->
	<script type="text/html" id="ListBar">
		<a class="layui-btn layui-btn-xs" lay-event="edit">编辑</a>
		<a class="layui-btn layui-btn-xs layui-btn-danger" lay-event="del">删除</a>
		<a class="layui-btn layui-btn-xs layui-btn-primary" lay-event="look">预览</a>
	</script>
@endsection

@section('script')
    <script type="text/javascript">
        var tableId = 'ListTable';
        var tableConfig = {
            elem: '#list',
            url : "{{route('users.getList')}}",
            cellMinWidth : 95,
            page : true,
            height : "full-125",
            limit : 20,
            limits : [10,15,20,25],
            id : tableId,
            cols : [[
                {type: "checkbox", fixed:"left", width:50},
                {field: 'id', title: 'ID', width:60, align:"center"},
                {field: 'nickname', title: '昵称'},
                {field: 'username', title: '用户名', align:'center'},
                {field: 'rolename', title: '角色', align:'center'},
                {field: 'logins', title: '登录次数',  align:'center',templet:"#formtype"},
                {field: 'active', title: '状态', align:'center',templet:"#active"},
                {field: 'lastTime', title: '上次登录时间', align:'center'},
                {title: '操作', width:170, templet:'#ListBar',fixed:"right",align:"center"}
            ]]
        };
        //新增路由
        var addUrl = "{{route('users.create')}}";
        //编辑路由
        var editUrl = "{{route('users.index')}}";
        //删除路由
        var delUrl = "{{route('users.delete')}}";
        //查看路由
        var showUrl = "{{route('users.index')}}";
    </script>
    <script type="text/javascript">
        
       layui.config({
            base: '/admin/js/'
        }).use(['list'],function(args){
            var list = layui.list,
                $ = list.jq,
                tableReload = list.tableReload;
                $('.searchBtn').on('click', function(){
                    var value = $(".searchForm").serialize();
                    if(value) {
                        var url = tableConfig.url+'?'+value;
                        tableReload['reload'] ? tableReload['reload']({url:url,page:{curr:1}}) : '';
                    } 
                });
        });
    </script>
@endsection