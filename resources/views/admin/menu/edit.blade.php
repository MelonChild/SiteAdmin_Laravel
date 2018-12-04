﻿@extends('admin.layout.base')

@section('content')
<form class="layui-form layui-row layui-col-space10" enctype="multipart/form-data">
    {{ csrf_field() }}
    {{ method_field('PUT') }}
	<div class="layui-col-md9 layui-col-xs12">
		<div class="layui-row layui-col-space10">
			<div class="layui-col-md9 layui-col-xs7">
				<div class="layui-form-item magt3">
					<label class="layui-form-label">名称</label>
					<div class="layui-input-block">
						<input type="text" class="layui-input" lay-verify="required" name="name" placeholder="请输入名称" value="{{$detail['name']}}" />
					</div>
                </div>
                <div class="layui-form-item magt3">
					<label class="layui-form-label">标题</label>
					<div class="layui-input-block">
						<input type="text" class="layui-input" lay-verify="required" name="title" placeholder="标题" value="{{$detail['title']}}" />
					</div>
                </div>
                <div class="layui-form-item magt3">
					<label class="layui-form-label">链接地址</label>
					<div class="layui-input-block">
						<input type="text" class="layui-input" lay-verify="required" name="href" placeholder="链接地址" value="{{$detail['href']}}" />
					</div>
                </div>
				<div class="layui-form-item magt3">
					<label class="layui-form-label">ICON</label>
					<div class="layui-input-block">
						<input type="text" class="layui-input" lay-verify="required" name="icon" placeholder="Layui 的ICON" value="{{$detail['icon']}}" />
					</div>
                </div>
				<div class="layui-form-item magt3">
					<label class="layui-form-label">排序</label>
					<div class="layui-input-block">
						<input type="text" class="layui-input" name="sort" placeholder="排序值" value="{{$detail['sort']}}" />
					</div>
                </div>
			</div>
		</div>
	</div>
	<div class="layui-col-md3 layui-col-xs12">
		<blockquote class="layui-elem-quote title"><i class="seraph icon-caidan"></i> 属性</blockquote>
		<div class="border category">
            <div class="layui-form-item">
				<label class="layui-form-label"><i class="layui-icon">&#xe60e;</i> 分类</label>
				<div class="layui-input-block newsStatus">
					<select name="pid">
                        <option value="0"  @if($detail['pid'] == 0) selected @endif>顶级菜单</option>
						@forelse($menus  as $menu)
                            <option value="{{$menu['id']}}"  @if($detail['pid'] == $menu['id']) selected @endif>{{$menu['name']}}</option>
                        @empty
                        @endforelse
					</select>
				</div>
            </div>
		</div>
		<blockquote class="layui-elem-quote title magt10"><i class="layui-icon">&#xe609;</i> 发布</blockquote>
		<div class="border">
			<div class="layui-form-item newsTop">
				<label class="layui-form-label"><i class="seraph icon-zhiding"></i>收起状态</label>
				<div class="layui-input-block">
					<input type="checkbox"   @if(1==$detail['spread']) checked @endif  name="spread" value="1" lay-skin="switch" lay-text="展开|收起">
				</div>
			</div>
			<div class="layui-form-item newsTop">
				<label class="layui-form-label"><i class="seraph icon-zhiding"></i>激活状态</label>
				<div class="layui-input-block">
					<input type="checkbox"   @if(1==$detail['active']) checked @endif  name="active" value="1" lay-skin="switch" lay-text="激活|禁用">
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
       
		var addUrl = "{{route('menus.update',['id'=>$id])}}",  //存储路由
			hascontent = true, //检测是否使用富文本,富文本内容会存在于content字段中
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



