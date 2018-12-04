
@extends('admin.layout.base')

@section('content')
    <fieldset class="layui-elem-field layui-field-title" style="margin-top: 20px;">
        <legend>详情</legend>
    </fieldset>
    <div style="padding: 20px; background-color: #F2F2F2;">
        <div class="layui-row layui-col-space15" >
            <div class="layui-col-xs12 layui-col-md8">
                <div class="layui-card">
                    <div class="layui-card-header">信息</div>
                    <div class="layui-card-body">
                        名称: {{$detail['name']}}<br>
                        排序值: {{$detail['sort']}}
                    </div>
                </div>
            </div>
        </div>
    </div>
    @can('permission-check','role.permission')
    <fieldset class="layui-elem-field layui-field-title" style="margin-top: 20px;">
    <legend>权限设置</legend>
    </fieldset>   
    
    <div style="padding: 20px; background-color: #F2F2F2;">
        <div class="layui-row layui-col-space15">
            <div class="layui-col-md12">
                <form class="layui-form" action="">
                    {{ csrf_field() }}
                    <input type="hidden" name="id" value="{{$detail['id']}}" />
                    <div class="layui-form-item">
                        @forelse($menus as $menu)
                            <div class="layui-card menu-card layui-col-space15">
                                <div class="layui-card-header">
                                    <input lay-filter="menu" class="nemu" type="checkbox" name="menu[]" value="{{$menu['id']}}" title="{{$menu['name']}}" @if(in_array($menu['id'],$menuIds)) checked @endif>
                                </div>
                                <div class="layui-card-body">
                                    <div class="layui-form-item" pane="">
                                        @forelse($menu->permissions() as $permission)
                                            <input lay-filter="permission" class="permission" type="checkbox" name="permission[]" lay-skin="primary" value="{{$permission['id']}}"  title="{{$permission['name']}}" @if(in_array($permission['id'],$permissionIds)) checked @endif>
                                        @empty
                                        @endforelse
                                    </div>
                                </div>
                            </div>
                        @empty
                        @endforelse
                        <div class="layui-card menu-card layui-col-space15">
                                <div class="layui-card-header">
                                    其它权限
                                </div>
                                <div class="layui-card-body">
                                    <div class="layui-form-item" pane="">
                                        @forelse($others as $permission)
                                            <input lay-filter="permission" class="permission" type="checkbox" name="permission[]" lay-skin="primary" value="{{$permission['id']}}"  title="{{$permission['name']}}" @if(in_array($permission['id'],$permissionIds)) checked @endif>
                                        @empty
                                        @endforelse
                                    </div>
                                </div>
                            </div>
                    </div>
                    <div class="layui-form-item">
                        <button type="button" class="layui-btn layui-btn-normal" lay-submit="" lay-filter="update">更新权限</button>
                    </div>
                </form>
            </div>
        </div>
    </div> 
    @endcan
@endsection

@section('script')

    <script>
        layui.use(['form','layer'], function (form) {
            var msg = layui.layer.msg,
                $ = layui.$;
            form.render();
            form.on('checkbox(menu)', function(data){
                $(data.othis).parents('.menu-card').find('.permission').each(function() {
                    $(this).prop("checked", data.elem.checked);
                });
                form.render('checkbox');
            });  
            form.on('checkbox(permission)', function(data){
                $(data.othis).parents('.menu-card').find('.nemu').each(function() {
                    $(this).prop('checked')||$(this).prop("checked", data.elem.checked);
                });
                form.render('checkbox');
            });  
            form.on('submit(update)', function (data) {
                
                console.log(data.field);
                $.ajax({
                    type: 'post',
                    url: "{{route('roles.upMenus')}}",
                    async: false,
                    data: data.field,
                    dataType: 'json',
                    success: function (json) {
                        msg(json.msg, {
                                icon: 1,
                                time: 2000
                            });
                        
                    },
                    error: function (xml) {
                        msg(xml.responseText == "" ? "数据处理失败" : xml.responseText, {
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