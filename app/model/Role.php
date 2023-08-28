<?php

namespace app\model;
use think\Model;
class Role extends Model
{
    protected  $table='role';
    protected $pk='id';
    protected $autoWriteTimestamp = true;
    protected $createTime = 'create_time';
    protected $updateTime = 'update_time';
    protected $dateFormat = 'Y-m-d H:i:s';
    protected  $schema=[
        'id'=>'int',
        'name'=>'string',
        'description'=>'string',
        'create_time'=>'datetime',
        'update_time'=>'datetime',
        'permissions'=>'array',
        'status'=>'int'
    ];
}