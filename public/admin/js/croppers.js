/*!
 * Cropper v3.0.0
 */

layui.config({
    base: '/admin/js/' //layui自定义layui组件目录
}).define(['jquery', 'layer', 'cropper'], function (exports) {
    var $ = layui.jquery
        , layer = layui.layer;
    var html = "<div class=\"layui-fluid showImgEdit\" style=\"display: none\">\n" +
        "    <div class=\"layui-form-item\">\n" +
        "        <div class=\"layui-input-inline layui-btn-container\" style=\"width: auto;\">\n" +
        "            <label for=\"cropper_avatarImgUpload\" class=\"layui-btn layui-btn-primary\">\n" +
        "                <i class=\"layui-icon\">&#xe67c;</i>选择图片\n" +
        "            </label>\n" +
        "            <input class=\"layui-upload-file\" id=\"cropper_avatarImgUpload\" type=\"file\" value=\"选择图片\" name=\"file\">\n" +
        "        </div>\n" +
        "        <div class=\"layui-form-mid layui-word-aux\">头像的尺寸限定150x150px,大小在50kb以内</div>\n" +
        "    </div>\n" +
        "    <div class=\"layui-row layui-col-space15\">\n" +
        "        <div class=\"layui-col-xs9\">\n" +
        "            <div class=\"readyimg\" style=\"height:450px;background-color: rgb(247, 247, 247);\">\n" +
        "                <img src=\"\" >\n" +
        "            </div>\n" +
        "        </div>\n" +
        "        <div class=\"layui-col-xs3\">\n" +
        "            <div class=\"img-preview\" style=\"width:200px;height:200px;overflow:hidden\">\n" +
        "            </div>\n" +
        "        </div>\n" +
        "    </div>\n" +
        "    <div class=\"layui-row layui-col-space15\">\n" +
        "        <div class=\"layui-col-xs9\">\n" +
        "            <div class=\"layui-row\">\n" +
        "                <div class=\"layui-col-xs6\">\n" +
        "                    <button type=\"button\" class=\"layui-btn layui-icon\" cropper-event=\"rotate\" data-option=\"-15\" title=\"Rotate -90 degrees\"> &#xe603;向左旋转</button>\n" +
        "                    <button type=\"button\" class=\"layui-btn layui-icon\" cropper-event=\"rotate\" data-option=\"15\" title=\"Rotate 90 degrees\"> &#xe602;向右旋转</button>\n" +
        "                </div>\n" +
        "                <div class=\"layui-col-xs5\" style=\"text-align: right;\">\n" +
        "                    <button type=\"button\" class=\"layui-btn layui-icon\" title=\"移动\">&#xe630;</button>\n" +
        "                    <button type=\"button\" class=\"layui-btn layui-icon\" title=\"放大图片\">&#xe615;</button>\n" +
        "                    <button type=\"button\" class=\"layui-btn layui-icon\" title=\"缩小图片\">&#xe615;</button>\n" +
        "                    <button type=\"button\" class=\"layui-btn layui-icon\" cropper-event=\"reset\" title=\"重置图片\">&#xe669;</button>\n" +
        "                </div>\n" +
        "            </div>\n" +
        "        </div>\n" +
        "        <div class=\"layui-col-xs3\">\n" +
        "            <button class=\"layui-btn  layui-icon layui-btn-fluid\" cropper-event=\"confirmSave\" type=\"button\">&#xe621; 保存修改</button>\n" +
        "        </div>\n" +
        "    </div>\n" +
        "\n" +
        "</div>";
    var obj = {
        render: function (e) {
            $('.showImgEdit').remove();
            $('body').append(html);
            var self = this,
                elem = e.elem,
                saveW = e.saveW,
                saveH = e.saveH,
                mark = e.mark,
                area = e.area,
                url = e.url,
                done = e.done;

            var content = $('.showImgEdit')
                , image = $(".showImgEdit .readyimg img")
                , preview = '.showImgEdit .img-preview'
                , file = $(".showImgEdit input[name='file']")
                , options = { aspectRatio: mark, preview: preview, viewMode: 1 };

            //修改图片按钮点击
            var cropperPage;
            $(elem).on('click', function () {
                cropperPage = layer.open({
                    id: 'imgCropperBox'
                    , title: '图片裁剪'
                    , type: 1
                    , content: content
                    , area: area
                    , success: function () {
                        image.cropper(options);
                    }
                    , cancel: function (index) {
                        layer.close('imgCropperBox');
                        image.cropper('destroy');
                    }
                });
            });
            $(".layui-btn").on('click', function () {
                var event = $(this).attr("cropper-event");
                //监听确认保存图像
                if (event === 'confirmSave') {
                    image.cropper("getCroppedCanvas", {
                        width: saveW,
                        height: saveH
                    }).toBlob(function (blob) {
                        var formData = new FormData();
                        formData.append('file', blob);
                        console.log(formData, cropperPage);
                        $.ajax({
                            method: "post",
                            url: url, //用于文件上传的服务器端请求地址
                            data: formData,
                            processData: false,
                            contentType: false,
                            success: function (result) {
                                if (result.status) {
                                    image.cropper('destroy');
                                    layer.close(cropperPage);
                                    return done(result.path);
                                } else if (result.code == -1) {
                                    layer.msg("上传失败，请重新提交", {
                                        icon: 2,
                                        time: 2000
                                    });
                                }

                            }
                        });
                    });
                    //监听旋转
                } else if (event === 'rotate') {
                    var option = $(this).attr('data-option');
                    image.cropper('rotate', option);
                    //重设图片
                } else if (event === 'reset') {
                    image.cropper('reset');
                }
                //文件选择
                file.change(function () {
                    var r = new FileReader();
                    var f = this.files[0];
                    r.readAsDataURL(f);
                    r.onload = function (e) {
                        image.cropper('destroy').attr('src', this.result).cropper(options);
                    };
                });
            });
        }

    };
    exports('croppers', obj);
});