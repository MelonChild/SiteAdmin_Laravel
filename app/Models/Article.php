<?php

namespace App\Models;

use App\Models\BaseModel;

class Article extends BaseModel {

    /**
     * 与模型关联的数据表
     *
     * @var string
     */
    protected $table = 'articles';

    /**
     * 表明模型是否应该被打上时间戳
     *
     * @var bool
     */
    public $timestamps = true;

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

}
