<?php

namespace app\validate;
use think\Validate;
class HotelTag extends Validate
{
    protected  $db='hotel_tag';
    protected  $field=[
        'id'=>'酒店标签ID',
        'name'=>'酒店标签名称',
        'description'=>'酒店标签描述',
        'status'=>'酒店标签状态',
        'create_time'=>'创建时间',
        'update_time'=>'更新时间'
    ];
    protected $rule=[
        'name'=>'require|max:25|unique',
        'description'=>'max:255',
        'status'=>'require|in:0,1',
        'create_time'=>'require|datetime',
        'update_time'=>'require|datetime'
    ];
    protected $message=[
        'name.require'=>'酒店标签名称不能为空',
        'name.max'=>'酒店标签名称不能超过25个字符',
        'name.unique'=>'酒店标签名称已存在',
        'description.max'=>'酒店标签描述不能超过255个字符',
        'status.require'=>'酒店标签状态不能为空',
        'status.in'=>'酒店标签状态只能为0或1',
        'create_time.require'=>'创建时间不能为空',
        'create_time.datetime'=>'创建时间格式不正确',
        'update_time.require'=>'更新时间不能为空',
        'update_time.datetime'=>'更新时间格式不正确'
    ];
}