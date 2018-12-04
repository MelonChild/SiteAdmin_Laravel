@extends('admin.layout.base')

@section('content')
    <blockquote class="layui-elem-quote quoteBox">

		<form class="searchForm layui-form">
			<div class="layui-inline">
				<div class="layui-input-inline">
					<input type="text" class="layui-input searchVal" placeholder="请输入搜索的内容" name="keyword" id="demoReload" autocomplete="off">
                </div>
                <div class="layui-input-inline" style="width: 100px;">
                    <input type="text" name="begin" id="begin" lay-verify="date" placeholder="开始日期" autocomplete="off" class="layui-input">
                </div>
                
                <div class="layui-input-inline" style="width: 100px;">
                    <input type="text" name="end" id="end" lay-verify="date" placeholder="结束日期" autocomplete="off" class="layui-input">
                </div>
                <div class="layui-input-inline" style="width: 100px;">
                    <select name="type">
                        <option value="" selected>全部</option>
                        <option value="1" >登录</option>
                        <option value="5" >退出</option>
                        <option value="2" >新增</option>
                        <option value="3" >编辑</option>
                        <option value="4" >删除</option>
                        <option value="6" >其他</option>
                    </select>
                </div>
				<a class="layui-btn searchBtn" data-type="reload">搜索</a>
			</div>
			<div class="layui-inline">
                <a id="reloadTable" class="layui-btn layui-btn-normal"><i class="fa fa-refresh" aria-hidden="true"></i>刷新数据</a>
			</div>
		</form>
	</blockquote>
	<table id="list" lay-filter="list"></table>

    <!--状态-->
    @verbatim
       
        <script type="text/html" id="active">
            {{#  if(d.type == 1){ }}
            登录
            {{#  } else if(d.type == 2) { }}
            新增
            {{#  } else if(d.type == 3) { }}
            编辑
            {{#  } else if(d.type == 4) { }}
            删除
            {{#  } else if(d.type == 5) { }}
            退出
            {{#  } else if(d.type == 6) { }}
            其他
            {{#  } }}
        </script>
    @endverbatim

@endsection

@section('script')
    <script type="text/javascript">
        //列表页需展示的列及其他配置项
        var tableId = 'ListTable';
        var tableConfig={
            id: tableId,
            elem: '#list',
            url: "{{route('logs.getList')}}",
            cellMinWidth : 95,
            height : "full-125",
            even:true,  //隔行变色
            page: true,
            limit : 20,
            limits : [10,15,20,25],
            cols : [[
                { field: 'id', type: 'checkbox' },
                { field: 'id', title: 'ID', width: 100 ,sort: true},
                { field: 'type', title: '类型', templet: '#active', width: 200 },
                { field: 'username', title: '用户', width: 200 },
                { field: 'mark', title: '操作' },
                { field: 'created_at', title: '创建日期', width: 250}
            ]]
        };
        //新增路由
        var addUrl = "{{route('logs.create')}}";
        //编辑路由
        var editUrl = "{{route('logs.index')}}";
        //删除路由
        var delUrl = "{{route('logs.delete')}}";
        //查看路由
        var showUrl = "{{route('logs.index')}}";
    </script>
    <script type="text/javascript">
        
        layui.config({
             base: '/admin/js/'
         }).use(['laydate','list'],function(args){
            laydate = layui.laydate;
  
            //日期
            laydate.render({
                elem: '#begin'
            });
            laydate.render({
                elem: '#end'
            });
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