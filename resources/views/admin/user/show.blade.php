
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
                        昵称: {{$detail['nickname']}}<br>
                        用户名: {{$detail->username}}<br>
                        角色: {{$detail->role['name']}}<br>
                        头像：{{$detail['filepath']}}<br>
                        <img src="/{{$detail['avatar']}}" width="200"><br>
                    </div>
                </div>
            </div>
            <div class="layui-col-xs12 layui-col-md4">
                <div class="layui-card">
                    <div class="layui-card-header">属性</div>
                    <div class="layui-card-body">
                        登录次数: {{$detail['logins']}}<br>   
                        上次登录: {{date('y-m-d H:i',$detail['last_login'])}}<br>   
                        上次ip: {{$detail['last_ip']}}<br>   
                        当前状态: @if($detail['active']==1) 激活 @else 禁止 @endif <br>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

