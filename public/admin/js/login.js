layui.use(['form','layer','jquery'],function(){
    var form = layui.form,
        layer = parent.layer === undefined ? layui.layer : top.layer
        $ = layui.jquery;

    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    $(function (){
        var handlerEmbed = function (captchaObj) {
            
            //登录按钮
            form.on("submit(login)",function(data){
                var validate = captchaObj.getValidate();
                if (!validate) {
                    $("#notice")[0].className = "show";
                    setTimeout(function () {
                        $("#notice")[0].className = "hide";
                    }, 2000);
                    return false;
                }

                //登录
                var index = layer.load(1, {
                    shade: [0.1,'#fff'] //0.1透明度的白色背景
                  });
                $.ajax({
                    url: verifyGeetestUrl,
                    type: 'POST',
                    dataType: 'json',
                    data: {
                        username: $('#admin_username').val(),
                        password: $('#admin_pwd').val(),
                        geetest_challenge: validate.geetest_challenge,
                        geetest_validate: validate.geetest_validate,
                        geetest_seccode: validate.geetest_seccode
                    },
                    success: function (data) {
                        layer.close(index);
                        if (data.status === 'success') {
                            layer.msg('登录成功');
                            location.href=dashbordUrl;
                        } else if (data.status === 'fail') {
                            layer.msg('登录失败，稍候重试');
                            captchaObj.reset();
                        } else if (data.status === 'fail1') {
                            layer.msg('用户名或者密码错误');
                            captchaObj.reset();
                        }
                    }
                });
                return false;
            })

            // 将验证码加到id为captcha的元素里，同时会有三个input的值：geetest_challenge, geetest_validate, geetest_seccode
            captchaObj.appendTo("#embed-captcha");
            captchaObj.onReady(function () {
                $("#wait")[0].className = "hide";
            });
        };
        $.ajax({
            // 获取id，challenge，success（是否启用failback）
            url: geetestUrl + '?'+(new Date()).getTime(), // 加随机数防止缓存
            type: "get",
            dataType: "json",
            success: function (data) {
            // console.log(data);
                // 使用initGeetest接口
                // 参数1：配置参数
                // 参数2：回调，回调的第一个参数验证码对象，之后可以使用它做appendTo之类的事件
                initGeetest({
                    gt: data.gt,
                    challenge: data.challenge,
                    new_captcha: data.new_captcha,
                    product: "float", // 产品形式，包括：float，embed，popup。注意只对PC版验证码有效
                    offline: !data.success, // 表示用户后台检测极验服务器是否宕机，一般不需要关注
                    width: '100%',
                }, handlerEmbed);
            }
        });
    });

    //表单输入效果
    $(".loginBody .input-item").click(function(e){
        e.stopPropagation();
        $(this).addClass("layui-input-focus").find(".layui-input").focus();
    })
    $(".loginBody .layui-form-item .layui-input").focus(function(){
        $(this).parent().addClass("layui-input-focus");
    })
    $(".loginBody .layui-form-item .layui-input").blur(function(){
        $(this).parent().removeClass("layui-input-focus");
        if($(this).val() != ''){
            $(this).parent().addClass("layui-input-active");
        }else{
            $(this).parent().removeClass("layui-input-active");
        }
    })
})
