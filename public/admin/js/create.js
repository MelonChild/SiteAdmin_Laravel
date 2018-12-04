layui.define(['form', 'layer', 'layedit', 'laydate', 'upload', 'croppers'], function (exports) {
    var form = layui.form
    layer = parent.layer === undefined ? layui.layer : top.layer,
        laypage = layui.laypage,
        upload = layui.upload,
        layedit = layui.layedit,
        laydate = layui.laydate,
        $ = layui.jquery,
        croppers = layui.croppers;

    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });


    //判断是否需要裁剪
    var needCrop = typeof cropper != 'undefined' && cropper;
    if (needCrop) {
        //创建一个头像上传组件
        croppers.render({
            elem: '#thumbImg'
            , saveW: saveW     //保存宽度
            , saveW: saveW
            , mark: mark    //选取比例
            , area: '900px'  //弹窗宽度
            , url: '/admins/upload'  //图片上传接口返回和（layui 的upload 模块）返回的JOSN一样
            , done: function (url) { //上传完毕回调
                $("#filepath").val(url);
                $(".thumbImg").attr('src', '/' + url);
            }
        });
    } else {
        //上传缩略图
        upload.render({
            elem: '.thumbBox',
            url: '/admins/upload',
            accept: 'images',
            size: '500',
            done: function (res, index, upload) {
                if (res.status) {
                    $('.thumbImg').attr('src', '/' + res.path);
                    $('.thumbBox').css("background", "#fff");
                    $("#filepath").val(res.path);
                } else {
                    layer.msg('上传失败，请稍候重试！');
                }
            }
        });
    }


    //格式化时间
    function filterTime(val) {
        if (val < 10) {
            return "0" + val;
        } else {
            return val;
        }
    }

    //设置验证项
    form.verify({
        name: function (val) {
            if (val == '') {
                return "标题不能为空";
            }
        },
        content: function (val) {
            if (val == '') {
                return "内容不能为空";
            }
        },
        imgpath: function (val) {
            if (val == '') {
                return "图片不能为空";
            }
        }
    })
    form.on("submit(add)", function (data) {
        //弹出loading
        var index = top.layer.msg('数据提交中，请稍候', { icon: 16, time: false, shade: 0.1 });
        typeof hascontent != 'undefined' && hascontent && (data.field.content = layedit.getContent(editIndex));
        console.log(data.field);
        $.ajax({
            url: addUrl,
            type: 'POST',
            dataType: 'json',
            data: data.field,
            success: function (data) {
                console.log(data);
                layer.close(index);
                layer.msg(data.msg);

                if (data.status) {
                    layer.closeAll();
                    //刷新父页面
                    parent.location.reload();
                }

            },
            error: function () {
                layer.close(index);
                layer.msg('请稍候再试');
            }
        });
        return false;
    })

    //预览
    form.on("submit(look)", function () {
        layer.alert("此功能需要前台展示，实际开发中传入对应的必要参数进行文章内容页面访问");
        return false;
    })

    //创建一个编辑器
    var editIndex = layedit.build('content', {
        height: 535,
        uploadImage: {
            url: '/admins/draftPicUpload'
        }
    });

    //用于同步编辑器内容到textarea
    layedit.sync(editIndex);

    exports('create', { 'jq': $ });
})