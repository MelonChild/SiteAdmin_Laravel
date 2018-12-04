@extends('admin.layout.base')

@section('content')
    <blockquote class="layui-elem-quote quoteBox">

		<form class="searchForm layui-form">
			<div class="layui-inline">
				<div class="layui-input-inline">
					<input type="text" class="layui-input searchVal" placeholder="请输入搜索的内容" name="keyword" id="demoReload" autocomplete="off">
				</div>
				<div class="layui-input-inline">
					<select name="menu_id">
                        <option value="-1" selected>全部</option>
                        <option value="0">其他</option>
                        @forelse($menus  as $menu)
                            <option value="{{$menu['id']}}">{{$menu['name']}}</option>
                        @empty
                        @endforelse
					</select>
				</div>
				<a class="layui-btn searchBtn" data-type="reload">搜索</a>
			</div>
			<div class="layui-inline">
                <a id="reloadTable" class="layui-btn layui-btn-normal"><i class="fa fa-refresh" aria-hidden="true"></i>刷新数据</a>
				@can('permission-check','permission.add')<a class="layui-btn layui-btn-normal add_btn">新增</a>@endcan
			</div>
            @can('permission-check','permission.delete')
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
            <span class="layui-red">禁用
            {{#  }}}
        </script>
    @endverbatim

	<!--操作-->
	<script type="text/html" id="ListBar">
		@can('permission-check','permission.delete')<a class="layui-btn layui-btn-xs layui-btn-danger" lay-event="del">删除</a>@endcan
	</script>
@endsection

@section('script')
    <script type="text/javascript">
        //列表页需展示的列及其他配置项
        var tableId = 'ListTable';
        var tableConfig={
            id: tableId,
            elem: '#list',
            url: "{{route('permissions.getList')}}",
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
                { field: 'the_alias', title: '节点名', width: 200 },
                { field: 'sort', title: '排序'},
                { field: 'menuname', title: '所属菜单'},
                { title: '操作', fixed: 'right', align: 'center',width: 200, toolbar: '#ListBar' }
            ]]
        };
        //新增路由
        var addUrl = "{{route('permissions.create')}}";
        //编辑路由
        var editUrl = "{{route('permissions.index')}}";
        //删除路由
        var delUrl = "{{route('permissions.delete')}}";
        //查看路由
        var showUrl = "{{route('permissions.index')}}";
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