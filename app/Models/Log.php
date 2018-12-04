<?php

namespace App\Models;


class Log extends BaseModel {

    /**
     * 与模型关联的数据表
     *
     * @var string
     */
    protected $table = 'logs';

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
     * 用户
     */
    public function user()
    {
        return $this->belongsTo('App\Models\Users');
    }

}
