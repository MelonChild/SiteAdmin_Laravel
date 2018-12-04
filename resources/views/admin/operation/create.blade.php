@extends('admin.layout.base')

@section('content')
<form class="layui-form layui-row layui-col-space10">
    {{ csrf_field() }}
	<div class="layui-col-md3 layui-col-xs12">
		<blockquote class="layui-elem-quote title magt10"><i class="layui-icon">&#xe609;</i> 发布</blockquote>
		<div class="border">
			<div class="layui-form-item ">
				<label class="layui-form-label">操作名称</label>
				<div class="layui-input-block">
					<input type="text" class="layui-input" lay-verify="required" name="name" placeholder="操作名">
				</div>
			</div>
			<div class="layui-form-item ">
				<label class="layui-form-label">文件命名</label>
				<div class="layui-input-block">
					<input type="text" class="layui-input" lay-verify="required" name="named" placeholder="请使用数据表单数形式">
				</div>
			</div>
			<div class="layui-form-item ">
				<label class="layui-form-label">ICON</label>
				<div class="layui-input-block">
					<input type="text" class="layui-input" lay-verify="" name="icon" placeholder="layui 中的图标值">
				</div>
			</div>
			<div class="layui-form-item newsTop">
				<label class="layui-form-label"><i class="seraph icon-zhiding"></i>创建数据表</label>
				<div class="layui-input-block">
					<input type="checkbox" checked name="database" value="1" lay-skin="switch" lay-text="是|否">
				</div>
			</div>
			<div class="layui-form-item newsTop">
				<label class="layui-form-label"><i class="seraph icon-zhiding"></i>创建Model</label>
				<div class="layui-input-block">
					<input type="checkbox" checked name="model" value="1" lay-skin="switch" lay-text="是|否">
				</div>
			</div>
			<hr class="layui-bg-gray" />
			<div class="layui-left">
				<a class="layui-btn layui-btn-sm" lay-filter="add" lay-submit><i class="layui-icon">&#xe609;</i>发布</a>
			</div>
		</div>
	</div>
</form>
@endsection

@section('script')
    <script type="text/javascript">
       
		var addUrl = "{{route('operations.store')}}";  //存储路由
		
    </script>
	<script type="text/javascript">
		layui.config({
				base: '/admin/js/'
			}).use(['create'],function(args){
				var create = layui.create,
					$ = create.jq;
					
			});
    </script>
@endsection