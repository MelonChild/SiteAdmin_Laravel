
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
                        创建于: {{$detail['created_at']}}<br>
                        缩略图：<br>
                        <img src="/{{$detail['imgpath']}}" width="200"><br>
                    </div>
                </div>
            </div>
            <div class="layui-col-xs12 layui-col-md4">
                <div class="layui-card">
                    <div class="layui-card-header">关键词</div>
                    <div class="layui-card-body">
                        {{$detail['keywords']}}
                    </div>
                </div>
            </div>
            <div class="layui-col-xs12 layui-col-md12">
                <div class="layui-card">
                    <div class="layui-card-header">描述</div>
                    <div class="layui-card-body">
                        {{$detail['desc']}}
                    </div>
                </div>
            </div>
            <!-- <div class="layui-col-xs12 layui-col-md12">
                <div class="layui-card">
                    <div class="layui-card-header">内容</div>
                    <div class="layui-card-body">
                        {!!$detail['content']!!}
                    </div>
                </div>
            </div> -->
        </div>
    </div>
@endsection