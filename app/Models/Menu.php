<?php

namespace App\Models;

use App\Models\BaseModel;

class Menu extends BaseModel {

    /**
     * 与模型关联的数据表
     *
     * @var string
     */
    protected $table = 'menus';

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
     * extend
     *
     * @param  string  $value
     * @return string
     */
    public function getExtendAttribute($value)
    {
        return $value>0?true:false;
    }

    /**
     * 子集
     */
    public function children()
    {
        return $this->hasMany('App\Models\Menu','pid');
    }
    
    /**
     * 父级
     */
    public function parent()
    {
        return $this->belongsTo('App\Models\Menu','pid');
    }
        
    /**
     * 权限表
     *
     * @param  string  $value
     * @return string
     */
    public function permissions()
    {
        $permissions = Permission::where('menu_id',$this->id)->get();
        return $permissions;
    }

}
