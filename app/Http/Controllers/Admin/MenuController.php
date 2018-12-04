<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Gate;

use App\Models\Menu;

class MenuController extends ResourceController
{

   /*
    |--------------------------------------------------------------------------
    |  Menu Controller
    |--------------------------------------------------------------------------
    |
    | Menu控制器，Menu的CURD
    |
    */
    
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function beforeIndex(Request $request)
    {
         //获取所有菜单
         $datas['menus'] = Menu::where('pid',0)->orderBy('sort','desc')->with('children')->get();

         return $datas;
    }

    
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function beforeCreate(Request $request)
    {
        //获取所有菜单
        $datas['menus'] = Menu::where('pid','>',0)->orderBy('sort','desc')->with('children')->get();

        return $datas;
    }


        
    /**
     * beforeEdit
     *
     * @return \Illuminate\Http\Response
     */
    public function beforeEdit(Request $request,$id)
    {
        //
        $datas['menus'] = Menu::where('pid','>',0)->orderBy('sort','desc')->with('children')->get();
        return $datas;
    }
    
    /**
     * getListCondition
     * 创建查找条件
     *
     * @return \Illuminate\Http\Response
     */
    public function getListCondition(Request $request)
    {
        $keyword = $request->input('keyword', '');
        $menu_id = $request->input('menu_id', '-1');
        $return = [];
        if ($keyword) {
            $return[0] = ['name', 'like', '%' . $keyword . '%'];
        }
        if ($menu_id>=0) {
            $return[1] = ['pid',$menu_id ];
        }
        return $return;
    }


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

        //是否展开
        if(isset($datas['spread'])){
            $datas['spread'] = 1;
        } else {
            $datas['spread'] = 0;
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
        
        
        //是否展开
        if(isset($datas['spread'])){
            $datas['spread'] = 1;
        } else {
            $datas['spread'] = 0;
        }

        //是否禁用
        if(isset($datas['active'])){
            $datas['active'] = 1;
        } else {
            $datas['active'] = 0;
        }

        $returnData['data'] = $datas;
        return $returnData;
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
            $data[$key]['pname'] = $value->parent?$value->parent->name:'顶级菜单';
            $data[$key] = $value->toArray();
        }
        return $data;
    }
}
