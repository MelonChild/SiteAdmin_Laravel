<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class BaseController extends Controller
{
   /*
    |--------------------------------------------------------------------------
    | Base Controller
    |--------------------------------------------------------------------------
    |
    | 基控制器，定义中间件及公用方法
    |
    */

    protected $model;       //当前模型
    protected $controller;  //当前控制器

    public function __construct()
    {
        $this->middleware('auth:admin');

        $route = get_current_url();
        // 当前控制器
        $this->controller = $route['controller'];
        // 当前模型
        $this->model = "App\Models\\".$this->controller.($this->controller=="User"?'s':'');
    }

    /**
     * uploadFile
     * 上传文件
     *
     * @param  Request  $request
     * @return Response
     */
    public function uploadFile(Request $request)
    {
        //dd($request->file('file'));
        $path = $request->file('file')->store('uploads/temp');

        $returnData['status'] = Storage::exists($path);
        $returnData['path'] = $path;

        return $returnData;
    }

    
    /**
     * Update the avatar for the user.
     *
     * @param  Request  $request
     * @return Response
     */
    public function draftPicUpload(Request $request)
    {
        //dd($request->file('file'));
        $path = $request->file('file')->store('uploads/temp');
        $result = Storage::exists($path);

        if($result){
            $returnData['code'] = 0;
            $returnData['msg'] = 'success';
            $returnData['data']['src'] = '/'.$path;
        } else {
            $returnData['code'] = 1;
            $returnData['msg'] = "图片上传失败";
        }

        return $returnData;
    }

}
