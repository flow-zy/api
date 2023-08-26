<?php

namespace app\validate;
use think\Validate;

class Member extends Validate
{
    protected  $db='member';
    protected  $field=[
        'id'=>'会员ID',
        'name'=>'会员姓名',
        'age'=>'年龄',
        'gender'=>'性别',
        'country'=>'国家',
        'city'=>'城市',
        'password'=>'密码',
        'avatar'=>'头像',
        'member_type_id'=>'会员类型ID（外键，关联到会员类型的id列）',
        'registration'=>'注册时间',
        'payment_password'=>'支付密码',
        'create_time'=>'创建时间',
        'update_time'=>'更新时间',
        'status'=>'会员状态'
    ];
    protected  $type=[
        'id'=>'number',
        'name'=>'string|require|unique',
        'age'=>'number|between:0,120',
        'gender'=>'number|in:男,女',
        'country'=>'string',
        'city'=>'string',
        'password'=>'string',
        'avatar'=>'string',
        'member_type_id'=>'number',
        'registration'=>'datetime',
        'payment_password'=>'string|required',
        'create_time'=>'datetime',
        'update_time'=>'date',
        'status'=>'number|in:-1,0,1'
    ];
    protected  $message=[
        'name.string'=>'会员姓名必须为字符串',
        'name.require'=>'会员姓名不能为空',
        'name.unique'=>'会员姓名不能重复',
        'age.number'=>'年龄必须为数字',
        'age.between'=>'年龄必须在0-120之间',
        'gender.number'=>'性别必须为数字',
        'gender.in'=>'性别必须为男或女',
        'country.string'=>'国家必须为字符串',
        'city.string'=>'城市必须为字符串',
        'password.string'=>'密码必须为字符串',
        'avatar.string'=>'头像必须为字符串',
        'member_type_id.number'=>'会员类型ID必须为数字',
        'registration.datetime'=>'注册时间必须为时间',
        'payment_password.string'=>'支付密码必须为字符串',
        'payment_password.required'=>'支付密码不能为空',
        'create_time.datetime'=>'创建时间必须为时间',
        'update_time.date'=>'更新时间必须为时间',
        'status.number'=>'状态必须为数字',
        'status.in'=>'状态必须为-1,0,1'
    ];
}