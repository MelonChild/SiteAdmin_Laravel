<?php

namespace App\Models;

use App\Models\BaseModel;

class Permission extends BaseModel {

    /**
     * 与模型关联的数据表
     *
     * @var string
     */
    protected $table = 'permissions';

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
     * 角色
     */
    public function menu()
    {
        return $this->belongsTo('App\Models\Menu', 'menu_id');
    }

}
