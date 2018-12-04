<?php

namespace App\Models;

use App\Models\BaseModel;

class Role extends BaseModel {

    /**
     * 与模型关联的数据表
     *
     * @var string
     */
    protected $table = 'roles';

    /**
     * 表明模型是否应该被打上时间戳
     *
     * @var bool
     */
    public $timestamps = false;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $guarded = [];


    /**
     * 角色菜单
     */
    public function menus()
    {
        return $this->belongsToMany('App\Models\Menu','role_menu');
    }

    
    /**
     * 角色权限
     */
    public function permissions()
    {
        return $this->belongsToMany('App\Models\Permission','role_permission');
    }

}
