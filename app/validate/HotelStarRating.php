<?php

namespace app\validate;
use think\Validate;
class HotelStarRating extends  Validate
{
    protected $db='hotel_star_rating';
    protected $rule = [
        'id' => 'require|number',
        'name' => 'require|max:50|unique',
        'description' => 'max:200',
        'create_time' => 'require|datetime',
        'update_time' => 'datetime',
        'status' => 'require|number|in:0,1',
    ];
    protected $message = [
        'name.require' => '酒店星级名称不能为空',
        'name.max' => '酒店星级名称不能超过50个字符',
        'name.unique' => '酒店星级名称已经存在',
        'description.max' => '酒店星级描述不能超过200个字符',
        'status.require' => '酒店星级状态不能为空',
        'status.number' => '酒店星级状态必须是数字',
        'status.in' => '酒店星级状态必须是0或1',
        'create_time.require' => '创建时间不能为空',
        'create_time.datetime' => '创建时间格式错误',
        'update_time.datetime' => '更新时间格式错误'
    ];
}