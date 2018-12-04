<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Gate;

use App\Models\Role;
use App\Models\Menu;
use App\Models\Permission;

class RoleController extends ResourceController
{

   /*
    |--------------------------------------------------------------------------
    |  Role Controller
    |--------------------------------------------------------------------------
    |
    | Role控制器，Role的CURD
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

        $returnData['data'] = $datas;
        return $returnData;
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function beforeShow(Request $request, $id)
    {
        //获取所有菜单
        $datas['menus'] = Menu::where('pid','>',0)->orderBy('sort','desc')->with('children')->get();

        //查找当前已有的菜单
        $datas['menuIds'] = DB::table('role_menu')->where('role_id',$id)->pluck('menu_id')->toArray();
        $datas['permissionIds'] = DB::table('role_permission')->where('role_id',$id)->pluck('permission_id')->toArray();

        //查看其它权限
        $datas['others'] = Permission::where('menu_id',0)->get();

        return $datas;
    }

    /**
     * 更新角色权限
     *
     * @return \Illuminate\Http\Response
     */
    public function upMenus(Request $request)
    {
        //返回信息
        $returnData['status'] = false;
        $returnData['msg'] = 'fail';

        //无权限，返回无权限信息
        if(Gate::denies('permission-check', 'role.permission')){
            $returnData['msg'] = '暂无权限';
            return $returnData;
        }

        //获取数据
        $datas = $request->except(['_token', '_method']);
        $model = new $this->model;
        
        $detail = $model->where('id', $datas['id'])->first();
        $menus = $request->input('menu',[]);
        $permissions = $request->input('permission',[]);


        if($detail){
           //保存信息
            $result = $detail->menus()->sync($menus);
            $result = $detail->permissions()->sync($permissions);

            if ($result) {
                $returnData['status'] = true;
                $returnData['msg'] = 'success';

                generate_log(6,'更新角色（'.$detail['name'].'）'.'的权限表');
            }

        } else{
            $returnData['msg'] = $before['msg'];
        }

        return $returnData;
    }

    
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function delete(Request $request)
    {
        $returnData['status'] = false;
        $returnData['msg'] = '删除失败';

        //无权限，返回无权限信息
        if(Gate::denies('permission-check', strtolower($this->controller).'.delete')){
            $returnData['msg'] = '暂无权限';
            return $returnData;
        }
        //
        $ids = $request->input('ids', '');

        $arrIds = explode(',', $ids);
        $model = new $this->model;

        foreach ($arrIds as $key => $id) {
            if ($id>3) {
                $detail = $model->where('id', $id)->first()->toArray();
                $result = $model->destroy($id);
                $this->afterDelete($request, $result, $detail);
            }
        }
        $returnData['status'] = true;
        $returnData['msg'] = '删除成功';
        generate_log(4,'删除数据ID：'.$ids.',控制器为：'.$this->controller);

        return $returnData;
    }

}
