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
				@can('permission-check','NAMED.add')<a class="layui-btn layui-btn-normal add_btn">新增</a>@endcan
			</div>
            @can('permission-check','NAMED.delete')
			<div class="layui-inline">
				<a class="layui-btn layui-btn-danger layui-btn-normal delAll_btn">批量删除</a>
			</div>
            @endcan
		</form>
	</blockquote>
	<table id="list" lay-filter="list"></table>

    <!--状态-->
    @verbatim
       
        <script type="text/html" id="active">
            {{#  if(d.active == "1"){ }}
            激活
            {{#  } else { }}
            <span class="layui-red">禁用</span>
            {{#  }}}
        </script>
    @endverbatim

	<!--操作-->
	<script type="text/html" id="ListBar">
        @can('permission-check','NAMED.edit')<a class="layui-btn layui-btn-xs" lay-event="edit">编辑</a>@endcan
		@can('permission-check','NAMED.delete')<a class="layui-btn layui-btn-xs layui-btn-danger" lay-event="del">删除</a>@endcan
		@can('permission-check','NAMED.show')<a class="layui-btn layui-btn-xs layui-btn-primary" lay-event="look">预览</a>@endcan
	</script>
@endsection

@section('script')
    <script type="text/javascript">
        //列表页需展示的列及其他配置项
        var tableId = 'ListTable';
        var tableConfig={
            id: tableId,
            elem: '#list',
            url: "{{route('ROUTENAME.getList')}}",
            cellMinWidth : 95,
            height : "full-125",
            even:true,  //隔行变色
            page: true,
            limit : 20,
            limits : [10,15,20,25],
            cols : [[
                {type: "checkbox", fixed:"left", width:50},
                {field: 'id', title: 'ID', width:60, align:"center"},
                {field: 'name', title: '名称'},
                { field: 'keywords', title: '关键字', width: 200 },
                { field: 'created_date', title: '创建日期'},
                { field: 'updated_date', title: '更新日期'},
                { field: 'active', title: '是否激活', templet: '#active' },
                { title: '操作', fixed: 'right', align: 'center',width: 200, toolbar: '#ListBar' }
            ]]
        };
        //新增路由
        var addUrl = "{{route('ROUTENAME.create')}}";
        //编辑路由
        var editUrl = "{{route('ROUTENAME.index')}}";
        //删除路由
        var delUrl = "{{route('ROUTENAME.delete')}}";
        //查看路由
        var showUrl = "{{route('ROUTENAME.index')}}";
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