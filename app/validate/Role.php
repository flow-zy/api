<?php

namespace app\validate;
use think\Validate;

class Role extends Validate
{
    protected  $db='role';
    protected  $field=[
       'id'=>'角色ID',
       'name'=>'角色名称',
       'description'=>'角色描述',
       'status'=>'角色状态',
       'create_time'=>'创建时间',
       'update_time'=>'更新时间',
       'permissions'=>'权限列表'
    ];
    protected $type = [
        'id' => 'integer',
        'name' => 'string',
        'description' => 'string',
        'create_time' => 'datetime',
        'update_time' => 'datetime',
        'permissions' => 'array',
        'status' => 'integer'
    ];

    protected $rule = [
        'name' => 'require|string|max:10|min:2|unique',
        'description' => 'string',
        'create_time' => 'datetime',
        'update_time' => 'datetime',
        'status'=>'require|integer|in:0,1',
        'permissions'=>'require|array'
    ];

    protected  $message=[
        'name.require'=>'角色名不能为空',
        'name.string'=>'角色名必须为字符串',
        'name.max'=>'角色名不能超过10个字符',
        'name.min'=>'角色名不能少于2个字符',
        'name.unique'=>'角色名不能重复',
        'description.string'=>'描述必须为字符串',
        'status.require'=>'状态必须为数字',
        'status.integer'=>'状态必须为数字',
        'status.in'=>'状态必须为0或1',
        'permissions.require'=>'权限不能为空',
        'permissions.array'=>'权限必须为数组'
    ];
    protected $scene = [

    ];

}