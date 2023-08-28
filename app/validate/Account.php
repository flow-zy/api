<?php

namespace app\validate;
use think\Validate;
class Account extends Validate
{
    // 校验规则
    protected $rule = [
        'username' => 'require|string|max:10|min:2|unique',
        'password' => 'require|string|min:6|max:20',
        'status' => 'require|integer|in:0,1',
        'create_time' => 'require|datetime',
        'update_time' => 'datetime',
        'email' => 'email',
        'phone'=>'mobile',
        'role_id'=>'integer|gt:0'
    ];
    // 校验失败提示信息
    protected $message = [
        'username.require' => '用户名是必需的',
        'username.string' => '用户名只能是字符串',
        'username.max' => '用户名最多只能包含10个字符',
        'username.min' => '用户名至少需要2个字符',
        'username.unique' => '用户名已存在',
        'password.require' => '密码是必需的',
        'password.string' => '密码只能是字符串',
        'password.min' => '密码至少需要6个字符',
        'password.max' => '密码最多只能包含18个字符',
        'status.integer' => '状态必须是整数',
        'status.in' => '状态在0到1之间',
        'create_time.require' => '创建时间不能为空',
        'create_time.datetime' => '创建时间必须是合法的日期时间格式',
        'update_time.datetime' => '更新时间必须是合法的日期时间格式',
        'email.email' => '邮箱格式不正确',
        'phone.mobile' => '手机号格式不正确',
        'role_id.integer' => '角色id必须是整数',
        'role_id.gt' => '角色id必须大于0'
    ];
    // 检验字段
    protected $scene = [
        'login'=>['username','password'],
        'add'=>['username','password','create_time','update_time','email','phone','role_id'],
        'edit'=>['username','status','update_time','email','phone','role_id'],
        'editPwd'=>['password','update_time']
    ];

}