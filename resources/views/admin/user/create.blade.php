@extends('admin.layout.base')

@section('content')
<form class="layui-form layui-row layui-col-space10">
    {{ csrf_field() }}
	<div class="layui-col-md9 layui-col-xs12">
		<blockquote class="layui-elem-quote title"><i class="seraph icon-xiugai"></i> 基础信息</blockquote>
		<div class=" layui-row layui-col-space10">
			<div class="layui-col-md9 layui-col-xs7">
				<div class="border magt3">
					<div class="layui-form-item ">
						<label class="layui-form-label">用户昵称</label>
						<div class="layui-input-block">
							<input type="text" class="layui-input" lay-verify="content" name="nickname" placeholder="请输入用户昵称">
						</div>
					</div>
					<div class="layui-form-item">
						<label class="layui-form-label">用户名</label>
						<div class="layui-input-block">
							<input type="text" class="layui-input" lay-verify="required" name="username" placeholder="用户名">
						</div>
					</div>
					<div class="layui-form-item">
						<label class="layui-form-label">用户密码</label>
						<div class="layui-input-block">
							<input type="text" class="layui-input"  lay-verify="required" name="password" placeholder="塡值即修改">
						</div>
					</div>
				</div>
			</div>
			<div class="layui-col-md3 layui-col-xs5">
				<div class="layui-word-aux">头像的尺寸150x150px,大小在100kb</div>
				<div class="layui-upload-list thumbBox mag0 magt3"  id="thumbImg">
					<img src="" class="layui-upload-img thumbImg" >
				</div>
				<!-- 图片验证请使用如下格式 -->
				<input type="hidden" name="avatar" lay-verify="imgpath" value="" id="filepath">
			</div>
			
		</div>
	</div>
	<div class="layui-col-md3 layui-col-xs12">
		<blockquote class="layui-elem-quote title"><i class="seraph icon-caidan"></i> 其他属性</blockquote>
		<div class="border category">
            <div class="layui-form-item">
				<label class="layui-form-label">用户角色</label>
				<div class="layui-input-block newsStatus">
					<select name="role_id">
						@forelse($roles as $role)
							<option value="{{$role['id']}}">{{$role['name']}}</option>
						@empty
						@endforelse
					</select>
				</div>
            </div>
		</div>
		<blockquote class="layui-elem-quote title magt10"><i class="layui-icon">&#xe609;</i> 发布</blockquote>
		<div class="border">
			<div class="layui-form-item newsTop">
				<label class="layui-form-label"><i class="seraph icon-zhiding"></i>激活状态</label>
				<div class="layui-input-block">
					<input type="checkbox" checked name="active" value="1" lay-skin="switch" lay-text="激活|禁用">
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
       
		var addUrl = "{{route('users.store')}}",  //存储路由
			hascontent = false, //检测是否使用富文本,富文本内容会存在于content字段中
			cropper = true, //是否裁剪图片，该值必须设置，如果裁剪，下面三个值必须设置
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