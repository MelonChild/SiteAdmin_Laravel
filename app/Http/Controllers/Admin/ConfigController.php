<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Gate;

use App\Models\Config;

class ConfigController extends ResourceController
{
    
    /**
     * beforeUpdate
     * 组合需要更新的数组
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        //无权限，转至403页面
        if(Gate::denies('permission-check', 'config.index')){
            abort(403);
        }
        //保存信息
        if($request->isMethod('post')){

            //返回信息
            $returnData['status'] = false;
            $returnData['msg'] = 'fail';

            if(Gate::denies('permission-check', 'config.index')){
                $returnData['msg'] = '没有权限';
                return $returnData;
            }

            //获取数据
            $datas = $request->except(['_token','file']);
            $datas['data']['notice'] = $datas['content'];

            if($datas['data']){
                foreach ($datas['data'] as $key => $value) {
                    
                    $config = Config::firstOrCreate(['name'=>$key]);
                    $config->content = $value;
                    $config->save();
                }
                generate_log(3,'更新网站配置项');

                $returnData['status'] = true;
                $returnData['msg'] = 'success';

            } else{
                $returnData['msg'] = '数据不正确';
            }

            return $returnData;
        }

        //获取数据

        $datas = Config::get()->toArray();

        return view('admin.config.index',compact('datas'));
    }

}
