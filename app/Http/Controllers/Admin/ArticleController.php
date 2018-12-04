<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

use App\Models\Article;

class ArticleController extends ResourceController
{

   /*
    |--------------------------------------------------------------------------
    |  Article Controller
    |--------------------------------------------------------------------------
    |
    | 文章控制器，文章的CURD
    |
    */

    /**
     * beforeUpdate
     * 组合需要更新的数组
     *
     * @return \Illuminate\Http\Response
     */
    public function beforeUpdate(Request $request,$datas,$detail)
    {
        $returnData['status'] = true;
        $returnData['msg'] = 'success';

        //查看用户名是否重复
        $model = new $this->model;
        $has = $model->where('name',$datas['name'])->where('name','<>',$detail['name'])->first();
        if($has){
            $returnData['status'] = false;
            $returnData['msg'] = '该数据已存在';
            return $returnData;
        }

        //是否禁用
        if(isset($datas['active'])){
            $datas['active'] = 1;
        } else {
            $datas['active'] = 0;
        }

       //判断是否修改图片
       if($datas['imgpath'] != $detail['imgpath']&&(Storage::exists($datas['imgpath']))){
            //移动图片 并更新
            Storage::move($datas['imgpath'], str_replace('temp','common',$datas['imgpath']));
            $datas['imgpath']=str_replace('temp','common',$datas['imgpath']);
        } else {
            $datas['imgpath']=$detail['imgpath'];
        }

        $returnData['data'] = $datas;
        return $returnData;
    }

     /**
     * beforeStore
     * 组合需要更新的数组
     *
     * @return \Illuminate\Http\Response
     */
    public function beforeStore(Request $request,$datas)
    {
        $returnData['status'] = true;
        $returnData['msg'] = 'success';

        // 查看是否可存
        $model = new $this->model;
        $has = $model->where('name',$datas['name'])->first();

        if($has){
            $returnData['status'] = false;
            $returnData['msg'] = '该数据已存在';
            return $returnData;
        }
        

        //是否禁用
        if(isset($datas['active'])){
            $datas['active'] = 1;
        } else {
            $datas['active'] = 0;
        }


       //判断是否修改图片
       if(Storage::exists($datas['imgpath'])){
            //移动图片 并更新
            Storage::move($datas['imgpath'], str_replace('temp','common',$datas['imgpath']));
            $datas['imgpath']=str_replace('temp','common',$datas['imgpath']);
        } else {
            $datas['imgpath']='';
        }

        $returnData['data'] = $datas;
        return $returnData;
    }

    /**
     * afterUpdate
     * 后置操作，如果修改了图片，删除之前的
     *
     * @return \Illuminate\Http\Response
     */
    public function afterUpdate(Request $request,$returnData,$detail)
    {
        //删除替换之前的图片
        $imgpath = $request->input('imgpath','');
        if($returnData['status']&&$imgpath != $detail['imgpath']&&Storage::exists($detail['imgpath'])){
            Storage::delete($detail['imgpath']);
        }
        return $returnData;
    }

    
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function afterDelete(Request $request,$result,$detail)
    {
        //
        if($result&&Storage::exists($detail['imgpath'])){
            Storage::delete($detail['imgpath']);
        }
        return true;
    }

    /**
     * formatData
     *
     * @return \Illuminate\Http\Response
     */
    public function formatData($data)
    {
        //
        foreach ($data as $key => $value) {
            $data[$key]['created_date'] = date('Y-m-d',$value['created_at']->timestamp);
            $data[$key]['updated_date'] = date('Y-m-d',$value['updated_at']->timestamp);
        }
        return $data;
    }
}
