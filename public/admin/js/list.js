layui.define(['form','layer','laydate','table','laytpl'],function(exports){
    var form = layui.form,
        layer = parent.layer === undefined ? layui.layer : top.layer,
        $ = layui.jquery,
        laydate = layui.laydate,
        laytpl = layui.laytpl,
        table = layui.table;
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    //列表
    var tableIns = table.render(tableConfig);
    var tableReload = {
        reload: function(obj){
            console.log(obj);
          //执行重载
          table.reload(tableConfig.id, obj);
        }
      };
    //表格刷新
    function reloadTable() {
        table.reload(tableId, {});
    }
    //添加或者编辑
    function add(id){
        if(id){
            addUrl= editUrl + '/' + id +"/edit";
        };
        var index = layui.layer.open({
            title : "编辑",
            type : 2,
            content : addUrl,
            area: ['650px', '600px'],
            maxmin: true,
            success : function(layero, index){
                var body = layui.layer.getChildFrame('body', index);
                setTimeout(function(){
                    layui.layer.tips('点击此处返回列表', '.layui-layer-setwin .layui-layer-close', {
                        tips: 3
                    });
                },500)
            }
        })
        //layui.layer.full(index);
        //改变窗口大小时，重置弹窗的宽高，防止超出可视区域（如F12调出debug的操作）
        $(window).on("resize",function(){
            layui.layer.full(index);
        })
    }

    //新增按钮
    $(".add_btn").click(function(){
        add();
    })

    //批量删除
    $(".delAll_btn").click(function(){
        var checkStatus = table.checkStatus('ListTable'),
            data = checkStatus.data,
            newsId = [];
        if(data.length > 0) {
            var ids = '';   //选中的Id
            for (var i in data) {
                ids += data[i].id + ',';
            }
            layer.confirm('确定删除选中的数据？', {icon: 3, title: '提示信息'}, function (index) {
                $.ajax({
                    type: 'post',
                    url: delUrl,
                    async: false,
                    data: {ids:ids},
                    dataType: 'json',
                    success: function (json) {
                        tableIns.reload();
                        layer.close(index);
                    }
                });
            })
        }else{
            layer.msg("请选择需要删除的文章");
        }
    })

    //列表操作
    table.on('tool(list)', function(obj){
        var layEvent = obj.event,
            data = obj.data;
        var ids = '';   //选中的Id
        $(data).each(function (index, item) {
            ids += item.id + ',';
        });

        if(layEvent === 'edit'){ //编辑
            add(data.id);
        } else if(layEvent === 'del'){ //删除
            layer.confirm('确定删除此项？',{icon:3, title:'提示信息'},function(index){
                $.ajax({
                    type: 'post',
                    url: delUrl,
                    async: false,
                    data: {ids:ids},
                    dataType: 'json',
                    success: function (json) {
                        tableIns.reload();
                        layer.close(index);
                    }
                });
            });
        } else if(layEvent === 'look'){ //预览
            var index = layui.layer.open({
                title : "查看",
                type : 2,
                content : showUrl+'/'+data.id,
                area: ['650px', '600px'],
                maxmin: true,
                success : function(layero, index){
                    var body = layui.layer.getChildFrame('body', index);
                    setTimeout(function(){
                        layui.layer.tips('点击此处返回列表', '.layui-layer-setwin .layui-layer-close', {
                            tips: 3
                        });
                    },500)
                }
            })
            //layui.layer.full(index);
            //改变窗口大小时，重置弹窗的宽高，防止超出可视区域（如F12调出debug的操作）
            $(window).on("resize",function(){
                layui.layer.full(index);
            })
        }
    });

    //绑定工具栏刷新按钮事件
    $('#reloadTable').on('click', reloadTable);

    exports('list', {'jq':$,'tableReload':tableReload});

})