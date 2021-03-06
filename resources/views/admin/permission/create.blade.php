﻿@extends('admin.layout.base')

@section('content')
<form class="layui-form layui-row layui-col-space10">
    {{ csrf_field() }}
	<div class="layui-col-md6 layui-col-xs12">
		
		<blockquote class="layui-elem-quote title magt10"><i class="layui-icon">&#xe609;</i> 发布</blockquote>
		<div class="border">
			<div class="layui-form-item magt3">
				<label class="layui-form-label">名称</label>
				<div class="layui-input-block">
					<input type="text" class="layui-input" lay-verify="required" name="name" placeholder="请输入名称">
				</div>
			</div>
			<div class="layui-form-item magt3">
				<label class="layui-form-label">验证字段</label>
				<div class="layui-input-block">
					<input type="text" class="layui-input" lay-verify="required" name="the_alias" placeholder="以小写控制器名+方法名设置">
				</div>
			</div>
			<div class="layui-form-item">
				<label class="layui-form-label"><i class="layui-icon">&#xe60e;</i> 所属菜单</label>
				<div class="layui-input-block newsStatus">
					<select name="menu_id">
						@forelse($menus as $menu)
							<option value="{{$menu['id']}}">{{$menu['name']}}</option>
						@empty
						@endforelse
					</select>
				</div>
            </div>
			<div class="layui-form-item magt3">
				<label class="layui-form-label">排序值</label>
				<div class="layui-input-block">
					<input type="number" class="layui-input" lay-verify="required" name="sort" value="1" placeholder="排序值">
				</div>
			</div>
			<hr class="layui-bg-gray" />
			<div class="layui-right">
				<a class="layui-btn layui-btn-sm" lay-filter="add" lay-submit><i class="layui-icon">&#xe609;</i>发布</a>
			</div>
		</div>
	</div>
</form>
@endsection

@section('script')
    <script type="text/javascript">
       
		var addUrl = "{{route('permissions.store')}}",  //存储路由
			hascontent = false, //检测是否使用富文本,富文本内容会存在于content字段中
			cropper = false, //是否裁剪图片，该值必须设置，如果裁剪，下面三个值必须设置
			saveW = 200, //保存宽度
			saveH = 200,
			mark = 1/1; //选取比例
		
    </script>
	<script type="text/javascript">
		layui.link('/admin/css/cropper.css')
		layui.config({
				base: '/admin/js/'
			}).use(['create'],function(args){
				var create = layui.create,
					$ = create.jq;
					
			});
    </script>
@endsection



