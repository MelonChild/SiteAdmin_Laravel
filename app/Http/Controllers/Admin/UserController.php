<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

use App\Models\Users;
use App\Models\Role;
use App\Models\Site;

class UserController extends ResourceController
{

   /*
    |--------------------------------------------------------------------------
    | User Controller
    |--------------------------------------------------------------------------
    |
    | 用户控制器，用户的CURD
    |
    */

    /**
     * getListCondition
     * 创建查找条件
     *
     * @return \Illuminate\Http\Response
     */
    public function getListCondition(Request $request)
    {
        $keyword = $request->input('keyword', '');
        $return = [];
        if($keyword){
            $return[0] = ['username','like','%'.$keyword.'%'];
        }
        return $return;
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function beforeCreate(Request $request)
    {
        //
        $data['roles'] = Role::orderBy('sort')->get()->toArray();
        return $data;
    }

        
    /**
     * beforeEdit
     *
     * @return \Illuminate\Http\Response
     */
    public function beforeEdit(Request $request,$id)
    {
        //
        $data['roles'] = Role::orderBy('sort')->get()->toArray();
        return $data;
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
        $has = $model->where('username',$datas['username'])->where('username','<>',$detail['username'])->first();
        if($has){
            $returnData['status'] = false;
            $returnData['msg'] = '该用户已存在';
            return $returnData;
        }

        //是否禁用
        if(isset($datas['active'])){
            $datas['active'] = 1;
        } else {
            $datas['active'] = 0;
        }

        //判断是否更改密码
        if(isset($datas['password'])){
            $datas['password'] = Hash::make($datas['password']);
        } else {
            unset($datas['password']);
        }

       //判断是否修改头像
       if($datas['avatar'] != $detail['avatar']&&(Storage::exists($datas['avatar']))){
            //移动图片 并更新
            Storage::move($datas['avatar'], str_replace('temp','avatar',$datas['avatar']));
            $datas['avatar']=str_replace('temp','avatar',$datas['avatar']);
        } else {
            $datas['avatar']=$detail['avatar'];
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
        $has = $model->where('username',$datas['username'])->first();

        if($has){
            $returnData['status'] = false;
            $returnData['msg'] = '该用户已存在';
            return $returnData;
        }
        

        //是否禁用
        if(isset($datas['active'])){
            $datas['active'] = 1;
        } else {
            $datas['active'] = 0;
        }

        //判断是否更改密码
        $datas['password'] = Hash::make($datas['password']);

       //判断是否修改头像
       if(Storage::exists($datas['avatar'])){
            //移动图片 并更新
            Storage::move($datas['avatar'], str_replace('temp','avatar',$datas['avatar']));
            $datas['avatar']=str_replace('temp','avatar',$datas['avatar']);
        } else {
            $datas['avatar']='';
        }

        $returnData['data'] = $datas;
        return $returnData;
    }

    /**
     * afterUpdate
     * 后置操作，如果修改了头像，删除之前的
     *
     * @return \Illuminate\Http\Response
     */
    public function afterUpdate(Request $request,$returnData,$detail)
    {
        //删除替换之前的头像
        $avatar = $request->input('avatar','');
        if($returnData['status']&&$avatar != $detail['avatar']&&Storage::exists($detail['avatar'])){
            Storage::delete($detail['avatar']);
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
        if($result&&Storage::exists($detail['avatar'])){
            Storage::delete($detail['avatar']);
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

        foreach($data as $key=>$value) {
            $data[$key]['rolename'] = $value['role']['name'];
            $data[$key]['lastTime'] = date('Y-m-d H:i',$value['last_login']);
        }
        return $data;
    }

}
