@extends('admin.layout.base')

@section('content')
    <blockquote class="layui-elem-quote quoteBox">
        <form class="searchForm layui-form">
            <div class="layui-inline">
                <a id="reloadTable" class="layui-btn layui-btn-normal"><i class="fa fa-refresh" aria-hidden="true"></i>刷新数据</a>
                <a class="layui-btn layui-btn-normal add_btn">新增</a>
            </div>
        </form>
    </blockquote>
	<table id="list" lay-filter="list"></table>

	<!--操作-->
	<script type="text/html" id="ListBar">
		<a class="layui-btn layui-btn-xs layui-btn-danger" lay-event="del">删除</a>
	</script>
@endsection

@section('script')
    <script type="text/javascript">
        var tableId = 'ListTable';
        var tableConfig = {
            elem: '#list',
            url : "{{route('operations.getList')}}",
            cellMinWidth : 95,
            page : true,
            height : "full-125",
            limit : 20,
            limits : [10,15,20,25],
            id : tableId,
            cols : [[
                {field: 'id', title: 'ID', width:60, align:"center"},
                {field: 'name', title: '操作名'},
                {field: 'named', title: '对象命名', align:'center'},
                {field: 'created_at', title: '创建于', align:'center'},
                {title: '操作', width:170, templet:'#ListBar',fixed:"right",align:"center"}
            ]]
        };
        //新增路由
        var addUrl = "{{route('operations.create')}}";
        //删除路由
        var delUrl = "{{route('operations.delete')}}";
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