<?php

namespace App\Models;

use App\Models\BaseModel;

class Config extends BaseModel {

    /**
     * 与模型关联的数据表
     *
     * @var string
     */
    protected $table = 'configs';

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

}
