<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <title>异常</title>
        <meta name="renderer" content="webkit">
        <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
        <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
        <!-- <link href="/admin/lib/layui/css/layui.css" rel="stylesheet" /> -->
    </head>
    <body>
        <fieldset class="layui-elem-field layui-field-title" style="margin-top: 20px;border-color: #e6e6e6;margin: 10px 0 20px;border-width: 0;border-top-width: 1px;padding: 0;border-style: solid;">
        <legend style="margin-left: 20px;padding: 0 10px;font-size: 20px;font-weight: 300;">网站异常</legend>
        </fieldset>   
    
        <div style="padding: 20px; background-color: #F2F2F2;">
            <div class="layui-row layui-col-space15" style="margin: -7.5px;">
                <div class="layui-col-md6" style="padding: 7.5px;position: relative;display: block;box-sizing: border-box;">
                    <div class="layui-card" style="margin-bottom: 0;border-radius: 2px;background-color: #fff;box-shadow: 0 1px 2px 0 rgba(0,0,0,.05);">
                        <div class="layui-card-header layui-bg-red" style="background-color: #FFB800 !important;color: #fff!important;position: relative;height: 42px;line-height: 42px;padding: 0 15px;border-bottom: 1px solid #f6f6f6;border-radius: 2px 2px 0 0;font-size: 14px;">路由信息</div>
                        <div class="layui-card-body" style="position: relative;padding: 10px 15px;line-height: 24px;">
                            <ul class="layui-timeline" style="padding-left: 5px;">
                                <li class="layui-timeline-item" style="position: relative;list-style: none;padding-bottom: 20px;">
                                    <i style="display: block;content: '';position: absolute;left: 5px;top: 0;z-index: 0;width: 1px;height: 100%;background-color: #e6e6e6;"></i>
                                    <i class="layui-icon layui-timeline-axis" style="position: absolute;left: -5px;top: 0;z-index: 10;width: 20px;height: 20px;line-height: 20px;background-color: #fff;color: #5FB878;border-radius: 50%;text-align: center;cursor: pointer;font-size: 16px;font-style: normal;-webkit-font-smoothing: antialiased;"></i>
                                    <div class="layui-timeline-content layui-text" style="padding-left: 25px;line-height: 22px;font-size: 14px;color: #666;">
                                        <h3 class="layui-timeline-title" style="font-size: 18px;font-weight: 500;color: #333;position: relative;margin-bottom: 10px;">路由</h3>
                                        <p> {{$data['path']}}</p>
                                    </div>
                                </li>
                                <li class="layui-timeline-item" style="position: relative;list-style: none;padding-bottom: 20px;">
                                    <i style="display: block;content: '';position: absolute;left: 5px;top: 0;z-index: 0;width: 1px;height: 100%;background-color: #e6e6e6;"></i>
                                    <i class="layui-icon layui-timeline-axis" style="position: absolute;left: -5px;top: 0;z-index: 10;width: 20px;height: 20px;line-height: 20px;background-color: #fff;color: #5FB878;border-radius: 50%;text-align: center;cursor: pointer;font-size: 16px;font-style: normal;-webkit-font-smoothing: antialiased;"></i>
                                    <div class="layui-timeline-content layui-text" style="padding-left: 25px;line-height: 22px;font-size: 14px;color: #666;">
                                        <h3 class="layui-timeline-title" style="font-size: 18px;font-weight: 500;color: #333;position: relative;margin-bottom: 10px;">状态</h3>
                                        <p> {{$data['urlstatus']}}</p>
                                    </div>
                                </li>
                                <li class="layui-timeline-item" style="position: relative;list-style: none;padding-bottom: 20px;">
                                    <i style="display: block;content: '';position: absolute;left: 5px;top: 0;z-index: 0;width: 1px;height: 100%;background-color: #e6e6e6;"></i>
                                    <i class="layui-icon layui-timeline-axis" style="position: absolute;left: -5px;top: 0;z-index: 10;width: 20px;height: 20px;line-height: 20px;background-color: #fff;color: #5FB878;border-radius: 50%;text-align: center;cursor: pointer;font-size: 16px;font-style: normal;-webkit-font-smoothing: antialiased;"></i>
                                    <div class="layui-timeline-content layui-text" style="padding-left: 25px;line-height: 22px;font-size: 14px;color: #666;">
                                        <h3 class="layui-timeline-title" style="font-size: 18px;font-weight: 500;color: #333;position: relative;margin-bottom: 10px;">时间</h3>
                                        <p> {{date('Y-m-d H:i:s',$data['time'])}}</p>
                                    </div>
                                </li>
                            </ul>  
                        </div>
                    </div>
                </div>

                <div class="layui-col-md6" style="padding: 7.5px;position: relative;display: block;box-sizing: border-box;">
                    <div class="layui-card" style="margin-bottom: 0;border-radius: 2px;background-color: #fff;box-shadow: 0 1px 2px 0 rgba(0,0,0,.05);">
                        <div class="layui-card-header layui-bg-red" style="background-color: #FF5722 !important;color: #fff!important;position: relative;height: 42px;line-height: 42px;padding: 0 15px;border-bottom: 1px solid #f6f6f6;border-radius: 2px 2px 0 0;font-size: 14px;">异常信息</div>
                        <div class="layui-card-body" style="position: relative;padding: 10px 15px;line-height: 24px;">
                            <ul class="layui-timeline" style="padding-left: 5px;">
                                <li class="layui-timeline-item" style="position: relative;list-style: none;padding-bottom: 20px;">
                                    <i style="display: block;content: '';position: absolute;left: 5px;top: 0;z-index: 0;width: 1px;height: 100%;background-color: #e6e6e6;"></i>
                                    <i class="layui-icon layui-timeline-axis" style="position: absolute;left: -5px;top: 0;z-index: 10;width: 20px;height: 20px;line-height: 20px;background-color: #fff;color: #5FB878;border-radius: 50%;text-align: center;cursor: pointer;font-size: 16px;font-style: normal;-webkit-font-smoothing: antialiased;"></i>
                                    <div class="layui-timeline-content layui-text" style="padding-left: 25px;line-height: 22px;font-size: 14px;color: #666;">
                                        <h3 class="layui-timeline-title" style="font-size: 18px;font-weight: 500;color: #333;position: relative;margin-bottom: 10px;">异常类型</h3>
                                        <p> {{$data['type']}}</p>
                                    </div>
                                </li>
                                <li class="layui-timeline-item" style="position: relative;list-style: none;padding-bottom: 20px;">
                                    <i style="display: block;content: '';position: absolute;left: 5px;top: 0;z-index: 0;width: 1px;height: 100%;background-color: #e6e6e6;"></i>
                                    <i class="layui-icon layui-timeline-axis" style="position: absolute;left: -5px;top: 0;z-index: 10;width: 20px;height: 20px;line-height: 20px;background-color: #fff;color: #5FB878;border-radius: 50%;text-align: center;cursor: pointer;font-size: 16px;font-style: normal;-webkit-font-smoothing: antialiased;"></i>
                                    <div class="layui-timeline-content layui-text" style="padding-left: 25px;line-height: 22px;font-size: 14px;color: #666;">
                                        <h3 class="layui-timeline-title" style="font-size: 18px;font-weight: 500;color: #333;position: relative;margin-bottom: 10px;">异常码</h3>
                                        <p> {{$data['code']}}</p>
                                    </div>
                                </li>
                                @if(isset($data['statusCode']))
                                <li class="layui-timeline-item" style="position: relative;list-style: none;padding-bottom: 20px;">
                                    <i style="display: block;content: '';position: absolute;left: 5px;top: 0;z-index: 0;width: 1px;height: 100%;background-color: #e6e6e6;"></i>
                                    <i class="layui-icon layui-timeline-axis" style="position: absolute;left: -5px;top: 0;z-index: 10;width: 20px;height: 20px;line-height: 20px;background-color: #fff;color: #5FB878;border-radius: 50%;text-align: center;cursor: pointer;font-size: 16px;font-style: normal;-webkit-font-smoothing: antialiased;"></i>
                                    <div class="layui-timeline-content layui-text" style="padding-left: 25px;line-height: 22px;font-size: 14px;color: #666;">
                                        <h3 class="layui-timeline-title" style="font-size: 18px;font-weight: 500;color: #333;position: relative;margin-bottom: 10px;">异常码</h3>
                                        <p> {{$data['statusCode']}}</p>
                                    </div>
                                </li>
                                @endif
                                <li class="layui-timeline-item" style="position: relative;list-style: none;padding-bottom: 20px;">
                                    <i style="display: block;content: '';position: absolute;left: 5px;top: 0;z-index: 0;width: 1px;height: 100%;background-color: #e6e6e6;"></i>
                                    <i class="layui-icon layui-timeline-axis" style="position: absolute;left: -5px;top: 0;z-index: 10;width: 20px;height: 20px;line-height: 20px;background-color: #fff;color: #5FB878;border-radius: 50%;text-align: center;cursor: pointer;font-size: 16px;font-style: normal;-webkit-font-smoothing: antialiased;"></i>
                                    <div class="layui-timeline-content layui-text" style="padding-left: 25px;line-height: 22px;font-size: 14px;color: #666;">
                                        <h3 class="layui-timeline-title" style="font-size: 18px;font-weight: 500;color: #333;position: relative;margin-bottom: 10px;">异常信息</h3>
                                        <p> {{$data['msg']}}</p>
                                    </div>
                                </li>
                                <li class="layui-timeline-item" style="position: relative;list-style: none;padding-bottom: 20px;">
                                    <i style="display: block;content: '';position: absolute;left: 5px;top: 0;z-index: 0;width: 1px;height: 100%;background-color: #e6e6e6;"></i>
                                    <i class="layui-icon layui-timeline-axis" style="position: absolute;left: -5px;top: 0;z-index: 10;width: 20px;height: 20px;line-height: 20px;background-color: #fff;color: #5FB878;border-radius: 50%;text-align: center;cursor: pointer;font-size: 16px;font-style: normal;-webkit-font-smoothing: antialiased;"></i>
                                    <div class="layui-timeline-content layui-text" style="padding-left: 25px;line-height: 22px;font-size: 14px;color: #666;">
                                        <h3 class="layui-timeline-title" style="font-size: 18px;font-weight: 500;color: #333;position: relative;margin-bottom: 10px;">异常文件</h3>
                                        <p> {{$data['file']}}</p>
                                    </div>
                                </li>
                                <li class="layui-timeline-item" style="position: relative;list-style: none;padding-bottom: 20px;">
                                    <i style="display: block;content: '';position: absolute;left: 5px;top: 0;z-index: 0;width: 1px;height: 100%;background-color: #e6e6e6;"></i>
                                    <i class="layui-icon layui-timeline-axis" style="position: absolute;left: -5px;top: 0;z-index: 10;width: 20px;height: 20px;line-height: 20px;background-color: #fff;color: #5FB878;border-radius: 50%;text-align: center;cursor: pointer;font-size: 16px;font-style: normal;-webkit-font-smoothing: antialiased;"></i>
                                    <div class="layui-timeline-content layui-text" style="padding-left: 25px;line-height: 22px;font-size: 14px;color: #666;">
                                        <h3 class="layui-timeline-title" style="font-size: 18px;font-weight: 500;color: #333;position: relative;margin-bottom: 10px;">异常位置</h3>
                                        <p> {{$data['line']}}</p>
                                    </div>
                                </li>
                            </ul>  
                        </div>
                    </div>
                </div>
                
                <div class="layui-col-md6" style="padding: 7.5px;position: relative;display: block;box-sizing: border-box;">
                    <div class="layui-card" style="margin-bottom: 0;border-radius: 2px;background-color: #fff;box-shadow: 0 1px 2px 0 rgba(0,0,0,.05);">
                        <div class="layui-card-header layui-bg-red" style="background-color: #1E9FFF !important;color: #fff!important;position: relative;height: 42px;line-height: 42px;padding: 0 15px;border-bottom: 1px solid #f6f6f6;border-radius: 2px 2px 0 0;font-size: 14px;">TRACE</div>
                        <div class="layui-card-body" style="position: relative;padding: 10px 15px;line-height: 24px;">
                            <ul class="layui-timeline" style="padding-left: 5px;">
                               @forelse($data['trace'] as $trace)
                                <li class="layui-timeline-item" style="position: relative;list-style: none;padding-bottom: 20px;">
                                        <i style="display: block;content: '';position: absolute;left: 5px;top: 0;z-index: 0;width: 1px;height: 100%;background-color: #e6e6e6;"></i>
                                        <i class="layui-icon layui-timeline-axis" style="position: absolute;left: -5px;top: 0;z-index: 10;width: 20px;height: 20px;line-height: 20px;background-color: #fff;color: #5FB878;border-radius: 50%;text-align: center;cursor: pointer;font-size: 16px;font-style: normal;-webkit-font-smoothing: antialiased;"></i>
                                        <div class="layui-timeline-content layui-text" style="padding-left: 25px;line-height: 22px;font-size: 14px;color: #666;">
                                            <h3 class="layui-timeline-title" style="font-size: 18px;font-weight: 500;color: #333;position: relative;margin-bottom: 10px;">{{isset($trace['class'])?$trace['class']:''}}</h3>
                                            <p>文件：{{isset($trace['file'])?$trace['file']:''}}</p>
                                            <p>行数：{{isset($trace['line'])?$trace['line']:''}}</p>
                                            <p>方法：{isset($trace['function'])?$trace['function']:''}}</p>
                                            <p>类型：{{isset($trace['type'])?$trace['type']:''}}</p>
                                        </div>
                                    </li>
                               @empty
                               @endforelse
                            </ul>
                        </div>
                    </div>
                </div>
                
            </div>
        </div> 

    </body>
</html>