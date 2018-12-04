@extends('admin.layout.base')

@section('content')
    <form class="layui-form" action="{{route('config.index')}}" enctype="multipart/form-data">
        {{ csrf_field() }}
		<table class="layui-table mag0">
			<colgroup>
				<col width="25%">
				<col width="45%">
				<col>
		    </colgroup>
		    <thead>
		    	<tr>
		    		<th>参数说明</th>
		    		<th>参数值</th>
		    		<th pc>变量名</th>
		    	</tr>
		    </thead>
		    <tbody>
                @forelse($datas as $data)
                <tr>
		    		<td>{{$data['desc']}}</td>
		    		<td>
                        @if($data['name'] =='notice')
                        <textarea name="data[notice]" placeholder="请输入描述内容" class="layui-textarea" id="content" style="display: none;">{{$data['content']}}</textarea>
                        @else
                        <input type="text" name="data[{{$data['name']}}]" class="layui-input" value="{{$data['content']}}" lay-verify="required" placeholder="请输入模版名称">
                        @endif
                    </td>
		    		<td pc>{{$data['name']}}</td>
		    	</tr>
                @empty
                @endforelse
		    	
		    	
		    </tbody>
		</table>
		<div class="magt10 layui-right">
			<div class="layui-input-block">
				<button class="layui-btn" lay-submit  lay-filter="formEdit">立即提交</button>
				<button type="reset" class="layui-btn layui-btn-primary">重置</button>
		    </div>
		</div>
	</form>
@endsection

@section('script')
<script>
    layui.use(['form','layer','layedit','laydate'], function (form) {
        var msg = layui.layer.msg,
            $ = layui.$,
            layedit = layui.layedit,
            laydate = layui.laydate;
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

         //富文本传图
         layedit.set({
            uploadImage: {
                url: '/admins/draftPicUpload'
            }
        });

        //富文本编译器
        var content = layedit.build('content',{tool: ['strong', 'italic','del','underline','|','left','center', 'right', '|', 'link','unlink']});
       
        form.render();
        
        form.on('submit(formEdit)', function (data) {
            data.field.content = layedit.getContent(content)
            //表单验证
            console.log(data.field);
            $.ajax({
                type: 'post',
                url: "{{route('config.index')}}",
                async: false,
                data: data.field,
                dataType: 'json',
                success: function (json) {
                    if (json.status) {
                        msg(json.msg, {
                            icon: 1,
                            time: 2000
                        });
                    } else {
                        msg(json.msg,{
                            icon: 2,
                            time: 2000
                        });
                    }
                    
                },
                error: function (xml) {
                    msg(xml.responseText == "" ? "获取页面失败" : xml.responseText, {
                        icon: 2,
                        time: 2000
                    });
                }
            });
            return false;
        });
    });
</script>
@endsection