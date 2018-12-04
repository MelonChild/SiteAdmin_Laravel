<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Gate;

use App\Models\Permission;
use App\Models\Menu;

class PermissionController extends ResourceController
{

   /*
    |--------------------------------------------------------------------------
    |  Permission Controller
    |--------------------------------------------------------------------------
    |
    | Permission控制器，Permission的CURD
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
        $menu_id = $request->input('menu_id', '-1');
        $return = [];
        if ($keyword) {
            $return[0] = ['name', 'like', '%' . $keyword . '%'];
        }
        if ($menu_id>=0) {
            $return[1] = ['menu_id',$menu_id ];
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
        //获取所有菜单
        $datas['menus'] = Menu::where('pid','>',0)->orderBy('sort','desc')->with('children')->get();

        return $datas;
    }

    
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function beforeIndex(Request $request)
    {
         //获取所有菜单
         $datas['menus'] = Menu::where('pid','>',0)->orderBy('sort','desc')->with('children')->get();

         return $datas;
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
            $data[$key]['menuname'] = $value->menu['name']?$value->menu['name']:'其他';
        }
        return $data;
    }
}
