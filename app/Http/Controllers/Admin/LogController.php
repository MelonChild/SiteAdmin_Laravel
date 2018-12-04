<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Gate;

use App\Models\Log;

class LogController extends ResourceController
{

   /*
    |--------------------------------------------------------------------------
    |  Log Controller
    |--------------------------------------------------------------------------
    |
    | Log控制器，Log的CURD
    |
    */
       
    /**
     * getList
     *
     * @return \Illuminate\Http\Response
     */
    public function getList(Request $request)
    {
        //无权限，返回无权限信息
        if(Gate::denies('permission-check', strtolower($this->controller).'.list')){
            $returnData['code'] = 0;
            $returnData['msg'] = 'msg';
            $returnData['count'] = 0;
            $returnData['data'] = [];

            return $returnData;
        }

        $model = new $this->model;
        $keyword = $request->input('keyword', '');
        $begin = $request->input('begin', '');
        $end = $request->input('end', '');
        $type = $request->input('type', '');

        $page = (int) ($request->input('page', 1));
        $limit = (int) ($request->input('limit', 15));

        $count = $model->where(function($query) use ($keyword){
                    if($keyword){
                        $query->where('mark','like','%'.$keyword.'%')
                            ->orWhereHas('user',function($query) use ($keyword){
                                if($keyword){
                                    $query->where('username','like','%'.$keyword.'%');
                                }
                            });
                    }
                })
                ->where(function($query) {
                    //管理员查看全部，编辑只看自己
                    if(Gate::denies('permission-check', 'log.listall')){
                        $query->where('user_id',session('adminUserId'));
                    }
                })
                ->where(function($query) use($begin,$end) {
                    if($begin&&$end){
                        $query->whereBetween('created_at',[strtotime($begin),strtotime($end)]);
                    }
                })
                ->where(function($query) use($type) {
                    if($type){
                        $query->where('type',$type);
                    }
                })
                ->count();

        $data =  $model->where(function($query) use ($keyword){
                    if($keyword){
                        $query->where('mark','like','%'.$keyword.'%')
                            ->orWhereHas('user',function($query) use ($keyword){
                                if($keyword){
                                    $query->where('username','like','%'.$keyword.'%');
                                }
                            });
                    }
                })
                ->where(function($query) {
                    //管理员查看全部，编辑只看自己
                    if(Gate::denies('permission-check', 'log.listall')){
                        $query->where('user_id',session('adminUserId'));
                    }
                })
                ->where(function($query) use($begin,$end) {
                    if($begin&&$end){
                        $query->whereBetween('created_at',[strtotime($begin),strtotime($end)]);
                    }
                })
                ->where(function($query) use($type) {
                    if($type){
                        $query->where('type',$type);
                    }
                })
                ->skip(($page - 1) * $limit)->take($limit)->orderBy('id', 'desc')->get()->toArray();

        foreach ($data as $key => $value) {
            $data[$key]['created_at'] = date('y-m-d H:i',$value['created_at']);
        }

        $returnData['code'] = 0;
        $returnData['msg'] = '';
        $returnData['count'] = $count;
        $returnData['data'] = $data;

        return $returnData;
    }
}
