<?php

namespace app\validate;
use think\Validate;
class Hotel extends Validate
{
    protected  $db='hotel';
    protected  $field=[
        'id'=>'酒店ID',
        'name'=>'酒店名称',
        'address'=>'酒店地址',
        'star_rating_id'=>'酒店星级',
        'tag_id'=>'酒店标签',
        'create_time'=>'创建时间',
        'update_time'=>'更新时间',
        'status'=>'状态',
    ];
    protected $rule=[
        'name'=>'require|max:100|unique',
        'address'=>'require|max:100',
        'star_rating_id'=>'require|number',
        'tag_id'=>'require|number',
        'create_time'=>'require|datetime',
        'update_time'=>'require|datetime',
        'status'=>'require|integer|in:0,1'
    ];
    protected $message=[
        'name.require'=>'酒店名称不能为空',
        'name.max'=>'酒店名称不能超过100个字符',
        'name.unique'=>'酒店名称已存在',
        'address.require'=>'酒店地址不能为空',
        'address.max'=>'酒店地址不能超过100个字符',
        'star_rating_id.require'=>'酒店星级不能为空',
        'star_rating_id.number'=>'酒店星级必须是数字',
        'tag_id.require'=>'酒店标签不能为空',
        'tag_id.number'=>'酒店标签必须是数字',
        'create_time.require'=>'创建时间不能为空',
        'create_time.datetime'=>'创建时间格式错误',
        'update_time.require'=>'更新时间不能为空',
        'update_time.datetime'=>'更新时间格式错误',
        'status.require'=>'状态不能为空',
        'status.integer'=>'状态必须是数字',
        'status.in'=>'状态取值范围错误'
    ];
}