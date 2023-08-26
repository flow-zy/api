<?php

namespace app\validate;
use think\Validate;
class MemberType extends Validate
{
    protected  $db='member_type';
    protected  $field=[
        'name'=>'会员类型名称',
        'description'=>'会员类型描述',
        'member_permissions'=>'会员权限',
        'status'=>'会员类型状态',
        'create_time'=>'创建时间',
        'update_time'=>'更新时间',
        'id'=>'会员类型ID'
    ];
    protected $rule=[
        'name'=>'require|unique:member_type',
        'description'=>'require',
        'member_permissions'=>'require',
        'status'=>'require',
        'create_time'=>'require',
        'update_time'=>'require'
    ];
    protected $message=[
        'name.require'=>'会员类型名称不能为空',
        'name.unique'=>'会员类型名称已存在',
        'description.require'=>'会员类型描述不能为空',
        'member_permissions.require'=>'会员权限不能为空',
        'status.require'=>'会员类型状态不能为空',
        'create_time.require'=>'创建时间不能为空',
        'update_time.require'=>'更新时间不能为空'
    ];

}